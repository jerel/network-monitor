<?php
class Controller_Settings extends Controller_Template 
{

	public function action_index()
	{
		$data['settings'] = Model_Setting::find('all');
		$this->template->title = "Settings";
		$this->template->content = View::forge('settings/index', $data);

	}

	public function action_view($id = null)
	{
		$data['setting'] = Model_Setting::find($id);

		is_null($id) and Response::redirect('Settings');

		$this->template->title = "Setting";
		$this->template->content = View::forge('settings/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Setting::validate('create');
			
			if ($val->run())
			{
				$setting = Model_Setting::forge(array(
					'slug' => Input::post('slug'),
					'value' => Input::post('value'),
					'required' => Input::post('required'),
				));

				if ($setting and $setting->save())
				{
					Session::set_flash('success', 'Added setting #'.$setting->id.'.');

					Response::redirect('settings');
				}

				else
				{
					Session::set_flash('error', 'Could not save setting.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Settings";
		$this->template->content = View::forge('settings/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('Settings');

		$setting = Model_Setting::find($id);

		$val = Model_Setting::validate('edit');

		if ($val->run())
		{
			$setting->slug = Input::post('slug');
			$setting->value = Input::post('value');
			$setting->required = Input::post('required');

			if ($setting->save())
			{
				Session::set_flash('success', 'Updated setting #' . $id);

				Response::redirect('settings');
			}

			else
			{
				Session::set_flash('error', 'Could not update setting #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$setting->slug = $val->validated('slug');
				$setting->value = $val->validated('value');
				$setting->required = $val->validated('required');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('setting', $setting, false);
		}

		$this->template->title = "Settings";
		$this->template->content = View::forge('settings/edit');

	}

	public function action_delete($id = null)
	{
		if ($setting = Model_Setting::find($id))
		{
			$setting->delete();

			Session::set_flash('success', 'Deleted setting #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete setting #'.$id);
		}

		Response::redirect('settings');

	}


}