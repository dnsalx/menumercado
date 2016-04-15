<html>
<body>
<?php 

require_once('auxiliar.php');
require_once('simple_html_dom.php');
require_once('dicio_com_br.php');

$pesquisa = tirarAcentos($_GET['p']);
$data = new Dicio($pesquisa);
echo json_encode($data->classeGramatical($pesquisa));

 ?>

 </body>
 </html>