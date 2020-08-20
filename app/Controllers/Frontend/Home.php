<?php namespace App\Controllers\Frontend;

class Home extends BaseController
{
	public function index()
	{
		return view(THEMEVIEW.'/pages/home');
	}

	//--------------------------------------------------------------------

}
