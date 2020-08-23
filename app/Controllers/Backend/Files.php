<?php namespace App\Controllers\Backend;

class Files extends AuthController
{
	public function index()
	{
		$data['title'] = 'Files';
		$data['subtitle'] = 'Lorem ipsum dolor sit amet';
		return view('dashboard', $data);
	}

	//--------------------------------------------------------------------

}
