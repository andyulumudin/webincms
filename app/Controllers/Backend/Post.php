<?php namespace App\Controllers\Backend;

use \App\Models\ContentModel;
use \App\Models\RoleModel;

class Post extends AuthController
{
	public function __construct()
	{
		$this->content = new ContentModel();
		$this->role = new RoleModel();
		$this->type = 'post';
	}

	public function index()
	{
		$data['posts'] = $this->content->getContent($this->type);
		$data['title'] = 'Post';
		$data['subtitle'] = 'List of post';
		return view('post/post', $data);
	}

	public function add()
	{
		$rules = [
			'title' => 'required|is_unique[content.content_title]',
			'excerpt' => 'required',
		];

		if(!$this->validate($rules)) {
			if($_POST) {
			session()->setFlashdata('alert', $this->validation->listErrors());
			}
			$data['title'] = 'Add Post';
			$data['subtitle'] = 'Add new post';
			return view('post/add', $data);
		} else {
			$user_id = session()->user_id;
			$created_at = date('Y-m-d H:i:s');
			$template = $this->type;
			$title = $this->request->getPost('title');
			$slug = url_title($title, '-', true);
			$excerpt = $this->request->getPost('excerpt');
			$body = htmlentities($this->request->getPost('body'));
			$meta_title = $this->request->getPost('meta_title');
			$meta_desc = $this->request->getPost('meta_desc');
			$publish_date = $this->request->getPost('publish_date');
			$publish = $this->request->getPost('publish');
			$language = $this->request->getPost('language');
			
			$data = [
				'user_id' => $user_id,
				'created_at' => $created_at,
				'content_type' => $this->type,
				'content_template' => $template,
				'content_title' => $title,
				'content_slug' => $slug,
				'content_excerpt' => $excerpt,
				'content_body' => $body,
				'content_meta_title' => $meta_title,
				'content_meta_desc' => $meta_desc,
				'content_publish_date' => $publish_date,
				'content_status' => $publish,
				'content_lang' => $language,
			];
			
			$saved = $this->content->insertContent($data);
			
			if($saved)
			{
				session()->setFlashdata('info', 'Post has been added');
				return redirect()->to(base_url(ADMINURL.'/post'));
			}
		}
    }

	//--------------------------------------------------------------------

	public function edit($id)
	{
		$rules = [
			'title' => 'required|is_unique[content.content_title, content_id, {id}]',
			'excerpt' => 'required',
		];

		if(!$this->validate($rules)) {
			if($_POST) {
			session()->setFlashdata('alert', $this->validation->listErrors());
			}
			$data['post'] = $this->content->getContent($this->type, $id);
			$data['title'] = 'Edit Post';
			$data['subtitle'] = 'Edit previous post';
			return view('post/edit', $data);
		} else {
			$id = $this->request->getPost('id');
			$updated_at = date('Y-m-d H:i:s');
			$title = $this->request->getPost('title');
			$slug = url_title($title, '-', true);
			$excerpt = $this->request->getPost('excerpt');
			$body = htmlentities($this->request->getPost('body'));
			$meta_title = $this->request->getPost('meta_title');
			$meta_desc = $this->request->getPost('meta_desc');
			$publish_date = $this->request->getPost('publish_date');
			$publish = $this->request->getPost('publish');
			$language = $this->request->getPost('language');

			$data = [
				'updated_at' => $updated_at,
				'content_title' => $title,
				'content_slug' => $slug,
				'content_excerpt' => $excerpt,
				'content_body' => $body,
				'content_meta_title' => $meta_title,
				'content_meta_desc' => $meta_desc,
				'content_publish_date' => $publish_date,
				'content_lang' => $language,
				'content_status' => $publish,
			];
			
			$saved = $this->content->updateContent($data, $id);
			
			if($saved)
			{
				session()->setFlashdata('info', 'Post has been updated');
				return redirect()->to(base_url(ADMINURL.'/post'));
			}
		}
	}
	
	//---------------------- Delete Post --------------------------

	public function delete($id)
    {
        $deleted = $this->content->deleteContent($id);

        if($deleted)
        {
            session()->setFlashdata('info', 'Deleted post successfully');
            return redirect()->to(base_url(ADMINURL.'/post'));
        }
	}

	//---------------------- Post Section --------------------------
	
	public function section()
	{
		$data['sections'] = $this->role->getType('post_section');
		$data['title'] = 'Post Section';
		$data['subtitle'] = 'List of post section';
		return view('post/section', $data);
	}

	public function addsection()
	{
		$rules = [
			'name' => 'required|is_unique_type[role.role_name,role_type,post_section]'
		];

		if(!$this->validate($rules)) {
			if($_POST) {
			session()->setFlashdata('alert', $this->validation->listErrors());
			}
		} else {
			$user_id = session()->user_id;
			$created_at = date('Y-m-d H:i:s');
			$type = 'post_section';
			$name = $this->request->getPost('name');
			$slug = url_title($name, '-', true);
			
			$data = [
				'user_id' => $user_id,
				'created_at' => $created_at,
				'role_type' => $type,
				'role_name' => $name,
				'role_slug' => $slug,
				'role_url' => $slug,
				'role_description' => $name,
			];
			
			$saved = $this->role->insertRole($data);
			
			if($saved)
			{
				session()->setFlashdata('info', 'Post section has been added');
			}
		}
		return redirect(ADMINURL.'/post/section');
    }

	//--------------------------------------------------------------------

	public function editsection($id)
	{
		$rules = [
			'name' => 'required|is_unique_type[role.role_name,role_type,post_section,role_id,{role_id}]'
		];

		if(!$this->validate($rules)) {
			if($_POST) {
			session()->setFlashdata('alert', $this->validation->listErrors());
			}
		} else {
			$role_id = $this->request->getPost('role_id');
			$updated_at = date('Y-m-d H:i:s');
			$name = $this->request->getPost('name');
			$slug = url_title($name, '-', true);
			
			$data = [
				'updated_at' => $updated_at,
				'role_name' => $name,
				'role_slug' => $slug,
				'role_url' => $slug,
				'role_description' => $name,
			];
			
			$saved = $this->role->updateRole($data, $role_id);
			
			if($saved)
			{
				session()->setFlashdata('info', 'Post section has been added');
			}
		}
		return redirect(ADMINURL.'/post/section');
	}
	
	//---------------------- Delete Post --------------------------

	public function deletesection($id)
    {
        $deleted = $this->role->deleteRole($id);

        if($deleted)
        {
            session()->setFlashdata('info', 'Deleted post section successfully');
            return redirect()->to(base_url(ADMINURL.'/post/section'));
        }
    }

}
