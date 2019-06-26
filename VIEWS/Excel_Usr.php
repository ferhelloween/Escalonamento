<?php 

	#inclui a classe de Conexão 
	include_once "../MODELS/Conexao.php";

	#definir o char-set da página 
	setlocale(LC_ALL,"pt_BR"); 
	header('Content-type: text/html; charset=windows-1252'); 

	abreConexao(); //Abre a Conexão com o Banco de Dados  
	global $sql; //Variavel global que irá efetuar a conexão 

	$dataAtual = date("d-m-Y"); 

	ob_start();
	header('Content-type: application/x-msdownload');
	header('Content-Disposition: attachment; filename=usuarios_'.$dataAtual.'.xls');
	header('Pragma: no-cache');
	header('Expires: 0');
	ob_end_flush();


	if(isset($_REQUEST['nPesquisar'])) { 
		$filtro = $_REQUEST['nPesquisar']; 

		$where = "([id] LIKE '%$filtro%') OR ([login_rede] LIKE '%$filtro%') OR 
		([nome] LIKE '%$filtro%') OR
		([gitec] LIKE '%$filtro%') OR
		([nivel_usr] LIKE '%$filtro%') ";

	} 


?> 

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" /> 
	<meta name="authors" content="CGR - Governança"/>
    <meta http-equiv="X-UA-Compatible" content="ie=11"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge"><!--Compatibilidade com o Microsoft Edge-->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
</head>
<body>  
		<!--Cria a tabela que exibirá a planilha--> 
		<? 
			echo "<b>Data da pesquisa: ".$dataAtual."</b>"
		?>
		<table border="1"> 
			<thead>
				<tr>
					<th style="background-color:Gainsboro">ID</th> 
					<th style="background-color:Gainsboro">Usuário de Rede</th> 
					<th style="background-color:Gainsboro">Nome Completo</th> 
					<th style="background-color:Gainsboro">Área</th> 
					<th style="background-color:Gainsboro">Nível de permissão</th> 					
				</tr>
			</thead>

			<tbody>  
					<? 
							$queryUser = "
								SELECT [id],[login_rede],[nome],[gitec] ,[nivel_usr]
								FROM [Inventario].[dbo].[Tb_inv_valida] WHERE $where
							"; 

								$result = $sql->prepare($queryUser); //Prepara a Consulta 
								$result->execute(); //Executa a Consulta 

								foreach ($result as  $value) {
								 		$id = $value['id'];
								 		$login = $value['login_rede']; 
								 		$nome = $value['nome']; 
								 		$gitec = $value['gitec']; 
								 		$nivel = $value['nivel_usr'];  

								 		//Cria a variavel nivelText 
								 		$nivelText = ""; 
								 		if($nivel == 1) { $nivelText = "1 - Adm Global";} 
								 		else 
										if($nivel == 2) { $nivelText = "2 - Leitura Caixa";} 
								 		else 
								 		if($nivel == 3) { $nivelText = "3 - Leitura Terceirizada";} 
								 		else 
								 		if($nivel == 4) { $nivelText = "4 - Adm Local";} 
								 		else 
								 			{ $nivelText = "Registro não reconhecido"; }


								 		echo "
								 			<tr> 	
								 				<td>".$id."</td>
								 				<td>".$login."</td>
								 				<td>".$nome."</td>
								 				<td>".$gitec."</td>
								 				<td>".$nivelText."</td>
								 			</tr>	
								 		";

								 	} 	

						fechaConexao();		 	
					?> 
			</tbody>
		</table>
</body>
</html>