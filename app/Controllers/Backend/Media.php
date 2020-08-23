<?php namespace App\Controllers\Backend;

use \App\Models\ContentModel;

class Media extends AuthController
{
	public function __construct()
	{
		$this->content = new ContentModel();
		$this->type = 'media';
	}
	public function index()
	{
		$data['medias'] = $this->content->getContent($this->type);
		$data['title'] = 'Media';
		$data['subtitle'] = 'List of medias';
		return view('media/media', $data);
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
			$data['title'] = 'Add Media';
			$data['subtitle'] = 'Add new media';
			return view('media/add', $data);
		} else {
			$user_id = session()->user_id;
			$created_at = date('Y-m-d H:i:s');
			$template = $this->type;
			$title = $this->request->getPost('title');
			$slug = url_title($title, '-', true);
			$body = htmlentities($this->request->getPost('body'));
			$publish_date = date('Y-m-d');
			$publish = $this->request->getPost('publish');
			$tags = $this->request->getPost('tags');
			
			$data = [
				'user_id' => $user_id,
				'created_at' => $created_at,
				'content_type' => $this->type,
				'content_template' => $template,
				'content_title' => $title,
				'content_slug' => $slug,
				'content_body' => $body,
				'content_tags' => $tags,
				'content_publish_date' => $publish_date,
				'content_status' => $publish,
			];
			
			$saved = $this->content->insertContent($data);
			
			if($saved)
			{
				session()->setFlashdata('info', 'Media has been added');
				return redirect()->to(base_url('admin/media'));
			}
		}
    }

	//--------------------------------------------------------------------

	public function edit($id)
	{
		$rules = [
			'title' => 'required|is_unique[content.content_title]',
			'body' => 'required',
		];

		if(!$this->validate($rules)) {
			if($_POST) {
			session()->setFlashdata('alert', $this->validation->listErrors());
			}
			$data['media'] = $this->content->getContent($this->type, $id);
			$data['title'] = 'Edit Media';
			$data['subtitle'] = 'Edit previous media';
			return view('media/edit', $data);
		} else {
			$id = $this->request->getPost('id');
			$updated_at = date('Y-m-d H:i:s');
			$title = $this->request->getPost('title');
			$slug = url_title($title, '-', true);
			$body = htmlentities($this->request->getPost('body'));
			$publish = $this->request->getPost('publish');
			$tags = $this->request->getPost('tags');

			$data = [
				'updated_at' => $updated_at,
				'content_title' => $title,
				'content_slug' => $slug,
				'content_body' => $body,
				'content_tags' => $tags,
				'content_status' => $publish,
			];
			
			$saved = $this->content->updateContent($data, $id);
			
			if($saved)
			{
				session()->setFlashdata('info', 'Media has been added');
				return redirect()->to(base_url('admin/media'));
			}
		}
	}
	
	//---------------------- Delete Media --------------------------

	public function delete($id)
    {
        $deleted = $this->content->deleteContent($id);

        if($deleted)
        {
            session()->setFlashdata('info', 'Deleted media successfully');
            return redirect()->to(base_url('admin/media'));
        }
    }

}
