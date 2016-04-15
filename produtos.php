<?php 

	$qtd = $_GET['q'];
	$connection = new mysqli('186.202.166.217', 'mmclouddb', 'max30PORcEnT0', 'mmclouddb');

	$sql = 'SELECT pro_codigo, pro_nome FROM tab_produtos_xml WHERE pro_nome <> "" AND pro_codigo IN (352363, 12811, 128568, 125666, 99754) OR pro_codigo = 99754 GROUP BY pro_codigo ORDER BY RAND() LIMIT '.$qtd;
	$sql = 'SELECT pro_codigo, pro_nome FROM tab_produtos_xml WHERE (pro_tags="" or pro_tags is null) and pro_loja="americanas" LIMIT 50';

	$query = $connection->query($sql);

	while ($row = $query->fetch_array()){
		$result[] = array('pro_codigo' => $row['pro_codigo'], 'pro_nome' => utf8_encode($row['pro_nome']));
	}

	//foreach ($result as $row) {
		//echo '('.$row['pro_codigo'].') '.$row['pro_nome'].'<br />';
	//}
	exit(json_encode($result));

	$query->close();
	$connection->close();
 ?>