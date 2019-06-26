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

	//echo $lista['nivel_usr'];    

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

		.ttcomercial { 
			position: relative;
 		} 	

		 .comText { 
			visibility: hidden;
		    width: 80px;
		    background-color: #000080;
		    color: #FFFFFF;
			font-size: 12px;
		    text-align: center;
		    border-radius: 6px;
		    padding: 0 5px;
		    position: absolute;
		    z-index: 1;
		    bottom: 40%;
		    left: 101%;
		    margin-left: -120px;
		    opacity: 0;
		    transition: opacity 1s;
		 } 

		 .ttcomercial:hover span.comText {visibility: visible; opacity: 1;}

	</style>  

	<script type="text/javascript">
		//Futura implantação do Script para exibição dos dados  
		$(document).ready( function() {  
			<? 
				if ($lista['nivel_usr'] == 1 || $lista['nivel_usr'] == 2 || $lista['nivel_usr'] == 4) {
			?>			
				$.getJSON('../CONTROLLERS/EscalonamentoController.php?opcao=Visualizar', function(data) { 
			<? 
				} else  if($lista['nivel_usr'] == 3) { 
			?>		
				$.getJSON('../CONTROLLERS/EscalonamentoController.php?opcao=VisualizarN', function(data) { 
			<? 
				}
			?>

				var escalonamento = ""; //Variavel exibindo o escalonamento que será montada

					for (var i = 0 ; i < data.length; i++) { 

						escalonamento += `
							<tr id='${data[i].cod}'> 
								<td>${data[i].operadora}</td>
								<td>${data[i].nivel}</td>
								<td class='ttcomercial'>${data[i].contatoT}</td>
								<td>${data[i].tpa}</td>
								<td>${data[i].telefone}</td>
								<td>${data[i].celular1}</td>
								<td>${data[i].niv_min}</td>
							
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
					        			data-coml = '${data[i].coml}'>
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
				$("#exiEscalonamento").html(escalonamento); 

				//Função para Abrir os modais 
				
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

					$('#infoRegistro').html('Informações do Registro de ID:'+infoId);
					$('#nomeOperadora').html('Nome da Operadora: <b>'+infoOpe+'</b>'); 
					$('#nomeContato').html('Nome do contato: <b>'+infoContato+'</b>');
					$('#nomeFuncao').html('Função do Contato: <b>'+infoFuncao+'</b>'); 
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

					$('#myModalInfo').modal('show');//Abre o Modal	


				});	

				//Editar
				$('.btnEdit').on('click',function() { 
					var ediId = $(this).data('id'); //
					$('#Registro').text('Alteração de Registro ID ' +ediId); 
					$('#codigo').val(ediId);
					$('#pagAlterar').attr('src','formAlteraEscalonamento.php?id='+ediId);
					$('#myModalAlterar').modal('show'); //Mostra o Modal
				});	

				//Excluir
				$('.btnExclui').on('click',function() { 
					var idE = $(this).data('id'); 
					$("#Exclusao").text('Exclusão do registro de ID: ' +idE); //Cria o Texto que irá exibir na caixa de exclusão
					$('#codigoExc').html('Deseja realmente excluir o registro de ID: <b>'+idE+'</b>?'); //Atribui o valor da idE para a id html 
					$('#excId').val(idE);
					$('#pagExcluir').attr('href','../CONTROLLERS/EscalonamentoController.php?opcao=Excluir&escId='+idE);
					$('#myModalExcluir').modal('show'); //Mostra o Modal
				});	

					
			});
		});
	</script>
</head>

<!--Corpo da Tabela-->
<body> 
	<br>
	<!--<h2 style="color: #066fa8; margin-left: 50px;"></h2>--> 
	<p class="text-primary" style="margin-left: 25px;">
		<b>1.</b> O SLA contratado para restabelecimento de circuitos é de 4 horas.<br> 
		<b>2.</b> Todo tempo de escalonamento deve ser considerado a partir da hora da queda do circuito no SIREA.<br>  
		<b>3.</b> Para incidentes envolvendo Painel Negocial, Extranet e Backbone, o tempo de escalonamento deve ser reduzido pela metade.
	</p>
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
				<th>Escalonar após</th>
				<th>Telefone</th>
				<th>Celular</th>
				<th>Nível Mínimo</th> 
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
	  				$("#exiEscalonamento tr").filter(function() { 
	  					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	  				});
	  			});
	  		});
	  	</script>

	  	
	  	<tbody id="exiEscalonamento">  
	  		
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