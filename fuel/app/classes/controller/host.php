<?php
class Controller_Host extends Controller_Template 
{

	public function action_index()
	{
		$data['hosts'] = Model_Host::find('all');
		$this->template->title = "Hosts";
		$this->template->content = View::forge('host/index', $data);

	}

	public function action_view($id = null)
	{
		$data['host'] = Model_Host::find($id);

		is_null($id) and Response::redirect('Host');

		$this->template->title = "Host";
		$this->template->content = View::forge('host/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Host::validate('create');
			
			if ($val->run())
			{
				$host = Model_Host::forge(array(
					'location' => Input::post('location'),
					'monitor' => Input::post('monitor') > '' OR 1,
				));

				if ($host and $host->save())
				{
					Session::set_flash('success', 'Added host #'.$host->id.'.');

					Response::redirect('host');
				}

				else
				{
					Session::set_flash('error', 'Could not save host.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Hosts";
		$this->template->content = View::forge('host/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('Host');

		$host = Model_Host::find($id);

		$val = Model_Host::validate('edit');

		if ($val->run())
		{
			$host->location = Input::post('location');
			$host->monitor = Input::post('monitor');

			if ($host->save())
			{
				Session::set_flash('success', 'Updated host #' . $id);

				Response::redirect('host');
			}

			else
			{
				Session::set_flash('error', 'Could not update host #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$host->location = $val->validated('location');
				$host->monitor = $val->validated('monitor');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('host', $host, false);
		}

		$this->template->title = "Hosts";
		$this->template->content = View::forge('host/edit');

	}

	public function action_delete($id = null)
	{
		if ($host = Model_Host::find($id))
		{
			$host->delete();

			Session::set_flash('success', 'Deleted host #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete host #'.$id);
		}

		Response::redirect('host');

	}


}