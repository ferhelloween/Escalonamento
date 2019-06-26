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
				SELECT [id],[empresa] ,[contato] ,[coml] ,[funcao],[tel] ,[cel] ,[cel1] ,[email],[ativo]
  			    ,[fabricante] ,[modelo] ,[host] ,[localidade] ,[servico] ,[obs] ,[user_alt] ,[niv_min]
  				FROM [Inventario].[dbo].[tb_esc_fornecedor]  WHERE [id] = $idd
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
		<br> 
		<fieldset class="borda-form" style="width: 90%;">
			<form name="regEscalonamento" method="POST">
				<input type="hidden" id="cod" name="nCod" value="<?=$lista['id'];?>">
				<br>	
				<!--Primeiro Bloco do Group ROW-->		
				<div class="form-group row">
					<!--Nome da Operadora-->
					<div class="col-sm-8">	
						<label for="Empresa" class="text-primary">Nome da Empresa</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-institution"></i></span>
							<input type="text" class="form-control" id="Empresa" name="nEmpresa" value="<?=$lista['empresa'];?>" placeholder="Nome da Empresa">
						</div>
					</div>
				</div><!--Fim do Primeiro Bloco--> 	


				<!--Segundo Bloco do Group ROW-->
				<div class="form-group row">
					
					<!--Contato-->
					<div class="col-sm-4">
						<label for="Contato" class="text-primary"><b>Contato:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="text" class="form-control" id="Contato" name="nContato" value="<?=$lista['contato'];?>" placeholder="Nome do Contato">
						</div>	
					</div>
					<!--Função-->
					<div class="col-sm-4">
						<label for="Funcao" class="text-primary"><b>Função:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-id-card"></i></span>
							<input type="text" class="form-control" id="Funcao" name="nFuncao" value="<?=$lista['funcao'];?>" placeholder="Função do Contato">
						</div>	
					</div>

					<!--Contato Comercial-->
					<div class="col-sm-2">
						<label for="ContComercial" class="text-primary"><b>Contato comercial:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-address-book"></i></span>
							<select class="form-control" id="ContComercial" name="nContComercial" required >
								<option value="$lista['coml'];?>"><?=$lista['coml'];?></option>
								<option value="">Selecione...</option>
								<option value="Não" default>Não</option>
								<option value="Sim" >Sim</option>
							</select>
						</div>	
					</div>
				</div><!--Fim do Segundo Bloco-->	 

				<!--Terceiro Bloco do Group ROW-->
				<div class="form-group row">
					
					<!--Telefone-->
					<div class="col-sm-3">
						<label for="Telefone" class="text-primary"><b>Telefone:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-phone"></i></span>
							<input type="text" class="form-control" id="Telefone" value="<?=$lista['tel'];?>" name="nTelefone" placeholder="(99)1111-1111" 
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
					

					<!--Celular 1-->
					<div class="col-sm-3">
						<label for="Celular1" class="text-primary"><b>Celular 1:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
							<input type="text" class="form-control" id="Celular1" name="nCelular1" value="<?=$lista['cel'];?>" placeholder="(99)99999-9999"
							maxlength="14" pattern="\([0-9]{2}\)[0-9]{5}-[0-9]{4}">
							<script type="text/javascript">$("#Celular1").mask("(00)00000-0000");</script>
						</div>	
					</div>


					<!--Celular 2-->
					<div class="col-sm-3">
						<label for="Celular2" class="text-primary"><b>Celular 2:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
							<input type="text" class="form-control" id="Celular2" name="nCelular2" value="<?=$lista['cel1'];?>" placeholder="(99)99999-9999"
							maxlength="14" pattern="\([0-9]{2}\)[0-9]{5}-[0-9]{4}">
							<script type="text/javascript">$("#Celular2").mask("(00)00000-0000");</script>
						</div>	
					</div>
				</div><!--Fim do Terceiro Bloco-->	 
				
				<!--Quarto Bloco do Group ROW-->
				<div class="form-group row">

					<!--E-Mail-->
					<div class="col-sm-4">
						<label for="Email" class="text-primary"><b>Email:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
							<input type="text" class="form-control" id="Email" name="nEmail" value="<?=$lista['email'];?>" placeholder="email@exemplo.com">
						</div>	
					</div> 

					<!--Escalonar Após-->
					<div class="col-sm-3">
						<label for="Ativo" class="text-primary"><b>Ativo:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-microchip"></i></span>
							<select class="form-control" id="Ativo" name="nAtivo" required>
								<option value="$lista['ativo'];?>"><?=$lista['ativo'];?></option>
								<option value="">Selecione...</option>
								<option value="Concentrador de VPN">Concentrador de VPN</option>
								<option value="Concentrador de GRE">Concentrador de GRE</option>
								<option value="Switch">Switch</option>
								<option value="Roteador">Roteador</option>
								<option value="Firewall">Firewall</option>
							</select>
						</div>	
					</div>


					<!--Escalonar Após-->
					<div class="col-sm-3">
						<label for="Fabricante" class="text-primary"><b>Fabricante:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-institution"></i></span>
							<select class="form-control" id="Fabricante" name="nFabricante" >
								<option value="<?=$lista['fabricante'];?>"><?=$lista['fabricante'];?></option>
								<option value="">Selecione...</option>
								<option value="CISCO">CISCO</option>
								<option value="HUAWEI">HUAWEI</option>
								<option value="JUNIPER">JUNIPER</option>
								<option value="EXTREME">EXTREME</option>
								<option value="H3C">H3C</option>
							</select>
						</div>	
					</div>	
				</div><!--Fim do Qaurto Bloco-->	 
				
			

				<!--Quinto Bloco do Group ROW-->
				<div class="form-group row">
					<!--Modelo-->
					<div class="col-sm-4">
						<label for="Modelo" class="text-primary"><b>Modelo:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-object-group"></i></span>
							<input type="text" class="form-control" id="Modelo" value="<?=$lista['modelo'];?>" name="nModelo" placeholder="Modelo">
						</div>	
					</div>

					<!--Host-->
					<div class="col-sm-3">
						<label for="Host" class="text-primary"><b>Host:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-rss"></i></span>
							<input type="text" class="form-control" id="Host" value="<?=$lista['host'];?>" name="nHost" placeholder="Host">
						</div>	
					</div>

					<!--Localidade-->
					<div class="col-sm-3">
						<label for="Localidade" class="text-primary"><b>Localidade:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-map"></i></span>
							<input type="text" class="form-control" id="Localidade" value="<?=$lista['localidade'];?>"  name="nLocalidade" placeholder="Localidade">
						</div>	
					</div>	

				</div><!--Fim do Quinto Bloco -->	

				<!--Sexto Bloco do Group ROW-->
				<div class="form-group row">
					
					<!--Serviço-->
					<div class="col-sm-3">
						<label for="Servico" class="text-primary"><b>Serviço:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-wrench"></i></span>
							<input type="text" class="form-control" id="Servico" value="<?=$lista['servico'];?>" name="nServico" placeholder="Serviço">
						</div>	
					</div>	

					<!--Nível de Escalonamento-->
					<div class="col-sm-6">
						<label for="Nivel" class="text-primary"><b>Nível Mínimo de Escalonamento:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-level-down"></i></span>
							<select class="form-control" id="Nivel" name="nNivel" >
								<option value="<?=$lista['niv_min'];?>"><?=$lista['niv_min'];?></option>
								<option value="">Selecione...</option>
								<option value="Coordenador Tercerizado">Coordenador terceirizado</option>
								<option value="Preposto terceirizado">Preposto terceirizado</option>
								<option value="Operador terceirizado">Operador terceirizado</option>
								<option value="Gestor Caixa">Gestor Caixa</option>
								<option value="Coordenador Caixa">Coordenador Caixa</option>
								<option value="Analista Caixa">Analista Caixa</option>
							</select>
						</div>	
					</div>	
		
				</div><!--Fim do Sexto Bloco-->
				
				<!--Sétimo Bloco do Group ROW-->
				<div class="form-group row">
					<div class="col-sm-6">
						<label for="Observacao" class="text-primary"><b>Observações/Comentários:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-font"></i></span>
							<textarea class="form-control" rows="3" id="Observacao" name="nObservacao" style="resize: none;"><?=$lista['obs'];?></textarea>
						</div>	
					</div>
				</div><!--Fim do Sétimo Bloco-->	
				
				<br>	
				
				<input type="hidden" id="registroUsr" name="nUsr" value="<?=$usuario;?>"> <!--Usuário que efetuou o registro--> 
				<input type="hidden" id="registroHora" name="nHora" value="<?=$data_at;?>"> <!--Data atual do registro-->


				<button type="submit" 
						value="Enviar" 
						name="Enviar" 
						class="btn btn-primary" 
						formaction="../CONTROLLERS/FornecedoresController.php?opcao=Alterar"
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