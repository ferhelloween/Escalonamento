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
		//Script para exibição dos dados 
		$(document).ready( function() { 
			$.getJSON('../CONTROLLERS/EscalonamentoCaixaController.php?opcao=Historico', function(data) { 

				var historico = ""; //variavel que irá exibir o resultado do histórico 
					for (var i = 0 ; i < data.length; i++) { 
						historico += `
							<tr id='${data[i].cod}'> 
								<td>${data[i].gitec}</td>
								<td>${data[i].nome}</td>
								<td>${data[i].matricula}</td>
								<td>${data[i].equipe}</td>
								<td>${data[i].exc_por}</td>
								<td>${data[i].data_exclusao}</td>
								
								<td>
									<button type='button' title='Informações' class='btnInfo btn btn-link' 
					        			data-id='${data[i].cod}' 
					        			data-gitec='${data[i].gitec}'
					        			data-nome = '${data[i].nome}'
					        			data-matricula = '${data[i].matricula}'
					        			data-equipe = '${data[i].equipe}'
					        			data-funcao = '${data[i].funcao}'
					        			data-tel = '${data[i].tel}'
					        			data-cel1 = '${data[i].cel1}'
					        			data-cel2 = '${data[i].cel2}'
					        			data-hc = '${data[i].hc}'
					        			data-ot = '${data[i].ot}'
					        			data-fim_semana = '${data[i].fim_semana}'
					        			data-madrugada = '${data[i].madrugada}'
					        			data-plantao = '${data[i].plantao}' 
					        			data-obs = '${data[i].obs}'
					        			data-niv_min = '${data[i].niv_min}'
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
					var infoGitec = $(this).data('gitec');
					var infoColaborador = $(this).data('nome'); 
					var infoMatricula = $(this).data('matricula'); 
					var infoEquipe = $(this).data('equipe'); 
					var infoFuncao = $(this).data('funcao'); 
					var infoTelefone = $(this).data('tel'); 
					var infoCelular1 = $(this).data('cel1'); 
					var infoCelular2 = $(this).data('cel2'); 
					var infoHc = $(this).data('hc'); 
					var infoOt = $(this).data('ot');
					var infoFds = $(this).data('fim_semana'); 
					var infoMad = $(this).data('madrugada'); 
					var infoPlantao = $(this).data('plantao'); 
					var infoObs = $(this).data('obs'); 
					var infoNivMin = $(this).data('niv_min'); 
					var infoExc = $(this).data('exc_por'); //Cria a Variavel exibindo quem exclui 
					var infoDataExc = $(this).data('data_exclusao'); //Cria a Variavel para exibir a data de exclusão 

					
					$('#infoRegistro').html('Informações do Registro de ID:'+infoId);
					$('#nomeGitec').html('GITEC/Área: <b>'+infoGitec+'</b>'); 
					$('#nomeColaborador').html('Nome do colaborador: <b>'+infoColaborador+'</b>');
					$('#nomeMatricula').html('Matrícula: <b>'+infoMatricula+'</b>'); 
					$('#nomeEquipe').html('Equipe: <b>'+infoEquipe+'</b>'); 
					$('#nomeFuncao').html('Função do colaborador: <b>'+infoFuncao+'</b>');
					$('#nomeTelefone').html('Telefone: <b>'+infoTelefone+'</b>');
					$('#nomeCelular1').html('Celular do Contato(1): <b>'+infoCelular1+'</b>');
					$('#nomeCelular2').html('Celular do Contato(2): <b>'+infoCelular2+'</b>');
					$('#nomeHc').html('Atende em horário comercial? <b>'+infoHc+'</b>');
					$('#nomeOt').html('Atende fora do horário comercial? <b>'+infoOt+'</b>');  
					$('#nomeFds').html('Atende aos finais de semana? <b>'+infoFds+'</b>'); 
					$('#nomeMad').html('Atende de madrugada?  <b>'+infoMad+'</b>');
					$('#nomePlantao').html('Efetua plantões? <b>'+infoPlantao+'</b>'); 
					$('#nomeNivMin').html('Nível mínimo para escalonamento: <b>'+infoNivMin+'</b>'); 
					$('#nomeObservacoes').html('Demais Observações: <b>'+infoObs+'</b>');
					$('#nomeExclusao').html('Excluído por: <b>'+infoExc+'</b>'); //Excluído por 
					$('#nomeDataExclusao').html('Data de Exclusão: <b>'+infoDataExc+'</b>'); //Data de Exclusão

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
				<th>Área</th>
				<th>Nome</th>
				<th>Matrícula</th>
				<th>Equipe</th>
				<th>Excluído por</th>
				<th>Data da Exclusão</th>
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
						<div id="nomeGitec" class="text-primary"></div>
						<div id="nomeColaborador" class="text-primary"></div>
						<div id="nomeMatricula" class="text-primary"></div>
						<div id="nomeEquipe" class="text-primary"></div>
						<div id="nomeFuncao" class="text-primary"></div>
						<div id="nomeTelefone" class="text-primary"></div>
						<div id="nomeCelular1" class="text-primary"></div>
						<div id="nomeCelular2" class="text-primary"></div>
						<div id="nomeHc" class="text-primary"></div>
						<div id="nomeOt" class="text-primary"></div>
						<div id="nomeFds" class="text-primary"></div>
						<div id="nomeMad" class="text-primary"></div>
						<div id="nomePlantao" class="text-primary"></div> 
						<div id="nomeNivMin" class="text-primary"></div>
						<div id="nomeObservacoes" class="text-primary"></div>
						<div id="nomeExcluido" class="text-primary"></div>
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