<?php namespace App\Controllers\Backend;

class Login extends AuthController
{
	public function index()
	{	
		return view('login');
	}

	public function auth()
	{	
		$request = \Config\Services::request();
		$username = $request->getPost('username');
		$password = $request->getPost('password');

		$db      = \Config\Database::connect('default');
		$builder = $db->table('users');
		$builder->where('users_name', $username);
		$builder->where('users_password', md5($password));
		$query = $builder->get();
		foreach ($query->getResult() as $row)
		{
			$this->session->set('login',true);
			$this->session->set('user_id',$row->users_id);
			$this->session->set('user_name',$row->users_name);
		}
		
		return redirect('admin/dashboard');
	}

	//--------------------------------------------------------------------

}
