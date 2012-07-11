<?php

namespace Fuel\Migrations;

class Create_hosts
{
	public function up()
	{
		\DBUtil::create_table('hosts', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'location' => array('constraint' => 255, 'type' => 'varchar'),
			'monitor' => array('constraint' => 1, 'type' => 'tinyint'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('hosts');
	}
}