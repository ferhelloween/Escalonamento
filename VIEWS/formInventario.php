<?php 

	//#Definir char-set 
	setlocale(LC_ALL,"pt_BR"); 
	header('Content-type: text/html; charset=utf-8');


	set_time_limit(1200); //Define tempo limite de execução
	ERROR_REPORTING (E_ERROR);  //Somente exibe erros fatais
	
	#Varíaveis globais que serão usadas para cadastramento 
	
	 #Cria a variável de usuário 
	 $usuario = strtolower($_SERVER["REMOTE_USER"]);
     $usuario_1 = split('\\\\', $usuario);
     $usuario = $usuario_1[1];  


     $data_at = date('Y-m-d H:i:s'); //Padrão data/hora para inserir no Banco 	

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

  	   <!--<script type="text/javascript" charset="utf-8" src="LIB/JS/jquery-1.11.1.min.js"></script>--> 
  	  <script type="text/javascript" charset="utf-8" src="../LIB/JS/jquery-1.11.1.min.js"></script> 
	  <script type="text/javascript" charset="utf-8" src="../LIB/JS/jQuery-Mask-Plugin-master/dist/jquery.mask.min.js"></script><!--Script para mascaras-->

	  <style type="text/css">
		body { 
			background-color: #F0F8FF;
		}	
	  </style> 

	  <script type="text/javascript">


	  </script>
</head>

<body>

	<fieldset class="borda-form" style="width: 90%;">
		<form name="regInventario" method="POST">		
		
			<!--Primeiro Bloco do Group ROW-->		
			<div class="form-group row">			
				<!--Nome da Operadora-->
				<div class="col-sm-6">	
					<label for="Tipo" class="text-primary">Tipo</label>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-wifi"></i></span>
						<select class="form-control" id="Tipo" name="nTipo" required>
							<option value="">Selecione...</option>
							<option value="Estação de Trabalho">Estação de Trabalho</option>
							<option value="Monitor">Monitor</option>
							<option value="Telefone">Telefone</option>
							<option value="Impressora">Imrpessora</option>
							<option value="Mesa">Mesa</option>
							<option value="Cadeira">Cadeira</option>
							<option value="Outros">Outros</option>	
						</select>
						</div>
					</div>

					<!--Nível de Escalonamento-->
					<div class="col-sm-4">	
						<label for="Patrimonio" class="text-primary">Patrimônio</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-hashtag"></i></span>
							<input type="text" class="form-control" id="Patrimonio" name="nPatrimonio" >
						</div>
					</div>
			
			</div><!--Fim do Primeiro Bloco--> 		

			<!--Segundo Bloco do Group ROW-->
			<div class="form-group row">
					
				<!--Contato-->
				<div class="col-sm-4">
					<label for="Serie" class="text-primary"><b>Nº de Série</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-user"></i></span>
						<input type="text" class="form-control" id="Serie" name="nSerie" placeholder="Nº de Série">
					</div>	
				</div>
			
				<!--Função-->
				<div class="col-sm-4">
					<label for="Empresa" class="text-primary"><b>Empresa</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-id-card"></i></span>
						<input type="text" class="form-control" id="Empresa" name="nEmpresa" placeholder="Nome da Empresa">
					</div>	
				</div>

				<!--Contato Comercial-->
				<div class="col-sm-4">
					<label for="Marca" class="text-primary"><b>Marca</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-address-book"></i></span>
						<input type="text" class="form-control" id="Marca" name="nMarca" placeholder="Marca do equipamento">
					</div>	
				</div>
			
			</div><!--Fim do Segundo Bloco-->	


			<!--Terceiro Bloco do Group ROW-->
			<div class="form-group row">
					
				<!--Contato-->
				<div class="col-sm-4">
					<label for="Usuario" class="text-primary"><b>Usuário</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-user"></i></span>
						<input type="text" class="form-control" id="Usuario" name="nUsuario" placeholder="Usuário do equipamento">
					</div>	
				</div>
			
				<!--Função-->
				<div class="col-sm-4">
					<label for="Telefone" class="text-primary"><b>Telefone</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-id-card"></i></span>
						<input type="text" class="form-control" id="Telefone" name="nTelefone" placeholder="(11)9999-9999">
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

				<!--Contato Comercial-->
				<div class="col-sm-4">
					<label for="Ponto" class="text-primary"><b>Ponto</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-address-book"></i></span>
						<input type="text" class="form-control" id="Ponto" name="nPonto" placeholder="Ponto de Instalação">
					</div>	
				</div>
			
			</div><!--Fim do Terceiro Bloco-->	


			<!--Quarto Bloco do Group ROW-->
			<div class="form-group row">
					
				<!--Contato-->
				<div class="col-sm-4">
					<label for="Hostname" class="text-primary"><b>Hostname</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-user"></i></span>
						<input type="text" class="form-control" id="Hostname" name="nHostname" placeholder="Hostname">
					</div>	
				</div>
			
				<!--Função-->
				<div class="col-sm-4">
					<label for="Sofware" class="text-primary"><b>Sofware</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-id-card"></i></span>
						<input type="text" class="form-control" id="Sofware" name="nSofware" placeholder="Programa/Software">
					</div>	
				</div>
			</div><!--Fim do Quarto Bloco-->	


				<!--Quinto Bloco do Group ROW-->
				<div class="form-group row">
					
					<div class="col-sm-6">
						<label for="Observacao" class="text-primary"><b>Observações/Comentários:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-font"></i></span>
							<textarea class="form-control" rows="6" id="Observacao" name="nObservacao" style="resize: none;"></textarea>
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
						formAction = "../CONTROLLERS/InventarioController.php?opcao=Registrar"
						formtarget = "_self"
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
