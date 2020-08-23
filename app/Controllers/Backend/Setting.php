<?php namespace App\Controllers\Backend;

class Setting extends AuthController
{
	public function index()
	{
		$data['title'] = 'Setting';
		$data['subtitle'] = 'Lorem ipsum dolor sit amet';
		return view('dashboard', $data);
	}

	//--------------------------------------------------------------------

}
