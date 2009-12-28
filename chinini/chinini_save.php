<?php

//require_once 'config.php';

//TODO gestion de l'encodage et html entity
//TODO vérifier que le bloc est bien éditable


$current_file = $_POST['current_file'];
$element_id = $_POST['id']; //we don't use this for now
$element_path = $_POST['element_path'];
$new_content = $_POST['value'];

//Read the files
$file_content =  read_file($current_file);
//$file_content = utf8_decode($file_content);

$parsed_xml = simplexml_load_string($file_content,'SimpleXMLElement',LIBXML_NOXMLDECL); //LIBXML_NOXMLDECL fonctionne pas so str_relace...
if(!$parsed_xml){
	echo 'xml error';
	exit();
}

$toEval = '$parsed_xml' . $element_path . ' = $new_content; '; 

eval($toEval);

$new_file_content = $parsed_xml->asXML();
$new_file_content = str_replace('<?xml version="1.0"?>','',$new_file_content);


write_file($current_file,$new_file_content); //TODO check error

echo $new_content;

/*
 * Read a files and return the content
 * Return False if the file is not readable
 */
function read_file($my_file){
	if(file_exists($my_file)){
		return file_get_contents($my_file);
	}
	return 'FALSE'; //TODO replace with a good false
}


/*
 * Write a files
 * @Return False if the file is not writable or byte
 */

function write_file($my_file,$new_content){
	return file_put_contents($my_file,$new_content);
}
