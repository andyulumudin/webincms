<?php namespace App\Controllers\Backend;

use \App\Models\ContentModel;

class Page extends AuthController
{
	public function __construct()
	{
		$this->content = new ContentModel();
		$this->type = 'page';
	}
	public function index()
	{
		$data['pages'] = $this->content->getContent($this->type);
		$data['title'] = 'Page';
		$data['subtitle'] = 'List of pages';
		return view('page/page', $data);
	}

	public function add()
	{
		$rules = [
			'title' => 'required|is_unique[content.content_title]',
			'body' => 'required',
		];

		if(!$this->validate($rules)) {
			if($_POST) {
			session()->setFlashdata('alert', $this->validation->listErrors());
			}
			$data['title'] = 'Add Page';
			$data['subtitle'] = 'Add new page';
			return view('page/add', $data);
		} else {
			$user_id = session()->user_id;
			$created_at = date('Y-m-d H:i:s');
			$template = $this->request->getPost('template')?$this->request->getPost('template'):$this->type;
			$title = $this->request->getPost('title');
			$slug = url_title($title, '-', true);
			$body = htmlentities($this->request->getPost('body'));
			$meta_title = $this->request->getPost('meta_title');
			$meta_desc = $this->request->getPost('meta_desc');
			$publish_date = date('Y-m-d');
			$publish = $this->request->getPost('publish');
			$language = $this->request->getPost('language');
			
			$data = [
				'user_id' => $user_id,
				'created_at' => $created_at,
				'content_type' => $this->type,
				'content_template' => $template,
				'content_title' => $title,
				'content_slug' => $slug,
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
				session()->setFlashdata('info', 'Page has been added');
				return redirect()->to(base_url(ADMINURL.'/page'));
			}
		}
    }

	//--------------------------------------------------------------------

	public function edit($id)
	{
		$rules = [
			'title' => 'required|is_unique[content.content_title, content_id, {id}]',
			'body' => 'required',
		];

		if(!$this->validate($rules)) {
			if($_POST) {
			session()->setFlashdata('alert', $this->validation->listErrors());
			}
			$data['page'] = $this->content->getContent($this->type, $id);
			$data['title'] = 'Edit Page';
			$data['subtitle'] = 'Edit previous page';
			return view('page/edit', $data);
		} else {
			$id = $this->request->getPost('id');
			$updated_at = date('Y-m-d H:i:s');
			$template = $this->request->getPost('template')?$this->request->getPost('template'):$this->type;
			$title = $this->request->getPost('title');
			$slug = url_title($title, '-', true);
			$body = htmlentities($this->request->getPost('body'));
			$meta_title = $this->request->getPost('meta_title');
			$meta_desc = $this->request->getPost('meta_desc');
			$publish = $this->request->getPost('publish');
			$language = $this->request->getPost('language');

			$data = [
				'updated_at' => $updated_at,
				'content_template' => $template,
				'content_title' => $title,
				'content_slug' => $slug,
				'content_body' => $body,
				'content_meta_title' => $meta_title,
				'content_meta_desc' => $meta_desc,
				'content_status' => $publish,
				'content_lang' => $language,
			];
			
			$saved = $this->content->updateContent($data, $id);
			
			if($saved)
			{
				session()->setFlashdata('info', 'Page has been updated');
				return redirect()->to(base_url(ADMINURL.'/page'));
			}
		}
	}
	
	//---------------------- Delete Page --------------------------

	public function delete($id)
    {
        $deleted = $this->content->deleteContent($id);

        if($deleted)
        {
            session()->setFlashdata('info', 'Deleted page successfully');
            return redirect()->to(base_url(ADMINURL.'/page'));
        }
    }

}
