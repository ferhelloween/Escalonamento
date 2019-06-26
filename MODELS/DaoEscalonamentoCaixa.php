<?php 


	setlocale(LC_ALL,"pt_BR"); 
	header('Content-type: text/html; charset=utf-8');


	set_time_limit(1200); //Define tempo limite de execução
	ERROR_REPORTING (E_ERROR);  //Somente exibe erros fatais
	
	include_once "Conexao.php"; 
	include_once "EscalonamentoCaixa.php"; 



	class DaoEscalonamentoCaixa
	{
		

		public function  registrarEscalonamentoCaixa(EscalonamentoCaixa $escalonamentoCaixa) { 

			//Chama os metodos Get que serão usados para atribuir os valores para o Banco 
			$nome = $escalonamentoCaixa->getNome(); 
			$matricula = $escalonamentoCaixa->getMatricula(); 
			$area = $escalonamentoCaixa->getArea(); 
			$equipe = $escalonamentoCaixa->getEquipe(); 
			$funcao = $escalonamentoCaixa->getFuncao(); 
			$telefone = $escalonamentoCaixa->getTelefone(); 
			$celular1 = $escalonamentoCaixa->getCelular1(); 
			$celular2 = $escalonamentoCaixa->getCelular2(); 
			$hc = $escalonamentoCaixa->getHc(); 
			$ot = $escalonamentoCaixa->getOc(); 
			$fds = $escalonamentoCaixa->getFds(); 
			$mad = $escalonamentoCaixa->getMad(); 
			$plantao = $escalonamentoCaixa->getPlantao(); 
			$nivmin = $escalonamentoCaixa->getNivMin(); 
			$observacao = $escalonamentoCaixa->getObservacao(); 


			abreConexao(); //Abre a Conexão com o banco de Dados 
			global $sql; //Variavel global que será responsável por executar a conexão 

			$queryInsert = "
				INSERT INTO [dbo].[tb_esc_GITEC] ([gitec],[nome]
           ,[matricula],[equipe],[funcao],[tel],[cel1],[cel2],[hc]
           ,[ot],[fim_semana],[madrugada],[plantao],[obs],[niv_min]) VALUES (";
           $queryInsert .= "'".$area."',"; 
           $queryInsert .= "'".$nome."',"; 
           $queryInsert .= "'".$matricula."',";
           $queryInsert .= "'".$equipe."',";
           $queryInsert .= "'".$funcao."',";
           $queryInsert .= "'".$telefone."',";
           $queryInsert .= "'".$celular1."',";
           $queryInsert .= "'".$celular2."',";
           $queryInsert .= "'".$hc."',";
           $queryInsert .= "'".$ot."',";
           $queryInsert .= "'".$fds."',";
           $queryInsert .= "'".$mad."',";
           $queryInsert .= "'".$plantao."',";
           $queryInsert .= "'".$observacao."',";
           $queryInsert .= "'".$nivmin."')"; 

			try { 

				$resultInsert = $sql->prepare($queryInsert); //Prepara a Consulta 
				$resultInsert->execute();  //Executa a Consulta 

				//Cria uma variavel de Sucesso em caso de Cadastro Correto. 
				$sucesso = "<BR>
					<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
						Efetuado registro com sucesso!	
					</p>	
				
					<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
						<a href='../VIEWS/formEscCaixa.php'>Clique aqui para efetuar um novo registro</a>
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


		public function  alterarEscalonamentoCaixa(EscalonamentoCaixa $escalonamentoCaixa) { 

			//Chama os metodos Get que serão usados para atribuir os valores para o Banco 
			$id = $escalonamentoCaixa->getId();
			$nome = $escalonamentoCaixa->getNome(); 
			$matricula = $escalonamentoCaixa->getMatricula(); 
			$area = $escalonamentoCaixa->getArea(); 
			$equipe = $escalonamentoCaixa->getEquipe(); 
			$funcao = $escalonamentoCaixa->getFuncao(); 
			$telefone = $escalonamentoCaixa->getTelefone(); 
			$celular1 = $escalonamentoCaixa->getCelular1(); 
			$celular2 = $escalonamentoCaixa->getCelular2(); 
			$hc = $escalonamentoCaixa->getHc(); 
			$ot = $escalonamentoCaixa->getOt(); 
			$fds = $escalonamentoCaixa->getFds(); 
			$mad = $escalonamentoCaixa->getMad(); 
			$plantao = $escalonamentoCaixa->getPlantao(); 
			$nivmin = $escalonamentoCaixa->getNivMin(); 
			$observacao = $escalonamentoCaixa->getObservacao(); 
			$userAlt = $escalonamentoCaixa->getUserAlt();

			abreConexao(); //Abre a Conexão com o banco de Dados 
			global $sql; //Variavel global que será responsável por executar a conexão 

			$queryUpdate = "UPDATE [dbo].[tb_esc_GITEC] SET ";
			$queryUpdate .= " [nome] = '".$nome."',";
			$queryUpdate .= " [matricula] = '".$matricula."',";
			$queryUpdate .= " [gitec] = '".$area."',";
			$queryUpdate .= " [equipe] = '".$equipe."',";
			$queryUpdate .= " [funcao] = '".$funcao."',";
			$queryUpdate .= " [tel] = '".$telefone."',";
			$queryUpdate .= " [cel1] = '".$celular1."',";
			$queryUpdate .= " [cel2] = '".$celular2."',";
			$queryUpdate .= " [hc] = '".$hc."',";
			$queryUpdate .= " [ot] = '".$ot."',";
			$queryUpdate .= " [fim_semana] = '".$fds."',";
			$queryUpdate .= " [madrugada] = '".$mad."',";
			$queryUpdate .= " [plantao] = '".$plantao."',";
			$queryUpdate .= " [obs] = '".$observacao."',"; 
			$queryUpdate .= " [niv_min] = '".$nivmin."',";
			$queryUpdate .= " [user_alt] = '".$userAlt."'"; 
			$queryUpdate .=	 " WHERE [id] = ".$id;

			//echo $queryUpdate."<BR>";

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
								<a href='../VIEWS/formAlteraEscalonamentocaixa.php?id=$id'>Clique aqui para retornar a tela do Registro</a>
							</p>
					"; 

					echo $sucesso; 


				} catch (Exception $e) {
					print "Ocorreu um erro: <b style='color: red;>".$e->getMessage()."</b>"; 						
				} 

			fechaConexao();	
		} 

		public function  excluirEscalonamentoCaixa($id) { 

			abreConexao(); //Abre a Conexão com o Banco de Dados 
			global $sql; //Varíavel global  

			//Cria a query para delete 
			$queryDelete = "
				DELETE FROM [dbo].[tb_esc_GITEC] WHERE [id] = '$id'
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
					print "Ocorreu um erro: <code style='color: red;>".$e->getMessage()."</code>";
				}

			fechaConexao();	
		} 

		public function  listarEscalonamentoCaixa() { 

			abreConexao(); //Abre a Conexão com o Banco de Dados 
			global $sql; //Varíavel global  

			$querySelect = "
				SELECT [id] as cod,[gitec],[nome],[matricula],[equipe],[funcao]
      			,[tel],[cel1],[cel2],[hc],[ot],[fim_semana],[madrugada]
     			,[plantao],[obs],[user_alt],ISNULL([niv_min],'-') as niv_min
  				FROM [Inventario].[dbo].[tb_esc_GITEC]
			";

			$escalonamentoCaixa = []; 

				try {
					
					$stmt = $sql->prepare($querySelect); //Prepara a consulta 
					$stmt->execute(); //Executa a Consulta   

						foreach ($stmt as $value) {
								$cod = $value['cod']; 
								$gitec = $value['gitec']; 
								$nome = $value['nome']; 
								$matricula = $value['matricula']; 
								$equipe = $value['equipe']; 
								$funcao = $value['funcao']; 
								$tel = $value['tel']; 
								$cel1 = $value['cel1']; 
								$cel2 = $value['cel2']; 
								$hc = $value['hc']; 
								$ot = $value['ot'];
								$fim_semana = $value['fim_semana'];  
								$madrugada = $value['madrugada']; 
								$plantao = $value['plantao']; 
								$obs = $value['obs']; 
								$user_alt = $value['user_alt']; 
								$niv_min = $value['niv_min']; 

								if($hc == 1) { 
									$hct = "Sim";} else { $hct = "Não";} 

								if($ot == 1) { 
									$otc = "Sim";} else { $otc = "Não";} 	 

								if($fim_semana == 1) { 
									$fds = "Sim";} else { $fds = "Não";}	

								if($madrugada == 1) { 
									$mad = "Sim";} else { $mad = "Não";}	
	

								//Cria o Vetor agrupando os dados 
								$escalonamentoCaixa[] = array(
									"cod" => $cod, 
									"gitec" => $gitec, 
									"nome" => $nome, 
									"matricula" => $matricula, 
									"equipe" => $equipe, 
									"funcao" => $funcao, 
									"tel" => $tel, 
									"cel1" => $cel1, 
									"cel2" => $cel2, 
									"hc" => $hct, 
									"ot" => $otc, 
									"fim_semana" => $fds, 
									"madrugada" => $mad, 
									"plantao" => $plantao, 
									"obs" => $obs, 
									"user_alt" => $user_alt, 
									"niv_min" => $niv_min	
								);	

							}	

						echo json_encode($escalonamentoCaixa,JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE  | JSON_PARTIAL_OUTPUT_ON_ERROR);
		

				} catch (Exception $e) {
					print "Ocorreu um erro: <code style='color: red;>".$e->getMessage()."</code>";
				}

			fechaConexao(); //Fecha a Conexão com o Banco	
		} 


		public function consultaDocumentoExclusao($id) { 

			try {

					abreConexao(); //Abre a Conexão com o Banco de Dados 
					global $sql; //Varíavel global  
 	
					$consultaExclusao = "
						SELECT [id],[gitec],[nome],[matricula],[equipe],[funcao]
      					,[tel],[cel1],[cel2],[hc],[ot],[fim_semana],[madrugada]
     					,[plantao],[obs],[user_alt],[niv_min]
  						FROM [Inventario].[dbo].[tb_esc_GITEC] WHERE [id]=$id ";

  					$result = $sql->prepare($consultaExclusao); 
  					$result->execute();  

  					$lista = $result->fetch(PDO::FETCH_ASSOC); 

  					$id = $lista['id']; 
  					$gitec = $lista['gitec']; 
  					$nome = $lista['nome']; 
  					$matricula = $lista['matricula']; 
  					$equipe = $lista['equipe']; 
  					$funcao = $lista['funcao']; 
  					$tel = $lista['tel']; 
  					$cel1 = $lista['cel1']; 
  					$cel2 = $lista['cel2']; 
  					$hc = $lista['hc']; 
  					$ot = $lista['ot']; 
  					$fim_semana = $lista['fim_semana']; 
  					$madrugada = $lista['madrugada']; 
  					$plantao = $lista['plantao']; 
  					$obs = $lista['obs']; 
  					$user_alt = $lista['user_alt']; 
  					$niv_min = $lista['niv_min']; 

  					fechaConexao(); //Fecha a primeira conexão 

  					//Reabre a Conexão 
					abreConexao(); //Abre a conexão com o banco de dados 
					global $sql; //variavel global para executar a conexão

					$userExc = strtolower($_SERVER["REMOTE_USER"]);
					$userExc = split('\\\\',$userExc); 
					$userExc = $userExc[1];

					//echo $userExc."<BR>";  

					$dataExclusao = date('d-m-Y H:m:s');  

					$insereEscCaixaExc = "INSERT INTO [dbo].[tb_GITEC_hist]
           			([gitec],[nome],[matricula],[equipe],[funcao],[tel],[cel1]
           			,[cel2],[hc],[ot],[fim_semana],[madrugada],[plantao],[obs]
           			,[user_alt],[niv_min],[exc_por],[data_exclusao]) VALUES ("; 
	           		$insereEscCaixaExc .= "'".$gitec."',"; 
	           		$insereEscCaixaExc .= "'".$nome."',"; 
	           		$insereEscCaixaExc .= "'".$matricula."',"; 
	           		$insereEscCaixaExc .= "'".$equipe."',";
	           		$insereEscCaixaExc .= "'".$funcao."',"; 
	           		$insereEscCaixaExc .= "'".$tel."',"; 
	           		$insereEscCaixaExc .= "'".$cel1."',"; 
	           		$insereEscCaixaExc .= "'".$cel2."',"; 
	           		$insereEscCaixaExc .= "'".$hc."',";
	           		$insereEscCaixaExc .= "'".$ot."',"; 
	           		$insereEscCaixaExc .= "'".$fim_semana."',"; 
	           		$insereEscCaixaExc .= "'".$madrugada."',"; 
	           		$insereEscCaixaExc .= "'".$plantao."',";
	           		$insereEscCaixaExc .= "'".$obs."',"; 
	           		$insereEscCaixaExc .= "'".$user_alt."',";
	           		$insereEscCaixaExc .= "'".$niv_min."',"; 
	           		$insereEscCaixaExc .= "'".$userExc."',"; 
	           		$insereEscCaixaExc .= "'".$dataExclusao."')"; 	

					$resultInsExc = $sql->prepare($insereEscCaixaExc); //Prepara a consulta 
					$resultInsExc->execute(); //Executa a conexão enviando para a base histórica

					fechaConexao(); //Fecha a Conexão com o Banco de Dados 

			} catch (Exception $e) {
				print "Ocorreu um erro: <code style='color: red;>".$e->getMessage()."</code>"; 
			}

		}

		public function listarHistorico() { 

			try {
				
				abreConexao(); //Abre a conexão com o banco de dados 
				global $sql; //variavel global para executar a conexão 

				$queryHistorico = "
					SELECT [id] as cod,[gitec],[nome],[matricula],[equipe],[funcao],[tel],[cel1]
				      ,[cel2],[hc],[ot],[fim_semana],[madrugada],[plantao],[obs]
				      ,[user_alt],[niv_min],[exc_por],[data_exclusao] FROM [Inventario].[dbo].[tb_GITEC_hist]
				";

				$result = $sql->prepare($queryHistorico); //Prepara a consulta 
				$result->execute(); //Executa a consulta 

				$lista = $result->fetchall(PDO::FETCH_ASSOC); //Lista os itens da tabela 

				echo json_encode($lista,JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE  | JSON_PARTIAL_OUTPUT_ON_ERROR);  

				fechaConexao(); 



			} catch (Exception $e) {
				echo "Ocorreu um erro: <b style='color: red;>".$e->getMessage()."</b>";	
			}

		}	
		
	} 

?> 