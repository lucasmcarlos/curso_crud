<?php
  
  include "include/conexao.php";

  session_start();

  if(strlen(trim($_SESSION['id']))==0){
    header("Location: index.php");
  }

  if(isset($_POST["btnacao"])){    
    $pesquisa = $_POST["pesquisa"];

    $sql = "SELECT * FROM aluno where nome like '%$pesquisa%' ";
    $res = mysqli_query($con, $sql);
    if(mysqli_num_rows($res)>0){
      $dados = mysqli_fetch_all($res, MYSQLI_ASSOC);
    }
  }



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Curso Mão na Massa PHP - CRUD</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="./css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="./js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Curso - CRUD</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="pesquisa.php">Pesquisa</a></li>
            <li><a href="cadastro.php">Cadastro</a></li>
            <li><a href="sair.php">Sair</a></li>        
          </ul>          
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <?php// include "include/menu.php"; ?>
        <div class="col-sm-12 col-md-12 main">         

          <h2 class="sub-header">Pesquisar</h2>

          <div class="row">
            <div class="col-sm-12 col-md-12 ">
              <form name="frm_cadastro_aluno" method="POST" action="pesquisa.php">
                <div class="row">
                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="label_nome">Pesquisa:</label>
                      <input type="text" name="pesquisa" value="" maxlength="55" class="form-control" id="nome" placeholder="Digite o nome do aluno">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12 col-md-12">              
                    <input type="submit" name="btnacao" value="Pesquisar" class="btn btn-default">
                  </div>
                </div>
              </form>
            </div>
          </div>          
        </div>
      </div>
      <?php  if(count($dados)>0){ ?>
      <div class="row">
        <div class="col-sm-12 col-md-12">
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Nome</th>
                  <th>E-Mail</th>
                  <th>Data de Nascimento</th>
                  <th>Mãe</th>
                  <th>Editar</th>
                </tr>
              </thead>
              <tbody>
              <?php 
             
                foreach($dados as $linha){
                    echo "<tr>
                      <td>$linha[nome]</td>
                      <td>$linha[email]</td>
                      <td>$linha[data_nascimento]</td>
                      <td>$linha[nome_mae]</td>
                      <td><a href='cadastro.php?aluno=$linha[id]'>Editar</a></td>
                    </tr>";  
                }
              

              ?>

                           
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="./js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="./js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
