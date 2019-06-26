<? 
	//Arquivo Index.php - Tem como utilidade carregar o template da página 
	setlocale(LC_ALL, "pt_BR"); 
	header('Content-type: text/html; charset=utf-8'); 

	include_once "MODELS/Conexao.php";

	//Cria a varíavel de usuário 
	$usuario = strtolower($_SERVER['REMOTE_USER']);
	$usuario_1 = split('\\\\', $usuario);
    $usuario = $usuario_1[1];

    set_time_limit(1200); //Define tempo limite de execução
	ERROR_REPORTING (E_ERROR);  //Somente exibe erros fatais  


    #Cria a variavel de data 
	$data_atual = date('d/m/Y H:i:s');
	//echo $data_atual;	
	
	$data_dia = date('d'); 
	//echo $data_dia; 
	
	$agent = strtolower($_SERVER["HTTP_USER_AGENT"]); 	
	//echo $agent; 
		if (strstr($agent," msie 7.0")) { 
			echo "<p style='font-size: 20px; text-align:center; color: #FF0000;'>
			Para melhor compatibilidade, utilize o Firefox ou o Chrome para rodar este sistema.
			</p>"; 
		} 	



		
	$hora = date('H');    




?> 
<!DOCTYPE html>
<html>
<head>
	<title>Escalonamento CGR</title>
	
	<meta charset="utf-8" /> <!--Charset da página-->
	<meta name="authors" content="CGR - Governança"/> <!--Autor do sistema - EQUIPE CGR - GOV-->
	<meta http-equiv="X-UA-Compatible" content="ie=11"> <!--Compatibilidade para o internet Explorer 11-->
	 <meta http-equiv="X-UA-Compatible" content="IE=edge"><!--Compatibilidade com o Microsoft Edge--> 

	 <style type="text/css">
		/*Itens da parte Negada*/ 
		fieldset#fdnegado { 
			border: 5px solid #000080; 
			border-color: #f9a16b;
			background-color: #EBF5FC;  	
		}

		fieldset#fdnegado p { 
			text-align: center; 
		}  
		/*FIM*/
	 </style>

</head>
<body>
	<!--Chama o arquivo que possui o Template(Tela Gráfica do sistem)--> 
	<? 

		//Efetua o Teste 
		$teste = "
			SELECT COUNT ([id]) AS 'total' FROM dbo.Tb_inv_valida WHERE [login_rede] = '$usuario'"; 

			abreConexao(); 
			global $sql; 

			$result = $sql->prepare($teste); //Prepara a Consulta 
			$result->execute(); //Executa a consulta 

			$total = $result->fetch(PDO::FETCH_ASSOC);

			//echo "<h1 style='color: black'>".$total['total']."</h1>";		
			
			if( $total['total'] == 0) { 
				echo  "
					<br><br><br><br><br><br><br>
					<fieldset id='fdnegado'>
						<p style='text-align: center; font-size: 20px; color: #000080'>Acesso negado - Usuário não encontrado no sistema!!!!</p> 
						<p style='text-align: center; font-size: 20px; color: #000080'>Para acesso entrar em contato com a CETEC78, no e-mail CETEC78@mail.caixa ou então nos ramais 
							5621/5622.</p> 
					</fieldset>	

				";

			} else if($total['total'] == 1) { 

				include "template.php"; 
			}

		fechaConexao();
	?> 
</body>
</html>
