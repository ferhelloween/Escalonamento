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

	  <!--Script que irá exbir a tabela-->	
	  <script type="text/javascript">
	  		$(document).ready(function(){ 
	  			//Captura o retorno da tabela que contem as unidades 
	  			$.getJSON('../CONTROLLERS/UsuariosController.php?opcao=Visualizar', function(data) { 

	  				var usuarios = ""; 

	  				for (var i = 0; i < data.length; i++) {
	  					usuarios += ` 
	  						<tr> 
	  							<td>${data[i].cod}</td>
	  							<td>${data[i].login}</td>
	  							<td>${data[i].nome}</td>
	  							<td>${data[i].area}</td>
	  							<td>${data[i].nivel}</td>
	  							
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
	  							</td>
	  						</tr>
	  					`;	
	  				}

	  				//Preenche a tabela 
	  				$("#exiUsuarios").html(usuarios); 


	  				//Função para abrir os modais 
	  				$('.btnEdit').on('click',function(){ 
	  					var id = $(this).data('id'); //Cria a Variavel ID 
	  					$('#Registro').text('Alteração de Registro ID ' +id); 
						$('#codigo').val(id);
						$('#pagAlterar').attr('src','formAlteraUsuarios.php?id='+id);
						$('#myModalAlterar').modal('show'); //Mostra o Modal
	  				});	


	  				 //Função para abrir modal de exclusão - Criando  
					$('.btnExclui').click(function() {
					 	var idE = $(this).data('id'); 
					 	$("#Exclusao").text('Exclusão do registro de ID: ' +idE); //Cria o Texto que irá exibir na caixa de exclusão
					 	$('#codigoExc').html('Deseja realmente excluir o registro de ID: <b>'+idE+'</b>?'); //Atribui o valor da idE para a id html 
					 	$('#excId').val(idE);
					 	$('#pagExcluir').attr('href','../CONTROLLERS/UsuariosController.php?opcao=Excluir&excId='+idE);
					    $('#myModalExcluir').modal('show'); //Mostra o Modal
					});

	  			});
	  		});


	  </script>
</head>

<!--Início do Corpo da Página-->
<body>

	<br> 

	<form accept-charset="utf-8" method="POST" > 
		<!--Primeiro Bloco do Group ROW-->		
		<div class="form-row align-itens-center">
			<div class="col-auto"> 
				<button  type="submit" value="Gerar" name="Gerar" class="btn btn-primary" style="margin-left: 10px;" formaction="Excel_Usr.php">
		 			Gerar Excel <i class="fa fa-file-excel-o"> </i>
		 		</button>
			</div> 
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
	  			<th>ID</th>
	  			<th>Login de Rede</th>
	  			<th>Nome do Funcionário</th>
	  			<th>Área de Atuação</th>
	  			<th>Nível de Permissão</th>
	  			<th>Alterar</th>
	  			<th>Excluir</th>	
	  		</tr>	


	  	</thead>	
	  	<script type="text/javascript">
	  		//Cria o Search in jquery 
	  		$(document).ready(function(){ 
	  			$("#pesquisar").on("keyup",function() { 
	  				var value = $(this).val().toLowerCase(); 
	  				$("#exiUsuarios tr").filter(function() { 
	  					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	  				});
	  			});
	  		});
	  	</script>


	  	<tbody id="exiUsuarios"> 
	
 		
	  	</tbody>	

	</table>	 

	<!--Modais-->

	<!--//Modal de Alteração-->
	<div id='myModalAlterar' class='modal fade Registro' role='dialog'>
											
		<!--//Dialog-->	
		<div class = 'modal-dialog' style='max-width: 1000px !important; max-height: 900px !important;' role='document'>
															
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
				   <iframe id="pagAlterar" style="width: 975px; height: 425px;"></iframe>
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