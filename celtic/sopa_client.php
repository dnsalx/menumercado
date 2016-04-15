<?php 

$option = array('location' => 'http://menumercado/celtic/sopa_server.php', 'uri' => 'http://menumercado.com/celtic/');

try{
	$client = new SoapClient(null, $option);

	$types = $client->getTypes();

	echo $types;
}
catch(){

}


 ?>