<? 
	//#Definir char-set 
	setlocale(LC_ALL,"pt_BR.utf-8"); 
  header('Content-type: text/html; charset=utf-8');

	 #Cria a variável de usuário 
	 $usuario = strtolower($_SERVER["REMOTE_USER"]);
   $usuario_1 = split('\\\\', $usuario);
   $usuario = $usuario_1[1];


   include_once "MODELS/Conexao.php"; 

   abreConexao(); //Abre a conexão com o banco de dados 
   global $sql; //Cria a Variavel para fazer 

   $queryUser = "
    SELECT [nome],[gitec],[nivel_usr] FROM [Inventario].[dbo].[Tb_inv_valida] WHERE login_rede = '$usuario'"; 

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
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> 

	<!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="LIB/BOOTSTRAP/css/bootstrap.min.css">

  <!--CSS Bootstrap e Próprios-->
  <link rel="stylesheet" type="text/css" href="LIB/CSS/bootstrap.min.css"/> <!--BootStrap-->
	<link rel="stylesheet" type="text/css" href="LIB/CSS/newPages.css"/><!--CSS Adicional-->
	

	<!--Link para o Font Awesome-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">	 
	<!--Link para o Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"> 

  <!-- Estilo do Tema(Irá Sofrer algumas alterações)-->
  <link rel="stylesheet" href="LIB/DIST/css/AdminLTE.min.css"> 
   <link rel="stylesheet" href="LIB/DIST/css/skins/_all-skins.min.css">

  <!-- iCheck -->
	<link rel="stylesheet" href="LIB/PLUGINS/iCheck/flat/blue.css">
	<!-- Morris chart -->
	<link rel="stylesheet" href="LIB/PLUGINS/morris/morris.css">
	<!-- jvectormap -->
	<link rel="stylesheet" href="LIB/PLUGINS/jvectormap/jquery-jvectormap-1.2.2.css">
	<!-- Date Picker -->
	<link rel="stylesheet" href="LIB/PLUGINS/datepicker/datepicker3.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="LIB/PLUGINS/daterangepicker/daterangepicker.css">
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet" href="LIB/PLUGINS/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">	 

	<!--Bootstrap JS--> 
	<script type="text/javascript" charset="utf-8" src="LIB/JS/jquery-1.11.1.min.js"></script> 
	<script type="text/javascript" charset="utf-8" src="LIB/JS/bootstrap.min.js"></script> 

 	<script type="text/javascript" src="LIB/JS/loader.js"></script>
	<script type="text/javascript" src="LIB/JS/jsapi.js"></script>

  <!--Para O Jquery Mask Plugin-->
  <script type="text/javascript" charset="utf-8" src="LIB/JS/jquery-1.11.1.min.js"></script> 
  <script type="text/javascript" charset="utf-8" src="LIB/JS/jQuery-Mask-Plugin-master/dist/jquery.mask.min.js"></script><!--Script para mascaras-->
 


  
	<style type="text/css">
		body { 
			background-color: #F0F8FF !important;
		}	

		ul,li { 
			list-style: none; 
		}    

    .sMenu { 
      color: #FFFFFF !important;
    }

    .sMenu:hover { 
      color: #000080 !important;
    } 
  
    .sidebar-menu > li > .treeview-menu {
      margin: 0 1px;
      background-color: #1793d6 !important; 
    }


	</style>
</head>

