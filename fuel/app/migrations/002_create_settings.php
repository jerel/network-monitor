<?php

namespace Fuel\Migrations;

class Create_settings
{
	public function up()
	{
		\DBUtil::create_table('settings', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'slug' => array('constraint' => 255, 'type' => 'varchar'),
			'value' => array('type' => 'text'),
			'required' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),

		), array('id'));

		$query = \DB::insert('settings');

		// Set the columns and values
		$query->set(array(
		    'slug' => 'frequency',
		    'value' => 60,
		    'required' => 1,
		))->execute();
	}

	public function down()
	{
		\DBUtil::drop_table('settings');
	}
}