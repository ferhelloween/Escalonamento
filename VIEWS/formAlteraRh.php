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

     $queryPorId = "
     	SELECT [id],[empresa],[matricula],[nome]
      	,[ramal],[cel],[grupo_gsc],[usr_alt],[funcao]
  		FROM [Inventario].[dbo].[tb_rh_cgr] WHERE [id] = $idd
     ";

     //echo $queryPorId;

     try {
		
		abreConexao(); 
		global $sql; 

		$result = $sql->prepare($queryPorId); 
		$result->execute();  

		$lista = $result->fetch(PDO::FETCH_ASSOC);



     } catch (Exception $e) {
     	print "Ocorreu um erro: <code>".$e->getMessage()."</code>";
     	
     }

    fechaConexao(); 
      
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
	  <script type="text/javascript"  src="../LIB/JS/jquery-1.11.1.min.js"></script> 
	  <script type="text/javascript"  src="../LIB/JS/bootstrap.min.js"></script>  
	
	  <!--Auto Complete Source-->
	  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 	  <link rel="stylesheet" href="/resources/demos/style.css">
  	  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  	  <script type="text/javascript"  src="../LIB/JS/jquery-1.11.1.min.js"></script> 
	  <script type="text/javascript"  src="../LIB/JS/jQuery-Mask-Plugin-master/dist/jquery.mask.min.js"></script><!--Script para mascaras-->
	 

  	  <style type="text/css">
		body { 
			background-color: #F0F8FF;
		}	
	  </style> 

	  
