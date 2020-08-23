<?php namespace App\Controllers\Backend;

class Widget extends AuthController
{
	public function index()
	{
		$data['title'] = 'Widget';
		$data['subtitle'] = 'Lorem ipsum dolor sit amet';
		return view('dashboard', $data);
	}

	//--------------------------------------------------------------------

}
