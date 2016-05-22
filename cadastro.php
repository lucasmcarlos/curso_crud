<?php

  include "include/conexao.php";

  session_start();

  if(strlen(trim($_SESSION['id']))==0){
    header("Location: index.php");
  }

  if(isset($_POST['btnacao_excluir'])){
    $id      = (int)$_POST["id"];

    $sql = "DELETE FROM aluno WHERE id = $id ";
    $res = mysqli_query($con, $sql); 
    if(strlen(trim(mysqli_error($con)))==0){
      $ok .= "Registro excluído com sucesso.";
    }
  }

  if(isset($_POST["btnacao"])){
      $nome             = $_POST["nome"];
      $data_nascimento  = $_POST["dt_nascimento"];
      $email            = $_POST["email"];
      $nome_mae         = $_POST["nome_mae"];
      $id               = (int)$_POST["id"];

      if(strlen(trim($nome))==0){
        $erro .= "O campo nome deve ser preenchido. <br>";
      }
      if(strlen(trim($data_nascimento))==0){
        $erro .= "O campo data de nascimento deve ser preenchido. <br>";
      }
      if(strlen(trim($email))==0){
        $erro .= "O campo email deve ser preenchido. <br>";
      }
      if(strlen(trim($nome_mae))==0){
        $erro .= "O campo nome da mãe deve ser preenchido. <br>";
      }

      if(strlen(trim($erro))==0){

        if($id == 0){
          $sql ="INSERT INTO aluno (nome, email, data_nascimento,
                     nome_mae) VALUES ('$nome', '$email', 
                    '$data_nascimento', '$nome_mae')";
        }else{
          $sql = "UPDATE aluno SET nome='$nome', 
                                    nome_mae='$nome_mae',
                                    data_nascimento='$data_nascimento',
                                    email='$email'
                  WHERE id = $id ";
        }
        $res = mysqli_query($con, $sql); 
        if(strlen(trim(mysqli_error($con)))==0){
          $ok .= "Cadastro realizado com sucesso.";
        }

        $nome = "";
        $nome_mae = "";
        $data_nascimento = "";
        $email = "";
      }      
  }

  if(isset($_GET["aluno"])){
    $aluno = (int)$_GET["aluno"];
    $sql = "SELECT nome, email, data_nascimento, nome_mae
             FROM aluno WHERE id = $aluno ";
    $res = mysqli_query($con, $sql);
    if(mysqli_num_rows($res) > 0){
      $dados = mysqli_fetch_all($res, MYSQLI_ASSOC);
 
      $nome             = $dados[0]['nome'];
      $nome_mae         = $dados[0]['nome_mae'];
      $data_nascimento  = $dados[0]['data_nascimento'];
      $email            = $dados[0]['email'];
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

          <h2 class="sub-header">Cadastro de Aluno</h2>  
          
            <?php if(strlen(trim($ok))>0){?>
              <div class="alert alert-success" role="alert"><?php echo $ok ?></div>
            <?php } 
              if(strlen(trim($erro))>0){?>
              <div class="alert alert-danger" role="alert"><?php echo $erro ?></div>
              <?php }
            ?>
            <form name="frm_cadastro_aluno" method="POST" action="cadastro.php">
              <div class="row">
                <div class="col-sm-12 col-md-10">
                  <div class="form-group">
                    <label for="label_nome">Nome:</label>
                    <input type="text" name="nome" value="<?php echo $nome ?>" maxlength="55" class="form-control" id="nome" placeholder="Nome">
                  </div>
                </div>
                <div class="col-sm-12 col-md-2">
                  <div class="form-group">
                    <label for="label_data">Data de Nascimento:</label>
                    <input type="date" name="dt_nascimento" value="<?php echo $data_nascimento?>" maxlength="10" class="form-control" id="dt_nascimento" placeholder="Data de Nascimento">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-5">
                  <div class="form-group">
                    <label for="label_email">Email:</label>
                    <input type="text" name="email" value="<?php echo $email?>" maxlength="55" class="form-control" id="email" placeholder="E-Mail">
                  </div>
                </div>
                <div class="col-sm-12 col-md-7">
                  <div class="form-group">
                    <label for="label_mae">Nome da Mãe:</label>
                    <input type="text" name="nome_mae" value="<?php echo $nome_mae?>" maxlength="55" class="form-control" id="nome_mae" placeholder="Nome da Mãe">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12"> 
                  <input type="hidden" name="id" value="<?php echo $aluno ?>"> 
                  <input type="submit" name="btnacao" value="Gravar" class="btn btn-default">

                  <?php if($aluno > 0){?>
                    <input type="submit" name="btnacao_excluir" value="Excluir" class="btn btn-danger">
                  <?php } ?>
                </div>
              </div>
            </form>          
        </div>
      </div>
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
