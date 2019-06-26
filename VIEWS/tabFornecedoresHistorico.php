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
	<meta name="authors" content="CGR-Governança"/>
    <meta http-equiv="X-UA-Compatible" content="ie=11"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge"><!--Compatibilidade com o Microsoft Edge-->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> 

    <!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

	<!--CSS Bootstrap e Próprios-->
	<link rel="stylesheet" type="text/css" href="../LIB/BOOTSTRAP_4/css/bootstrap.min.css"><!--BootStrap-->
	<link rel="stylesheet" type="text/css" href="../LIB/CSS/newPages.css"/><!--CSS Adicional-->
			
	
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

 	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="../LIB/BOOTSTRAP_4/js/bootstrap.min.js"></script>
 
 

	  
	<style type="text/css">
		body { 
			background-color: #F0F8FF;
		}	

	</style>  

	<script type="text/javascript">
			//Cria o Script para  exibição dos dados 
		$(document).ready(function() { 
			$.getJSON('../CONTROLLERS/FornecedoresController.php?opcao=Historico', function(data) { 

				var historico = ""; //Variavel que irá exbir os fornecedores registrados 

					for (var i = 0 ; i < data.length; i++) {
							historico += `
								<tr id='${data[i].cod}'> 
									<td>${data[i].empresa}</td>
									<td>${data[i].contato}</td>
									<td>${data[i].funcao}</td>
									<td>${data[i].tel}</td>
									<td>${data[i].exc_por}</td>
									<td>${data[i].data_exclusao}</td>
									<td>
						        		<button type='button' title='Informações' class='btnInfo btn btn-link' 
						        			data-id='${data[i].cod}' 
						        			data-empresa='${data[i].empresa}'
						        			data-contato = '${data[i].contato}'
						        			data-coml = '${data[i].coml}'
						        			data-funcao = '${data[i].funcao}'
						        			data-tel = '${data[i].tel}'
						        			data-cel = '${data[i].cel}'
						        			data-cel1 = '${data[i].cel1}'
						        			data-email = '${data[i].email}'
						        			data-ativo = '${data[i].ativo}'
						        			data-fabricante = '${data[i].fabricante}'
						        			data-modelo = '${data[i].modelo}'
						        			data-e_hostname = '${data[i].e_hostname}'
						        			data-localidade = '${data[i].localidade}' 
						        			data-servico = '${data[i].servico}'
						        			data-obs = '${data[i].obs}' 
						        			data-niv_min = '${data[i].niv_min}'
						        			data-exc_por = '${data[i].exc_por}'
						        			data-data_exclusao = '${data[i].data_exclusao}'	>
						            		 <i class='fa fa-info-circle' style='font-size:20px; color:#0066F8;'></i>
						           		</button>
					        		</td>
					 			</tr>
							`; 
						}  

					//Preenche a tabela 
					$("#exiHistorico").html(fornecedores); 	 

						//Preenche os modais 
					$('.btnInfo').on('click', function() { 

						var infoId = $(this).data('id'); //Cria a Variavel buscando o ID do Registro 
						var infoEmpresa = $(this).data('empresa'); //Cria a variavel buscando a Empresa do Registro 
						var infoContato = $(this).data('contato');//Cria a variavel buscando o Contato do Registro
						var infoComl = $(this).data('coml'); //Cria a variavel buscando se o Contato é Comercial no Registro 
						var infoFuncao = $(this).data('funcao'); //Cria a variavel buscando a função do contato no registro 
						var infoTel = $(this).data('tel'); //Cria a variavel buscando o telefone do contato no Registro 
						var infoCel = $(this).data('cel'); //Cria a variavel buscando o celular do contato no Registro 
						var infoCel1 = $(this).data('cel1'); //Cria a variavel buscando o segundo celular do contato no Registro 
						var infoEmail = $(this).data('email'); //Cria a variavel buscando o e-mail do contato no Registro 
						var infoAtivo = $(this).data('ativo'); //Cria a variavel buscando o ativo do Registro
						var infoFabricante = $(this).data('fabricante'); //Cria a Variavel buscando o fabricante do ativo no Registro 
						var infoModelo = $(this).data('modelo'); //Cria a Variavel buscando o modelo do ativo no Registro 
						var infoHostname = $(this).data('e_hostname'); //Cria a variavel buscando o hostname do ativo no Registro 
						var infoLocalidade = $(this).data('localidade'); //Cria a variavel buscando a localidade do ativo no Registro 
						var infoServico = $(this).data('servico'); //Cria a variavel buscando o serviço realizado pelo ativo no Registro 
						var infoObs = $(this).data('obs'); //Cria a variavel buscando demais informações do registro 
						var infoNivel = $(this).data('niv_min'); //Cria a variavel exibindo o nível  
						var infoExc = $(this).data('exc_por'); //Cria a Variavel exibindo quem exclui 
						var infoDataExc = $(this).data('data_exclusao'); //Cria a Variavel para exibir a data de exclusão 


						//cria os outputs que serão exibidos nas DIVS HTML 
						$('#infoRegistro').html('Informações do registro de ID: '+infoId); //Info
						$('#nomeEmpresa').html('Nome da empresa: <b>'+infoEmpresa+'</b>'); //Empresa
						$('#nomeContato').html('Nome do contato: <b>'+infoContato+'</b>'); //Empresa
						$('#nomeComl').html('É comercial: <b>'+infoComl+'</b>'); //Empresa
						$('#nomeFuncao').html('Função do contato: <b>'+infoFuncao+'</b>'); //Empresa
						$('#nomeTel').html('Telefone do Contato: <b>'+infoTel+'</b>'); //Empresa
						$('#nomeCelular1').html('Celular(1) do Contato: <b>'+infoCel+'</b>'); //Empresa
						$('#nomeCelular2').html('Celular(2) do Contato: <b>'+infoCel1+'</b>'); //Empresa
						$('#nomeEmail').html('E-mail do Contato: <b>'+infoEmail+'</b>'); //Empresa
						$('#nomeAtivo').html('Ativo : <b>'+infoAtivo+'</b>'); //Empresa
						$('#nomeFabricante').html('Fabricante do ativo: <b>'+infoFabricante+'</b>'); //Empresa
						$('#nomeModelo').html('Modelo do ativo: <b>'+infoModelo+'</b>'); //Empresa
						$('#nomeHostname').html('Hostname do ativo: <b>'+infoHostname+'</b>'); //Empresa
						$('#nomeLocalidade').html('Localidade do ativo: <b>'+infoLocalidade+'</b>'); //Empresa
						$('#nomeServico').html('Serviço realizado: <b>'+infoServico+'</b>'); //Empresa
						$('#nomeObservacoes').html('Observacões: <b>'+infoObs+'</b>'); //Empresa
						$('#nomeNivMin').html('Nível minimo para contato: <b>'+infoNivel+'</b>'); //Empresa 
						$('#nomeExclusao').html('Excluído por: <b>'+infoExc+'</b>'); //Excluído por 
						$('#nomeDataExclusao').html('Data de Exclusão: <b>'+infoDataExc+'</b>'); //Data de Exclusão

						
						//Abre o Modal 
						$('#myModalInfo').modal('show');//Abre o Modal	
					});	

				});
	
			});	
		


	</script>
