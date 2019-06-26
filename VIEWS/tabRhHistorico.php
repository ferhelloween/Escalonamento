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
			$.getJSON('../CONTROLLERS/RhController.php?opcao=HistoricoRh', function(data) { 

				var rh = ""; //Vairavel para exbir os resultados 
				for (var i = 0; i < data.length; i++) {
					rh +=  `	
						<tr id='${data[i].cod}'> 
							<td>${data[i].empresa}</td>
							<td>${data[i].matricula}</td>
							<td>${data[i].nome}</td>
							<td>${data[i].ramal}</td>
							<td>${data[i].excPor}</td>
							<td>${data[i].desligamento}</td>

							<td>
								<button type='button' title='Informações' class='btnInfo btn btn-link'
									data-id = '${data[i].cod}'
									data-empresa = '${data[i].empresa}'
									data-matricula = '${data[i].matricula}'
									data-nome = '${data[i].nome}'
									data-ramal = '${data[i].ramal}'
									data-cel = '${data[i].cel}'
									data-funcao = '${data[i].funcao}'
									data-gsc = '${data[i].gsc}'
									data-excpor = '${data[i].excPor}'
					        		data-desligamento = '${data[i].desligamento}'
								> 	
									<i class='fa fa-info-circle' style='font-size:20px; color:#0066F8;'></i>	
								</button>	
							</td>
						</tr>	
					`; 
				}

			//Preenche a tabela 
			$("#exiHistRh").html(rh); 	

			$('.btnInfo').on('click',function() {  

				var infoId = $(this).data('id');
				var infoEmpresa = $(this).data('empresa');
				var infoMatricula = $(this).data('matricula');
				var infoNome = $(this).data('nome');
				var infoRamal = $(this).data('ramal');
				var infoCel = $(this).data('cel');
				var infoFuncao = $(this).data('funcao');
				var infoGsc = $(this).data('gsc');
				var excPor = $(this).data('excpor'); //Cria a Variavel exibindo quem exclui 
				var dataExc = $(this).data('desligamento'); //Cria a Variavel para exibir a data de exclusão 

				$('#infoRegistro').html('Informações do Registro de ID: '+infoId); //Esta informação ficará no titulo do modal 


				$('#nomeEmpresa').html('Empresa do colaborador: <b>'+infoEmpresa+'</b>'); // Empresa do Colaborador
				$('#nomeFuncionario').html('Nome do colaborador: <b>'+infoNome+'</b>'); //Nome do Funcionário 
				$('#nomeMatricula').html('Matrícula do colaborador: <b>'+infoMatricula+'</b>'); //Matricula do Funcionário 
				$('#nomeRamal').html('Ramal do colaborador: <b>'+infoRamal+'</b>'); //Ramal do Funcionário 
				$('#nomeCel').html('Celular do colaborador: <b>'+infoCel+'</b>'); //Celular do Funcionário 
				$('#nomeFuncao').html('Função do colaborador: <b>'+infoFuncao+'</b>'); //Função do Funcionário 
				$('#nomeGsc').html('Grupo do colaborador no GSC: <b>'+infoGsc+'</b>'); //Grupo GSC do Funcionário 
				$('#excluidoPor').html('Excluído por: <b>'+excPor+'</b>'); //Excluído por 
				$('#dataExclusao').html('Data de Exclusão: <b>'+dataExc+'</b>'); //Data de Exclusão

				$('#myModalInfo').modal('show');//Abre o Modal	
			});



			}); //Fim do GetJSON 
		}); //FIm da Função Jquery


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
				<th>Empresa</th>
				<th>Matrícula</th>
				<th>Nome</th>
				<th>Ramal</th>
				<th>Excluído Por</th>
				<th>Data/Desligamento</th>
				<th>Info +</th>
			</tr>	
		</thead>	

		<script type="text/javascript">
		//Cria o Search in jquery 
	  		$(document).ready(function(){ 
	  			$("#pesquisar").on("keyup",function() { 
	  				var value = $(this).val().toLowerCase(); 
	  				$("#exiHistRh tr").filter(function() { 
	  					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	  				});
	  			});
	  		})	;
	  	</script>

	  	
	  	<tbody id="exiHistRh">  
	  		
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
						<div id="nomeEmpresa" class="text-primary"></div>
						<div id="nomeFuncionario" class="text-primary"></div>
						<div id="nomeMatricula" class="text-primary"></div>
						<div id="nomeRamal" class="text-primary"></div>
						<div id="nomeCel" class="text-primary"></div>
						<div id="nomeFuncao" class="text-primary"></div>
						<div id="nomeGsc" class="text-primary"></div>
						<div id="excluidoPor" class="text-primary" ></div>
						<div id="dataExclusao" class="text-primary" ></div>
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