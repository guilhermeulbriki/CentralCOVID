<?php
//inicializa as sessões do server
session_start();
//destroi as sessões do server para o usuário logado
session_destroy();

session_start();
$_SESSION['adicionaMenu'] = 'deslogado';
//Criptografa em padrão md5 qualquer valor.
$msg = md5('logout');
//redireciona para a página de login
//QUERYSTRING: formada de uma variável e um valor
header('location:index.php?msg=' . $msg);
?>

