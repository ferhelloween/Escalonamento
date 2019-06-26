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

        include_once "../MODELS/Conexao.php"; 

	   abreConexao(); //Abre a conexão com o banco de dados 
	   global $sql; //Cria a Variavel para fazer 

	   $queryUser = "
	    SELECT [nivel_usr] FROM [Inventario].[dbo].[Tb_inv_valida] WHERE login_rede = '$usuario'"; 

	    //Cria o Bloco Try Catch para tratamento 
	    try {
	      
	      $result = $sql->prepare($queryUser); 
	      $result->execute(); 

	      $lista = $result->fetch(PDO::FETCH_ASSOC);

	    } catch (Exception $e) {
	       echo  "Ocorreu um erro: <b style='color: red;>".$e->getMessage."</b>";   
	    }
	

    

?>  


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="authors" content="Cgr-Governança"/>
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
		//Futura implantação do Script para exibição dos dados 
		$(document).ready( function () { 
			$.getJSON('../CONTROLLERS/EscalonamentoCaixaController.php?opcao=Visualizar', function(data) { 

				var caixa = ""; //Variavel exibindo o escalonamento Caixa que será montado 

					for (var i = 0 ; i < data.length; i++) { 
						caixa += `
							<tr id='${data[i].cod}'>
								<td>${data[i].gitec}</td>
								<td>${data[i].nome}</td>
								<td>${data[i].matricula}</td>
								<td>${data[i].equipe}</td>
								<td>${data[i].funcao}</td>
								<td>${data[i].tel}</td>
								<td>${data[i].niv_min}</td>

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
					        			data-niv_min = '${data[i].niv_min}'>
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

				//Preenche a tabela 
				$("#exiCaixa").html(caixa);		 

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

					$('#myModalInfo').modal('show');//Abre o Modal	


				});	

				//Editar
				$('.btnEdit').on('click',function() { 
					var ediId = $(this).data('id'); //
					$('#Registro').text('Alteração de Registro ID ' +ediId); 
					$('#codigo').val(ediId);
					$('#pagAlterar').attr('src','formAlteraEscalonamentoCaixa.php?id='+ediId);
					$('#myModalAlterar').modal('show'); //Mostra o Modal
				});	

				//Excluir
				$('.btnExclui').on('click',function() { 
					var idE = $(this).data('id'); 
					$("#Exclusao").text('Exclusão do registro de ID: ' +idE); //Cria o Texto que irá exibir na caixa de exclusão
					$('#codigoExc').html('Deseja realmente excluir o registro de ID: <b>'+idE+'</b>?'); //Atribui o valor da idE para a id html 
					$('#excId').val(idE);
					$('#pagExcluir').attr('href','../CONTROLLERS/EscalonamentoCaixaController.php?opcao=Excluir&escId='+idE);
					$('#myModalExcluir').modal('show'); //Mostra o Modal
				});	

					
			});
		}); 



	</script>	
</head>
<body>
		<!--<h2 style="color: #066fa8; margin-left: 50px;"></h2>-->
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
				<th>Função</th> 
				<th>Telefone</th>
				<th>Nível Minímo</th>
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
	  				$("#exiCaixa tr").filter(function() { 
	  					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	  				});
	  			});
	  		});
	  	</script>

	  	
	  	<tbody id="exiCaixa">  
	  		
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
					   <? 
					   		if($lista['nivel_usr'] == 1 || $lista['nivel_usr'] == 4) { 
					   ?> 			
					   <iframe id="pagAlterar" style="width: 1075px; height: 425px;"></iframe> 
					   <? 
					   	} else {  
					   ?>
					   	<iframe id="pagNegado" src="negado.html" style="width: 1075px; height: 425px;"></iframe> 
					   <? 
					   	} 
					   ?>
					
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
							 						
							 <? 
					   			if($lista['nivel_usr'] == 1 || $lista['nivel_usr'] == 4) { 
					   		  ?>  						
								<div id="codigoExc"></div>
							 <? 
					   			} else {  
					   		  ?>	
					   		  	<p class="text-primary">Acesso negado - Exclusão permitida somente para administradores!!!</p>   
					   		 <? 
					   		 	}
					   		 ?> 	

						</div><!--Fim do Modal-Body-->	

						<!--Modal Footer-->
						<div class="modal-footer" style="background-color: #066fa8; padding: 2px 16px; color: #FFFFFF">
							<input type="hidden" id="excId" name="excId">
							 <? 
					   			if($lista['nivel_usr'] == 1 || $lista['nivel_usr'] == 4) { 
					   		 ?>
								<a class="btn btn-danger" id="pagExcluir">Excluir</a>
								<button type='button' class="btn btn-danger" data-dismiss='modal'>Cancelar</button> 
							 <? 
					   			} else {  
					   		  ?>	
					   		  	<button type='button' class="btn btn-danger" data-dismiss='modal'>Cancelar</button> 
					   		 <? 
					   		 	}
					   		 ?> 		
						</div><!--Fim do Modal Footer-->
				
					</div><!--Fim do Content-->	
			
			</div><<!--Fim do Dialog-->

		</div><!--Fim do Modal-->




</body>
</html>