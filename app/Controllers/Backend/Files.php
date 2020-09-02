<?php namespace App\Controllers\Backend;

use \App\Models\FilesModel;

class Files extends AuthController
{
	public function __construct()
	{
		helper('text');
		$this->files = new FilesModel();
		$this->type = 'media';
	}

	public function index()
	{
		$id = $this->request->getGet('id');
		if($id > 0) {
		$file = $this->files->getFiles($id);
		$data['detail'] = $file;
		}
		$data['files'] = $this->files->getFiles();
		$data['title'] = 'Files';
		$data['subtitle'] = 'List of upload files';
		return view('files/files', $data);
	}

	public function upload()
	{
		$rules = [
			'webfile' => 'uploaded[webfile]|max_size[webfile,50024]|mime_in[webfile,image/png,image/jpg,image/jpeg,application/pdf,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]'
		];
		if(!$this->validate($rules)) {
			session()->setFlashdata('alert', $this->validation->listErrors());
		} else {
			$file = $this->request->getFile('webfile');
			$name = $file->getName();
			$ext = $file->getClientExtension();
			$mime_type = $file->getClientMimeType();

			$file_type = '';
			if(in_array($ext, ['jpg','jpeg','png'])) {
				$file_type = 'image';
			} else if($ext == 'pdf') {
				$file_type = 'pdf';
			} else if(in_array($ext, ['xls','xlsx'])) {
				$file_type = 'excel';
			} else if(in_array($ext, ['doc','docx'])) {
				$file_type = 'document';
			}

			$data = [
				'created_at'		=> date('Y-m-d H:i:s'),
				'file_type'			=> $file_type,
				'file_mime_type'	=> $mime_type,
				'file_name'			=> $name,
				'file_url'			=> $name,
				'file_caption'		=> $name,
				'file_size'			=> '',
				'file_ext'			=> $ext,
				'file_image_width'	=> 0,
				'file_image_height'	=> 0,
				'file_status'		=> 1
			];
			$this->files->insertFiles($data);
			$file->move('upload');	
			session()->setFlashdata('alert', 'Upload success.');
		}
		return redirect(ADMINURL.'/files');

	}
	//--------------------------------------------------------------------

}
