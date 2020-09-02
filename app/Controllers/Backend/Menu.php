<?php namespace App\Controllers\Backend;

use \App\Models\RoleModel;
use \App\Models\RelationModel;
use \App\Models\MenuModel;
use \App\Models\SettingModel;
use \App\Models\ContentModel;

class Menu extends AuthController
{
	public function __construct()
	{
		helper('theme');
		helper('menu');
		$this->role = new RoleModel();
		$this->relation = new RelationModel();
		$this->menuitem = new MenuModel();
		$this->setting = new SettingModel();
		$this->content = new ContentModel();
		$this->type = 'menu';
	}

	public function index()
	{
		if(!$this->role->getType('menu')) {
			return redirect(ADMINURL.'/menu/add');
		}
		$data['menus'] = $this->role->getType($this->type);
		if(setting('default_menu')) {
		$default_menu = setting('default_menu');
		$data['detail'] = $this->role->getRole($default_menu);
		$data['items'] = $this->menuitem->getList($default_menu);
		}
		if(themeCheck()) {
		$data['positions'] = themeInfo('menu_position');
		$data['relations'] = $this->relation->getRelation($default_menu) == false?array():$this->relation->getRelation($default_menu);
		}
		$data['title'] = 'Menu';
		$data['subtitle'] = 'Menu/Navigation Configuration';
		return view('menu/menu', $data);
	}

	// ---------------------------- Add Menu -----------------------------

	public function add()
	{
		$rules = [
			'name' => 'required|is_unique_type[role.role_name,role_type,'.$this->type.']',
			'description' => 'required',
		];

		if(!$this->validate($rules)) {
			if($_POST) {
			session()->setFlashdata('alert', $this->validation->listErrors());
			}
			$data['title'] = 'Menu';
			$data['subtitle'] = 'Add Menu Group';
			return view('menu/add', $data);
		} else {
			$user_id = session()->user_id;
			$created_at = date('Y-m-d H:i:s');
			$name = $this->request->getPost('name');
			$slug = url_title($name, '-', true);
			$description = htmlentities($this->request->getPost('description'));
			
			$data = [
				'user_id' => $user_id,
				'created_at' => $created_at,
				'role_type' => $this->type,
				'role_name' => $name,
				'role_slug' => $slug,
				'role_description' => $description
			];
			
			$saved = $this->role->insertRole($data);
			
			if($saved)
			{
				$insert_id = $saved->connID->insert_id;
				$key = 'default_menu';
				if($this->setting->getSetting($key)) {
					// Update setting
					$this->setting->updateSetting(['setting_value' => $insert_id], $key);
				} else {
					// Insert setting
					$this->setting->insertSetting(['setting_name' => $key, 'setting_value' => $insert_id]);
				}
				session()->setFlashdata('alert', 'Menu has been added');
				return redirect()->to(base_url(ADMINURL.'/menu'));
			}
		}
	}

	// ---------------------------- Set Default Menu -----------------------------

	public function default($id = false)
	{
		if($id > 0) {
			$menu = $this->role->getRole($id);
			$key = 'default_menu';
			if($menu && $menu['role_type'] == 'menu') {
				$this->setting->updateSetting(['setting_value' => $id], $key);
				return redirect(ADMINURL.'/menu');
			}
		}
		return false;
	}

	// ---------------------------- Update Menu -----------------------------

	public function update() {
		$rules = [
			'menu_name' => 'required',
		];

		if(!$this->validate($rules)) {
			if($_POST) {
			session()->setFlashdata('alert', $this->validation->listErrors());
		}
		} else {
			// Update Menu
			$role_id = $this->request->getPost('role_id');
			$updated_at = date('Y-m-d H:i:s');
			$name = $this->request->getPost('menu_name');
			$slug = url_title($name, '-', true);
			$description = htmlentities($this->request->getPost('menu_description'));
			
			$data = [
				'updated_at' => $updated_at,
				'role_name' => $name,
				'role_slug' => $slug,
				'role_description' => $description
			];
			
			$saved = $this->role->updateRole($data, $role_id);
			
			if($saved){
				session()->setFlashdata('alert', 'Menu has been updated.');

				// Check Relation
				if($this->relation->getRelation($role_id)) {
					// Delete Position
					$this->relation->deleteRelation($role_id);
				}
				
				// Add Position
				$positions = !$this->request->getPost('menu_position')?array():$this->request->getPost('menu_position');
				if(count($positions) > 0) {
					foreach($positions as $position) {
						$pos = [
							'role_id' 		=> $role_id,
							'object_type'	=> 'menu_position',
							'object_value'	=> $position
						];

						$this->relation->insertRelation($pos);
					}
				}

				// Update Menu Item Order
				if ($this->request->getPost('menu'))
				{
					foreach ($this->request->getPost('menu') as $menu)
					{
						$menu_id = $menu['id'];
						$menu_parent = $menu['parent'];
						$menu_order = $menu['order'];
						$menu_item = [
							'menu_parent' => $menu_parent,
							'menu_order' => $menu_order,
						];

						$this->menuitem->updateMenu($menu_item, $menu_id);
					}
				}
			}
		}
		return redirect()->to(base_url(ADMINURL.'/menu'));
	}

