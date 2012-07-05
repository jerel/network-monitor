<?php

namespace Model;

class Network extends \Model{

	public static $current_log = false;

	public static function ping($host = '192.168.1.1', $timeout = 1)
	{
		/* ICMP ping packet with a pre-calculated checksum */
		$package = "\x08\x00\x7d\x4b\x00\x00\x00\x00PingHost";
		$socket  = socket_create(AF_INET, SOCK_RAW, 1);
		socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => $timeout, 'usec' => 0));
		socket_connect($socket, $host, null);

		$ts = microtime(true);
		socket_send($socket, $package, strLen($package), 0);

		if (socket_read($socket, 255))
		{
			$result = microtime(true) - $ts;
		}
		else
		{
			$result = false;
		}
		
		socket_close($socket);

		return array('up' => (bool) $result, 'location' => $host, 'latency' => $result, 'down_at' => false);
	}

	public static function write_log($data, $log_location)
	{
		$folder = $log_location.date('Y/F').'/';
		$filename = date('H:00').'.json';
		self::$current_log = $folder.'/'.$filename;

		is_dir($folder) OR mkdir($folder, 0777, TRUE);

		$fh = fopen($folder.'/'.$filename, 'a');
		fwrite($fh, json_encode($data)."\n");
		fclose($fh);

		return true;
	}
}