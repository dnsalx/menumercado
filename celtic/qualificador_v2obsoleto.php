<?php

require_once("auxiliar.php");

$codigo = $_GET['codigo'];
$frase = $_GET['frase'];

//$json = file_get_contents("http://menumercado.com/celtic/words.php?codigo=".$codigo."&frase=".$frase);

//frase=lixeira%20oval%205l%20com%20borda%20para%20esconder%20saco%20de%20lixo%20%26quot%3B%20ideal%20para%20pia%20%26quot%3B%20cor%20preta%20retrô%20-%20coza&codigo=99754");

$dados = json_decode(utf8_encode($json), true);


function sujeito($bloco){
	$subject = -1;
	$subjectSetted = false;
	$i = 0;
	foreach ($bloco as $item) { //loop por cada PALAVRA no bloco/oração
		if(!$subjectSetted && in_array("subs", $item["classe"])){
			$subjectSetted = true;
			$subject = $i;

			$result[] = $item["palavra"];
		}
		else{

		}


		$i += 1;
	}
	return $result;
}

function qualificar($oracao){
	$base = 'http://menumercado.com/celtic/dicio.php?';
	//"http://menumercado.com/celtic/dicio.php?codigo=" + codigo + "&p=" + wd

	$subjectSetted = false;
	$i = 0;
	foreach (split("[ ]", $oracao) as $wrd) {
		if(!in_array($wrd, array('"', '-')) && !in_array(rawurlencode($wrd), array('%26quot%3B', '%22'))){
			//echo rawurlencode(tirarAcentos($wrd));
			$json = file_get_contents($base."p=".rawurlencode(tirarAcentos($wrd)));
			//echo $json;
			$data = json_decode($json, true);
			

			if(in_array("subs", $data["classe"]) && !in_array("prep", $data["classe"]) && !$subjectSetted){
				$result[] = $data["palavra"];
				$subjectSetted = true;
				break;
			}

			$i+=1;
		}
	}

	$result[] = "teste";
	return $result;
}

$value = array("codigo" => $codigo, "tags" => qualificar($frase));
exit(json_encode($value));

?>