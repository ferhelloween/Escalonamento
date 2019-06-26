
<?php
	
	setlocale(LC_ALL,"pt_BR"); 
	header('Content-type: text/html; charset=utf-8');

	set_time_limit(1200); //Define tempo limite de execução
	ERROR_REPORTING (E_ERROR);  //Somente exibe erros fatais


	include_once "Conexao.php"; 
	require_once "Operadoras.php"; 


	class DaoOperadoras { 

			//Criando métodos CRUD 
			public function registrarOperadora(Operadoras $operadoras) { 

				$operadora =  $operadoras->getOperadora(); 
				$sigla = $operadoras->getSigla(); 
				$observacao = $operadoras->getObservacao();
				$usuario =  $operadoras->getUsuario(); 
				$dataRegistro = $operadoras->getDataRegistro();



				//Cria o método Try Catch para a Conexão 	
				try { 
					$queryInsert = "
						INSERT INTO [dbo].[tbl_oper_escalona] ([operadora],[sigla],[observacao],[usuario],[hora_reg]) VALUES ("; 
					$queryInsert .= "'".$operadora."',"; 
					$queryInsert .= "'".$sigla."',";
					$queryInsert .= "'".$observacao."',";
					$queryInsert .= "'".$usuario."',";
					$queryInsert .= "'".$dataRegistro."')";	  

					//echo $queryInsert."<BR>"; 

					abreConexao(); 
					global $sql; //Variavel global para utilizar na Conexão 

					$resultInsert = $sql->prepare($queryInsert); 
					$resultInsert->execute();  

					//Cria uma variavel de Sucesso em caso de Cadastro Correto. 
					$sucesso = "<BR>
						<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
							Efetuado registro com sucesso!	
						</p>	
						<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
							<a href='../VIEWS/formOperadoras.php'>Clique aqui para efetuar um novo registro</a>
						</p>

						<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
							<a href='../VIEWS/inicial.php'>Clique aqui para retornar a tela principal</a>
						</p>
						

					"; 

					echo $sucesso; 
					//header('Refresh: 3; url=../inicial.php');
		
					fechaConexao(); // Fecha a Conexão com o Banco de Dados
					
				} catch (Exception $e) {
					print "Ocorreu um erro: <code style='color: red;>".$e->getMessage."</code>"; 
					
				}
			   
			} 


			//Função para alterar o registro
			public function alterarOperadora(Operadoras $operadoras) { 

				try { 
				//Busca o ID para alterar o registro correto 
				$id = $operadoras->getId(); 

				//Demais Campos para alteração 
				$operadora =  $operadoras->getOperadora(); 
				$sigla = $operadoras->getSigla(); 
				$observacao = $operadoras->getObservacao(); 

				abreConexao(); //Abre a Conexão com o Banco de Dados 
				global $sql; //Varíavel global 

				$queryUpdate = "UPDATE [dbo].[tbl_oper_escalona] SET";
				$queryUpdate .= "[operadora] = '".$operadora."',";
				$queryUpdate .= "[sigla] = '".$sigla."',"; 
				$queryUpdate .= "[observacao] = '".$observacao."'"; 
				$queryUpdate .= "WHERE [id] = ".$id;

				//echo $queryUpdate."<BR><BR>";

				//Executa a query 
				$resUpdate = $sql->prepare($queryUpdate); //Prepara a atualização
				$resUpdate->execute(); //Executa a atualização  

				//Cria uma variavel de Sucesso em caso de Cadastro Correto. 
				$sucesso = "<BR>
						<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
							Alterado registro com sucesso!	
						</p>	
						
						<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
							<a href='../VIEWS/formAlteraOperadoras.php?id=$id'>Clique aqui para retornar a tela do Registro</a>
						</p>
				"; 

				echo $sucesso; 

				fechaConexao();
				} catch(Exception $e2) { 
					print "Ocorreu um erro: <b style='color: red;>".$e->getMessage()."</b>"; 
				}	
			
			} 

			//Função para excluir um registro
			public function excluirOperadora($id) { 
					try {

						
						abreConexao(); //Abre a Conexão com o Banco de Dados 
						global $sql; //Varíavel global 

						$queryDelete = "
							DELETE FROM [dbo].[tbl_oper_escalona] WHERE [id] = '$id'
						"; 

						$result = $sql->prepare($queryDelete); //Prepara a consulta 
						$result->execute(); //Executa a consulta


							//Cria uma variavel de Sucesso em caso de Cadastro Correto. 
						$sucesso = "<BR>
						<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
							Registro Excluido com Sucesso!!!	
						</p>	
						
						<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
							<a href='../VIEWS/inicial.php'>Clique aqui para retornar a tela principal</a>
						</p>
						"; 

						echo $sucesso; 


						fechaConexao();

					} catch (Exception $e) {
						print "Ocorreu um erro: <code style='color: red;>".$e->getMessage."</code>"; 
					}

			} 

			//Função para listar um unico id 
			public function listarOperadoraPorId($id) { 
				//Cria o bloco try catch para exibir o resultado
				try {  


					$queryPorId = "
						SELECT [id] as cod,[operadora],[sigla],[observacao],[usuario],[hora_reg] 
						FROM [dbo].[tbl_oper_escalona] WHERE [id] = $id; 
					"; 

					echo $queryPorId;

					abreConexao(); //Abre a Conexão com o Banco de Dados 
					global $sql; //Varíavel global 

					$result = $sql->prepare($queryPorId); 
					$result->bindValue(1,$id);
					$result->execute();
					sleep(1); 
					echo json_encode($result->fetch(PDO::FETCH_ASSOC)); 

					
					fechaConexao();
					
					//return $resBusca;
					
				} catch (Exception $e4) {
					print "Ocorreu um erro: <code style='color: red;>".$e4->getMessage."</code>"; 
				}

			}	


			//Função para listar os registros 
			public function listarOperadoras() { 

				//Cria o bloco Try Catch para exibir os resultados 
				try {

						abreConexao(); //Abre a conexão com o banco de dados 
						global $sql; //Variavel para efetuar a Conexão 

						$querySelect = "
							SELECT [id] as cod,[operadora],[sigla],[observacao],[usuario],[hora_reg] FROM [dbo].[tbl_oper_escalona]
						"; 

						
						$stmt = $sql->prepare($querySelect); //Prepara a Consulta  
						$stmt->execute();

						$oper = []; //Cria o Array de operadoras 

							foreach ($stmt as $value) {
								$cod = $value['cod']; //Irá exibir os códigos 
								$operadora = $value["operadora"];
								$sigla =  $value["sigla"];
								$observacao =  $value["observacao"];
								$usuario = $value["usuario"];
								$hora_reg = $value["hora_reg"];  

								$oper[] = [ 
									"cod" => $cod, 
									"operadora" => $operadora, 
									"sigla" => $sigla, 
									"observacao" => $observacao, 
									"usuario" => $usuario, 
									"hora_reg" => $hora_reg

								]; 

						}


						echo json_encode($oper,JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE  | JSON_PARTIAL_OUTPUT_ON_ERROR);	

						fechaConexao();	
				
					} catch (Exception $e5) {
						print "Ocorreu um erro: <code style='color: red;>".$e5->getMessage."</code>"; 
					}	
			//return $json_result;
		  }

	}

?>