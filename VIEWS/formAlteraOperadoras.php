<?php 
	########### CABEÇALHO PHP #####################	

	//#Definir char-set 
	setlocale(LC_ALL,"pt_BR"); 
	header('Content-type: text/html; charset=utf-8');

	set_time_limit(1200); //Define tempo limite de execução
	ERROR_REPORTING (E_ERROR);  //Somente exibe erros fatais
	
	#Varíaveis globais que serão usadas para cadastramento 
	
	include_once "../MODELS/Conexao.php";


	 #Cria a variável de usuário 
	 $usuario = strtolower($_SERVER["REMOTE_USER"]);
     $usuario_1 = split('\\\\', $usuario);
     $usuario = $usuario_1[1];  


     $data_at = date('Y-m-d H:i:s'); //Padrão data/hora para inserir no Banco 	

	 $idd = $_REQUEST['id'];		 

	 //echo $idd; 

	 //Método antigo enquanto não encontro a solução XD 
	 $queryPorId = "
			SELECT [id],[operadora],[sigla],[observacao],[usuario],[hora_reg] 
			FROM [dbo].[tbl_oper_escalona] WHERE [id] = $idd; 
	";  

		try {
			abreConexao(); 
			global $sql; 

			$result = $sql->prepare($queryPorId); 
			$result->execute();  

			$lista = $result->fetch(PDO::FETCH_ASSOC);


		} catch (Exception $e) {
			print "Ocorreu um erro: <code>".$e->getMessage()."</code>";
		}




?> 

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="authors" content="CGR - Governança"/>
	    <meta http-equiv="X-UA-Compatible" content="ie=11"> 
	    <meta http-equiv="X-UA-Compatible" content="IE=edge"><!--Compatibilidade com o Microsoft Edge-->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> 

	      <!-- Font Awesome -->
		  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
		  <!-- Ionicons -->
		  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

		  <!--CSS Bootstrap e Próprios-->
		  <link rel="stylesheet" type="text/css" href="../LIB/CSS/bootstrap.min.css"/> <!--BootStrap-->
		  <link rel="stylesheet" type="text/css" href="../LIB/CSS/newPages.css"/><!--CSS Adicional-->
		
		  <!--Bootstrap JS--> 
		  <script type="text/javascript" src="../LIB/JS/jquery3.1.1.js"></script>
		  <script type="text/javascript" charset="utf-8" src="../LIB/JS/jquery-1.11.1.min.js"></script> 
		  <script type="text/javascript" charset="utf-8" src="../LIB/JS/bootstrap.min.js"></script>  

		  <!--Auto Complete Source-->
		  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	 	  <link rel="stylesheet" href="/resources/demos/style.css">
	  	  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	  	  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

		  <style type="text/css">
			body { 
				background-color: #F0F8FF;
			}	
		  </style> 
		  <script type="text/javascript">
		  		//Busca o Código em PHP 
		  		var cod = <?=$idd;?>; 
		  		$(document).ready( function() { 
			  		$("#cod").html('O código é: ' + cod);
		  		});	
		  </script>
	</head>
	<body>
		 <h4 class="text-primary" style="margin-left: 50px;">Alteração do Registro</h4>	 
		 <fieldset class="borda-form" style="width: 85%;">
		 <br>
		 <form name="altOperadora" method="POST">

		 		<input type="hidden" id="cod" name="nCod" value="<?=$lista['id'];?>">

				<!--Primeiro Bloco do Group ROW-->		
				<div class="form-group row">
					<!--Nome da Operadora-->
					<div class="col-sm-6">	
						<label for="inserirOperadora" class="text-primary">Operadora</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-wifi"></i></span>
							<input type="text" class="form-control" id="inserirOperadora" name="nOperadora" value="<?=$lista['operadora'];?>" placeholder="Nome da Operadora">
						</div>
					</div>

					<!--Sigla da Operadora-->
					<div class="col-sm-2">	
						<label for="inserirSigla" class="text-primary">Sigla</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-hashtag"></i></span>
							<input type="text" class="form-control" id="inserirSigla" name="nSigla" value="<?=$lista['sigla'];?>"  placeholder="Sigla">
						</div>
					</div>
				</div>	

				<div class="form-group row">
					<div class="col-sm-6">
						<label for="registroObs" class="text-primary"><b>Observações/Comentários:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-font"></i></span>
							<textarea class="form-control" rows="3" id="registroObs" name="nObs" style="resize: none;"><?=$lista['observacao'];?></textarea>
						</div>	
					</div>
				</div>	

				<input type="hidden" id="registroUsr" name="nUsr" value="<?=$usuario;?>"> <!--Usuário que efetuou o registro--> 
				<input type="hidden" id="registroHora" name="nHora" value="<?=$data_at;?>"> <!--Data atual do registro-->


				<button type="submit" 
						value="Editar" 
						name="Editar" 
						class="btn btn-primary" 
						formaction="../CONTROLLERS/OperadorasController.php?opcao=Editar"
						formtarget="_self"
						>
	 				Alterar <i class="fa fa-floppy-o"></i>
	 			</button>	
	 			<!--../MODEL/Qualidade.php?opcao=Registrar -->		
	 			<button  type="reset" value="Limpar" name="Limpar" class="btn btn-primary" style="margin-left: 10px;">
	 				Limpar <i class="fa fa-eraser"> </i>
	 			</button>
			</form>			

		 </fieldset>	
	</body>
</html>