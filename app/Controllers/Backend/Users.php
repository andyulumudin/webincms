<?php namespace App\Controllers\Backend;

use App\Models\UsersModel;

class Users extends AuthController
{
	public function __construct() {
		helper('form');
        $this->user = new UsersModel();
	}
	
	public function index()
	{
		$data['users'] = $this->user->getUser();
		$data['title'] = 'Users';
		$data['subtitle'] = 'User list';
		return view('users/users', $data);
	}

	//---------------------- User Profile --------------------------

	public function profile()
	{
		$rules = [
			'user_name' => 'required',
			'user_email' => 'required|valid_email'
		];
		if($this->request->getPost('password') !== '') {
		$rules['password'] = 'required';
		$rules['pass_confirm'] = 'required|matches[password]';
		}

		if(!$this->validate($rules)) {
			if($_POST) {
			session()->setFlashdata('alert', $this->validation->listErrors());
			}
			$id = session()->user_id;
			$data['user'] = $this->user->getUser($id);
			$data['title'] = 'My Profile';
			$data['subtitle'] = 'User profile detail page';
			
			return view('users/profile', $data);
		} else {
			$id = session()->user_id;
			$name = $this->request->getPost('user_name');
			$email = $this->request->getPost('user_email');
			$password = $this->request->getPost('password');
			$data = [
				'user_name' => $name,
				'user_email' => $email
			];
			
			if($password !== '') {
				$data['user_password'] = md5($password);
			}
			
			$updated = $this->user->updateUser($data, $id);
			
			if($updated)
			{
				session()->setFlashdata('alert', 'Updated profile successfully');
				return redirect()->to(base_url(ADMINURL.'/profile')); 
			}
		}
	}

	//---------------------- User Add --------------------------

	public function add()
	{
		$rules = [
			'user_name' => 'required',
			'user_email' => 'required|valid_email|is_unique[users.user_email]',
			'user_account' => 'required|is_unique[users.user_account]',
			'password' => 'required',
			'pass_confirm' => 'required|matches[password]',
		];

		if(!$this->validate($rules)) {
			if($_POST) {
			session()->setFlashdata('info', $this->validation->listErrors());
			}
			$data['title'] = 'Add User';
			$data['subtitle'] = 'Add new user';
			return view('users/add', $data);
		} else {
			$name = $this->request->getPost('user_name');
			$email = $this->request->getPost('user_email');
			$account = $this->request->getPost('user_account');
			$password = $this->request->getPost('password');

			$data = [
				'user_name' => $name,
				'user_email' => $email,
				'user_account' => $account,
				'user_password' => md5($password),
			];
			
			$saved = $this->user->insertUser($data);
			
			if($saved)
			{
				session()->setFlashdata('info', 'Add user successfully');
				return redirect()->to(base_url(ADMINURL.'/users'));
			}
		}
    }

	//---------------------- User Edit --------------------------

	public function edit($id)
	{
		$rules = [
			'user_name' => 'required',
			'user_email' => 'required|valid_email'
		];
		if($this->request->getPost('password') !== '') {
		$rules['password'] = 'required';
		$rules['pass_confirm'] = 'required|matches[password]';
		}

		if(!$this->validate($rules)) {
			if($_POST) {
			session()->setFlashdata('alert', $this->validation->listErrors());
			}

			$data['user'] = $this->user->getUser($id);
			$data['title'] = 'Edit User';
			$data['subtitle'] = 'Edit user page';
			return view('users/edit', $data);
		} else {
			$name = $this->request->getPost('user_name');
			$email = $this->request->getPost('user_email');
			$password = $this->request->getPost('password');
			$data = [
				'user_name' => $name,
				'user_email' => $email
			];
			
			if($password !== '') {
				$data['user_password'] = md5($password);
			}
			
			$updated = $this->user->updateUser($data, $id);
			
			if($updated)
			{
				session()->setFlashdata('alert', 'Updated user successfully');
				return redirect()->to(base_url(ADMINURL.'/users')); 
			}
		}
	}

	//---------------------- Delete User --------------------------

	public function delete($id)
    {
        $deleted = $this->user->deleteUser($id);

        if($deleted)
        {
            session()->setFlashdata('info', 'Deleted user successfully');
            return redirect()->to(base_url(ADMINURL.'/users'));
        }
    }

}
