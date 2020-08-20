<?php namespace App\Controllers\Backend;

class Dashboard extends AuthController
{
	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['subtitle'] = 'Lorem ipsum dolor sit amet';
		return view('dashboard', $data);
	}

	//--------------------------------------------------------------------

}
