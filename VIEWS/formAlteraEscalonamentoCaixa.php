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
	 	SELECT [id] ,[gitec],[nome],[matricula],[equipe],[funcao]
      	,[tel],[cel1],[cel2],[hc],[ot],[fim_semana],[madrugada]
     	,[plantao],[obs],[user_alt],[niv_min]
  		FROM [Inventario].[dbo].[tb_esc_GITEC] WHERE [id] = $idd
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

	    <script> 
			//Criando a função para alterar o valor do Hidden do Horario Comercial  
			function AlterarHiddenComercial() { 
				var checkComercial = document.getElementById("hc"); 
				document.getElementById("hiddenhc").value = "<?=$lista['hc']?>"; 
					//Caso checkbox fique marcado 
					if(checkComercial.checked == true) 
						{ 
							//var confirmaComercial = confirm("tem certeza que deseja alterar o campo?")
							document.getElementById("hiddenhc").value = "1"; 
						} else { 
							document.getElementById("hiddenhc").value = "0"; 
					}
					
			}		
			
			//Criando a função para alterar o valor do Hidden do Horario Comercial  
			function AlterarHiddenOut() { 
				var checkOut = document.getElementById("ot"); 
				document.getElementById("hiddenot").value = "<?=$lista['ot']?>"; 
					//Caso checkbox fique marcado 
					if(checkOut.checked == true) 
						{ 
							//var confirmaComercial = confirm("tem certeza que deseja alterar o campo?")
							document.getElementById("hiddenot").value = "1"; 
						} else { 
								document.getElementById("hiddenot").value = "0"; 
						}
						
			}	

				//Criando a função para alterar o valor do Hidden do Horario Comercial  
			function AlterarHiddenFds() { 
				var checkFds = document.getElementById("fs"); 
				document.getElementById("hiddenfds").value = "<?=$lista['fim_semana']?>"; 
					//Caso checkbox fique marcado 
					if(checkFds.checked == true) 
						{ 
							//var confirmaComercial = confirm("tem certeza que deseja alterar o campo?")
							document.getElementById("hiddenfds").value = "1"; 
						} else { 
								document.getElementById("hiddenfds").value = "0"; 
						}
						
			}	

				//Criando a função para alterar o valor do Hidden do Horario Comercial  
			function AlterarHiddenMad() { 
				var checkMad = document.getElementById("ma"); 
				document.getElementById("hiddenmad").value = "<?=$lista['madrugada']?>"; 
					//Caso checkbox fique marcado 
					if(checkMad.checked == true) 
						{ 
							//var confirmaComercial = confirm("tem certeza que deseja alterar o campo?")
							document.getElementById("hiddenmad").value = "1"; 
						} else { 
							document.getElementById("hiddenmad").value = "0"; 
						}
						
			}	
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
					<!--Nome do Funcionário-->
					<div class="col-sm-8">	
						<label for="Funcionario" class="text-primary">Nome do Funcionário</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="text" class="form-control" id="Funcionario" name="nFuncionario" value="<?=$lista['nome'];?>" placeholder="Nome do Funcionário">
						</div>
					</div>
				</div><!--Fim do Primeiro Bloco--> 	


				<!--Segundo Bloco do Group ROW-->
				<div class="form-group row">
					
					<!--Matrícula-->
					<div class="col-sm-2">
						<label for="Matricula" class="text-primary"><b>Matrícula:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class=" 	fa fa-hashtag"></i></span>
							<input type="text" class="form-control" id="Matricula" name="nMatricula" value="<?=$lista['matricula']; ?>"placeholder="C000000">
						</div>	
					</div>
					<!--Área-->
					<div class="col-sm-3">
						<label for="Area" class="text-primary"><b>Área:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-building"></i></span>
							<select class="form-control" id="Area" name="nArea" >
								<option value="<?=$lista['gitec']?>"><?=$lista['gitec']?></option>
								<option value="">Selecione...</option>
								<option value="GITECPO">GITEC/PO</option>
								<option value="GITECFL">GITEC/FL</option>
								<option value="GITECCT">GITEC/CT</option>
								<option value="GITECSP">GITEC/SP</option>
								<option value="GITECCP">GITEC/CP</option>
								<option value="GITECBU">GITEC/BU</option>
								<option value="GITECRJ">GITEC/RJ</option>
								<option value="GITECBH">GITEC/BH</option>
								<option value="GITECCG">GITEC/CG</option>
								<option value="GITECGO">GITEC/GO</option>
								<option value="GITECBR">GITEC/BR</option>
								<option value="GITECSA">GITEC/SA</option>
								<option value="GITECRE">GITEC/RE</option>
								<option value="GITECFO">GITEC/FO</option>
								<option value="GITECBE">GITEC/BE</option>
								<option value="GITECMN">GITEC/MN</option>
								<option value="CEPTISP">CEPTI/SP</option>
								<option value="CEPTIRJ">CEPTI/RJ</option>
								<option value="CEPTIBR">CEPTI/BR</option>
								<option value="CETEC">CETEC</option>
								<option value="SUETI02">SUETI02</option>
								<option value="CETAD">CETAD</option>
								<option value="GERTI">GERTI</option>
							</select>
						</div>	
					</div>

					<!--Equipe Comercial-->
					<div class="col-sm-3">
						<label for="Equipe" class="text-primary"><b>Equipe:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-users"></i></span>
							<select class="form-control" id="Equipe" name="nEquipe" >
								<option value="<?=$lista['equipe']?>"><?=$lista['equipe']?></option>
								<option value="">Selecione...</option>
								<option value="Caixa">Caixa</option>
								<option value="Terceira">Terceira</option>
							</select>
						</div>	
					</div>

					<!--Função-->
					<div class="col-sm-4">
						<label for="Funcao" class="text-primary"><b>Função:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-wrench"></i></span>
							<input type="text" class="form-control" id="Funcao" name="nFuncao" value="<?=$lista['funcao']?>"  placeholder="Funcao do funcionario">
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
							<input type="text" class="form-control" id="Telefone" value="<?=$lista['tel']?>" name="nTelefone" placeholder="(99)1111-1111">
							<script>
								$("#Telefone").keypress(function(event) { 
									var campo = $(this).val(); 
										//Irá verificar os primeiros digitos informados 
										if(campo !== "" && campo.substring(0,2) === "08" || campo.substring(0,3) === "(08") { 
											$("#Telefone").mask("0000-000-0000");
										} else {
											$("#Telefone").mask("(00) 0000-0000");
									}
										// console.log(campo.substring(0, 2));
								});		
							</script>


						</div>	
					</div>

					<!--Celular 1-->
					<div class="col-sm-3">
						<label for="Celular1" class="text-primary"><b>Celular 1:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
							<input type="text" class="form-control" id="Celular1" value="<?=$lista['cel1']?>" name="nCelular1" placeholder="(99)99999-9999">
							<script type="text/javascript">$("#Celular1").mask("(00)00000-0000");</script>
						</div>	
					</div>


					<!--Celular 2-->
					<div class="col-sm-3">
						<label for="Celular2" class="text-primary"><b>Celular 2:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
							<input type="text" class="form-control" id="Celular2" value="<?=$lista['cel2']?>" name="nCelular2" placeholder="(99)99999-9999">
							<script type="text/javascript">$("#Celular2").mask("(00)00000-0000");</script>
						</div>	
					</div>
				</div><!--Fim do Terceiro Bloco-->	 
				
				<!--Quarto Bloco do Group ROW-->
				<div class="form-group row">
					
					<!--Período de Atendimento-->
					<div class="col-sm-12">
						<label class="text-primary">Período de Atendimento</label>
						<div class="input-group">
							<label class="checkbox-inline text-primary">
							<input type="checkbox" id="hc" name="nEscHc" value="<?=$lista['hc']?>" <? if($lista['hc'] == 1) echo "checked='checked'"?> onclick="AlterarHiddenComercial()">
							<input type="hidden" id="hiddenhc" name="escHiddenHc" value="<?=$lista['hc']?>"  />
							Horário Comercial
							</label> 
							
							<label class="checkbox-inline text-primary">
							<input type="checkbox" id="ot" name="nEscOt" value="<?=$lista['ot']?>" <? if($lista['ot'] == 1) echo "checked='checked'"?> onclick="AlterarHiddenOut()">
							<input type="hidden" id="hiddenot" name="escHiddenOt" value="<?=$lista['ot']?>"  />	
							Fora do Horário Comercial
							</label> 
							
							<label class="checkbox-inline text-primary">
							<input type="checkbox" id="fs" name="nEscFs" value="<?=$lista['fim_semana']?>" <? if($lista['fim_semana'] == 1) echo "checked='checked'"?> onclick="AlterarHiddenFds()">
							<input type="hidden" id="hiddenfds" name="escHiddenFds" value="<?=$lista['fim_semana']?>"  />
							Fins de Semana
							</label> 
							
							<label class="checkbox-inline text-primary">
							<input type="checkbox" id="ma" name="nEscMa" value="<?=$lista['madrugada']?>" <? if($lista['madrugada'] == 1) echo "checked='checked'"?> onclick="AlterarHiddenMad()">
							<input type="hidden" id="hiddenmad" name="escHiddenMad" value="<?=$lista['madrugada']?>"  />
							Madrugada
							</label>
						
						</div>
					</div>	
				</div><!--Fim do Quarto Bloco-->		
		

				<!--Quinto Bloco do Group ROW-->
				<div class="form-group row">
				
					<!--Plantão-->
					<div class="col-sm-4">
						<label for="Plantao" class="text-primary"><b>Plantão:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
							<select class="form-control" id="Plantao" name="nPlantao" >
								<option value="<?=$lista['plantao']?>"><?=$lista['plantao']?></option>
								<option value="">Selecione...</option>
								<option value="Sim">Sim</option>
								<option value="Não">Não</option>
							</select>
						</div>	
					</div>

					<!--Escalonar-->
					<!--<div class="col-sm-3">
						<label for="Escalonar" class="text-primary"><b>Escalonar:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
							<select class="form-control" id="Escalonar" name="nEscalonar" >
								<option value="">Selecione...</option>
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
							</select>
						</div>	
					</div>--> 

					<!--Nível de Escalonamento-->
					<div class="col-sm-4">
						<label for="Nivel" class="text-primary"><b>Nível Mínimo de Escalonamento:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-level-down"></i></span>
							<select class="form-control" id="Nivel" name="nNivel" >
								<option value="<?=$lista['niv_min']?>"><?=$lista['niv_min']?></option>
								<option value="-">Selecione...</option>
								<option value="-">-</option>
								<option value="Coordenador Tercerizado">Coordenador terceirizado</option>
								<option value="Preposto terceirizado">Preposto terceirizado</option>
								<option value="Operador terceirizado">Operador terceirizado</option>
								<option value="Gestor Caixa">Gestor Caixa</option>
								<option value="Coordenador Caixa">Coordenador Caixa</option>
								<option value="Analista Caixa">Analista Caixa</option>
							</select>
						</div>	
					</div>	
				
				</div><!--Fim do Quinto Bloco -->	

					
				<!--Sexto Bloco do Group ROW-->
				<div class="form-group row">
					
					<!--Observação-->
					<div class="col-sm-6">
						<label for="Observacao" class="text-primary"><b>Observações/Comentários:</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-font"></i></span>
							<textarea class="form-control" rows="3" id="Observacao" name="nObservacao" style="resize: none;"><?=$lista['obs']?></textarea>
						</div>	
					</div>
				</div><!--Fim do Sexto Bloco-->	
				
				<br>	
				
				<input type="hidden" id="registroUsr" name="nUsr" value="<?=$usuario;?>"> <!--Usuário que efetuou o registro--> 
				<input type="hidden" id="registroHora" name="nHora" value="<?=$data_at;?>"> <!--Data atual do registro-->


				<button type="submit" 
						value="Enviar" 
						name="Enviar" 
						class="btn btn-primary" 
						formaction="../CONTROLLERS/EscalonamentoCaixaController.php?opcao=Alterar" 
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
