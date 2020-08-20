<?php namespace App\Controllers\Backend;

class Logout extends AuthController
{
	public function index()
	{
		$session = session();
		$session->destroy();

		return redirect('admin/login');
	}

	//--------------------------------------------------------------------

}
