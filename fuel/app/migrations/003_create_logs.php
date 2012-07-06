<?php

namespace Fuel\Migrations;

class Create_logs
{
	public function up()
	{
		\DBUtil::create_table('logs', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'log_data' => array('type' => 'text'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('logs');
	}
}