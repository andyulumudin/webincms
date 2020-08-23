<?php namespace App\Controllers\Backend;

use \App\Models\ContentModel;

class Post extends AuthController
{
	public function __construct()
	{
		$this->content = new ContentModel();
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
			];
			
			$saved = $this->content->insertContent($data);
			
			if($saved)
			{
				session()->setFlashdata('info', 'Post has been added');
				return redirect()->to(base_url('admin/post'));
			}
		}
    }

	//--------------------------------------------------------------------

	public function edit($id)
	{
		$rules = [
			'title' => 'required|is_unique[content.content_title]',
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

			$data = [
				'updated_at' => $updated_at,
				'content_title' => $title,
				'content_slug' => $slug,
				'content_excerpt' => $excerpt,
				'content_body' => $body,
				'content_meta_title' => $meta_title,
				'content_meta_desc' => $meta_desc,
				'content_publish_date' => $publish_date,
				'content_status' => $publish,
			];
			
			$saved = $this->content->updateContent($data, $id);
			
			if($saved)
			{
				session()->setFlashdata('info', 'Post has been added');
				return redirect()->to(base_url('admin/post'));
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
            return redirect()->to(base_url('admin/post'));
        }
    }

}
