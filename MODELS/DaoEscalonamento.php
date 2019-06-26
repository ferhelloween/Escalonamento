<?php
	
	setlocale(LC_ALL,"pt_BR"); 
	header('Content-type: text/html; charset=utf-8');

	set_time_limit(1200); //Define tempo limite de execução
	ERROR_REPORTING (E_ERROR);  //Somente exibe erros fatais


	include_once "Conexao.php"; 
	require_once "Escalonamento.php"; 

	/**
	* 
	*/
	class DaoEscalonamento
	{
		
		//Criando os métodos CRUD 

		//Função para registrar o escalonamento
		public function registrarEscalonamento(Escalonamento $escalonamento) { 

			//Cria  variaveis que irão buscar os métodos  
			$operadora = $escalonamento->getOperadora(); 
			$nivel = $escalonamento->getNivel(); 
			$contato = $escalonamento->getContato(); 
			$funcao = $escalonamento->getFuncao(); 
			$comercial = $escalonamento->getComercial();  
			$telefone = $escalonamento->getTelefone(); 
			$opcao = $escalonamento->getOpcao(); 
			$celular1 = $escalonamento->getCelular1(); 
			$celular2 = $escalonamento->getCelular2(); 
			$email = $escalonamento->getEmail(); 
			$horario = $escalonamento->getHorario(); 
			$escalonarApos = $escalonamento->getEscalonarApos(); 
			$hc = $escalonamento->getHc(); 
			$ot = $escalonamento->getOt(); 
			$nme = $escalonamento->getNme(); 
			$observacao = $escalonamento->getObservacao(); 

			abreConexao(); //Abre a Conexão com o banco de Dados 
			global $sql; //Variável Global para utilizar na Conexão
			
			try {
				
				$queryInsert = "
					INSERT INTO [dbo].[Tb_escalonamento]
		           ([operadora],[nivel],[contato],[funcao],[coml],[telefone],[opcao]
		           ,[celular1],[celular2],[email],[hor_atend]
		           ,[tpa] ,[hc],[ot],[niv_min],[obs]) VALUES("; 
		        $queryInsert .= "'".$operadora."',"; 
		        $queryInsert .= "'".$nivel."',"; 
		        $queryInsert .= "'".$contato."',";
		        $queryInsert .= "'".$funcao."',";
		        $queryInsert .= "'".$comercial."',";
		        $queryInsert .= "'".$telefone."',";
		        $queryInsert .= "'".$opcao."',";
		        $queryInsert .= "'".$celular1."',";
		        $queryInsert .= "'".$celualr2."',";
		        $queryInsert .= "'".$email."',";
		        $queryInsert .= "'".$horario."',";
		        $queryInsert .= "'".$escalonarApos."',";
		        $queryInsert .= "'".$hc."',"; 
		        $queryInsert .= "'".$ot."',";
		        $queryInsert .= "'".$nme."',";
		        $queryInsert .= "'".$observacao."')";

				$resultInsert = $sql->prepare($queryInsert); //Prepara a Conexão 
				$resultInsert->execute(); //Executa o Insert

				//Cria uma variavel de Sucesso em caso de Cadastro Correto. 
				$sucesso = "<BR>
					<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
						Efetuado registro com sucesso!	
					</p>	
					<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
						<a href='../VIEWS/formEscalonamento.php'>Clique aqui para efetuar um novo registro</a>
					</p>

					<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
						<a href='../VIEWS/inicial.php'>Clique aqui para retornar a tela principal</a>
					</p>
				"; 

					echo $sucesso; 
				

			} catch (Exception $e) {
				print "Ocorreu um erro: <code style='color: red;>".$e->getMessage."</code>";
			}

			fechaConexao(); //Fecha a Conexão com o banco de Dados	
		} 

		//Função para alterar o escalonamento
		public function alteraEscalonamento(Escalonamento $escalonamento) { 

			abreConexao(); //Abre a Conexão com o SQL 
			global $sql; //Variável Global para utilizar na Conexão 

			//Busca o Id para alterar o registro correto 
			$id = $escalonamento->getId(); 

			//Busca os demais campos 
			$operadora = $escalonamento->getOperadora(); 
			$nivel = $escalonamento->getNivel(); 
			$contato = $escalonamento->getContato(); 
			$funcao = $escalonamento->getFuncao(); 
			$comercial = $escalonamento->getComercial();  
			$telefone = $escalonamento->getTelefone(); 
			$opcao = $escalonamento->getOpcao(); 
			$celular1 = $escalonamento->getCelular1(); 
			$celular2 = $escalonamento->getCelular2(); 
			$email = $escalonamento->getEmail(); 
			$horario = $escalonamento->getHorario(); 
			$escalonarApos = $escalonamento->getEscalonarApos(); 
			$hc = $escalonamento->getHc(); 
			$ot = $escalonamento->getOt(); 
			$nme = $escalonamento->getNme(); 
			$observacao = $escalonamento->getObservacao();  
			$usr_alt = $escalonamento->getUserAlt();

			//echo "HORARIO: ".$horario."<BR>";

			//Cria o Bloco Try~catch  
			try {
				
				$queryUpdate = "UPDATE [dbo].[Tb_escalonamento] SET"; 
				$queryUpdate .= "[operadora] = '".$operadora."',";
				$queryUpdate .= "[nivel] = '".$nivel."',";
				$queryUpdate .= "[contato] = '".$contato."',";
				$queryUpdate .= "[funcao] = '".$funcao."',";
				$queryUpdate .= "[coml] = '".$comercial."',";
				$queryUpdate .= "[telefone] = '".$telefone."',";
				$queryUpdate .= "[opcao] = '".$opcao."',";
				$queryUpdate .= "[celular1] = '".$celular1."',";
				$queryUpdate .= "[celular2] = '".$celular2."',";
				$queryUpdate .= "[email] = '".$email."',";
				$queryUpdate .= "[hor_atend] = '".$horario."',";
				$queryUpdate .= "[tpa] = '".$escalonarApos."',";
				$queryUpdate .= "[hc] = '".$hc."',";
				$queryUpdate .= "[ot] = '".$ot."',";
				$queryUpdate .= "[niv_min] = '".$nme."',";
				$queryUpdate .= "[obs] = '".$observacao."',";
				$queryUpdate .= "[user_alt] = '".$usr_alt."'";
				$queryUpdate .= "WHERE [id] = '".$id."'";

				//echo $queryUpdate."\n";

				$resultUpdate = $sql->prepare($queryUpdate); //Prepara a Consulta 
				$resultUpdate->execute(); //Executa a Consulta  

					//Cria uma variavel de Sucesso em caso de Cadastro Correto. 
				$sucesso = "<BR>
						<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
							Alterado registro com sucesso!	
						</p>	
						
						<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
							<a href='../VIEWS/formAlteraEscalonamento.php?id=$id'>Clique aqui para retornar a tela do Registro</a>
						</p>
				"; 

				echo $sucesso; 



			} catch (Exception $e) {

				print "Ocorreu um erro: <b style='color: red;>".$e->getMessage()."</b>"; 
			}

			fechaConexao(); //Fecha a Conexão com Banco de Dados 
		}

		//Função para excluir o escalonamento 
		public function excluirEscalonamento($id) {  

			abreConexao(); //Abre a conexão com o banco de dados 
			global $sql; //variavel global para executar a conexão  

			try {
				
				$queryDelete = "
					DELETE FROM [dbo].[Tb_escalonamento] WHERE [id] = '$id'
				"; 	

				$resDelete = $sql->prepare($queryDelete); 
				$resDelete->execute(); 

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
				print "Ocorreu um erro: <code style='color: red;>".$e3->getMessage."</code>"; 	
			}	

			fechaConexao();
		}  


		public function listarEscalonamento() { 

			abreConexao(); //Abre a conexão com o banco de dados 
			global $sql; //variavel global para executar a conexão   

			try { 

				$querySelect = "
					SELECT [id] as cod,[operadora],[sigla],[nivel],[contato],[funcao],[telefone],[opcao]
    			  ,[celular1],[celular2],[email],[hor_atend],[tpa],[hc],[ot],[obs],[user_alt]
    			  ,[niv_min],[coml]
  					FROM [Inventario].[dbo].[tb_escalonamento] ORDER BY [operadora], [nivel]
				"; 

				$resSelect = $sql->prepare($querySelect); //Prepara a consulta 
				$resSelect->execute();  

				$escalonamento = []; //Cria o Array de Escalonamentos 

				foreach ($resSelect as $value) {
					
					$cod = $value['cod'];  
					$operadora =  $value["operadora"];
					$sigla = $value["sigla"];
					$nivel =  $value["nivel"];
					$contato =  $value["contato"];
					$funcao =  $value["funcao"];
					$telefone = $value["telefone"];
					$opcao = $value["opcao"];
					$celular1 = $value["celular1"];
					$celular2 = $value["celular2"];
					$email = $value["email"];
					$hor_atend = $value["hor_atend"];
					$tpa =  $value["tpa"];
					$hc =  $value["hc"];
					$ot =  $value["ot"];
					$obs =  $value["obs"];
					$user_alt =  $value["user_alt"];
					$niv_min =  $value["niv_min"];
					$coml =  $value["coml"];  

					if($coml == 'Sim') { 
						$contatoT = $contato." (C)<span class='comText' style='font-size: 12px;'>Comercial</span>";
					} else { 
						$contatoT = $contato; 
					} 

					if($hc == 1) { 
						$hct = "Sim";} else { $hct = "Não";} 

					if($ot == 1) { 
						$otc = "Sim";} else { $otc = "Não";} 	


                    


					//Cria o Vetor agrupando os dados 
					$escalonamento[] = array( 
						"cod" => $cod, 
						"operadora" => $operadora, 
						"sigla" => $sigla, 
						"nivel" => $nivel, 
						"contato" => $contato,
						"contatoT" =>$contatoT, 
						"funcao" => $funcao, 
						"telefone" => $telefone, 
						"opcao" => $opcao, 
						"celular1" => $celular1, 
						"celular2" => $celular2, 
						"email" => $email, 
						"hor_atend" => $hor_atend, 
						"tpa" =>$tpa, 
						"hc" => $hct, 
						"ot" => $otc, 
						"obs" => $obs, 
						"user_alt" => $user_alt, 
						"niv_min" => $niv_min, 
						"coml" => $coml
					);  

				}

				echo json_encode($escalonamento,JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE  | JSON_PARTIAL_OUTPUT_ON_ERROR);  


				

			} catch (Exception $e) {
				print "Ocorreu um erro: <code style='color: red;>".$e->getMessage."</code>"; 	
			}

			fechaConexao(); //Fecha a Conexão com o Banco de Dados 

		}


		public function listarEscalonamentoN() { 

			abreConexao(); //Abre a conexão com o banco de dados 
			global $sql; //variavel global para executar a conexão   

			try { 

				$querySelect = "
					SELECT [id] as cod,[operadora],[sigla],[nivel],[contato],[funcao],[telefone],[opcao]
    			  ,[celular1],[celular2],[email],[hor_atend],[tpa],[hc],[ot],[obs],[user_alt]
    			  ,[niv_min],[coml]
  					FROM [Inventario].[dbo].[tb_escalonamento] WHERE [coml]<>'Sim' ORDER BY [operadora],[nivel]
				"; 

				$resSelect = $sql->prepare($querySelect); //Prepara a consulta 
				$resSelect->execute();  

				$escalonamento = []; //Cria o Array de Escalonamentos 

				foreach ($resSelect as $key => $value) {

					
					$cod = $value['cod'];  
					$operadora =  $value["operadora"];
					$sigla = $value["sigla"];
					$nivel =  $value["nivel"];
					$contato =  $value["contato"];
					$funcao =  $value["funcao"];
					$telefone = $value["telefone"];
					$opcao = $value["opcao"];
					$celular1 = $value["celular1"];
					$celular2 = $value["celular2"];
					$email = $value["email"];
					$hor_atend = $value["hor_atend"];
					$tpa =  $value["tpa"];
					$hc =  $value["hc"];
					$ot =  $value["ot"];
					$obs =  $value["obs"];
					$user_alt =  $value["user_alt"];
					$niv_min =  $value["niv_min"];
					$coml =  $value["coml"];  

					if($coml == 'Sim') { 
						$contatoT = $contato." (C)<span class='comText' style='font-size: 12px;'>Comercial</span>";
					} else { 
						$contatoT = $contato; 
					} 

					if($hc == 1) { 
						$hct = "Sim";} else { $hct = "Não";} 

					if($ot == 1) { 
						$otc = "Sim";} else { $otc = "Não";} 	

					//Cria o Vetor agrupando os dados 
					$escalonamento[] = array( 
						"cod" => $cod, 
						"operadora" => $operadora, 
						"sigla" => $sigla, 
						"nivel" => $nivel, 
						"contato" => $contato,
						"contatoT" =>$contatoT, 
						"funcao" => $funcao, 
						"telefone" => $telefone, 
						"opcao" => $opcao, 
						"celular1" => $celular1, 
						"celular2" => $celular2, 
						"email" => $email, 
						"hor_atend" => $hor_atend, 
						"tpa" =>$tpa, 
						"hc" => $hct, 
						"ot" => $otc, 
						"obs" => $obs, 
						"user_alt" => $user_alt, 
						"niv_min" => $niv_min, 
						"coml" => $coml
					);  

				}

				echo json_encode($escalonamento,JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE  | JSON_PARTIAL_OUTPUT_ON_ERROR); 

			} catch (Exception $e) {
				print "Ocorreu um erro: <code style='color: red;>".$e->getMessage."</code>"; 	
			}

			fechaConexao(); //Fecha a Conexão com o Banco de Dados 

		}


		//Função para alimentar a base histórica 	
		public function	consultaDocumentoExclusao($id) { 
			
			

			$escalonamento = new Escalonamento();

			#Cria a consulta que será usada para enviar o registro apagado para a base histórica 
			$consultaExclusao = "
				SELECT  [id],[operadora],[nivel],[contato],[funcao],[telefone]
				,[opcao],[celular1],[celular2],[email],[hor_atend],[tpa],[hc],[ot],[obs],[user_alt]
				,[niv_min],[coml] FROM [Inventario].[dbo].[tb_escalonamento] WHERE [id]=$id"; 

				//echo $consultaExclusao."<BR><BR>";


			try {

				abreConexao(); //Abre a conexão com o banco de dados 
				global $sql; //variavel global para executar a conexão


				$result = $sql->prepare($consultaExclusao); //Prepara a Consulta 
				$result->execute(); 

				$lista = $result->fetch(PDO::FETCH_ASSOC); 

				//Atribui os Campos 
				$id = iconv("CP1252","UTF-8//TRANSLIT",$lista['id']); 
				$operadora = iconv("CP1252","UTF-8//TRANSLIT",$lista['operadora']);
				$nivel = iconv("CP1252","UTF-8//TRANSLIT",$lista['nivel']); 
				$contato = iconv("CP1252","UTF-8//TRANSLIT",$lista['contato']); 
				$funcao = iconv("CP1252","UTF-8//TRANSLIT",$lista['funcao']); 
				$telefone = iconv("CP1252","UTF-8//TRANSLIT",$lista['telefone']); 
				$opcao = iconv("CP1252","UTF-8//TRANSLIT",$lista['opcao']); 
				$celular1 = iconv("CP1252","UTF-8//TRANSLIT",$lista['celular1']); 
				$celular2 = iconv("CP1252","UTF-8//TRANSLIT",$lista['celular2']); 
				$email = iconv("CP1252","UTF-8//TRANSLIT",$lista['email']); 
				$hor_atend = iconv("CP1252","UTF-8//TRANSLIT",$lista['hor_atend']); 
				$tpa = iconv("CP1252","UTF-8//TRANSLIT",$lista['tpa']); 
				$hc = iconv("CP1252","UTF-8//TRANSLIT",$lista['ot']); 
				$obs = iconv("CP1252","UTF-8//TRANSLIT",$lista['obs']); 
				$user_alt = iconv("CP1252","UTF-8//TRANSLIT",$lista['user_alt']); 
				$niv_min = iconv("CP1252","UTF-8//TRANSLIT",$lista['niv_min']); 
				$coml = iconv("CP1252","UTF-8//TRANSLIT",$lista['coml']);  

				fechaConexao(); //Fecha a Primeira conexão 

				//Reabre a Conexão 
				abreConexao(); //Abre a conexão com o banco de dados 
				global $sql; //variavel global para executar a conexão

				$userExc = strtolower($_SERVER["REMOTE_USER"]);
				$userExc = split('\\\\',$userExc); 
				$userExc = $userExc[1];

				//echo $userExc."<BR>";  

				$dataExclusao = date('d-m-Y H:m:s');  

				$insereEscalonamentoExc = "INSERT INTO [dbo].[tb_escalonamento_hist]
				([operadora],[nivel],[contato],[funcao],[telefone],[celular1],[celular2]
				,[email],[hor_atend],[tpa],[hc],[ot],[obs],[niv_min],[user_alt],[coml]
				,[exc_por],[data_exclusao])	VALUES(";
				$insereEscalonamentoExc .= "'".$operadora."',";
				$insereEscalonamentoExc .= "'".$nivel."',";
				$insereEscalonamentoExc .= "'".$contato."',";
				$insereEscalonamentoExc .= "'".$funcao."',";
				$insereEscalonamentoExc .= "'".$telefone."',";
				$insereEscalonamentoExc .= "'".$celular1."',";
				$insereEscalonamentoExc .= "'".$celular2."',";
				$insereEscalonamentoExc .= "'".$email."',";
				$insereEscalonamentoExc .= "'".$hor_atend."',";
				$insereEscalonamentoExc .= "'".$tpa."',";
				$insereEscalonamentoExc .= "'".$hc."',";
				$insereEscalonamentoExc .= "'".$ot."',";
				$insereEscalonamentoExc .= "'".$obs."',";
				$insereEscalonamentoExc .= "'".$niv_min."',";
				$insereEscalonamentoExc .= "'".$user_alt."',";
				$insereEscalonamentoExc .= "'".$coml."',";
				$insereEscalonamentoExc .= "'".$userExc."',";
				$insereEscalonamentoExc .= "'".$dataExclusao."'";
				$insereEscalonamentoExc .= ")"; 

				//echo $insereEscalonamentoExc;
				$resultInsExc  = $sql->prepare($insereEscalonamentoExc); 
				$resultInsExc->execute(); //Executa a consulta

					//Cria uma variavel de Sucesso em caso de Cadastro Correto. 
				$sucesso = "<BR>
				<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
					Valores transferidos para a base histórica!!!	
				</p>	
				"; 

				echo $sucesso; 

				fechaConexao();

				

			} catch (Exception $e) {
			
				print "Ocorreu um erro: <code style='color: red;>".$e->getMessage."</code>";

			}	

					
		} 


		public function alimentaOperadoras() { 

				abreConexao(); //Abre a conexão com o sql 
				global $sql; //Variavel global para a conexão. 

				try {
					
					//Cria a query que irá listar as operadoras 
					$queryOperadora = "
		            SELECT [id] as cod,[operadora],[sigla] FROM [Inventario].[dbo].[tbl_oper_escalona] ORDER BY [operadora] ASC
				";

					$result = $sql->prepare($queryOperadora); 
					$result->execute(); //Executa a consulta 

					$listaOperadora = []; //Cria um array que será utilizado 

					//Cria o Foreach para criar os resultados 
					foreach ($result as $value) {
						$cod = $value['cod']; 
						$operadora = $value['operadora']; 
						$sigla = $value['sigla']; 
						

						//Cria o Vetor que será passado para o JSON Encode  
						$listaOperadora[] = [
							"cod"=>$cod, 
							"operadora"=>$operadora, 
							"sigla"=>$sigla, 
							"observacao"=>$observacao, 
							"usuario"=>$usuario, 
							"hora_reg"=>$hora_reg 
						];
					}

				echo json_encode($listaOperadora,JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE  | JSON_PARTIAL_OUTPUT_ON_ERROR); 
					
				} catch (Exception $e) {
					print "Ocorreu um erro: <code style='color: red;>".$e3->getMessage."</code>";
				}			


		} 

		public function listarHistorico() {
			
				abreConexao(); //Abre a conexão com o sql 
				global $sql; //Variavel global para a conexão. 


				try {
					
					$queryHistorico = "
						SELECT [id] as cod,[operadora],[nivel],[contato],[funcao]
      					,[telefone],[opcao],[celular1],[celular2],[email]
      					,[hor_atend],[tpa],[hc],[ot],[obs],[niv_min]
      					,[user_alt],[coml],[exc_por],[data_exclusao]
  						FROM [Inventario].[dbo].[tb_escalonamento_hist]
					";

					$result = $sql->prepare($queryHistorico); //Prepara a Consulta 
					$result->execute(); //Executa a Consulta 

					$lista = []; //Cria o Vetor que será usado 

						//Cria um Foreach com Iconv para Exibir os valores 
						foreach ($result as  $value) {

							$cod = $value['cod']; 
							$operadora = iconv("CP1252","UTF-8//TRANSLIT",$value['operadora']);
							$operadora = iconv("CP1252","UTF-8//TRANSLIT",$value['operadora']);
							$nivel = iconv("CP1252","UTF-8//TRANSLIT",$value['nivel']);
							$contato = iconv("CP1252","UTF-8//TRANSLIT",$value['contato']);
							$funcao = iconv("CP1252","UTF-8//TRANSLIT",$value['funcao']);
							$telefone = iconv("CP1252","UTF-8//TRANSLIT",$value['telefone']);
							$opcao = iconv("CP1252","UTF-8//TRANSLIT",$value['opcao']);
							$celular1 = iconv("CP1252","UTF-8//TRANSLIT",$value['celular1']);
							$celular2 = iconv("CP1252","UTF-8//TRANSLIT",$value['celular2']);
							$email = iconv("CP1252","UTF-8//TRANSLIT",$value['email']);
							$hor_atend = iconv("CP1252","UTF-8//TRANSLIT",$value['hor_atend']);
							$tpa = iconv("CP1252","UTF-8//TRANSLIT",$value['tpa']);
							$hc = iconv("CP1252","UTF-8//TRANSLIT",$value['hc']);
							$ot = iconv("CP1252","UTF-8//TRANSLIT",$value['ot']);
							$obs = iconv("CP1252","UTF-8//TRANSLIT",$value['obs']);
							$niv_min = iconv("CP1252","UTF-8//TRANSLIT",$value['niv_min']);
							$user_alt = iconv("CP1252","UTF-8//TRANSLIT",$value['user_alt']);
							$coml = iconv("CP1252","UTF-8//TRANSLIT",$value['coml']);
							$exc_por = iconv("CP1252","UTF-8//TRANSLIT",$value['exc_por']);
							$data_exclusao = iconv("CP1252","UTF-8//TRANSLIT",$value['data_exclusao']); 

								if($hc == 1) { 
									$hct = "Sim";} else { $hct = "Não";} 

								if($ot == 1) { 
									$otc = "Sim";} else { $otc = "Não";} 	

							$lista[] = [ 
								"cod" => $cod, 
								"operadora" => $operadora, 
								"sigla" => $sigla, 
								"nivel" => $nivel, 
								"contato" => $contato, 
								"funcao" => $funcao, 
								"telefone" => $telefone, 
								"opcao" => $opcao, 
								"celular1" => $celular1, 
								"celular2" => $celular2, 
								"email" => $email, 
								"hor_atend" => $hor_atend, 
								"tpa" =>$tpa, 
								"hc" => $hct, 
								"ot" => $otc, 
								"obs" => $obs, 
								"user_alt" => $user_alt, 
								"niv_min" => $niv_min, 
								"coml" => $coml,
								"exc_por" => $exc_por,
								"data_exclusao" => $data_exclusao
							];		

						}

					echo json_encode($lista,JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE  | JSON_PARTIAL_OUTPUT_ON_ERROR); 	

					fechaConexao();

				} catch (Exception $e) {
					print "Ocorreu um erro: <b style='color: red;>".$e3->getMessage."</b>";
				}
		}


	}



?> 