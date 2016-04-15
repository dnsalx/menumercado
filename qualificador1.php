<?php
$codigo = rawurlencode($_GET['codigo']);
$frase = rawurlencode($_GET['frase']);

$json = file_get_contents("http://menumercado.com/celtic/words.php?codigo=".$codigo."&frase=".$frase);

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

function qualificar($listOfData){
	
	//foreach ($listOfData as $data) { //para cada ORAÇÃO
		foreach ($listOfData["palavras"] as $item) { //para cada PALAVRA
			if($item != null){
				if(in_array("prep", $item["classe"])){
					$blocos[] = sujeito($items);
					unset($items);

					/*echo "</div>"."<div style='color:red'>";
					echo $item["palavra"];
					echo "<span style='color:lightgray'>".json_encode($item["classe"])."</span>";
					echo "</div><div>";*/
				}
				elseif(in_array("subs", $item["classe"]) || in_array("adje", $item["classe"])){
					$items[] = $item;
					/*echo "<span>";
					echo $item["palavra"];
					echo "<span style='color:lightgray'>";
					echo json_encode($item["classe"]);
					echo "</span>";*/
				}

				/*echo "<div>";
				var_dump($item);
				echo "</div>";*/
			}
		}

		$result = $blocos[0];
		unset($blocos);
	//}


	return $result;
}

$value = array("codigo" => $codigo, "tags" => qualificar($dados));
exit(json_encode($value));

?>