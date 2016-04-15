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
					
				
					wd = encodeURIComponent(nome.toLowerCase());

					$("#listas").append("<div id='" + codigo + "' nome='" + nome + "' escaped='" + wd + "'></div>");

					if (true==true){
						y = 0;

						//alert("ARGUMENTSO DO DICIO := ".codigo." | ".escade(wd));

						if(wd != ""){

							$.ajax({
								url: "http://menumercado.com/celtic/words.php?codigo=" + codigo + "&frase=" + wd
							}).done(function(data){
								info = $.parseJSON(data);

								subject = false;
								$.each(info.palavras, function(i, item){
									if(item!=null){
										joined_class = item.classe.join();
										if (joined_class.indexOf("subs") > -1 || joined_class.indexOf("adje") > -1 || joined_class.indexOf("prep") > -1 || true==false){
											if(!subject){
												if (joined_class.indexOf("subs") > -1){
													subject = true;
													label_subject = " subject";
												}
											}

											div = "<span data='" + item.palavra + "'" + label_subject + ">" + joined_class + "</span>";
											$("#" + info.codigo).append(div);

											label_subject = "";
										}
									}	
								});
							});
							y += 1;
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