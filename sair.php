<?php
//INICIAR SESSÃO
session_start();
 //DESTRUIR SESSÃO E DADOS E REDIRECIONAR PARA O LOGIN
 unset($_SESSION['id'],$_SESSION['nome'],$_SESSION['email']);
 $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Memer deslogado com Sucesso !</div>";
 header("Location: login.php");