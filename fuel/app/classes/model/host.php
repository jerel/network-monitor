<?php
use Orm\Model;

class Model_Host extends Model
{
	protected static $_properties = array(
		'id',
		'location',
		'frequency',
		'notify_email',
		'notify_call',
		'notify_sms',
		'downtime_allowed',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('location', 'Location', 'required|max_length[255]');
		$val->add_field('frequency', 'Frequency', 'required|numeric_min[1]');
		$val->add_field('notify_email', 'Notify Email', 'required|max_length[255]');
		$val->add_field('notify_call', 'Notify Call', 'max_length[255]');
		$val->add_field('notify_sms', 'Notify Sms', 'max_length[255]');
		$val->add_field('downtime_allowed', 'Downtime Allowed', 'required|numeric_min[30]');

		return $val;
	}

}
