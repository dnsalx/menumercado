<?php

require_once('word.php');

$option = array('uri' => "http://menumercado.com/celtic");

$server = new SoapServer(null, $option);
$server->setClass('Words');
$server->handle();

?>