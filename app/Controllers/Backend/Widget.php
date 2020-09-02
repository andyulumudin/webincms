<?php namespace App\Controllers\Backend;

use \App\Models\SettingModel;
use \App\Models\WidgetModel;

class Widget extends AuthController
{
	public function __construct()
	{
		helper('theme');
		$this->setting = new SettingModel();
		$this->widgetitem = new WidgetModel();

		$defaultWidget[] = [
			'name' => 'Image',
			'value'	=> 'image',
			'inputs'	=> [[
				'label'	=> 'Image',
				'type'	=> 'file',
				'name'	=> 'image',
			]]
		];
		$themeWidget = themeInfo('widgets');
		$this->widgets = array_merge($defaultWidget, $themeWidget);
	}

	//--------------------------------------------------------------------

	public function index()
	{
		$default_position = setting('widget_position');
		$data['positions'] = themeInfo('widget_position');
		$data['widgets'] = $this->widgets;

		if($default_position) {
		$data['items'] = $this->widgetitem->getList($default_position);
		}

		$data['title'] = 'Widget';
		$data['subtitle'] = 'Widget of Default Template';

		if($this->request->getGet('id') > 0) {
			$detail = $this->widgetitem->getWidget($this->request->getGet('id'));
			if($detail) {
				$data['detail'] = $detail;
				// // Search array key widgets from theme.json
				$key = array_search($detail['widget_name'], array_column($this->widgets, 'value'));
				// // Get widget name
				$title = $this->widgets[$key]['name'];
				$data['key'] = $key;
				$data['detail_title'] = $title;
			}
		}

		if(setting('widget_position')) {
		return view('widget/widget', $data);
		} else {
		return view('widget/widget_empty', $data);
		}
	}

	// ---------------------------- Set Default Widget Area -----------------------------

	public function default($position = false)
	{
		if($position !== false) {
			$key = 'widget_position';
			if($this->setting->getSetting($key)) {
				$this->setting->updateSetting(['setting_value' => $position], $key);
			} else {
				$this->setting->insertSetting(['setting_name' => $key, 'setting_value' => $position]);
			}
		}
		return redirect(ADMINURL.'/widget');
	}

	// ---------------------------- Set Order Widget -----------------------------

	public function setorder() {
		$id = $this->request->getPost('id');
		$order = $this->request->getPost('order');
		return $this->widgetitem->updateWidget(['widget_order' => $order], $id);
	}

	// ---------------------------- Add Widget -----------------------------

	public function add() {
		$rules = [
			'widget' => 'required',
		];

		if(!$this->validate($rules)) {
			if($_POST) {
			session()->setFlashdata('alert', $this->validation->listErrors());
			}
		} else {
			$position = setting('widget_position');
			$name = $this->request->getPost('widget');
			// Search array key widgets from theme.json
			$w = array_search($name, array_column($this->widgets, 'value'));
			// Get widget name
			$title = $this->widgets[$w]['name'];
			$order = $this->widgetitem->getList($position)?(count($this->widgetitem->getList($position))+1):1;
			$value = serialize(array());
			
			$data = [
				'widget_position'	=> $position,
				'widget_order'	=> $order,
				'widget_name' => $name,
				'widget_title' => $title,
				'widget_value' => $value,
			];
			
			$saved = $this->widgetitem->insertWidget($data);
			
			if($saved)
			{
				session()->setFlashdata('alert', 'Widget item has been added');
			}
		}
		return redirect()->to(base_url(ADMINURL.'/widget'));
	}

	// ---------------------------- Edit Widget -----------------------------

	public function edit() {
		$rules = [
			'widget_id' => 'required',
		];
		$id = $this->request->getPost('widget_id');

		if(!$this->validate($rules)) {
			if($_POST) {
			session()->setFlashdata('alert', $this->validation->listErrors());
			}
		} else {
			$posts = $this->request->getPost();
			$req = array();
			foreach($posts as $key => $post) {
				if($key != 'widget_id') {
					$req[$key] = $post;
				}
			}
			$value = serialize($req);
			
			$saved = $this->widgetitem->updateWidget(['widget_value' => $value], $id);
			
			if($saved)
			{
				session()->setFlashdata('alert', 'Widget item has been updated');
			}
		}
		return redirect()->to(base_url(ADMINURL.'/widget?id='.$id));
	}

	// ---------------------------- Delete Widget -----------------------------

	public function delete($id = false) {
		if($id > 0) {
			$this->widgetitem->deleteWidget($id);
			session()->setFlashdata('alert', 'Widget item has been deleted');
		}
		return redirect(ADMINURL.'/widget');
	}
}
