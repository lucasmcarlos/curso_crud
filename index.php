<?php
  session_start();
  include "include/conexao.php";

  if(isset($_POST["entrar"])){

      $login = addslashes($_POST["login"]);
      $senha = addslashes($_POST["senha"]);

      $sql = "SELECT id, login, senha FROM usuario 
              WHERE login = '$login' 
              and senha = '$senha' ";
      $res = mysqli_query($con, $sql);
      

      if(mysqli_num_rows($res) == 1 ){
        $dados = mysqli_fetch_all($res, MYSQLI_ASSOC);
          $id                 = $dados[0]['id'];
          $login              = $dados[0]['login'];
          $_SESSION["id"]     = $id;
          $_SESSION["login"]  = $login;
          header("Location: pesquisa.php");
      }else{
          $erro .= "Login/senha inválido";
      }
  }


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    
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
    <link href="./css/signin.css" rel="stylesheet">

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

    <div class="container">

      <form class="form-signin" method="POST" action="index.php" name="frm_login">
        <h2 class="form-signin-heading">Autenticação</h2>
        <?php  
          if(strlen(trim($erro))>0){?>
            <div class="alert alert-danger" role="alert"><?php echo $erro ?></div>
          <?php }
        ?>
        <label for="inputEmail" class="sr-only">Email</label>
        <input type="text" id="login" class="form-control" name="login" placeholder="Login"  autofocus>
        <label for="senha" class="sr-only">Senha</label>
        <input type="password" id="senha" name="senha" class="form-control" placeholder="Senha" >
        
        <button class="btn btn-lg btn-primary btn-block" name="entrar" type="submit">Entrar</button>
      </form>
    </div> <!-- /container -->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
