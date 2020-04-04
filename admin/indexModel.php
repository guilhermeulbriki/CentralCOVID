<?php
require_once 'autentica.php';
require_once 'ConexaoMysql.php';

session_start();
/*
 * Cadastro usuario
 */
if (@$_POST['usuarioCadastro']) {

    $datadocadastro = date('Y-m-d');
    $nome = $_POST['nome'];
    $usuarioPost = $_POST['usuario'];
    $senhaPost = $_POST['senha'];
    $tipo = $_POST['tipo'];
    $senhaNova = md5($senhaPost);
    $conexao = new ConexaoMysql();
    $conexao->Conecta();

    $sql = "INSERT INTO usuarios (datadecadastro, user_nome, user_login, user_senha, user_tipo) VALUES ('$datadocadastro','$nome','$usuarioPost','$senhaNova','$tipo');";

    $conexao->Executa($sql);
    $conexao->Desconecta();
    $msg = md5('cadastro');
    header('location:usuarios.php?msg=' . $msg);
}

/*
 * Atualizar usuario
 */
if (@$_POST['usuarioUpdate']) {
    $nome = $_POST['nome'];
    $usuarioPost = $_POST['usuario'];
    $senhaPost = $_POST['senha'];
    $tipo = $_POST['tipo'];
    $senhaNova = md5($senhaPost);
    $conexao = new ConexaoMysql();
    $conexao->Conecta();
    $sql = "UPDATE usuarios SET nome = $nome, usuario = $usuarioPost, senha = $senhaNova, idTipo = $tipo WHERE idUsuario =" . $_SESSION['idUsuario'];
    $conexao->Executa($sql);
    $conexao->Desconecta();
    $msg = md5('cadastro');
    header('location:usuario.php?msg=' . $msg);
}
/*
 * Cadastro 
 */
if (@$_POST['cadastroTipo']) {

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    $conexao = new ConexaoMysql();
    $conexao->Conecta();

    $sql = "INSERT INTO tipo (tipo_nome, tipo_descricao) VALUES ('$nome','$descricao');";

    $conexao->Executa($sql);
    $conexao->Desconecta();
    $msg = md5('cadastro');
    header('location:tiposEstabelecimentos.php?msg=' . $msg);
}

if (@$_POST['cadastroContato']) {

    $contato = $_POST['contato'];
    $descricao = $_POST['descricao'];

    $conexao = new ConexaoMysql();
    $conexao->Conecta();

    $sql = "INSERT INTO contatos (cont_contato, cont_descricao) VALUES ('$contato','$descricao');";

    $conexao->Executa($sql);
    $conexao->Desconecta();
    $msg = md5('cadastro');
    header('location:contatos.php?msg=' . $msg);
}

if (@$_POST['cadastroEstabelecimento']) {

    $contato = $_POST['contato'];
    $descricao = $_POST['descricao'];

    $conexao = new ConexaoMysql();
    $conexao->Conecta();

    $sql = "INSERT INTO contatos (cont_contato, cont_descricao) VALUES ('$contato','$descricao');";

    $conexao->Executa($sql);
    $conexao->Desconecta();
    $msg = md5('cadastro');
    header('location:contatos.php?msg=' . $msg);
}

/*Atualiza suspeito*/
if (@$_POST['idPacienteSuspeito']) {

    $conexao = new ConexaoMysql();
    $conexao->Conecta();
    $sql = 'UPDATE formulariopacientes SET suspeitoPaciente = "SIM" WHERE idPaciente =' . $_POST['idPacienteSuspeito'];
    $conexao->Executa($sql);
    $conexao->Desconecta();
    $msg = md5('suspeito');
    header('location:pacientesAnalise.php?msg=' . $msg);
}

if (@$_POST['idPacienteSuspeitoN']) {

    $conexao = new ConexaoMysql();
    $conexao->Conecta();
    $sql = 'UPDATE formulariopacientes SET suspeitoPaciente = "NAO" WHERE idPaciente =' . $_POST['idPacienteSuspeitoN'];
    $conexao->Executa($sql);
    $conexao->Desconecta();
    $msg = md5('suspeito');
    header('location:pacientesAnalise.php?msg=' . $msg);
}

/*Atualiza suspeito*/
if (@$_POST['idPacienteSuspeito2']) {

    $conexao = new ConexaoMysql();
    $conexao->Conecta();
    echo $sql = 'UPDATE formulariopacientes SET suspeitoPaciente = "SIM" WHERE idPaciente =' . $_POST['idPacienteSuspeito2'];
    $conexao->Executa($sql);
    $conexao->Desconecta();
    $msg = md5('suspeito');
    header('location:pacientesAnalisados.php?msg=' . $msg);
}

if (@$_POST['idPacienteSuspeitoN2']) {

    $conexao = new ConexaoMysql();
    $conexao->Conecta();
    $sql = 'UPDATE formulariopacientes SET suspeitoPaciente = "NAO" WHERE idPaciente =' . $_POST['idPacienteSuspeitoN2'];
    $conexao->Executa($sql);
    $conexao->Desconecta();
    $msg = md5('suspeito');
    header('location:pacientesAnalisados.php?msg=' . $msg);
}
/******************/
if (@$_POST['idExcluiUsuario']) {

    $conexao = new ConexaoMysql();
    $conexao->Conecta();
    $sql = 'DELETE FROM usuarios WHERE idUsuario =' . $_POST['idExcluiUsuario'];
    $conexao->Executa($sql);
    $conexao->Desconecta();
    $msg = md5('excluir');
    header('location:usuarios.php?msg=' . $msg);
}

if (@$_POST['idExcluiMorador']) {
    $conexao = new ConexaoMysql();
    $conexao->Conecta();
    $sql = 'DELETE FROM morador WHERE idMorador =' . $_POST['idExcluiMorador'];
    $conexao->Executa($sql);
    $conexao->Desconecta();
    $msg = md5('excluir');
    header('location:consultaMorador.php?msg=' . $msg);
}
