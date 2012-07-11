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

		\DB::insert('settings')->set(array(
		    'slug' => 'organization_name',
		    'value' => 'Company Name',
		    'required' => 1,
		    )
		)->execute();

		\DB::insert('settings')->set(array(
		    'slug' => 'notify_sms',
		    'value' => '',
		    'required' => 1,
		    )
		)->execute();

		\DB::insert('settings')->set(array(
		    'slug' => 'notify_email',
		    'value' => '',
		    'required' => 1,
		    )
		)->execute();

		\DB::insert('settings')->set(array(
		    'slug' => 'ping_frequency',
		    'value' => 60,
		    'required' => 1,
		    )
		)->execute();

		\DB::insert('settings')->set(array(
		    'slug' => 'downtime_allowed',
		    'value' => 300,
		    'required' => 1,
		    )
		)->execute();

		\DB::insert('settings')->set(array(
		    'slug' => 'notification_frequency',
		    'value' => 900,
		    'required' => 1,
		    )
		)->execute();

		\DB::insert('settings')->set(array(
		    'slug' => 'twilio_account_sid',
		    'value' => '',
		    'required' => 1,
		    )
		)->execute();

		\DB::insert('settings')->set(array(
		    'slug' => 'twilio_auth_token',
		    'value' => '',
		    'required' => 1,
		    )
		)->execute();

		\DB::insert('settings')->set(array(
		    'slug' => 'twilio_from_phone_number',
		    'value' => '',
		    'required' => 1,
		    )
		)->execute();

		\DB::insert('settings')->set(array(
		    'slug' => 'email_driver',
		    'value' => '',
		    'required' => 1,
		    )
		)->execute();

		\DB::insert('settings')->set(array(
		    'slug' => 'email_address_from',
		    'value' => '',
		    'required' => 1,
		    )
		)->execute();

		\DB::insert('settings')->set(array(
		    'slug' => 'email_name_from',
		    'value' => '',
		    'required' => 1,
		    )
		)->execute();

		\DB::insert('settings')->set(array(
		    'slug' => 'email_subject',
		    'value' => '',
		    'required' => 1,
		    )
		)->execute();

		\DB::insert('settings')->set(array(
		    'slug' => 'smtp_host',
		    'value' => '',
		    'required' => 1,
		    )
		)->execute();

		\DB::insert('settings')->set(array(
		    'slug' => 'smtp_port',
		    'value' => '',
		    'required' => 1,
		    )
		)->execute();

		\DB::insert('settings')->set(array(
		    'slug' => 'smtp_username',
		    'value' => '',
		    'required' => 1,
		    )
		)->execute();

		\DB::insert('settings')->set(array(
		    'slug' => 'smtp_password',
		    'value' => '',
		    'required' => 1,
		    )
		)->execute();
	}

	public function down()
	{
		\DBUtil::drop_table('settings');
	}
}