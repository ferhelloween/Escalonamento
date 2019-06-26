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
		$(document).ready( function() {
			$.getJSON('../CONTROLLERS/InventarioController.php?opcao=Visualizar', function(data) { 

				var inventario = ""; //Variavel exibindo a tabela de itens do inventário 
					for (var i = 0 ; i < data.length; i++) {
						inventario += `
							<tr id='${data[i].cod}'>
								<td>${data[i].empresa}</td>
								<td>${data[i].tipo}</td>
								<td>${data[i].marca}</td>
								<td>${data[i].num_serie}</td>
								<td>${data[i].patrimonio}</td>
								<td>${data[i].usuario}</td>
								<td>${data[i].fone}</td>
								<td>${data[i].pont_log}</td>
								<td>${data[i].hostX}</td>

								<td>
									<button type='button' title='Informações' class='btnInfo btn btn-link'
										data-id='${data[i].cod}' 
										data-tipo = '${data[i].tipo}'
										data-empresa = '${data[i].empresa}'  
										data-marca = '${data[i].marca}'
										data-num_serie = '${data[i].num_serie}'
										data-patrimonio = '${data[i].patrimonio}'
										data-usuario = '${data[i].usuario}' 
										data-fone = '${data[i].fone}' 
										data-pont_log = '${data[i].pont_log}' 
										data-hostX = '${data[i].hostX}' 
										data-software = '${data[i].software}' 
										data-obs1 = '${data[i].obs1}' >
										 <i class='fa fa-info-circle' style='font-size:20px; color:#0066F8;'></i>
					           		</button>	
								</td>

								<td>
									<button type='button' title='Editar' class='btnEdit btn btn-link' data-id='${data[i].cod}' >
					            		 <i class='fa fa-cut' style='font-size:20px; color:#0066F8;'></i>
					           		</button>
								</td>

								<td>
									<button type='button' title='Excluir' class='btnExclui btn btn-link' data-id='${data[i].cod}' >
					            		<i class='fa fa-eraser' style='font-size:20px; color:#0066F8;'></i>
					          		</button>
								</td>
							</tr>	
						`;
					}

				$("#exiInventario").html(inventario); //Exibe a tabela	 

				//Info
				$('.btnInfo').on('click',function() { 
					var infoId = $(this).data('id'); 
					var infoTipo = $(this).data('tipo'); 
					var infoEmpresa = $(this).data('empresa'); 
					var infoMarca = $(this).data('marca'); 
					var infoNSerie = $(this).data('num_serie'); 
					var infoPatrimonio = $(this).data('patrimonio'); 
					var infoUsuario = $(this).data('usuario'); 
					var infoFone = $(this).data('fone'); 
					var infoPonto = $(this).data('pont_log');
					var infoHost = $(this).data('hostX'); 
					var infoSoftware = $(this).data('software'); 
					var infoObs = $(this).data('obs1');  

					//Exibe no HTML 
					$('#infoRegistro').html('Informações do Registro de ID: '+infoId); 
					$('#nomeTipo').html('Tipo de Item: <b>'+infoTipo+'</b>'); 
					$('#nomeEmpresa').html('Empresa fabricante/distribuidora: <b>'+infoEmpresa+'</b>'); 
					$('#nomeMarca').html('Marca do equipamento: <b>'+infoMarca+'</b>'); 
					$('#nomeNSerie').html('Número de Série: <b>'+infoNSerie+'</b>'); 
					$('#nomePatrimonio').html('Patrimônio do equipamento: <b>'+infoPatrimonio+'</b>'); 
					$('#nomeUsuario').html('Usuário do equipamento: <b>'+infoUsuario+'</b>');
					$('#nomeFone').html('Telefone de contato: <b>'+infoFone+'</b>'); 
					$('#nomePonto').html('Host do equipamento <b>'+infoHost+'</b>'); 
					$('#nomeSoftware').html('Software vinculado: <b>'+infoSoftware+'</b>'); 
					$('#nomeObs').html('Demais observações: <b>'+infoObs+'</b>'); 

					$('#myModalInfo').modal('show'); //Abre o Modal

				});	

				//Editar
				$('.btnEdit').on('click',function() { 
					var ediId = $(this).data('id'); //
					$('#Registro').text('Alteração de Registro ID ' +ediId); 
					$('#codigo').val(ediId);
					$('#pagAlterar').attr('src','formAlteraInventario.php?id='+ediId);
					$('#myModalAlterar').modal('show'); //Mostra o Modal
				});	

				//Excluir
				$('.btnExclui').on('click',function() { 
					var idE = $(this).data('id'); 
					$("#Exclusao").text('Exclusão do registro de ID: ' +idE); //Cria o Texto que irá exibir na caixa de exclusão
					$('#codigoExc').html('Deseja realmente excluir o registro de ID: <b>'+idE+'</b>?'); //Atribui o valor da idE para a id html 
					$('#excId').val(idE);
					$('#pagExcluir').attr('href','../CONTROLLERS/InventarioController.php?opcao=Excluir&escId='+idE);
					$('#myModalExcluir').modal('show'); //Mostra o Modal
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
				<th>Empresa</th>
				<th>Tipo</th>
				<th>Marca</th>
				<th>Nº de Série</th>
				<th>patrimônio</th>
				<th>Usuário</th>
				<th>Telefone</th>
				<th>Ponto</th>
				<th>Hostname</th> 
				<th>Info +</th>
				<th>Editar</th>
				<th>Excluir</th>	 	
			</tr>	
		</thead>	

		<script type="text/javascript">
		//Cria o Search in jquery 
	  		$(document).ready(function(){ 
	  			$("#pesquisar").on("keyup",function() { 
	  				var value = $(this).val().toLowerCase(); 
	  				$("#exiInventario tr").filter(function() { 
	  					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	  				});
	  			});
	  		});
	  	</script>

	  	
	  	<tbody id="exiInventario">  
	  		
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
						<div id="nomeTipo" class="text-primary"></div>
						<div id="nomeMarca" class="text-primary"></div>
						<div id="nomeNSerie" class="text-primary"></div>
						<div id="nomePatrimonio" class="text-primary"></div>
						<div id="nomeUsuario" class="text-primary"></div>
						<div id="nomeFone" class="text-primary"></div>
						<div id="nomePonto" class="text-primary"></div>
						<div id="nomeHost" class="text-primary"></div>
						<div id="nomeSoftware" class="text-primary"></div>
						<div id="nomeObs" class="text-primary"></div>
					</div><!--//Fim do Modal-Body-->	

					<!--//Modal Footer-->
					<div class='modal-footer' style='background-color: #066fa8; padding: 2px 16px; color: #FFFFFF'>
						<h6 style='color: white;'>Centro de Gerenciamento de Rede - CETEC 27</h6> 
						
					</div><!--//Fim do Modal Footer-->
																			
				</div><!--//Fim do Content-->	
												
			</div><<!--//Fim do Dialog-->

		</div><!--//Fim do Modal-->	 


		<!--//Modal de Alteração-->
		<div id='myModalAlterar' class='modal fade Registro' role='dialog'>
											
			<!--//Dialog-->	
			<div class = 'modal-dialog' style='max-width: 1100px !important; max-height: 900px !important;' role='document'>
															
				<!--//Content-->
				<div class='modal-content'>
														
					<!--//Modal Header-->
					<div class='modal-header' style='background-color: #066fa8; padding: 2px 16px; color: #FFFFFF'>
						<h5 class='modal-title' style='color: #F8F8FF; '>
							<b><div id="Registro"></div></b> 
						</h5>

						<input type="hidden" id="codigo">
																				
						<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
		       			    <span aria-hidden='true'>X</span>
				       	</button>

					</div><!--//fim do Modal Header-->	
						
					<!--Modal Body -->
					<div class='modal-body' style='height: 450px; background-color: #DCDCDC;'>
					   <iframe id="pagAlterar" style="width: 1075px; height: 425px;"></iframe>
					</div><!--//Fim do Modal-Body-->	

					<!--//Modal Footer-->
					<div class='modal-footer' style='background-color: #066fa8; padding: 2px 16px; color: #FFFFFF'>
						<h6 style='color: white;'>Centro de Gerenciamento de Rede - CETEC 27</h6> 
						
					</div><!--//Fim do Modal Footer-->
																			
				</div><!--//Fim do Content-->	
												
			</div><<!--//Fim do Dialog-->

		</div><!--//Fim do Modal-->	 	
						  		
	  			
	  		

	  	<!--Modal de Exclusão-->
		<div id='myModalExcluir' class='modal fade' role='dialog'>
			<!--Dialog-->	
			<div class = 'modal-dialog' style='max-width: 450px !important; max-height: 900px !important;' role='document'>
				<!--Content-->
					<div class='modal-content'>
					    <!--Modal Header-->
						<div class='modal-header' style='background-color: #066fa8; padding: 2px 16px; color: #FFFFFF'>
							<h5 class='modal-title' style='color: #F8F8FF;'>
								<b><div id="Exclusao"></div></b>
							</h5>
							<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
        					  <span aria-hidden='true'>&times;</span>
       						</button>
						</div><!--fim do Modal Header-->	
	
						<!--Modal Body -->
						<div class="modal-body" style="height: 200px; background-color: #DCDCDC;"> 
							 						
							<div id="codigoExc"></div>

						</div><!--Fim do Modal-Body-->	

						<!--Modal Footer-->
						<div class="modal-footer" style="background-color: #066fa8; padding: 2px 16px; color: #FFFFFF">
							<input type="hidden" id="excId" name="excId">
							<a class="btn btn-danger" id="pagExcluir">Excluir</a>
							<button type='button' class="btn btn-danger" data-dismiss='modal'>Cancelar</button> 

						</div><!--Fim do Modal Footer-->
				
					</div><!--Fim do Content-->	
			
			</div><<!--Fim do Dialog-->

		</div><!--Fim do Modal-->




</body>
</html> 