</head>
<body> 
		<br> 
		<fieldset class="borda-form" style="width: 90%;">
			<form name="regEscalonamento" method="POST">

				<input type="hidden" id="cod" name="nCod" value="<?=$lista['id'];?>">
				<br>	
				<!--Primeiro Bloco do Group ROW-->		
				<div class="form-group row">
					<!--Nome do Funcionário-->
					<div class="col-sm-10">	
						<label for="Funcionario" class="text-primary">Nome do Funcionário</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="text" class="form-control" id="Funcionario" name="nFuncionario" placeholder="Nome do Funcionário" value="<?=$lista['nome'];?>">
						</div>
					</div>
				</div><!--Fim do Primeiro Bloco--> 	


				<!--Segundo Bloco do Group ROW-->
				<div class="form-group row">
					
					<!--Matrícula-->
					<div class="col-sm-3">
						<label for="Matricula" class="text-primary"><b>Matrícula:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class=" 	fa fa-hashtag"></i></span>
							<input type="text" class="form-control" id="Matricula" value="<?=$lista['matricula'] ?>" name="nMatricula" placeholder="C000000">
						</div>	
					</div>
					<!--Área-->
					<div class="col-sm-4">
						<label for="Empresa" class="text-primary"><b>Empresa:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-institution"></i></span>
							<select class="form-control" id="Empresa" name="nEmpresa" >
								<option value="<?=$lista['empresa'];?>"><?=$lista['empresa'];?></option> 
								<option value="">Selecione...</option> 
								<option value="CAIXA">CAIXA</option> 
								<option value="TIVIT">TIVIT</option> 
								<option value="STEFANINI">STEFANINI</option> 
								<option value="TELEFONICA/VIVO">TELEFONICA/VIVO</option> 
								<option value="AMERICANET">AMERICANET</option> 
								<option value="EMBRATEL">EMBRATEL</option> 
							</select>
						</div>	
					</div>

					<!--Função-->
					<div class="col-sm-3">
						<label for="Funcao" class="text-primary"><b>Função:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-wrench"></i></span>
							<input type="text" class="form-control" id="Funcao" value="<?=$lista['funcao'];?>" name="nFuncao" placeholder="Funcao do funcionario">
						</div>	
					</div>
					


				</div><!--Fim do Segundo Bloco-->	 

				<!--Terceiro Bloco do Group ROW-->
				<div class="form-group row">

					<!--Telefone-->
					<div class="col-sm-3">
						<label for="Telefone" class="text-primary"><b>Ramal:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-phone"></i></span>
							<input type="text" class="form-control" id="Telefone" value="<?=$lista['ramal'];?>" name="nTelefone" placeholder="(99)1111-1111" 
								maxlength="13">
							<script>
								$("#Telefone").keypress(function(event) { 
									var campo = $(this).val(); 
								//Irá verificar os primeiros digitos informados 
								if(campo !== "" && campo.substring(0,2) === "08" || campo.substring(0,3) === "(08") { 
									$("#Telefone").mask("0000-000-0000");
								} else {
									$("#Telefone").mask("(00) 0000-0000");
								}
									 console.log(campo.substring(0, 2));
							});			
							</script>
						</div>	
					</div>

					<!--Celular-->
					<div class="col-sm-3">
						<label for="Celular" class="text-primary"><b>Celular:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
							<input type="text" class="form-control" id="Celular" name="nCelular" value="<?=$lista['cel'];?>" placeholder="(99)99999-9999"
							maxlength="14" pattern="\([0-9]{2}\)[0-9]{4}-[0-9]{4}"> 
							<script type="text/javascript">$("#Celular").mask("(00)00000-0000");</script>
						</div>	
					</div>

			
				</div><!--Fim do Terceiro Bloco-->	 
				
				<!--Quinto Bloco do Group ROW-->
				<div class="form-group row">
				
					<!--GRUPO GSC-->
					<div class="col-sm-8">
						<label for="Gsc" class="text-primary"><b>Grupo GSC:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
							<select class="form-control" id="Gsc" name="nGsc" >
								<option value="<?=$lista['grupo_gsc'];?>"><?=$lista['grupo_gsc'];?></option>
								<option value="">Selecione...</option>
								<option value="OUTROS">OUTROS</option>
								<option value="CAIXA-CETEC-CGR-Centro de Gerenciamento de Rede">CAIXA-CETEC-CGR-Centro de Gerenciamento de Rede</option>		
								<option value="TIVIT TERC DE PROC SERV-CETEC-Teleprocessamento N0">TIVIT TERC DE PROC SERV-CETEC-Teleprocessamento N0</option>		
								<option value="TIVIT TERC DE PROC SERV-CETEC-CGR-Suporte N2">TIVIT TERC DE PROC SERV-CETEC-CGR-Suporte N2</option>		
								<option value="TIVIT TERC DE PROC SERV-CETEC-CGR-Governança N2">TIVIT TERC DE PROC SERV-CETEC-CGR-Governança N2</option>		
								<option value="STEFANINI CONS ASSESSORIA INFORMÁTICA SA-CGR-Monitoração N1">STEFANINI CONS ASSESSORIA INFORMÁTICA SA-CGR-Monitoração N1</option>
							</select>
						</div>	
					</div>

				</div><!--Fim do Quinto Bloco -->	

				<br>	
				
				<input type="hidden" id="registroUsr" name="nUsr" value="<?=$usuario;?>"> <!--Usuário que efetuou o registro--> 
				<input type="hidden" id="registroHora" name="nHora" value="<?=$data_at;?>"> <!--Data atual do registro-->


				<button type="submit" 
						value="Enviar" 
						name="Enviar" 
						class="btn btn-primary" 
						formaction="../CONTROLLERS/RhController.php?opcao=Alterar"
						formtarget="_self"
						>
	 				Registrar <i class="fa fa-floppy-o"></i>
	 			</button>
	 			<!--formaction="CONTROLLERS/OperadorasController.php?opcao=Registrar"
					formtarget="_self"
				 -->

	 			
	 			<button  type="reset" value="Limpar" name="Limpar" class="btn btn-primary" style="margin-left: 10px;">
	 				Limpar <i class="fa fa-eraser"> </i>
	 			</button>
			</form>			
		</fieldset>

</body>
</html>
