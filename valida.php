<?php
//INCLUI O ARQUIVO DE CONEXÃO COM O BANCO DE DADOS
include_once('conexao.php');
//INICIA A SESSÃO
session_start();
//ATRIBUI O CAMPO SUBMIT DO BTNLOGIN NO FORMULÁRIO A VARIÁVEL $BTNLOGIN
$btnLogin = filter_input(INPUT_POST,'btnLogin',FILTER_SANITIZE_STRING);
//CASO CLIQUE NO BTN LOGIN
if ($btnLogin){
	/*ATRIBUI  OS CAMPOS USUÁRIO E SENHA DO LOGIN A UMA VARIÁVEL*/
	$usuario = filter_input(INPUT_POST,'usuario',FILTER_SANITIZE_STRING);
	$senha = filter_input(INPUT_POST,'senha',FILTER_SANITIZE_STRING);
	/*CASO OS CAMPOS NÃO SEJE VÁZIO  ELE PESQUISA NO BD*/
	if (!(empty($usuario)) AND (!empty($senha))) {
		
		//PESQUISA DO USUÁRIO NO BD COM OS COMPARATIVOS DA TABLE USUÁRIOS LIMIT 1
		$result_usuario = "SELECT id , nome ,email,senha FROM usuarios WHERE usuario='$usuario'LIMIT 1";
		//ATRIBUI OS RESULTADOS A VARIAVEL,USANDO A VARIAVEL CONN E A PESQUISA
		$resultado_usuario = mysqli_query($conn,$result_usuario);
		//SE HOUVER CONEXÃO
		if($resultado_usuario){
			//RECEBE A VARIAVEL DA CONEXAO
			$row_usuario = mysqli_fetch_assoc($resultado_usuario);
			//SE AS DUAS VÁRAVEIS SENHA TIVER O MESMO VALOR
			if (password_verify($senha , $row_usuario['senha'])) {
				//SE OS DADOS DO USUÁRIO FOR IGUAL AO BD
				$_SESSION['id'] = $row_usuario['id'];
				$_SESSION['nome'] = $row_usuario['nome'];
				$_SESSION['email'] = $row_usuario['email'];
				header("Location:administrativo.php");
				// ELE IRÁ LOGAR
				
			}else{
				//SENÃO  ERRO
				$_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>NickPass ou Nickmeme Inválido!</div>";
				header("Location: login.php");

			}
		}

	}else{
		//CAMPO VAZIO
			$_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>NickPass ou Nickmeme Inválido!</div>";
	header("Location: login.php");	
	}

}else{
	//USUARIO TENTANDO ACESSAR A PAG SEM LOGAR
	$_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Página não encontrada !</div>";
	header("Location: login.php");
}