	// ---------------------------- Delete Menu -----------------------------

	public function delete($id = false) {
		if($id > 0) {
			$this->role->deleteRole($id);
			$menus = $this->role->getType($this->type);
			if(count($menus) > 0) {
				$id = $menus[0]['role_id'];
				
				$menu = $this->role->getRole($id);
				$key = 'default_menu';
				if($menu && $menu['role_type'] == 'menu') {
					$this->setting->updateSetting(['setting_value' => $id], $key);
					session()->setFlashdata('alert', 'Menu item has been deleted');
				}
			}
		}
		return redirect(ADMINURL.'/menu');
	}

	// ---------------------------- Add Menu Item -----------------------------

	public function additem() {
		$rules = [
			'menu_item_type' => 'required',
			'menu_item_title' => 'required|is_unique[menu.menu_title]',
		];

		if(!$this->validate($rules)) {
			if($_POST) {
			session()->setFlashdata('alert', $this->validation->listErrors());
			}
		} else {
			$user_id = session()->user_id;
			$created_at = date('Y-m-d H:i:s');
			$role_id = $this->request->getPost('role_id');
			$type = $this->request->getPost('menu_item_type');
			$title = $this->request->getPost('menu_item_title');
			$slug = url_title($title, '-', true);
			$description = htmlentities($this->request->getPost('menu_item_description'));
			$order = $this->menuitem->getList($role_id)?(count($this->menuitem->getList($role_id))+1):1;
			
			$data = [
				'user_id' => $user_id,
				'created_at' => $created_at,
				'role_id'	=> $role_id,
				'menu_type' => $type,
				'menu_title' => $title,
				'menu_slug' => $slug,
				'menu_description' => $description,
				'menu_order'	=> $order
			];
			
			$saved = $this->menuitem->insertMenu($data);
			
			if($saved)
			{
				session()->setFlashdata('alert', 'Menu item has been added');
			}
		}
		return redirect()->to(base_url(ADMINURL.'/menu'));
	}

	// ---------------------------- Detail Menu Item -----------------------------

	public function detailitem($id = false) {
		if($id != false) {
		$menu = $this->menuitem->getMenu($id);
		if($menu) {
			$views = [
				[
					'title' => 'Custom Link',
					'type' => 'link',
					'view' => 'menu/detail_link',
				],
				[
					'title' => 'Detail Post',
					'type' => 'post',
					'view' => 'menu/detail_post',
				],
				[
					'title' => 'Detail Page',
					'type' => 'page',
					'view' => 'menu/detail_page',
				],
				[
					'title' => 'Detail Media',
					'type' => 'media',
					'view' => 'menu/detail_media',
				],
			];
			$data['menu'] = $menu;
			$data['pages'] = $this->content->getContent('page');
			$data['medias'] = $this->content->getContent('media');
			$data['sections'] = $this->role->getType('post_section');
			foreach($views as $view) {
				$data['title'] = $view['title'];
				if($menu['menu_type'] == $view['type']) {
					return view($view['view'], $data);
				}
			}
		}
		}
		return false;
	}

	// ---------------------------- Update Menu Item -----------------------------

	public function updateitem() {
		$rules = [
			'menu_id' => 'required',
			'menu_item_title' => 'required|is_unique[menu.menu_title, menu_id, {menu_id}]',
		];

		if(!$this->validate($rules)) {
			if($_POST) {
			session()->setFlashdata('alert', $this->validation->listErrors());
			}
		} else {
			$menu_id = $this->request->getPost('menu_id');
			$updated_at = date('Y-m-d H:i:s');
			$title = $this->request->getPost('menu_item_title');
			$slug = url_title($title, '-', true);
			$description = htmlentities($this->request->getPost('menu_item_description'));
			$url = $this->request->getPost('menu_item_url');
			
			$data = [
				'updated_at' => $updated_at,
				'menu_title' => $title,
				'menu_slug' => $slug,
				'menu_description' => $description,
				'menu_url'	=> $url
			];
			
			$saved = $this->menuitem->updateMenu($data, $menu_id);
			
			if($saved)
			{
				session()->setFlashdata('alert', 'Menu item has been updated');
			}
		}
		return '<script>setTimeout(function(){parent.jQuery.fancybox.close();parent.location.reload()}, 100);</script>';
	}

	// ---------------------------- Delete Menu Item -----------------------------

	public function deleteitem($id = false) {
		if($id > 0) {
			$this->menuitem->deleteMenu($id);
			session()->setFlashdata('alert', 'Menu item has been deleted');
		}
		return redirect(ADMINURL.'/menu');
	}
}