</head>
<body>
	
	<br>
	<form accept-charset="utf-8" method="POST" > 
		<!--Primeiro Bloco do Group ROW-->		
		<div class="form-row align-itens-center">
			<div class="col-sm-4" style="margin-left: 30px">
				<label for="pesquisar" class="sr-only text-primary">Pesquisar</label>
				<div class="input-group">
					<div class="input-group-prepend">
						 <div class="input-group-text"><i class="fa fa-search"></i></div>
					</div>	
					<input type="search" class="form-control" id="pesquisar" name="nPesquisar" placeholder="Pesquisar">
				</div>

			</div>	
		</div>	
	</form>  
	
	<br>	

	<table class="table table-striped table-bordered"> 
		<thead class="bg-primary">
			<tr>
				<th>Nome da Empresa</th>
				<th>Contato</th>
				<th>Função</th>
				<th>Telefone</th>
				<th>Excluído Por</th>
				<th>data da Exclusão</th> 
				<th>Info +</th>
			</tr>	
		</thead>	

		<script type="text/javascript">
		//Cria o Search in jquery 
	  		$(document).ready(function(){ 
	  			$("#pesquisar").on("keyup",function() { 
	  				var value = $(this).val().toLowerCase(); 
	  				$("#exiHistorico tr").filter(function() { 
	  					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	  				});
	  			});
	  		});
	  	</script>

	  	
	  	<tbody id="exiHistorico">  
	  		
	  	</tbody>	 

		</table>  


		<!--//Modal de Alteração-->
		<div id='myModalInfo' class='modal fade Registro' role='dialog'>
											
			<!--//Dialog-->	
			<div class = 'modal-dialog' style='max-width: 500px !important; max-height: 900px !important;' role='document'>
															
				<!--//Content-->
				<div class='modal-content'>
														
					<!--//Modal Header-->
					<div class='modal-header' style='background-color: #066fa8; padding: 2px 16px; color: #FFFFFF'>
						<h5 class='modal-title' style='color: #F8F8FF; '>
							<b><div id="infoRegistro"></div></b> 
						</h5>

						<input type="hidden" id="codigo">
																				
						<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
		       			    <span aria-hidden='true'>X</span>
				       	</button>

					</div><!--//fim do Modal Header-->	
						
					<!--Modal Body -->
					<div class='modal-body' style='height: 450px; background-color: #DCDCDC;'>
						<div id="nomeOperadora" class="text-primary"></div>
						<div id="nomeNivel" class="text-primary"></div>
						<div id="nomeContato" class="text-primary"></div>
						<div id="nomeFuncao" class="text-primary"></div>
						<div id="nomeComercial" class="text-primary"></div>
						<div id="nomeTelefone" class="text-primary"></div>
						<div id="nomeOpcao" class="text-primary"></div>
						<div id="nomeCelular1" class="text-primary"></div>
						<div id="nomeCelular2" class="text-primary"></div>
						<div id="nomeEmail" class="text-primary"></div>
						<div id="nomeHorario" class="text-primary"></div>
						<div id="nomeTpa" class="text-primary"></div>
						<div id="nomeHc" class="text-primary"></div>
						<div id="nomeOt" class="text-primary"></div> 
						<div id="nomeNivMin" class="text-primary"></div>
						<div id="nomeObservacoes" class="text-primary"></div>
						<div id="nomeExclusao" class="text-primary" ></div>
						<div id="nomeDataExclusao" class="text-primary" ></div>
					</div><!--//Fim do Modal-Body-->	

					<!--//Modal Footer-->
					<div class='modal-footer' style='background-color: #066fa8; padding: 2px 16px; color: #FFFFFF'>
						<h6 style='color: white;'>Centro de Gerenciamento de Rede - CETEC 27</h6> 
						
					</div><!--//Fim do Modal Footer-->
																			
				</div><!--//Fim do Content-->	
												
			</div><<!--//Fim do Dialog-->

		</div><!--//Fim do Modal-->	 


</body>
</html>