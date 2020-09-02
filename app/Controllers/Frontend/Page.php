<?php namespace App\Controllers\Frontend;

class Page extends BaseController
{
	public function view($page = 'home')
	{
		if ( ! file_exists(ROOTTHEME.'/pages/'.$page.'.php'))
		{
			// Get from ADMINURL/setting/save
			$adminurl = session()->getFlashdata('adminurl');
			if($adminurl == '') {
				// Page/find not found!
				return view(THEMEVIEW.'/404');
			} else {
				// Redirect to new admin
				return redirect($adminurl.'/setting');
			}
		}
		
		return view(THEMEVIEW.'/pages/'.$page);
	}

	public function error() {
		return '404';
	}

	//--------------------------------------------------------------------

}
