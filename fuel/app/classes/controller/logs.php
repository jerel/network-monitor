<?php
class Controller_Logs extends Controller_Template 
{

	public function action_index()
	{
		$data['logs'] = Model_Log::find('all', array('limit' => 10));
		$this->template->title = "Logs";
		$this->template->content = View::forge('logs/index', $data);

	}

	public function action_view($id = null)
	{
		$data['log'] = Model_Log::find($id);

		is_null($id) and Response::redirect('Logs');

		$this->template->title = "Log";
		$this->template->content = View::forge('logs/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Log::validate('create');
			
			if ($val->run())
			{
				$log = Model_Log::forge(array(
					'log_data' => Input::post('log_data'),
				));

				if ($log and $log->save())
				{
					Session::set_flash('success', 'Added log #'.$log->id.'.');

					Response::redirect('logs');
				}

				else
				{
					Session::set_flash('error', 'Could not save log.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Logs";
		$this->template->content = View::forge('logs/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('Logs');

		$log = Model_Log::find($id);

		$val = Model_Log::validate('edit');

		if ($val->run())
		{
			$log->log_data = Input::post('log_data');

			if ($log->save())
			{
				Session::set_flash('success', 'Updated log #' . $id);

				Response::redirect('logs');
			}

			else
			{
				Session::set_flash('error', 'Could not update log #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$log->log_data = $val->validated('log_data');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('log', $log, false);
		}

		$this->template->title = "Logs";
		$this->template->content = View::forge('logs/edit');

	}

	public function action_delete($id = null)
	{
		if ($log = Model_Log::find($id))
		{
			$log->delete();

			Session::set_flash('success', 'Deleted log #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete log #'.$id);
		}

		Response::redirect('logs');

	}


}