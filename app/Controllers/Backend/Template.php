<?php namespace App\Controllers\Backend;

use \App\Models\SettingModel;

class Template extends AuthController
{
	function __construct()
	{
		helper('theme');
		$this->setting = new SettingModel();
	}

	public function index($theme = false)
	{
		if($theme != false && themeCheck($theme)) {
			$data = $this->setting->getSetting('customize');
			$value = $data['setting_value'];
			$setting = unserialize($value);
			$header = $setting['header'];
			$footer = $setting['footer'];

			$detail = [
				'theme' => $theme,
				'header' => $header,
				'footer' => $footer
			];
			$data['detail'] = $detail;
		}
		$data['themes'] = themeList();
		$data['title'] = 'Template';
		$data['subtitle'] = 'Template option';
		return view('template/template', $data);
	}

	public function update()
	{	
		$data = $this->setting->getSetting('customize');
		$theme = $this->request->getPost('theme');
		$header = $this->request->getPost('header');
		$footer = $this->request->getPost('footer');
		$value = ['header' => $header, 'footer' => $footer];
		$setting_value = serialize($value);
	
		if($data) {
			$this->setting->updateSetting(['setting_value' => $setting_value], 'customize');
		} else {
			$this->setting->insertSetting(['setting_name' => 'customize', 'setting_value' => $setting_value]);
		}
		
		session()->setFlashdata('alert', $theme.' customize has been updated.'); 
		
		return redirect(ADMINURL.'/template');
    }

	//--------------------------------------------------------------------

}
