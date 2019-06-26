<?php

	setlocale(LC_ALL,"pt_BR"); 
	header('Content-type: text/html; charset=utf-8');

	set_time_limit(1200); //Define tempo limite de execução
	ERROR_REPORTING (E_ERROR);  //Somente exibe erros fatais


	include_once "Conexao.php"; 
	require_once "Usuarios.php"; 

	//Classe DaoUsuarios
	class DaoUsuarios 
	{
		
		######Criando métodos CRUD 
		
		//Função para criar usuário
		public function criarUsuario(Usuarios $usuarios) { 
			
			$login = $usuarios->getLogin(); //Instancia o Login 
			$nome = $usuarios->getNome(); //Instancia o Nome 
			$area = $usuarios->getArea(); //Instancia a Area 
			$nivel = $usuarios->getNivel(); //Instancia o Nivel  

			//Cria o método Try Catch para Execução do Insert 
			try {
				$queryInsert = "
				    INSERT INTO [dbo].[Tb_inv_valida] ([login_rede],[nome],[gitec],[nivel_usr]) VALUES(";
				$queryInsert .= "'".$login."',"; 
				$queryInsert .= "'".$nome."',"; 
				$queryInsert .= "'".$area."',"; 
				$queryInsert .= "'".$nivel."')"; 

				//echo $queryInsert."<BR>";

				abreConexao(); //Abre a conexão com o banco de dados 
				global $sql; //Variavel global para executar a conexão 

				$resultInsert = $sql->prepare($queryInsert); //Prepara o Script 
				$resultInsert->execute(); //Executa o Script de Inserção de Dados 

				//Cria uma variavel de Sucesso em caso de Cadastro Correto. 
				$sucesso = "<BR>
					<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
						Efetuado registro com sucesso!	
					</p>	
					<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
						<a href='../VIEWS/formUsuarios.php'>Clique aqui para efetuar um novo registro</a>
					</p>

					<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
						<a href='../VIEWS/inicial.php'>Clique aqui para retornar a tela principal</a>
					</p>
				"; 

				echo $sucesso; 
				//header('Refresh: 3; url=../inicial.php');
		
				fechaConexao(); // Fecha a Conexão com o Banco de Dados
		
			} catch (Exception $e) {
				echo "Ocorreu um erro: <b style='color: red;>".$e->getMessage."</b>";		
			}
		}
 
 		//Função para editar usuário
 		public function editarUsuario(Usuarios $usuarios) {  

 				$id = $usuarios->getId();  //Instancia o ID que será usado para efetuar a alteração do registro 
 				$login = $usuarios->getLogin(); //Instancia o Login 
				$nome = $usuarios->getNome(); //Instancia o Nome 
				$area = $usuarios->getArea(); //Instancia a Area 
				$nivel = $usuarios->getNivel(); //Instancia o Nivel  

				//Cria o Bloco Try Catch para efetuar a alteração 
				try {
					
					abreConexao(); //Abre a conexão com o banco de dados 
					global $sql; //Variavel global para executar a conexão  

					//Cria o Script de update
					$queryUpdate = "UPDATE [dbo].[Tb_inv_valida] SET"; 
					$queryUpdate .= "[login_rede] = '".$login."',"; 
					$queryUpdate .= "[nome] = '".$nome."',"; 
					$queryUpdate .= "[gitec] = '".$area."',"; 
					$queryUpdate .= "[nivel_usr] = '".$nivel."'"; 
					$queryUpdate .= "WHERE [id] = '".$id."'";

					//echo $queryUpdate."<BR>";


					$resultUpdate = $sql->prepare($queryUpdate); //Prepara a Consulta 
					$resultUpdate->execute();//Executa a Consulta 


					//Cria uma variavel de Sucesso em caso de Cadastro Correto. 
					$sucesso = "<BR>
						<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
							Alterado registro com sucesso!	
						</p>	
						
						<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
							<a href='../VIEWS/formAlteraUsuarios.php?id=$id'>Clique aqui para retornar a tela do Registro</a>
						</p>
					"; 

					echo $sucesso; 

					fechaConexao();

				 } catch (Exception $e) {
				 	print "Ocorreu um erro: <b style='color: red;>".$e->getMessage."</b>";
				 } 

 		} 

 		//Função para excluir usuário
 		public function excluirUsuario($id) { 
 			
 			try {
 				  
 					abreConexao(); //Abre a Conexão com o Banco de Dados 
					global $sql; //Varíavel global 

					$queryDelete = "
						DELETE FROM [dbo].[Tb_inv_valida] WHERE [id] = '$id'
					"; 

					$result = $sql->prepare($queryDelete); //Prepara a consulta 
					$result->execute(); //Executa a consulta 

							//Cria uma variavel de Sucesso em caso de Cadastro Correto. 
					$sucesso = "<BR>
						<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
							Usuário Excluido com Sucesso!!!	
						</p>	
						
						<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
							<a href='../VIEWS/inicial.php'>Clique aqui para retornar a tela principal</a>
						</p>
						"; 

					echo $sucesso; 

					fechaConexao();	
 
 				} catch (Exception $e) {
 					print "Ocorreu um erro: <b style='color: red;>".$e->getMessage."</b>";
 				}	
 		} 

 		//Função para listar usuário 
 		public function listarUsuarios() { 
 				
 				//Cria o Bloco Try Catch para exibir os resultados 
 				try {
				
					$querySelect = "
						   SELECT [id] as cod, [login_rede] as login,
   						   [nome] as nome,  
  						  [gitec] as area, [nivel_usr] as nivel FROM [Inventario].[dbo].[Tb_inv_valida] 
					"; 

					abreConexao(); //Abre a Conexão com o Banco De Dados
					global $sql; //Variavel Global que será usada para a Conexão

					//echo $querySelect."<BR><BR>";

					$result = $sql->prepare($querySelect); //Prepara a Consulta -> PDO 
					$result->execute(); //Executa a Consulta -> PDO 

					$teste = [];

					foreach ($result as $value) {
						$cod = $value['cod']; 
						$login = $value['login']; 
						$nome = $value['nome']; 
						$area = $value['area']; 
						$nivel = $value['nivel']; 
						
							if ($nivel == 1) { 
								$nivel_saida = "1(Acesso Admin)";	
								
							} else if ($nivel == 2) { 
								$nivel_saida = "2(Acesso Leitura CAIXA)";
								
							} else if ($nivel == 3) { 
								$nivel_saida = "3(Acesso Leitura Terceiro)";
								
							} else if ($nivel == 4) { 
								$nivel_saida = "4(Acesso Adm Local)";
								
							} else { 
								$nivel_saida = "Não Reconhecido";
								
							}


						$teste[] = array( 
							"cod" => $cod, 
							"login" => $login, 
							"nome" => $nome, 
							"area" => $area, 
							"nivel" => $nivel_saida

						);
						
					}
	
					echo json_encode($teste,JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE  | JSON_PARTIAL_OUTPUT_ON_ERROR);

					fechaConexao();
 			
 				} catch (Exception $e) {
					print "Ocorreu um erro: <b style='color: red;>".$e->getMessage."</b>"; 					 					
 				}
 		}

 	}



?>