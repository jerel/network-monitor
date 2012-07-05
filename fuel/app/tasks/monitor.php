<?php

namespace Fuel\Tasks;
use Model\Network;

/**
 * Monitor a network
 *
 * @package		Monitor
 * @version		1.0
 * @author		Jerel Unruh
 */

class Monitor extends \Controller
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
		$data = array();

		while(1)
		{
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
					// it's (back?) up
					self::$downtime[$result['location']] = array();
				}

				$data[] = $result;

				if (isset(self::$downtime[$result['location']]) and count(self::$downtime[$result['location']]) >= 5 and self::$last_notification < (time() - 1800))
				{
					self::notify();
				}
			}

			Network::write_log($data, self::$location);

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
