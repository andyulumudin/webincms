<?php
helper('website');

if(!function_exists('themeList')) {
    function themeList() {
        $path = ROOTPATH.'/themes';
        $maps = scandir($path);
        $themes = array();
        foreach($maps as $map) {
            if(!in_array($map, ['.','..','index.html'])) {
                $themes[] = $map;
            }
        }
        return $themes;
    }
}

if(!function_exists('themeInfo')) {
    function themeInfo($key) {
        $theme = website('default_theme');
        
        if($theme != false) {
            $filename = ROOTPATH.'/themes/'.$theme.'/theme.json';
            if(file_exists($filename)) {
                $themeinfo = file_get_contents($filename);
                $themeinfoData = json_decode($themeinfo, true);
                
                if(array_key_exists($key, $themeinfoData)) {
                    return $themeinfoData[$key];
                }
            }
        }
        return false;
    }
}

if(!function_exists('themeCheck')) {
    function themeCheck() {
        $theme = website('default_theme');
        if($theme != false) {
            $filename = ROOTPATH.'/themes/'.$theme.'/theme.json';
            if(file_exists($filename)) {
                return true;
            }
        }
        return false;
    }
}