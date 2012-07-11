<?php
use Orm\Model;

class Model_Host extends Model
{
	protected static $_properties = array(
		'id',
		'location',
		'monitor',
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
		$val->add_field('monitor', 'Monitor', 'match_pattern[/^[0-1]$/]');

		return $val;
	}

}
