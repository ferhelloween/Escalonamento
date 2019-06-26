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

		$where = " ([operadora] LIKE '%$filtro%') OR 
		([sigla] LIKE '%$filtro%') OR
		([observacao] LIKE '%$filtro%') ";

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
					<th style="background-color:Gainsboro">Operadora</th>
					<th style="background-color:Gainsboro">Sigla</th>
					<th style="background-color:Gainsboro">Observações</th>
				</tr> 
			</thead>	

			<tbody>
				
					<? 

						//Cria a Query 
						$queryOpe = "
							SELECT [id],[operadora],[sigla],[observacao]
      						 FROM [Inventario].[dbo].[tbl_oper_escalona]
      						 WHERE $where
						";

						//echo $queryOpe;

						$result = $sql->prepare($queryOpe); //Prepara a Consulta 
						$result->execute();  //Executa a Consulta 

						foreach ($result as  $value) {
							echo "<tr><td>".$value['id']."</td>";
							echo "<td>".$value['operadora']."</td>";
							echo "<td>".$value['sigla']."</td>";
							echo "<td>".$value['observacao']."</td></tr>";
						}


						fechaConexao();		 	

					?>	
					
			</tbody>
	</table>
</body>
</html> 