<?php 

//require_once('auxiliar.php');
//require_once('simple_html_dom.php');
// phpinfo();

//$pesquisa = tirarAcentos($_GET['p']);

class Dicio{
	public function classeGramatical($pesquisa){
		$tag = new simple_html_dom();
		$div = new simple_html_dom();
		$dicio = new simple_html_dom();

		$dicio->load_file('http://www.dicio.com.br/' . $pesquisa);

		if($dicio != null){
			if(!empty($dicio)){			
				foreach ($dicio->find('p.adicional') as $div) {
					$classe = split('(<br>|<br />|</br>)', $div->innertext);
	
					if(preg_match('(Classe gramatical)', $classe[0])){
						$tag->load($classe[0]);
						$data = array('palavra' => $pesquisa, 'classe' => $tag->find('b', 0)->innertext);
					}
				}
			}
			else{
				$data = null;
			}
		}
		else{
			$data = null;
		}

		return $data;
	}
}
 ?>