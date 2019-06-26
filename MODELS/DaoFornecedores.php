<?php 

	setlocale(LC_ALL,"pt_BR"); 
	header('Content-type: text/html; charset=utf-8');

	set_time_limit(1200); //Define tempo limite de execução
	ERROR_REPORTING (E_ERROR);  //Somente exibe erros fatais


	include_once "Conexao.php"; 
	include_once "Fornecedores.php"; 

	/**
	* 
	*/
	class DaoFornecedores
	{
		

		public function registrarFornecedores(Fornecedores $fornecedores) { 

			//Chama os metodos Get que serão usados para atribuir os valores para o Banco 
			$empresa = $fornecedores->getEmpresa(); 
			$contato = $fornecedores->getContato(); 
			$contatoComercial = $fornecedores->getContatoComercial(); 
			$funcao = $fornecedores->getFuncao(); 
			$telefone  = $fornecedores->gettelefone(); 
			$celular1 = $fornecedores->getCelular1(); 
			$celular2 = $fornecedores->getCelular2(); 
			$email = $fornecedores->getEmail(); 
			$ativo = $fornecedores->getAtivo(); 
			$fabricante = $fornecedores->getFabricante(); 
			$modelo = $fornecedores->getModelo(); 
			$host = $fornecedores->getHost(); 
			$localidade = $fornecedores->getLocalidade(); 
			$servico = $fornecedores->getServico(); 
			$nivelMinimo = $fornecedores->getNivelMinimo(); 
			$observacao = $fornecedores->getObservacao(); 

			abreConexao(); //Abre a Conexão com o banco de Dados 
			global $sql; //Variavel global que será responsável por executar a conexão 

			//Cria a query que será utilizadda para a criação 
			$queryInsert = "
				INSERT INTO [dbo].[tb_esc_fornecedor] ([empresa],[contato],[coml],[funcao],[tel],[cel],[cel1],[email],[ativo]
           		,[fabricante],[modelo],[host],[localidade],[servico],[niv_min],[obs]) VALUES ( ";
           	$queryInsert .= "'".$empresa."',";
           	$queryInsert .= "'".$contato."',";
           	$queryInsert .= "'".$contatoComercial."',";
           	$queryInsert .= "'".$funcao."',";
           	$queryInsert .= "'".$telefone."',";
           	$queryInsert .= "'".$celular1."',";
           	$queryInsert .= "'".$celular2."',";
           	$queryInsert .= "'".$email."',";
           	$queryInsert .= "'".$ativo."',";
           	$queryInsert .= "'".$fabricante."',";
           	$queryInsert .= "'".$modelo."',";
           	$queryInsert .= "'".$host."',";
           	$queryInsert .= "'".$localidade."',";
           	$queryInsert .= "'".$servico."',";
           	$queryInsert .= "'".$nivelMinimo."',";	
           	$queryInsert .= "'".$observacao."')";	
           		

				//Executa a Consulta 
				try {
					
					$resultInsert = $sql->prepare($queryInsert); //Prepara a Consulta 
					$resultInsert->execute();  //Executa a Consulta 

					//Cria uma variavel de Sucesso em caso de Cadastro Correto. 
					$sucesso = "<BR>
						<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
							Efetuado registro com sucesso!	
						</p>	
						<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
							<a href='../VIEWS/formFornecedores.php'>Clique aqui para efetuar um novo registro</a>
						</p>

						<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
							<a href='../VIEWS/inicial.php'>Clique aqui para retornar a tela principal</a>
						</p>
						

					"; 

					echo $sucesso; 




				} catch (Exception $e) {
					print "Ocorreu um erro: <code style='color: red;>".$e->getMessage."</code>"; 
				}
			
			fechaConexao(); // Fecha a Conexão com o Banco de Dados	


		}


		public function alterarFornecedores(Fornecedores $fornecedores) { 

			//Chama os metodos Get que serão usados para atribuir os valores para o Banco 
			$id = $fornecedores->getId();
			$empresa = $fornecedores->getEmpresa(); 
			$contato = $fornecedores->getContato(); 
			$contatoComercial = $fornecedores->getContatoComercial(); 
			$funcao = $fornecedores->getFuncao(); 
			$telefone  = $fornecedores->gettelefone(); 
			$celular1 = $fornecedores->getCelular1(); 
			$celular2 = $fornecedores->getCelular2(); 
			$email = $fornecedores->getEmail(); 
			$ativo = $fornecedores->getAtivo(); 
			$fabricante = $fornecedores->getFabricante(); 
			$modelo = $fornecedores->getModelo(); 
			$host = $fornecedores->getHost(); 
			$localidade = $fornecedores->getLocalidade(); 
			$servico = $fornecedores->getServico(); 
			$nivelMinimo = $fornecedores->getNivelMinimo(); 
			$observacao = $fornecedores->getObservacao(); 
			$userAlt = $fornecedores->getUserAlt();


			abreConexao(); //Abre a Conexão com o banco de Dados 
			global $sql; //Variavel global que será responsável por executar a conexão 


			$queryUpdate = "UPDATE [dbo].[tb_esc_fornecedor] SET"; 
			$queryUpdate .=	"[empresa] = '".$empresa."',";
			$queryUpdate .=	"[contato] = '".$contato."',";
			$queryUpdate .=	"[coml] = '".$contatoComercial."',";
			$queryUpdate .=	"[funcao] = '".$funcao."',";
			$queryUpdate .=	"[tel] = '".$telefone."',";
			$queryUpdate .=	"[cel] = '".$celular1."',";
			$queryUpdate .=	"[cel1] = '".$celular2."',";
			$queryUpdate .=	"[email] = '".$email."',";
			$queryUpdate .=	"[ativo] = '".$ativo."',";
			$queryUpdate .=	"[fabricante] = '".$fabricante."',";
			$queryUpdate .=	"[modelo] = '".$modelo."',";
			$queryUpdate .=	"[host] = '".$host."',";
			$queryUpdate .=	"[localidade] = '".$localidade."',";
			$queryUpdate .=	"[servico] = '".$servico."',";
			$queryUpdate .=	"[obs] = '".$observacao."',";
			$queryUpdate .=	"[user_alt] = '".$userAlt."',";
			$queryUpdate .=	"[niv_min] = '".$nivelMinimo."'";
			$queryUpdate .=	 "WHERE [id] = ".$id;

			//echo $queryUpdate;
			//Cria o bloco Try Catch para executar a consulta 
			try {
				//Executa a query 
				$resUpdate = $sql->prepare($queryUpdate); //Prepara a atualização
				$resUpdate->execute(); //Executa a atualização  

					//Cria uma variavel de Sucesso em caso de Cadastro Correto. 
				$sucesso = "<BR>
						<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
							Alterado registro com sucesso!	
						</p>	
						
						<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
							<a href='../VIEWS/formAlteraFornecedores.php?id=$id'>Clique aqui para retornar a tela do Registro</a>
						</p>
				"; 

				echo $sucesso; 

				
			} catch (Exception $e) {

				echo "Ocorreu um erro: <b style='color: red;>".$e->getMessage()."</b>"; 
			}

			fechaConexao();
			
		}

		public function excluirFornecedores($id) { 

			abreConexao(); //Abre a Conexão com o Banco de Dados 
			global $sql; //Varíavel global  

			//Cria a query para delete 
			$queryDelete = "
				DELETE FROM [dbo].[tb_esc_fornecedor] WHERE [id] = '$id'
			";

				try {

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



				} catch (Exception $e) {
					echo "Ocorreu um erro: <code style='color: red;>".$e->getMessage."</code>"; 
				}
	
			fechaConexao();	

		} 

		public function listarFornecedores() { 

			abreConexao(); //Abre a Conexão com o Banco de Dados 
			global $sql; //Varíavel global  
 
 			$querySelect = "
 				SELECT [id] as cod ,[empresa] ,[contato] ,[coml] ,[funcao],[tel] ,[cel] ,[cel1] ,[email],[ativo]
  			    ,[fabricante] ,[modelo] ,[host] ,[localidade] ,[servico] ,[obs] ,[user_alt] ,[niv_min]
  				FROM [Inventario].[dbo].[tb_esc_fornecedor]";

  			$fornecedores = []; //Cria um array de fornecedores	

  				//Cria o Try Catch para executar a consulta 
  				try {
  					
					$stmt = $sql->prepare($querySelect); //Prepara a Consulta  
					$stmt->execute(); //Executa a Consulta  

						//Cria o foreach para depois jogar no vetor 
						foreach ($stmt as $value) {
							
							$cod = $value['cod'];
							$empresa = $value['empresa']; 
							$contato = $value['contato']; 
							$coml = $value['coml']; 
							$funcao = $value['funcao']; 
							$tel = $value['tel']; 
							$cel = $value['cel']; 
							$cel1 = $value['cel1']; 
							$email = $value['email']; 
							$ativo = $value['ativo']; 
							$fabricante = $value['fabricante']; 
							$modelo = $value['modelo']; 
							$host = $value['host']; 
							$localidade = $value['localidade']; 
							$servico = $value['servico']; 
							$obs = $value['obs']; 
							$user_alt = $value['user_alt']; 
							$niv_min = $value['niv_min']; 


							//Cria o Vetor agrupando os dados 
							$fornecedores[] = array(
								"cod" => $cod, 
								"empresa" => $empresa, 
								"contato" => $contato, 
								"coml" => $coml, 
								"funcao" => $funcao, 
								"tel" => $tel, 
								"cel" => $cel, 
								"cel1" => $cel1, 
								"email" => $email, 
								"ativo" => $ativo, 
								"fabricante" => $fabricante,
								"modelo" => $modelo, 
								"e_hostname" => $host, 
								"localidade" => $localidade, 
								"servico" => $servico, 
								"obs" => $obs, 
								"user_alt" => $user_alt, 
								"niv_min" => $niv_min
							); 


						}

						echo json_encode($fornecedores,JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE  | JSON_PARTIAL_OUTPUT_ON_ERROR);


  				} catch (Exception $e) {
  					echo "Ocorreu um erro: <code style='color: red;>".$e->getMessage."</code>";
  				}

  			fechaConexao(); //Fecha a Conexão com o Banco	
		}

		public function consultaDocumentoExclusao($id) { 

			try {

				abreConexao(); //Abre a Conexão com o Banco de Dados 
				global $sql; //Varíavel global  
 
				$consultaExclusao = "
					SELECT [id] ,[empresa] ,[contato] ,[coml] ,[funcao],[tel] ,[cel] ,[cel1] ,[email],[ativo]
  				    ,[fabricante] ,[modelo] ,[host] ,[localidade] ,[servico] ,[obs] ,[user_alt] ,[niv_min]
  					FROM [Inventario].[dbo].[tb_esc_fornecedor] WHERE [id]=$id	";

  				$result = $sql->prepare($consultaExclusao); 
  				$result->execute(); 

  				$lista = $result->fetch(PDO::FETCH_ASSOC); 

  				$id = $lista['id']; 
  				$empresa = $lista['empresa']; 
  				$contato = $lista['contato']; 
  				$coml = $lista['coml']; 
  				$funcao = $lista['funcao']; 
  				$tel = $lista['tel']; 
  				$cel = $lista['cel']; 
  				$cel1 = $lista['cel1']; 
  				$email = $lista['email']; 
  				$ativo = $lista['ativo']; 
  				$fabricante = $lista['fabricante']; 
  				$modelo = $lista['modelo']; 
  				$host = $lista['host']; 
  				$localidade = $lista['localidade']; 
  				$servico = $lista['servico']; 
  				$obs = $lista['obs']; 
  				$user_alt = $lista['user_alt']; 
  				$niv_min = $lista['niv_min']; 		


  				fechaConexao(); //Fecha a Primeira conexão 

  				//Reabre a Conexão 
				abreConexao(); //Abre a conexão com o banco de dados 
				global $sql; //variavel global para executar a conexão


				$userExc = strtolower($_SERVER["REMOTE_USER"]);
				$userExc = split('\\\\',$userExc); 
				$userExc = $userExc[1];

				//echo $userExc."<BR>";  

				$dataExclusao = date('d-m-Y H:m:s');  

				$insereFornecedorExc = "INSERT INTO [dbo].[tb_fornecedor_hist]
          		 ([empresa],[contato],[coml],[funcao],[tel],[cel],[cel1],[email]
           		,[ativo],[modelo],[host],[localidade],[servico],[user_alt],[niv_min]
           		,[exc_por],[data_exclusao]) VALUES ("; 
           		$insereFornecedorExc .= "'".$empresa."',"; 
           		$insereFornecedorExc .= "'".$contato."',"; 
           		$insereFornecedorExc .= "'".$coml."',"; 
           		$insereFornecedorExc .= "'".$funcao."',";
           		$insereFornecedorExc .= "'".$tel."',"; 
           		$insereFornecedorExc .= "'".$cel."',"; 
           		$insereFornecedorExc .= "'".$cel1."',"; 
           		$insereFornecedorExc .= "'".$email."',"; 
           		$insereFornecedorExc .= "'".$ativo."',";
           		$insereFornecedorExc .= "'".$modelo."',"; 
           		$insereFornecedorExc .= "'".$host."',"; 
           		$insereFornecedorExc .= "'".$localidade."',"; 
           		$insereFornecedorExc .= "'".$servico."',";
           		$insereFornecedorExc .= "'".$user_alt."',"; 
           		$insereFornecedorExc .= "'".$niv_min."',"; 
           		$insereFornecedorExc .= "'".$userExc."',"; 
           		$insereFornecedorExc .= "'".$dataExclusao."')"; 
			
				$resultInsExc = $sql->prepare($insereFornecedorExc); //Prepara a consulta 
				$resultInsExc->execute(); //Executa a Conexão Enviando para a base histórica


				fechaConexao(); //Fecha a Conexão com o Banco de Dados 

				
			} catch (Exception $e) {
				echo "Ocorreu um erro: <code style='color: red;>".$e->getMessage."</code>"; 
			}

			
		}

		public function listarHistorico() { 

				try {
					
					abreConexao(); //Abre a conexão com o banco de dados 
					global $sql; //

					$queryHistorico = "
						SELECT [id] as cod,[empresa],[contato],[coml],[funcao],[tel],[cel],[cel1],[email]
      					,[ativo],[modelo],[host],[localidade],[servico],[user_alt],[niv_min],[exc_por]
					    ,[data_exclusao]  FROM [Inventario].[dbo].[tb_fornecedor_hist]
					  ";


					  $resHistorico = $sql->prepare($queryHistorico) //Prepara a Consulta 
					  $resHistorico->execute(); //Executa a consulta 
					  $lista =  $resHistorico->fetchall(PDO::FETCH_ASSOC); //Lista os objetos 

					  echo json_encode($lista,JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE  | JSON_PARTIAL_OUTPUT_ON_ERROR); 


					  fechaConexao(); //Fecha a conexão com o banco de dados

				} catch (Exception $e) {
						echo "Ocorreu um erro: <b style='color: red;>".$e->getMessage."</b>"; 				
				}


		}

		
	}


?> 