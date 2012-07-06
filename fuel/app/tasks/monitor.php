<?php

namespace Fuel\Tasks;
use Model\Network;
use Model\Log;

/**
 * Monitor a network
 *
 * @package		Monitor
 * @version		1.0
 * @author		Jerel Unruh
 */

class Monitor
{
	private static $location = './public/network/'; // log storage location
	private static $downtime = array();
	private static $downtime_allowed = 300; // seconds before a machine is considered down
	private static $ping_frequency = 60; // seconds between pinging all machines
	private static $notification_frequency = 30; // minutes between calls
	private static $last_notification;

	/**
	 * Usage (from command line):
	 *
	 * php oil r monitor
	 *
	 * @return void
	 */
	public static function run()
	{
		$hosts = array('192.168.1.1', '192.168.1.254');

		while(1)
		{
			$data = array();

			foreach ($hosts as $host)
			{
				$result = Network::ping(trim($host));

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

				if (isset(self::$downtime[$result['location']]) and count(self::$downtime[$result['location']]) >= 5 and self::$last_notification < (time() - 1800))
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

			sleep(self::$ping_frequency);
		}
	}

	public static function notify()
	{
		self::$last_notification = time();
		
		$json = file_get_contents(Network::$current_log);

		View::forge('report.php', json_decode($json));
	}
}

/* End of file tasks/monitor.php */
