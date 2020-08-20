<?php namespace App\Controllers\Frontend;

class Page extends BaseController
{
	public function view($page = 'home')
	{
		if ( ! file_exists(ROOTTHEME.'/pages/'.$page.'.php'))
		{
			// Page/find not found!
			return view(THEMEVIEW.'/404');
		}
		
		return view(THEMEVIEW.'/pages/'.$page);
	}

	public function error() {
		return '404';
	}

	//--------------------------------------------------------------------

}
