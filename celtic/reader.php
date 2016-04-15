<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
</head>
<body>
	<div id="listas"></div>

	<script type="text/javascript">
		$(document).ready(function(){
			produtos = null;

			$.getJSON("http://menumercado.com/celtic/produtos.php?q=10", function(data){
				$.each(data, function(i){
					//$("#listas").append("<div data='" + data[i].pro_codigo + "'>" + data[i].pro_nome + "</div>");

					var codigo = data[i].pro_codigo;
					var nome = data[i].pro_nome;
					var words = nome.split(" ");
					var count = words.length;
					count = 0
					
				
					$("#listas").append("<div id='" + codigo + "' nome='" + nome + "'></div>");

					if (true==true){
						y = 0;

						for (i=0; i < words.length; i++){
						//	setTimeout(function(){

							wd = words[y].replace("-", "");
							wd = decodeURIComponent(wd.toLowerCase())
							//alert("ARGUMENTSO DO DICIO := ".codigo." | ".escade(wd));

							if(wd != ""){

								$("#" + codigo).append("<span data='" + wd + "'></span>");

								$.ajax({
									url: "http://menumercado.com/celtic/dicio.php?codigo=" + codigo + "&p=" + wd
								}).done(function(data){
									info = $.parseJSON(data);
									div = "<div>" + info.palavra + "#" + info.classe + "</div>";
									div = div == ""? "empty" : div;
									div = "[" + info.classe + "]";
									$('span[data="' + info.palavra + '"]').append(div);
								});
								y += 1;
							}
						//	}, 5000);
						}
					}	
					else{
						$('#' + codigo).append(nome);
					}
				});
			});

		});
	</script>
</body>
</html>

<!--

/*	if (preg_match('Classe gramatical', $classe[0])){
		$tag->load($classe[0]);
		echo $tag->find('b')->innertext;
	}*/

-->