<?php
// Listen  echo "God's Plan";
//INICIAR SESSÃO
session_start();
//LIMPAR DADOS
ob_start();
//ATRIBUI O SUBMIT DO FORMULÁRIO AO $BTNCAD
$btnCad = filter_input(INPUT_POST, 'btnCad',FILTER_SANITIZE_STRING);
//SE CLICAR NO BTNCAD
if($btnCad){
	//INCLUI O ARQUIVO DE CONEXÃO
	include_once'conexao.php';
	//VARIÁVEL DE DADOS RECEBIDOS
	$dados_rc = filter_input_array(INPUT_POST,FILTER_DEFAULT);
	//VARIÁVEL BOOLEAN $ERRO CASO EXISTA UM ERRO
	$erro = false;
	//TIRA AS TAGS
	$dados_st= array_map('strip_tags',$dados_rc);
	//TIRA  O ESPAÇO
	$dados= array_map('trim',$dados_st);
			//CASO TENHA ALGUM CAMPO VAZIO DARÁ ERRO
		if (in_array('',$dados)){
			$erro=true;
			$_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Necessário Preencher todos os Campos!</div>";
			//CASO A SENHA TENHA MENOS QUE 6 CARACTERES DÁ ERRO
		}elseif(strlen($dados['senha']) < 6 ){
			$erro = true;
			$_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>NickPass deve conter no Mínimo 6 Caracteres !</div>";
			//CASO TENHA ASPAS SIMPLES NA SENHA DARÁ ERRO
		}elseif (stristr($dados['senha'], "'")){
			$erro = true;
			$_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>NickPass não deve conter este [ ' ] Caracter !</div>";
			//CASO TENHA CIFRÃO DARÁ ERRO
		}elseif (stristr($dados['senha'], "$")){
			$erro = true;
			$_SESSION['msg'] = "* <div class='alert alert-danger' role='alert'>NickPass não deve conter este [ $ ] Caracter !</div>";
			
		}//CASO TENHA UM O SINAL DE ADIÇÃO DARÁ ERRO
		elseif (stristr($dados['senha'], "+")){
			$erro = true;
			$_SESSION['msg'] = " <div class='alert alert-danger' role='alert'>NickPass não deve conter este [ + ] Caracter !</div>";
			
		}//CASO TENHA CERQUILHA DARÁ ERRO
		elseif (stristr($dados['senha'], "#")){
			$erro = true;
			$_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>NickPass não deve conter este [ # ] Caracter !</div>";
			
		}else{
			//CASO TENHA 2 USUÁRIOS IGUAIS DARÁ ERRO
			$result_usuario ="SELECT id FROM usuarios WHERE usuario='".$dados['usuario']."'";
			$resultado_usuario = mysqli_query($conn , $result_usuario);
			if(($resultado_usuario)AND($resultado_usuario->num_rows !=0)){
				$erro = true;
			$_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Nickmeme Já utilizado !</div> ";
			}
			//2 EMAIL IGUAIS DARÁ ERRO
			$result_email ="SELECT id FROM usuarios WHERE email='".$dados['email']."'";
			$resultado_email = mysqli_query($conn , $result_usuario);
			if(($resultado_email)AND($resultado_email->num_rows !=0)){
				$erro = true;
			$_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>E-mail Já utilizado !</div>!";
			}
		}
	if (!$erro){

		//CRIPTOGRAFIA HASH DO PHP NA SENHA 
	$dados['senha'] = password_hash($dados['senha'],PASSWORD_DEFAULT);

	//INSERÇÃO DE DADOS NO BD
	$result_usuario ="INSERT INTO usuarios (nome,email,usuario,senha) VALUES (
			'".$dados['nome']."',
			'".$dados['email']."',
			'".$dados['usuario']."',
			'".$dados['senha']."'
		)";
		//QUERY DE CONEXÃO COM O BD
	 $resultado_usuario = mysqli_query($conn,$result_usuario);
	 //CASO A INSERÇÃO DÊ CERTO REDIRECIONA PARA O LOGIN
	 if (mysqli_insert_id($conn)){
	 	$_SESSION['msgCad'] = "<div class='alert alert-success' role='alert'>Memer Cadastrado com Sucesso !</div>";
	 	header("Location: login.php");

	 }else{
	 	//CASO NÃO DÊ CERTO MOSTRA O ERRO !
	 	$_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro ao cadastrar Meme !</div>";
	 }

	}
	

}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<!--CABEÇALHO -->
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
</head>
<body>
	
	
	<!--FORMULÁRIOS METODO POST A VALIDAÇÃO FOI FEITA ACIMA -->
	<div class="container my-4">
	<form method="POST" action="" class="form-signin text-center" style="background-color:#85d1f8">
		<h2  class="text-center" style="color: #fff;font-family: 'Indie Flower', cursive;">Seja um Memer !</h2>
			<?php
			/*MENSAGENS SOBRE O CADASTRO VALIDADAS
			NAS VÁRIAVEIS  GLOBAIS*/
		if (isset($_SESSION['msg'])){
			echo $_SESSION['msg'];
			unset($_SESSION['msg']);

		}
		?>
		<input type="text" name="nome" class="form-control" placeholder="* Nome"><br>
		<input type="email" id="inputEmail" name="email" class="form-control" placeholder="* email"><br>
		<input type="text" name="usuario" class="form-control" placeholder="* Nickmeme"><br>
		<input type="password" name="senha" class="form-control" placeholder=" *Memepass">
		<input type="submit" name="btnCad" class="btn btn-success btn-block" value="Serei um Memer !">
		<h5>Já sou um Memer!
		<a href="login.php"><br/>Clique aqui</a></h5> 
	</form>
	<!--BOOTSTRAP 3.7 JQUERY -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">
		
	</script>
	<!--BOOTSTRAP 3.7 JAVASCRIPT -->
	 <script src="js/bootstrap.min.js"></script>
</body>

</html>