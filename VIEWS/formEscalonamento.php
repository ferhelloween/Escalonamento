<?php 
	########### CABEÇALHO PHP #####################	

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
	  		//Cria o Script que irá criar a lista 
	  		$(document).ready(function() { 
	  			//$('#Operadora').html('<option value="">Selecione...</option>');

	  			//Inicia a função 
	  			$.getJSON('../CONTROLLERS/EscalonamentoController.php?opcao=Listar', function(data) { 
	  				if(data.length > 0) { 
	  					var option = '<option value="">Selecione...</option>'; 
	  					$.each(data,function(i,obj) { 
	  						option += '<option value="'+ obj.operadora +'">' + obj.operadora + '</option>';
	  					});
	  				} else { 
	  					Reset();
	  				}
	  				//Exibe o resultado 
	  				$('#Operadora').html(option).show();	
	  			});	
	  		});
	  </script>  
</head>
<body> 
		
		<fieldset class="borda-form" style="width: 90%;">
			<form name="regEscalonamento" method="POST">
				<br>	
				<!--Primeiro Bloco do Group ROW-->		
				<div class="form-group row">
					<!--Nome da Operadora-->
					<div class="col-sm-6">	
						<label for="Operadora" class="text-primary">Operadora</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-wifi"></i></span>
							<select class="form-control" id="Operadora" name="nOperadora" required>
															
							</select>
						</div>
					</div>

					<!--Nível de Escalonamento-->
					<div class="col-sm-2">	
						<label for="Nivel" class="text-primary">Nível</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-hashtag"></i></span>
							<input type="number" class="form-control" id="Nivel" name="nNivel" placeholder="0-10" min="0" max="10">
						</div>
					</div>
				</div><!--Fim do Primeiro Bloco--> 	


				<!--Segundo Bloco do Group ROW-->
				<div class="form-group row">
					
					<!--Contato-->
					<div class="col-sm-6">
						<label for="Contato" class="text-primary"><b>Contato:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="text" class="form-control" id="Contato" name="nContato" placeholder="Nome do Contato">
						</div>	
					</div>
					<!--Função-->
					<div class="col-sm-4">
						<label for="Funcao" class="text-primary"><b>Função:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-id-card"></i></span>
							<input type="text" class="form-control" id="Funcao" name="nFuncao" placeholder="Função do Contato">
						</div>	
					</div>

					<!--Contato Comercial-->
					<div class="col-sm-2">
						<label for="ContComercial" class="text-primary"><b>Contato comercial:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-address-book"></i></span>
							<select class="form-control" id="ContComercial" name="nContComercial" >
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
							<input type="text" class="form-control" id="Telefone" name="nTelefone" placeholder="(99)1111-1111" 
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
					<!--Opção-->
					<div class="col-sm-3">
						<label for="Opcao" class="text-primary"><b>Opção:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" id="Opcao" name="nOpcao" placeholder="Nome do Contato">
						</div>	
					</div>

					<!--Celular 1-->
					<div class="col-sm-3">
						<label for="Celular1" class="text-primary"><b>Celular 1:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
							<input type="text" class="form-control" id="Celular1" name="nCelular1" placeholder="(99)99999-9999" 
							maxlength="14" pattern="\([0-9]{2}\)[0-9]{5}-[0-9]{4}">
							<script type="text/javascript">$("#Celular1").mask("(00)00000-0000");</script>
						</div>	
					</div>


					<!--Celular 2-->
					<div class="col-sm-3">
						<label for="Celular2" class="text-primary"><b>Celular 2:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
							<input type="text" class="form-control" id="Celular2" name="nCelular2" placeholder="(99)99999-9999" 
							maxlength="14" pattern="\([0-9]{2}\)[0-9]{5}-[0-9]{4}">
							<script type="text/javascript">$("#Celular2").mask("(00)00000-0000");</script>
						</div>	
					</div>
				</div><!--Fim do Terceiro Bloco-->	 
				
				<!--Quarto Bloco do Group ROW-->
				<div class="form-group row">

					<!--E-Mail-->
					<div class="col-sm-6">
						<label for="Email" class="text-primary"><b>Email:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
							<input type="text" class="form-control" id="Email" name="nEmail" placeholder="email@exemplo.com">
						</div>	
					</div> 

					<!--Horario de Atendimento-->
					<div class="col-sm-3">
						<label for="Atendimento" class="text-primary"><b>Horario de Atendimento:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
							<select class="form-control" id="Atendimento" name="nAtendimento" >
								<option value="Comercial">Comercial</option>
								<option value="24x7" >24x7</option>
							</select>
						</div>	
					</div>	

					<!--Escalonar Após-->
					<div class="col-sm-3">
						<label for="Escalonar" class="text-primary"><b>Escalonar Após:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
							<select class="form-control" id="Escalonar" name="nEscalonar" >
								<option value="0h">0h</option>
								<option value="1h">1h</option>
								<option value="2h">2h</option>
								<option value="3h">3h</option>
								<option value="4h">4h</option>
								<option value="5h">5h</option>
								<option value="6h">6h</option>
								<option value="7h">7h</option>
								<option value="8h">8h</option>
								<option value="9h">9h</option>
								<option value="10h">10h</option>
								<option value="11h">11h</option>
								<option value="12h">12h</option>
								<option value="13h">13h</option>
								<option value="14h">14h</option>
								<option value="15h">15h</option>
								<option value="16h">16h</option>
								<option value="17h">17h</option>
								<option value="18h">18h</option>
								<option value="19h">19h</option>
								<option value="20h">20h</option>
							</select>
						</div>	
					</div>	
				</div><!--Fim do Qaurto Bloco-->	 
				

				<!--Quinto Bloco do Group ROW-->
				<div class="form-group row">
					<!--Escalonar Após-->
					<div class="col-sm-12">
						<label class="text-primary">Período de Atendimento</label>
						<div class="input-group">
							<label class="checkbox-inline text-primary"><input type="checkbox" id="hc" name="nEscHc" value="1">Horário Comercial</label> 
							<label class="checkbox-inline text-primary"><input type="checkbox" id="ot" name="nEscOt" value="1">Fora do Horário Comercial</label>
						</div>	 
					</div>	
				
				</div><!--Fim do Quinto Bloco-->					

				<!--Sexto Bloco do Group ROW-->
				<div class="form-group row">
					<!--Escalonar Após-->
					<div class="col-sm-3">
						<label for="NivelMinimo" class="text-primary"><b>Nível Mínimo de Escalonamento:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-hashtag"></i></span>
							<select class="form-control" id="NivelMinimo" name="nNivelMinimo" >
								<option value="">Selecione...</option>
								<option value="Terceiro-Tecnico">Terceiro-Técnico</option>
								<option value="Terceiro-Preposto">Terceiro-Preposto</option>
								<option value="Gestor Caixa">Caixa-Gestor</option>
								<option value="Analista Caixa">Caixa-Analista</option>
							</select>
						</div>	
					</div>	

					<div class="col-sm-6">
						<label for="Observacao" class="text-primary"><b>Observações/Comentários:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-font"></i></span>
							<textarea class="form-control" rows="3" id="Observacao" name="nObservacao" style="resize: none;"></textarea>
						</div>	
					</div>
				</div><!--Fim do Sexto Bloco -->	 

				
				<br>	
				<input type="hidden" id="registroUsr" name="nUsr" value="<?=$usuario;?>"> <!--Usuário que efetuou o registro--> 
				<input type="hidden" id="registroHora" name="nHora" value="<?=$data_at;?>"> <!--Data atual do registro-->


				<button type="submit" 
						value="Enviar" 
						name="Enviar" 
						class="btn btn-primary" 
						formaction="../CONTROLLERS/EscalonamentoController.php?opcao=Registrar"
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