<!--Início do body-->
<body class="hold-transition skin-blue sidebar-mini">
 	<div class="wrapper">
 		<header class="main-header">

    <!-- Logo -->
    <a href="template.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini" style="font-size: 12px; color: #F96A1B;">CGR</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b style="color: #F96A1B;">ESCALONAMENTO</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
       
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a class="dropdown-toggle" data-toggle="dropdown">
              <img src="LIB/dist/img/avatar5.png" class="user-image" alt="User Image">
              <span class="hidden-xs">Bem Vindo,&nbsp;<i><?=$lista['nome'];?></i></span>
            </a>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!--<li>
             <img class="fig1" src="LIB/IMG/Nova Cetec27_2.png" alt="CETEC27" width="140" height="50">
          </li>-->
         
          <li>
          	  <img src="LIB/IMG/logo-caixa.png" alt="CAIXA" width = "150" height="40">	
          </li>	
          <!--<li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>-->

        </ul>
      </div>

    </nav>
  </header>
 
   <!--Menu Lateral-->  
   <aside class="main-sidebar" style="background-color: #006FA8 !important;"> 

   		<section class="sidebar">
   			<!-- Sidebar user panel -->
		    <div class="user-panel">
		        <div class="pull-left image">
		          <img src="LIB/DIST/img/avatar5.png" class="img-circle" alt="User Image">
		        </div>
		        <div class="pull-left info">
		          <p><?=$usuario;?></p>
		          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
		        </div> 
		      </div> 

		      <!--Menu Principal-->
		       <ul class="sidebar-menu">
		       		 <!--Título de Classe-->	
		       		 <li class="header" style="color: #FFFFFF !important; background: #000080 !important;">MENU PRINCIPAL</li> 
	       		    
                <!--Inicial-->
                <li class="treeview">
                   <a href="VIEWS/inicial.php" id="Inicial" target="interno" >
                      <i class="fa fa-map-pin"></i> <span>Inicial</span>
                  </a>
        				</li> 
        				<!--Registro-->
        				<li class="treeview">
        					<a href="#">
        						<i class="fa fa-edit"></i>
        						<span>Cadastros - Escalonamentos</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-right pull-right"></i>
                    </span>   
        					</a>
                   <ul class="treeview-menu" >   
                      <? 
                        //Cria os ifs em php para alterar as permissões de acesso
                        if($lista['nivel_usr'] == 1 || $lista['nivel_usr'] == 4 ) { 

                      ?>
                      <!--Irá abrir a página de formulário para escalonamneto-->
                      <li><a href="VIEWS/formEscalonamento.php" class="sMenu" id="cadOperadora" target="interno">
                        <i class="fa fa-circle-o"></i>Escal. Operadora
                      </a></li>
                     
                      <!--Irá abrir a página de formulário para fornecedores-->
                      <li><a href="VIEWS/formFornecedores.php" class="sMenu" id="cadFornecedores" target="interno">
                        <i class="fa fa-circle-o"></i>Fornecedores
                      </a></li>
                      
                      <!--Irá abrir a página de formulário para fornecedores-->
                      <li><a href="VIEWS/formEscCaixa.php" class="sMenu" id="cadGitec" target="interno">
                        <i class="fa fa-circle-o"></i>Caixa - GITEC
                      </a></li>
                      
                      <!--Irá abrir a página de formulário para fornecedores-->
                      <li><a href="VIEWS/formRhCgr.php" class="sMenu" id="cadCgr" target="interno">
                        <i class="fa fa-circle-o"></i>RH - CGR
                      </a></li>  

                      <? 
                        } else { 

                      ?>
                      <!--Irá abrir a página de formulário para escalonamneto-->
                      <li><a href="VIEWS/negado.html" class="sMenu" id="cadOperadora" target="interno">
                        <i class="fa fa-circle-o"></i>Escal. Operadora
                      </a></li>
                     
                      <!--Irá abrir a página de formulário para fornecedores-->
                      <li><a href="VIEWS/negado.html" class="sMenu" id="cadFornecedores" target="interno">
                        <i class="fa fa-circle-o"></i>Fornecedores
                      </a></li>
                      
                      <!--Irá abrir a página de formulário para fornecedores-->
                      <li><a href="VIEWS/negado.html" class="sMenu" id="cadGitec" target="interno">
                        <i class="fa fa-circle-o"></i>Caixa - GITEC
                      </a></li>
                      
                      <!--Irá abrir a página de formulário para fornecedores-->
                      <li><a href="VIEWS/negado.html" class="sMenu" id="cadCgr" target="interno">
                        <i class="fa fa-circle-o"></i>RH - CGR
                      </a></li>  

                      <? 
                        }
                      ?>
                   </ul>  
        					<!--Modal para o Registro--> 
        					<!--Fim do Modal-->
        				</li>

                <!--Visualizações-->  
          			<li class="treeview"> 
        					<a href="#">
    								<i class="fa fa-file-text-o"></i> 
    								<span>Visualizar - Escalonamentos</span>	  
                    <span class="pull-right-container">
                      <i class="fa fa-angle-right pull-right"></i>
                    </span>      						
            			</a> 
                  <ul class="treeview-menu">  
                  
                    <li><a href="VIEWS/tabEscalonamento.php" class="sMenu" id="escOperadora" target="interno">
                      <i class="fa fa-circle-o"></i>Escal. Operadora
                    </a></li>

                    <li><a href="VIEWS/tabFornecedores.php" class="sMenu" id="escFornecedores" target="interno">
                      <i class="fa fa-circle-o"></i>Fornecedores
                    </a></li>
                    
                    <li><a href="VIEWS/tabCaixa.php" class="sMenu" id="escGitec" target="interno">
                      <i class="fa fa-circle-o"></i>Caixa - GITEC
                    </a></li>
                    
                    <li><a href="VIEWS/tabRh.php" class="sMenu" id="escCgr" target="interno">
                      <i class="fa fa-circle-o"></i>RH - CGR
                    </a></li>
                  </ul>  
        				</li>	 

                <!--Inventário-->  
                <li class="treeview"> 
                  <a href="#">
                    <i class="fa fa-institution"></i> 
                    <span>Inventário</span>    
                    <span class="pull-right-container">
                      <i class="fa fa-angle-right pull-right"></i>
                    </span>                 
                  </a> 
                  <ul class="treeview-menu">   
                     <? 
                        //Cria os ifs em php para alterar as permissões de acesso
                        if($lista['nivel_usr'] == 1 || $lista['nivel_usr'] == 4 ) { 
                      ?>

                    <li><a href="VIEWS/formInventario.php" class="sMenu" id="cadInv" target="interno">
                      <i class="fa fa-circle-o"></i>Cadastro
                    </a></li>
                    <li><a href="VIEWS/tabInventario.php" class="sMenu" id="relInv" target="interno">
                      <i class="fa fa-circle-o"></i>Relatório
                    </a></li>
                    <? 
                       } else { 
                    ?>
                    <li><a href="VIEWS/negado.html" class="sMenu" id="cadInv" target="interno">
                      <i class="fa fa-circle-o"></i>Cadastro
                    </a></li>
                    
                    <li><a href="VIEWS/negado.html" class="sMenu" id="relInv" target="interno">
                      <i class="fa fa-circle-o"></i>Relatório
                    </a></li>
                    
                    <? 
                      }
                    ?>



                  </ul>  
                </li>  

                <!--Sobre-->
                <li class="treeview">
                  <a href="VIEWS/sobre.html" id="Sobre" target="interno" >
                      <i class="fa fa-info-circle"></i> <span>Sobre</span>
                  </a>
                </li>

                <!--Ajuda-->
                <li class="treeview">
                  <a href="VIEWS/ajuda.html" id="Ajuda" target="interno" >
                      <i class="fa fa-question-circle"></i> <span>Ajuda</span>
                  </a>
                </li>

                <!--Histórico-->
                <li class="treeview">
                 
                  <a href="#" id="Historico">
                      <i class="fa fa-book"></i> 
                      <span>Histórico</span>
                      <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                      </span>
                  </a>
                   <ul class="treeview-menu">   
                     <? 
                      //Cria os ifs em php para alterar as permissões de acesso
                      if($lista['nivel_usr'] == 1 || $lista['nivel_usr'] == 2   || $lista['nivel_usr'] == 4  ) { 
                    ?>
                    <li><a href="VIEWS/tabOperadorasHistorico.php" class="sMenu" id="histOpe" target="interno">
                      <i class="fa fa-circle-o"></i>Operadoras
                     </a></li>

                    <li><a href="VIEWS/tabFornecedoresHistorico.php" class="sMenu" id="histFor" target="interno">
                      <i class="fa fa-circle-o"></i>Fornecedores
                    </a></li>
                   
                    <li><a href="VIEWS/tabGitecHistorico.php" class="sMenu" id="histGit" target="interno">
                      <i class="fa fa-circle-o"></i>Gitec
                    </a></li>
                    
                    <li><a href="VIEWS/tabRhHistorico.php" class="sMenu" id="histFun" target="interno">
                      <i class="fa fa-circle-o"></i>Colaboradores
                    </a></li>
                    <? 
                      } else {

                    ?>
                       <li><a href="VIEWS/negado.html" class="sMenu" id="histOpe" target="interno">
                           <i class="fa fa-circle-o"></i>Operadoras
                       </a></li>

                      <li><a href="VIEWS/negado.html" class="sMenu" id="histFor" target="interno">
                           <i class="fa fa-circle-o"></i>Fornecedores
                       </a></li>
                   
                       <li><a href="VIEWS/negado.html" class="sMenu" id="histGit" target="interno">
                          <i class="fa fa-circle-o"></i>Gitec
                       </a></li>
                    
                      <li><a href="VIEWS/negado.html" class="sMenu" id="histFun" target="interno">
                        <i class="fa fa-circle-o"></i>Colaboradores
                      </a></li>
                    <? 
                      }

                    ?>

                  </ul>  
                </li>


                <!--Administração do Sistema-->
               <? 
                  //Cria os ifs em php para alterar as permissões de acesso
                     if($lista['nivel_usr'] == 1 || $lista['nivel_usr'] == 4 ) { 
               ?>
                <li class="treeview"> 
                  <a href="#">
                    <i class="fa fa-gears"></i> 
                    <span>Administração</span>    
                    <span class="pull-right-container">
                      <i class="fa fa-angle-right pull-right"></i>
                    </span>                 
                  </a> 
                  <ul class="treeview-menu">   
                  
                    
                    <li><a href="VIEWS/formUsuarios.php" class="sMenu" id="cadUsr" target="interno">
                      <i class="fa fa-circle-o"></i>Cadastrar Usuários
                    </a></li>
                    
                    <li><a href="VIEWS/tabUsuarios.php" class="sMenu" id="gerUsr" target="interno">
                      <i class="fa fa-circle-o"></i>Gerenciar Usuarios
                    </a></li>
                   
                    <li><a href="VIEWS/formOperadoras.php" class="sMenu" id="cadOpe" target="interno">
                      <i class="fa fa-circle-o"></i>Cadastrar Operadora
                    </a></li>
                   
                    <li><a href="VIEWS/tabOperadoras.php" class="sMenu" id="gerOpe" target="interno">
                      <i class="fa fa-circle-o"></i>Gerenciar Operadora
                    </a></li>
                 
                   </ul>  
                </li>  

                <? 
                   } else { } 
                ?>


		       </ul>	
   		</section>
   	</aside> 	

   	<!-- Content Wrapper. Conterá o conteúdo da página-->
  	<div class="content-wrapper">
  		<!--Cabeçalho do Contéudo Principal--> 
  		<section class="content-header">
			   <div id="text-container">
          <script type="text/javascript">
          $(document).ready(function() { 

                  //Padrão - Principal 
                  $("h3").html("Escalonamento CGR");  

                 //caso pressione o botão inicial
                  $("#Inicial").click(function() {
                    $("h3").html("Escalonamento CGR");  
                  }); 

                    //Caso pressione a opção para registrar Escalonamento 
                  $("#cadOperadora").click(function() {
                    $("h3").html("Cadastro de Escalonamento");  
                  }); 

                  //Caso pressione a opção para registrar Fornecedores 
                  $("#cadFornecedores").click(function() {
                    $("h3").html("Cadastro de Fornecedores");  
                  }); 
                  
                  //Caso pressione a opção para registrar Gitec
                  $("#cadGitec").click(function() {
                    $("h3").html("Cadastro Escalonamento GITEC");  
                  }); 

                  //Caso pressione a opção para registrar Escalonamento 
                  $("#cadCgr").click(function() {
                     $("h3").html("Cadastro de Colaboradores");  
                  }); 

                   /************Visualização de Escalonamentos*************/

                  //Caso pressione a opção para registrar Escalonamento 
                  $("#escOperadora").click(function() {
                    $("h3").html("Lista de Escalonamento Operadora");  
                  }); 

                  //Caso pressione a opção para registrar Fornecedores 
                  $("#escFornecedores").click(function() {
                     $("h3").html("Lista de Fornecedores");  
                  }); 
                  
                  //Caso pressione a opção para registrar Gitec
                  $("#escGitec").click(function() {
                     $("h3").html("Lista de Escalonamento GITEC");  
                  }); 

                  //Caso pressione a opção para registrar Escalonamento 
                  $("#escCgr").click(function() {
                     $("h3").html("Lista de Colaboradores");  
                  }); 


                   /************Inventario*************/

                  //Caso pressione a opção para registrar Escalonamento 
                  $("#cadInv").click(function() {
                     $("h3").html("Cadastro de Itens");  
                  }); 

                  //Caso pressione a opção para registrar Fornecedores 
                  $("#relInv").click(function() {
                     $("h3").html("Lista Inventário");  
                  }); 
                            

                   /************Ajuda*************/

                  //Caso pressione a opção para registrar Escalonamento 
                  $("#Ajuda").click(function() {
                     $("h3").html("Ajuda ao Sistema");  
                  }); 


                   /************Sobre*************/

                  //Caso pressione a opção para registrar Escalonamento 
                  $("#Sobre").click(function() {
                     $("h3").html("Sobre o Sistema");  
                  }); 

                  /************Histórico*************/

                  //Caso Pressione o botão de Eventos Recorrentes 
                 $("#histOpe").click(function() { 
                   $("h3").html("Tabela Histórico de sistema de escalonamento"); 
                 });
                 
                  //Caso Pressione o botão de Eventos Recorrentes 
                 $("#histFor").click(function() { 
                   $("h3").html("Tabela Histórico de Fornecedores"); 
                 });
                 
 
                 //Caso Pressione o botão de Eventos Recorrentes 
                 $("#histGit").click(function() { 
                    $("h3").html("Tabela Histórico de sistema de escalonamento GITEC");
                 });
                 
                  //Caso Pressione o botão de Eventos Recorrentes 
                 $("#histFun").click(function() { 
                    $("h3").html("Tabela Histórico de Colaboradores");
                 });
                 
                 
                 /************* Administração ************/
                
                  //Caso Pressione o botão de Eventos Recorrentes 
                 $("#cadUsr").click(function() { 
                   $("h3").html("Registro de Usuários para utilização do sistema de escalonamento"); 
                 });
                 
                  //Caso Pressione o botão de Eventos Recorrentes 
                 $("#gerUsr").click(function() { 
                   $("h3").html("Tabela de Usuários para utilização do sistema de escalonamento"); 
                 });
                 
 
                 //Caso Pressione o botão de Eventos Recorrentes 
                 $("#cadOpe").click(function() { 
                    $("h3").html("Registro de Operadoras para o sistema de escalonamento");
                 });
                 
                  //Caso Pressione o botão de Eventos Recorrentes 
                 $("#gerOpe").click(function() { 
                    $("h3").html("Tabela de Operadoras para o sistema de escalonamento");
                 });
                 



          })
          </script>

          <h3 style="color: #066fa8; margin-left: 50px;"> </h3>
          
         </div>
  		</section>

  		<!--Conteúdo Principal-->
  		<section class="content">
  			<!--Irá alterar conforme a página escolhida em PHP--> 
  			<div id="container">
  			  
          <iframe src="VIEWS/inicial.php" name="interno" id="app_frame" 
          style="display: block; margin: 0 auto; width: 100%; min-height: 650px; border-style: none; overflow-x: auto;">
          </iframe>
           	
  			</div>	

  		</section><!--Fim do Conteúdo Principal-->

  		

  	</div><!--Final do Content Wrapper-->

  	<footer class="main-footer" style="background-color: #066FA8 !important;">
  		<div class="pull-right hidden-xs" style="color: #FFFFFF;">
         	 <b>Versão </b> 2 
    	</div>
  		<strong style="color: #FFFFFF;">Sistema de Escalonamento CGR.</strong> 
  	</footer>
</div> 

<!-- jQuery 2.2.3 -->
<script src="LIB/PLUGINS/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="LIB/BOOTSTRAP/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="LIB/PLUGINS/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="LIB/DIST/js/app.min.js"></script>
<!-- Sparkline -->
<script src="LIB/PLUGINS/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="LIB/PLUGINS/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="LIB/PLUGINS/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="LIB/PLUGINS/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="LIB/PLUGINS/chartjs/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="LIB/DIST/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="LIB/DIST/js/demo.js"></script>

</body>
</html>


