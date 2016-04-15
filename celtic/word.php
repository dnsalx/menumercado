<?php 
	
class Words{
	public static function getTypes(){
		$types = array("Substantivo" => "subs", "Verbo" => "vrb", "Adjetivo" => "adj", "Artigo" => "art", "Pronome" => "pron", "Numeral" => "num", "Advérbio" => "adv", "Preposição" => "prep", "Conjunção" => "conj", "Interjeição" => "intj", 10 => "dez, brother");
		return $types;
	}

	public function getType($full_name){
		$get_type = self::getTypes();
		return $get_type[$full_name];
	}
}

?>