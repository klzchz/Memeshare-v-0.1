<?php
//INICIAR SESSÃO
session_start();
//CASO O USUÁRIO NÃO TENHA O ID VÁZIO ELE LOGA
if (!empty($_SESSION['id'])){
	echo "Olá ".$_SESSION['nome'].", Bem Vindo!<br/>";
echo "<a href='sair.php'>Sair</a>";
}else{
	//SENÃO ELE REDIRECIONA P O LOGIN COMO NÃO EXISTENTE
	 $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Memer não existente !</div>";
 header("Location: login.php");
}
