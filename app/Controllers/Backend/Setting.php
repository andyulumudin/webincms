<?php namespace App\Controllers\Backend;

use \App\Models\SettingModel;

class Setting extends AuthController
{
	function __construct()
	{
		helper('website');
		$this->datasetting = new SettingModel();
	}
	public function index()
	{
		$data['title'] = 'Setting';
		$data['subtitle'] = 'Website configuration';
		return view('setting/general', $data);
	}

	public function save()
	{	
		$adminurl = false;
		$reqs = $this->request->getPost();
		if(count($reqs) > 0) {
			foreach($reqs as $key => $req) {
				if($key == 'admin_url') {
					// Get new adminurl
					if(ADMINURL != $req) {
						$adminurl = $req;
					}
				} else {
					if($this->datasetting->getSetting($key)) {
						// Update setting
						$this->datasetting->updateSetting(['setting_value' => $req], $key);
					} else {
						// Insert setting
						$this->datasetting->insertSetting(['setting_name' => $key, 'setting_value' => $req]);
					}
				}
			}
		}
		if($adminurl != false) {
			// Update website.json
			website('adminurl', $adminurl); 
			// Save new admin url -> bring to Controllers/Frontend/Page.php/view, because new admin url is error
			session()->setFlashdata('adminurl', $adminurl); 
		}
		// Can't redirect to new admin. Old admin = error page (Controllers/Frontend/Page.php/view)
		return redirect(ADMINURL.'/setting');
    }

	//--------------------------------------------------------------------

}
