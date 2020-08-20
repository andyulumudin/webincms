<?php

if(!function_exists('baseUrl')) {
    function baseUrl() {
        $baseUrl = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) : 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']);
        return $baseUrl;
    }
}
if(!function_exists('website')) {
    function website($keyname, $val=false) {
        $filename = ROOTPATH.'website.json';
		$website = file_get_contents($filename);
        $websiteData = json_decode($website, true);
        if($val !== false) {
		foreach($websiteData as $key => $web) {
			if($key == $keyname) {
				$websiteData[$keyname] = $val;
			}
		}
		$config = json_encode($websiteData, JSON_PRETTY_PRINT);
        return file_put_contents($filename, $config);
        } else {
        return $websiteData[$keyname];
        }
    }
}