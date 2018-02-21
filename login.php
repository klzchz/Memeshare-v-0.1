<?php
//INICIAR A SESSÃO
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<!-- CABEÇALHO HEAD -->
 <meta charset="utf-8">
 <!--CONFIG P RESPONSIVIDADE-->
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <!--CSS BOOTSTRAP-->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!--FONTAWESOME-->
  <link rel="stylesheet"  href="fontawesome.css">
      <!-- Custom styles for this template -->
  <link href="css/signin.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
<title>Memeshare</title>
<!--FIM CABEÇALHO HEAD -->
</head>
<body>
	
	
	<!--FORMULÁRIO DE LOGIN COM 2 INPUTS E 1 SUBMIT METHOD POST-->
	<br/>
	 <div class="container my-4">

      <form method="post" action="valida.php" class="form-signin" style="background-color:#85d1f8">
        <h1 class="text-center" style="color: #fff; font-family: 'Indie Flower', cursive;">Memeshare</h1>
        <h4 class="form-signin-heading text-center"><img src="img/logo.jpg"></h4>
              <?php
              /*MENSAGEM DE LOGIN CASO O USUÁRIO
                ERRE A SENHA OU DESLOGUE O CÓDIGO 
                ESTÁ NO VALIDA PHP*/
            
              if (isset($_SESSION['msg'])){
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            
              }
              /*MENSAGEM DE CADASTRO ESTÁ NA PÁGINA DE 
              CADASTRO CASO O USUÁRIO CRIE UMA CONTA NOVA*/
              if (isset($_SESSION['msgCad'])){
                echo $_SESSION['msgCad'];
                unset($_SESSION['msgCad']);
            
              }
              ?>
        <input type="text" id="inputEmail" name="usuario" class="form-control" placeholder="Nickmeme" required autofocus><br/>
        <input type="password" name="senha" id="inputPassword" class="form-control" placeholder="MemePass" required>
        <div class="checkbox">
          
        </div>
        <input class="btn btn-lg btn-primary btn-block" type="submit" name="btnLogin" value="Acessar"><br/>
        <h6 class="text-center">Ainda não é Membro ?
      <a style="text-decoration: none;" href="cadastrar.php"><br/>Seja um Memer !</a></h6> 
      </form>

    </div> <!-- /container -->


	<!-- FIM FORMULÁRIO DE LOGIN COM 2 INPUTS E 1 SUBMIT METHOD POST-->

	<!--BOOTSTRAP 3.7 JQUERY -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">
		
	</script>
	<!--BOOTSTRAP 3.7 JAVASCRIPT -->
	 <script src="js/bootstrap.min.js">
	 	
	 </script>
</body>

</html>