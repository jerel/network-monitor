<?php

namespace Fuel\Tasks;
use Package;
use Model\Network;
use Model\Log;
use Model\Setting;
use Uri;
use Config;
use Twilio;

/**
 * Monitor a network
 *
 * @package		Monitor
 * @version		1.0
 * @author		Jerel Unruh
 */

class Monitor
{
	public static $setting;
	private static $downtime = array();
	private static $last_notification = false;

	/**
	 * Usage (from command line):
	 *
	 * php oil r monitor
	 *
	 * @return void
	 */
	public static function run()
	{
		while(1)
		{
			$data = array();

			// grab the servers that we'll be monitoring
			$hosts = \Model_Host::find('all', array('where' => array('monitor' => 1)));

			// get all settings (we do this in the loop so changes take effect without restarting the task)
			static::$setting = new \stdClass();
			$settings = \Model_Setting::find('all');

			// build a cute little object of all settings
			foreach ($settings as $setting)
			{
				if ($setting->slug === 'notify_sms' or $setting->slug === 'notify_email')
				{
					static::$setting->{$setting->slug} = explode("\n", $setting->value);

					continue;
				}

				static::$setting->{$setting->slug} = $setting->value;
			}

			// check the status of each server
			foreach ($hosts as $host)
			{
				$result = Network::ping(trim($host->location));

				// is the server down?
				if ( ! $result['latency'])
				{
					$down_at = time();

					// store the time for that server so we can see how long it's down
					self::$downtime[$result['location']][] = $down_at;

					$result['down_at'] = $down_at;
				}
				else
				{
					// it's (back?) up reset the downtime counter
					self::$downtime[$result['location']] = array();
				}

				$data[] = $result;

				if (isset(self::$downtime[$result['location']]) and (count(self::$downtime[$result['location']]) * static::$setting->ping_frequency) > static::$setting->downtime_allowed)
				{
					self::notify();
				}
			}

			// save the log to the database
			$log = new \Model_Log();
			$log->log_data = json_encode($data);
			$log->save();

			// clean up old logs
			unset($data);

			sleep(static::$setting->ping_frequency);
		}
	}

	public static function notify()
	{
		\Package::load('fuel-twilio');
		\Package::load('email');

		// if they're due for a notification then send it
		if ( ! self::$last_notification or self::$last_notification + (static::$setting->notification_frequency) < time())
		{
			self::$last_notification = time();

			// grab the keys from the downtime array where the value is not empty
			$down_locations = array_keys(self::$downtime, TRUE);

			if (static::$setting->notify_sms)
			{
				\Config::load('twilio', true);
				\Config::set('twilio.account_sid', static::$setting->twilio_account_sid);
				\Config::set('twilio.auth_token', static::$setting->twilio_auth_token);

				foreach (static::$setting->notify_sms as $sms_to)
				{
					$sms = Twilio\Twilio::request('SmsMessage');
					$response = $sms->create(array(
						'To' => $sms_to,
						'From' => static::$setting->twilio_from_phone_number,
						'Body' => substr("The following servers at ".static::$setting->organization_name." appear to be down:\n".implode("\n", $down_locations), 0, 159)
					));
				}
			}

			if (static::$setting->notify_email)
			{
				$email = \Email::forge(array(
					'driver' => static::$setting->email_driver,
					'smtp' => array(
						'host' => static::$setting->smtp_host,
						'port' => static::$setting->smtp_port,
						'username' => static::$setting->smtp_username,
						'password' => static::$setting->smtp_password
						)
					)
				);

				$email->to(static::$setting->notify_email)
					->from(static::$setting->email_address_from)
					->subject(static::$setting->email_subject)
					->body("The following servers at ".static::$setting->organization_name." appear to be down:\n".implode("\n", $down_locations))
					->send();
			}
		}
	}
}

/* End of file tasks/monitor.php */
