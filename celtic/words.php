<?php 
	require_once('multi_requests.php');

	$codigo = $_GET['codigo'];
	$frase = rawurldecode($_GET['frase']);
	$base = 'http://menumercado.com/celtic/dicio.php?';
	//"http://menumercado.com/celtic/dicio.php?codigo=" + codigo + "&p=" + wd

	$i = 0;
	foreach (split("[ ]", $frase) as $wrd) {
		if(!in_array($wrd, array('"', '-')) && !in_array(rawurlencode($wrd), array('%26quot%3B', '%22'))){
			$data[] = $base."p=".rawurlencode($wrd)."&codigo=".$i;

			$i+=1;
		}
	}

	$r = multiRequest($data);
	 
	 foreach ($r as $reg) {
 		$result[] = json_decode($reg);
 		//$classes[] = array("codigo" => json_decode($reg)->codigo, "palavra" => json_decode($reg)->palavra);
	 }

	 $dados = array("codigo" => $codigo, "frase" => $frase, "count" => $i, "palavras" => $result); //, "classes" => $classes);

	 exit(json_encode($dados));

 ?>