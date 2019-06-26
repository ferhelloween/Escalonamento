<?php 
	//Arquivo que irá atribuir as funções de conexão em PHP utilizando PDO 
	
	###########Cabeçalho PHP 
	setlocale(LC_ALL,"pt_BR"); 
	header('Content-type: text/html; charset=utf-8');

	$ADODB_COUNTRECS = true;  

	function abreConexao() { 
		global $sql; 
		$sql =  new PDO('odbc:Driver={SQL Server};Server=.;Database=Inventario; charset=utf8;Uid=retirada;Pwd=retirada');  
		$sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
		$sql->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
		$sql->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
		
	}	 

	function fechaConexao() { 
		global $sql; 
		$sql = null; //Fecha a conexão 
	}

?> 