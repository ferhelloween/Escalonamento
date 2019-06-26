<?php

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
	 	 SELECT [id] , [login_rede] as login,
   		 [nome] as nome,  
  		 [gitec] as area, [nivel_usr] as nivel FROM [Inventario].[dbo].[Tb_inv_valida] WHERE [id] = $idd
	 ";

	 	//Cria o método Try Catch para a Exibição do Código na Página 
	 	try {
	 		abreConexao(); //Irá Abrir a conexão 
	 		global $sql; //Cria a Variavel Global $sql que irá executar os comandos 

	 		$result = $sql->prepare($queryPorId); //Prepara a Consulta 
	 		$result->execute(); //Executa a consulta 

			$lista = $result->fetch(PDO::FETCH_ASSOC); //Cria a Variavel para exibição do registro

	 	} catch (Exception $e) {
	 		print "Ocorreu um erro <b>".$e->getMessage()."</b>"; 
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

	  </script>  
</head> 

<body>
	<br> 
		
			<fieldset class="borda-form" style="width: 75%;">
			<form name="altUsuarios" method="POST">

				<input type="hidden" id="cod" name="nCod" value="<?=$lista['id'];?>">

				<!--Primeiro Bloco do Group ROW-->		
				<div class="form-group row">
					<!--Matrícula - Login-->
					<div class="col-sm-3">	
						<label for="login" class="text-primary">Usuário de Rede</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-code"></i></span>
							<input type="text" class="form-control" id="login" name="nLogin" value="<?=$lista['login'];?>" placeholder="Login do Usuário">
						</div>
					</div>
				</div>
					
				<div class="form-group row">
					<!--Sigla da Operadora-->
					<div class="col-sm-6">	
						<label for="nome" class="text-primary">Nome Completo</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="text" class="form-control" id="nome" name="nNome" value="<?=$lista['nome'];?>" placeholder="Nome do Usuário">
						</div>
					</div>
				</div>	

				<div class="form-group row">
					<div class="col-sm-4">
						<label for="area" class="text-primary"><b>Área:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-building"></i></span>
							<select class="form-control" id="area" name="nArea"> 
								<option value="<?=$lista['area'];?>"><?=$lista['area'];?></option>
								<option value="">Selecione...</option>
								<option value="GITECPO">GITECPO</option>
								<option value="GITECFL">GITECFL</option>
								<option value="GITECCT">GITECCT</option>
								<option value="GITECSP">GITECSP</option>
								<option value="GITECCP">GITECCP</option>
								<option value="GITECBU">GITECBU</option>
								<option value="GITECRJ">GITECRJ</option>
								<option value="GITECBH">GITECBH</option>
								<option value="GITECCG">GITECCG</option>
								<option value="GITECGO">GITECGO</option>
								<option value="GITECBR">GITECBR</option>
								<option value="GITECBR">GITECBR</option>
								<option value="GITECSA">GITECSA</option>
								<option value="GITECRE">GITECRE</option>
								<option value="GITECFO">GITECFO</option>
								<option value="GITECBE">GITECBE</option>
								<option value="GITECMN">GITECMN</option>
								<option value="CEPTISP">CEPTISP</option>
								<option value="CEPTIRJ">CEPTIRJ</option>
								<option value="CEPTIBR">CEPTIBR</option>
								<option value="CETEC27">CETEC27</option>
								<option value="CETEC77">CETEC77</option>
								<option value="CETEC76">CETEC76</option>
								<option value="SUOTI02">SUETI02</option>
								<option value="GERTI12">GERTI12</option>
								<option value="CETEC">CETEC</option>
								<option value="CETAD">CETAD</option>
							</select>
						</div>	
					</div>
				</div>	

				<div class="form-group row">
					<div class="col-sm-6">
						<label for="nivel" class="text-primary"><b>Nível de Permissão:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-check"></i></span>
							<select class="form-control" id="nivel" name="nNivel">
							<? 
							if ($lista['nivel'] == 1) { 
								$nivel_saida = "1(Acesso Admin)";	
							} else if ($lista['nivel'] == 2) { 
								$nivel_saida = "2(Acesso Leitura CAIXA)";
							} else if ($lista['nivel'] == 3) { 
								$nivel_saida = "3(Acesso Leitura Terceiro)";
							} else if ($lista['nivel'] == 4) { 
								$nivel_saida = "4(Acesso Adm Local)";
							} else { 
								$nivel_saida = "Não Reconhecido";
							} 



							?>
							<option value="<?=$lista['nivel'];?>"><?=$nivel_saida;?></option>  
								<option value="">Selecione...</option> 
								<option value="1">1(Acesso Admin)</option> 
								<option value="2">2(Acesso Leitura CAIXA)</option> 
								<option value="3">3(Acesso Leitura Terceiro)</option> 
								<option value="4">4(Acesso Adm Local)</option> 
							</select>
						</div>	
					</div>
				</div>	

				<input type="hidden" id="registroUsr" name="regUsr" value="<?=$usuario;?>"> <!--Usuário que efetuou o registro--> 
				<input type="hidden" id="registroHora" name="regHora" value="<?=$data_at;?>"> <!--Data atual do registro-->


				<button type="submit" 
						value="Enviar" 
						name="Enviar" 
						formAction="../CONTROLLERS/UsuariosController.php?opcao=Alterar" 
						formtarget="_self"
						class="btn btn-primary">
	 				Registrar <i class="fa fa-floppy-o"></i>
	 			</button>	
	 			<!--../MODEL/Qualidade.php?opcao=Registrar -->		
	 			<button  type="reset" value="Limpar" name="Limpar" class="btn btn-primary" style="margin-left: 10px;">
	 				Limpar <i class="fa fa-eraser"> </i>
	 			</button>
			</form>			
		</fieldset>

</body>

</html>
