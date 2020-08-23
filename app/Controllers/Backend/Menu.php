<?php namespace App\Controllers\Backend;

class Menu extends AuthController
{
	public function index()
	{
		$data['title'] = 'Menu';
		$data['subtitle'] = 'Lorem ipsum dolor sit amet';
		return view('dashboard', $data);
	}

	//--------------------------------------------------------------------

}
