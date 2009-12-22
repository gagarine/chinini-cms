<?php

init_config();
chinini_boot();

function chinini_boot(){
 	//TODO test si user est logé
	include_once('chinini/config.php');
	include_once('chinini/js/init_js.php');
}

function init_config(){
    global $base_url, $base_path, $base_root;
    $base_root = ( isset ($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')?'https':'http';
    // As $_SERVER['HTTP_HOST'] is user input, ensure it only contains
    // characters allowed in hostnames.
    $base_url = $base_root .= '://'.preg_replace('/[^a-z0-9-:._]/i', '', $_SERVER['HTTP_HOST']);

    // $_SERVER['SCRIPT_NAME'] can, in contrast to $_SERVER['PHP_SELF'], not
    // be modified by a visitor.
    if ($dir = trim(dirname($_SERVER['SCRIPT_NAME']), '\,/'))
    {
        $base_path = "/$dir";
        $base_url .= $base_path;
        $base_path .= '/';
    }
    else
    {
        $base_path = '/';
    }
}

// return the base path
function base_path(){
	return $GLOBALS['base_path'];
}
function base_url(){
	return $GLOBALS['base_url'];
}

function base_root(){
	return $GLOBALS['base_root'];
}

function script_absolute_sys_path(){
	return $_SERVER['DOCUMENT_ROOT'] . $_SERVER["SCRIPT_NAME"];
}
