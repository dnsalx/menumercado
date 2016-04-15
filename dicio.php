<?php 

require_once('simple_html_dom.php');

function tirarAcentos($string){
    return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
}

function classeGramatical($search, $codigo = -1){
	$pesquisa = utf8_encode(rawurldecode(tirarAcentos($search)));
	$cru = $search;

	$tag = new simple_html_dom();
	$div = new simple_html_dom();
	$dicio = new simple_html_dom();

	try{
		//echo 'http://www.dicio.com.br/' . $cru . '<br />';
		$dicio->load_file('http://www.dicio.com.br/' . $cru);

		if($dicio != null){
			if(!empty($dicio)){		
				echo $dicio->find('h1.norp', 0)->innertext;
				if (preg_match('(Busca por)', $dicio->find('h1.norp', 0)->innertext)){
					echo 'multiple results<br />';
					foreach ($dicio->find('ul.resultados>li') as $li_item) {
						echo 'test for result: '.$li_item->find('a', 0)->innertext.'  ('.utf8_decode($pesquisa).')<br />';
						if($li_item->find('a', 0)->innertext == utf8_decode($pesquisa)){
							echo 'acquired correct result: '.utf8_decode($pesquisa);
							return classeGramatical(str_replace('/', '', $li_item->find('a', 0)->href));
							break 2;
						}
					}
				}
				else{
					//echo 'unique result<br />';
					foreach ($dicio->find('p.adicional') as $div) {
						//echo "foreach<br />";
						$classe = split('(<br>|<br />|</br>)', $div->innertext);

						if(preg_match('(Classe gramatical)', $classe[0])){
							//echo "preg_match<br />";
							$tag->load($classe[0]);
							foreach ($tag->find('b') as $b) {
								
									$clss[] = utf8_encode(substr($b->innertext, 0, 4));
							}
							$data = array('codigo' => $codigo, 'palavra' => utf8_encode($search));, 'classe' => $clss);
							//var_dump($data);
						}
					}
				}
			}
			else{
				$data = array('empty dicio');
			}
		}
		else{
			$data = array('null dicio');
		}	
	}
	catch(Exception $e){
		$data = array('error dicio');
	}

	return $data;
}


if(isset($_GET['p'])){
	if(isset($_GET['codigo'])){
		$value = classeGramatical($_GET['p'], $_GET['codigo']);
	}
	else{
		$value = classeGramatical($_GET['p']);
	}
}

exit(json_encode($value));

 ?>