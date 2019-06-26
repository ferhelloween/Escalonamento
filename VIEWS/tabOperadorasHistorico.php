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
		$(document).ready(function() { 
			$.getJSON('../CONTROLLERS/EscalonamentoController.php?opcao=Historico', function(data) { 
				var historico = ""; //Variavel que irá exibir os resultados 

					for (var i = 0 ; i < data.length; i++) { 
						historico += `
							<tr id='${data[i].cod}'> 
								<td>${data[i].operadora}</td>
								<td>${data[i].nivel}</td>
								<td>${data[i].contato}</td>
								<td>${data[i].funcao}</td>
								<td>${data[i].telefone}</td>
								<td>${data[i].exc_por}</td>
								<td>${data[i].data_exclusao}</td>
								<td>
									<button type='button' title='Informações' class='btnInfo btn btn-link' 
					        			data-id='${data[i].cod}' 
					        			data-operadora='${data[i].operadora}'
					        			data-nivel = '${data[i].nivel}'
					        			data-contato = '${data[i].contato}'
					        			data-funcao = '${data[i].funcao}'
					        			data-telefone = '${data[i].telefone}'
					        			data-opcao = '${data[i].opcao}'
					        			data-celular1 = '${data[i].celular1}'
					        			data-celular2 = '${data[i].celular2}'
					        			data-email = '${data[i].email}'
					        			data-hor_atend = '${data[i].hor_atend}'
					        			data-tpa = '${data[i].tpa}'
					        			data-hc = '${data[i].hc}'
					        			data-ot = '${data[i].ot}' 
					        			data-obs = '${data[i].obs}'
					        			data-niv_min = '${data[i].niv_min}' 
					        			data-coml = '${data[i].coml}'
					        			data-exc_por = '${data[i].exc_por}' 
					        			data-data_exclusao = '${data[i].data_exclusao}'
					        			>
					            		 <i class='fa fa-info-circle' style='font-size:20px; color:#0066F8;'></i>
					           		</button>	

								</td>
							</tr>	
						`;

					}
				
				//Preenche a tabela 
				$("#exiHistorico").html(historico);  

					//Info
				$('.btnInfo').on('click',function() { 
					var infoId = $(this).data('id');  
					var infoOpe = $(this).data('operadora');
					var infoNivel = $(this).data('nivel'); 
					var infoContato = $(this).data('contato'); 
					var infoFuncao = $(this).data('funcao'); 
					var infoTelefone = $(this).data('telefone'); 
					var infoOpcao = $(this).data('opcao'); 
					var infoCelular1 = $(this).data('celular1'); 
					var infoCelular2 = $(this).data('celular2'); 
					var infoEmail = $(this).data('email'); 
					var infoHora = $(this).data('hor_atend');
					var infoTpa = $(this).data('tpa'); 
					var infoHc = $(this).data('hc'); 
					var infoOt = $(this).data('ot'); 
					var infoObs = $(this).data('obs'); 
					var infoNivMin = $(this).data('niv_min'); 
					var infoComl =  $(this).data('coml');  
					var infoExc = $(this).data('exc_por'); 
					var infoDataExc = $(this).data('data_exclusao');

					$('#infoRegistro').html('Informações do Registro de ID:'+infoId);
					$('#nomeOperadora').html('Nome da Operadora: <b>'+infoOpe+'</b>'); 
					$('#nomeContato').html('Nome do contato: <b>'+infoContato+'</b>');
					$('#nomeFuncao').html('Função do Contato: <b>'+infoContato+'</b>'); 
					$('#nomeNivel').html('Nível de Atendimento: <b>'+infoNivel+'</b>'); 
					$('#nomeTelefone').html('Telefone do Contato: <b>'+infoTelefone+'</b>');
					$('#nomeOpcao').html('Opção/Ramal: <b>'+infoOpcao+'</b>');
					$('#nomeCelular1').html('Celular do Contato(1): <b>'+infoCelular1+'</b>');
					$('#nomeCelular2').html('Celular do Contato(2): <b>'+infoCelular2+'</b>');
					$('#nomeEmail').html('E-mail do Contato: <b>'+infoEmail+'</b>');
					$('#nomeHorario').html('Horário para o Atendimento: <b>'+infoHora+'</b>');  
					$('#nomeTpa').html('Escalonar após: <b>'+infoTpa+'</b>'); 
					$('#nomeHc').html('Atendimento no horário comercial: <b>'+infoHc+'</b>');
					$('#nomeOt').html('Atendimento fora do horário comercial: <b>'+infoOt+'</b>'); 
					$('#nomeNivMin').html('Nível mínimo para escalonamento: <b>'+infoNivMin+'</b>'); 
					$('#nomeObservacoes').html('Demais Observações: <b>'+infoObs+'</b>'); 
					$('#nomeExclusao').html('Excluído por: <b>'+infoExc+'</b>');
					$('#nomeDataExclusao').html('Data da Exclusão: <b>'+infoDataExc+'</b>');
				
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
				<th>Operadora</th>
				<th>Nível</th>
				<th>Contato</th>
				<th>Função</th>
				<th>Telefone</th>
				<th>Excluiído por</th>
				<th>Data da Exclusão</th>
				<th>Info +</th>	 	
			</tr>	
		</thead>	

		<script type="text/javascript">
		//Cria o Search in jquery 
	  		$(document).ready(function(){ 
	  			$("#pesquisar").on("keyup",function() { 
	  				var value = $(this).val().toLowerCase(); 
	  				$("#exiEscalonamento tr").filter(function() { 
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
						<div id="nomeExclusao" class="text-primary"></div>
						<div id="nomeDataExclusao" class="text-primary"></div>
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