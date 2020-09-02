<?php namespace App\Controllers\Backend;

use App\Models\UsersModel;

class Login extends AuthController
{
	public function __construct() {
        $this->user = new UsersModel();
	}

	public function index()
	{	
		return view('login');
	}

	public function auth()
	{	
		$rules = [
			'username' => 'required',
			'password' => 'required|passcheck'
		];
		if(!$this->validate($rules)) {
			session()->setFlashdata('alert', $this->validation);
			return redirect('admin/login');
		} else {
			$username = $this->request->getPost('username');
			$password = $this->request->getPost('password');
			$auth = $this->user->authUser($username, $password);
			
			if($auth) {
				$userData = [
					'user_id'  		=> $auth['user_id'],
					'user_email'    => $auth['user_email'],
					'login' 		=> TRUE
				];
				
				session()->set($userData);
				return redirect(ADMINURL);
			} else {
				return redirect(ADMINURL.'/login');
			}	
		}
		   
	}

	//--------------------------------------------------------------------

}
