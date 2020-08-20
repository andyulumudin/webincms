<?php namespace App\Controllers\Frontend;

class Asset extends BaseController
{
	public function static($type = '', $file = '')
	{
		if ( ! file_exists(ROOTTHEME.'/static/'.$type.'/'.$file))
		{
			// Whoops, we don't have a page for that!
			// throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
			return view(THEMEVIEW.'/404');
		}

		$filename = ROOTTHEME.'/static/'.$type.'/'.$file;

		if($type == 'css') {
			$view_file = file_get_contents($filename);
			return $view_file;
		} else if($type == 'img') {
			$xfile = explode('.', $file);
			$ext = end($xfile);
			header('Content-Type: image/'.$ext);
			header('Content-Length: ' . filesize($filename));
			$getfile = fopen($filename, "r") or die("Unable to open file!");
			echo fread($getfile,filesize($filename));
			fclose($filename);
		}
		
		
	}

	//--------------------------------------------------------------------

}
