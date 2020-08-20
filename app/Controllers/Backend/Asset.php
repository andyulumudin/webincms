<?php namespace App\Controllers\Backend;

class Asset extends AuthController
{
	public function static($type = '', $file = '')
	{
		$request = \Config\Services::request();
		$fullPath = $request->uri->getPath();
		$mainUri = $request->uri->getSegment(1);
		$filePath = str_replace(array($mainUri, '/assets/'), '', $fullPath);
		$files = explode('/',$filePath);
		$file = end($files);
		if ( ! file_exists(APPPATH.'/Views/assets/'.$filePath))
		{
			// Whoops, we don't have a page for that!
			// throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
			return view(THEMEVIEW.'/404');
		}

		$filename = APPPATH.'/Views/assets/'.$filePath;

		if($type == 'css') {
			$css_file = file_get_contents($filename);
			$base_url = base_url().'/admin/assets/';
			$view_file = str_replace('[base_url]',$base_url,$css_file);
			return $view_file;
		} else if($type == 'img') {
			$xfile = explode('.', $file);
			$ext = end($xfile);
			header('Content-Type: image/'.$ext);
			header('Content-Length: ' . filesize($filename));
			$getfile = fopen($filename, "r") or die("Unable to open file!");
			echo fread($getfile,filesize($filename));
			fclose($filename);
		} else if($type == 'libs') {
			$view_file = file_get_contents($filename);
			return $view_file;
		} else if($type == 'fonts') {
			$svg   = 'image/svg+xml';
			$ttf   = 'application/x-font-ttf';
			$otf   = 'application/x-font-otf';
			$woff  = 'application/x-font-woff';
			$woff2 = 'application/font-woff';
			$eot   = 'application/vnd.ms-fontobject';

			$xfile = explode('.', $file);
			$ext = end($xfile);
			switch ($ext) {
				case 'ttf':
					$contentType = $ttf;
					break;
				
				case 'otf':
					$contentType = $otf;
					break;
				
				case 'woff':
					$contentType = $woff;
					break;
				
				case 'woff2':
					$contentType = $woff2;
					break;
				
				case 'eot':
					$contentType = $eot;
					break;
				
				default:
					$contentType = $svg;
					break;
			}
			
			header('Content-Type: '.$contentType);
			header('Content-Disposition: inline; filename="'.basename($filename).'"');
			header('Content-Length: ' . filesize($filename));
			readfile($filename);
		}
	}

	//--------------------------------------------------------------------

}
