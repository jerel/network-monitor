<?php

namespace Fuel\Migrations;

class Create_hosts
{
	public function up()
	{
		\DBUtil::create_table('hosts', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'location' => array('constraint' => 255, 'type' => 'varchar'),
			'notify_email' => array('constraint' => 255, 'type' => 'varchar'),
			'notify_call' => array('constraint' => 255, 'type' => 'varchar'),
			'notify_sms' => array('constraint' => 255, 'type' => 'varchar'),
			'downtime_allowed' => array('constraint' => 11, 'type' => 'int', 'default' => 60),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('hosts');
	}
}