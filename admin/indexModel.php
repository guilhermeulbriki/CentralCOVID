<?php

require_once 'autentica.php';
require_once 'ConexaoMysql.php';

/*
 * Cadastro usuario ['ATUALIZAR']
 */
if (@$_POST['usuarioCadastro']) {

    $datadocadastro = date('Y-m-d');
    strtoupper($nome = $_POST['nome']);
    $usuarioPost = $_POST['usuario'];
    $senhaPost = $_POST['senha'];
    $tipo = $_POST['tipo'];
    $descricao = $_POST['descricao'];
    $idCidade = $_POST['idCidade'];
    $senhaNova = md5($senhaPost);
    $conexao = new ConexaoMysql();
    $conexao->Conecta();

    echo $sql = "INSERT INTO usuarios (datadecadastro, user_nome, user_login, user_senha, user_tipo, descricao, idCidade) VALUES ('$datadocadastro','$nome','$usuarioPost','$senhaNova','$tipo', '$descricao', $idCidade);";

    $conexao->Executa($sql);
    $conexao->Desconecta();
    $msg = md5('cadastro');
    header('location:sistemaUsuarios.php?msg=' . $msg);
}

/*
 * Atualizar usuario ['ATUALIZAR']
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
    header('location:sistemaUsuarios.php?msg=' . $msg);
}

if (@$_POST['esqueceuSenha']) {

    $conexao = new ConexaoMysql();
    $conexao->Conecta();
    $sql = "UPDATE usuarios SET senhaEsquecida = '1' WHERE user_cod =" .  $_POST['esqueceuSenha'];
    $conexao->Executa($sql);
    $conexao->Desconecta();
    $msg = md5('cadastro');
    header('location:sistemaUsuarios.php?msg=' . $msg);
}
/*
 * Cadastro 
 */
//cidade
if (@$_POST['cadastroCidade']) {

    $cidade = strtoupper($_POST['cidade']);
    $estado = strtoupper($_POST['estado']);
    $pais = strtoupper($_POST['pais']);

    $conexao = new ConexaoMysql();
    $conexao->Conecta();

    $sql = "INSERT INTO `cidadeatuacao`(`nomeCidade`, `estado`, `pais`) VALUES ('$cidade','$estado','$pais');";

    $conexao->Executa($sql);
    $conexao->Desconecta();
    $msg = md5('cadastro');
    header('location:sistemaCidades.php?msg=' . $msg);
}
//tipoEstabelecimento
if (@$_POST['cadastroTipo']) {

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    $conexao = new ConexaoMysql();
    $conexao->Conecta();

    $sql = "INSERT INTO tipo (tipo_nome, tipo_descricao) VALUES ('$nome','$descricao');";

    $conexao->Executa($sql);
    $conexao->Desconecta();
    $msg = md5('cadastro');
    header('location:portalTipoEstabelecimento.php?msg=' . $msg);
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

/* Atualiza suspeito */
if (@$_POST['idPacienteSuspeito']) {

    $conexao = new ConexaoMysql();
    $conexao->Conecta();

    $sql = "UPDATE formulariopacientes SET suspeitoPaciente = 'SIM', idUsuarioAtualizado = " . $_SESSION['idUsuario'] . " WHERE idPaciente =" . $_POST['idPacienteSuspeito'];

    $conexao->Executa($sql);
    $conexao->Desconecta();
    $msg = md5('suspeito');
    header('location:fichaAnalise.php?msg=' . $msg);
}

if (@$_POST['idPacienteSuspeitoN']) {

    $conexao = new ConexaoMysql();
    $conexao->Conecta();
    $sql = "UPDATE formulariopacientes SET suspeitoPaciente = 'NAO', idUsuarioAtualizado  = " . $_SESSION['idUsuario'] . " WHERE idPaciente =" . $_POST['idPacienteSuspeitoN'];
    $conexao->Executa($sql);
    $conexao->Desconecta();
    $msg = md5('suspeito');
    header('location:fichaAnalise.php?msg=' . $msg);
}

/* Atualiza suspeito */
if (@$_POST['idPacienteSuspeito2']) {

    $conexao = new ConexaoMysql();
    $conexao->Conecta();
    echo $sql = "UPDATE formulariopacientes SET suspeitoPaciente = 'SIM', idUsuarioAtualizado =  = " . $_SESSION['idUsuario'] . " WHERE idPaciente =" . $_POST['idPacienteSuspeito2'];
    $conexao->Executa($sql);
    $conexao->Desconecta();
    $msg = md5('suspeito');
    header('location:fichaAnalisada.php?msg=' . $msg);
}

if (@$_POST['idPacienteSuspeitoN2']) {

    $conexao = new ConexaoMysql();
    $conexao->Conecta();
    $sql = "UPDATE formulariopacientes SET suspeitoPaciente = 'NAO', idUsuarioAtualizado  = " . $_SESSION['idUsuario'] . " WHERE idPaciente =" . $_POST['idPacienteSuspeitoN2'];
    $conexao->Executa($sql);
    $conexao->Desconecta();
    $msg = md5('suspeito');
    header('location:fichaAnalisada.php?msg=' . $msg);
}


//confirmado/não

if (@$_POST['idPacienteConfirmado']) {

    $conexao = new ConexaoMysql();
    $conexao->Conecta();
    $sql = "UPDATE formulariopacientes SET suspeitoPaciente = 'CONF' , idUsuarioAtualizado  = " . $_SESSION['idUsuario'] . " WHERE idPaciente =" . $_POST['idPacienteConfirmado'];

    $conexao->Executa($sql);
    $conexao->Desconecta();
    //dados para o insert
    $status = 'CONFIRMADO';
    $laboratorio = strtoupper($_POST['laboratorio']);
    date_default_timezone_set('America/Sao_Paulo');
    $dataAtual = date('Y-m-d H:i:s');
    $idUsuario = $_SESSION['idUsuario'];
    $idPaciente = $_POST['idPacienteConfirmado'];
    $conexao2 = new ConexaoMysql();
    $conexao2->Conecta();

    $sql2 = "INSERT INTO laboratoriotestado (idPaciente,status,nomeLaboratorio,idFuncionario,dataCadastro) VALUES ('$idPaciente','$status','$laboratorio','$idUsuario','$dataAtual')";

    $conexao2->Executa($sql2);
    $conexao2->Desconecta();

    $msg = md5('suspeito');
    header('location:fichaSuspeitos.php?msg=' . $msg);
}

//AtualizaProntuario

if (@$_POST['avaliaSuspeito']) {

    $exame = $_POST['exameR'];
    $dtRexame = $_POST['dataRealizaExame'];
    $dtPexame = $_POST['dataPrevisaoExame'];
    $contatado = $_POST['pacienteContatado'];
    $tipoIsolamento = $_POST['tipoIsolamentoSelect'];

    $conexao = new ConexaoMysql();
    $conexao->Conecta();
    echo $sql = "UPDATE formulariopacientes SET tipoIsolamento = '$tipoIsolamento', exameRealizado = '$exame', contatadoPaciente = '$contatado', dataRealizaExame = '$dtRexame',dataPrevisaoExame = '$dtPexame', idUsuarioAtualizado  = " . $_SESSION['idUsuario'] . " WHERE idPaciente =" . $_POST['avaliaSuspeito'];

    $conexao->Executa($sql);
    $conexao->Desconecta();

    $msg = md5('suspeito');
    header('location:fichaSuspeitos.php?msg=' . $msg);
}

/* Atualiza suspeito */
if (@$_POST['idPacienteNConfirmado']) {

    $conexao = new ConexaoMysql();
    $conexao->Conecta();
    echo $sql = "UPDATE formulariopacientes SET suspeitoPaciente = 'NAOCONF',  idUsuarioAtualizado  = " . $_SESSION['idUsuario'] . " WHERE idPaciente =" . $_POST['idPacienteNConfirmado'];
    $conexao->Executa($sql);
    $conexao->Desconecta();

    $msg = md5('suspeito');

    $conexao2 = new ConexaoMysql();
    $conexao2->Conecta();

    //dados para o insert
    $status = 'NAO CONFIRMADO';
    $laboratorio = strtoupper($_POST['laboratorio']);
    date_default_timezone_set('America/Sao_Paulo');
    $dataAtual = date('Y-m-d H:i:s');
    $idUsuario = $_SESSION['idUsuario'];
    $idPaciente = $_POST['idPacienteConfirmado'];
    $conexao2 = new ConexaoMysql();
    $conexao2->Conecta();

    echo $sql2 = "INSERT INTO laboratoriotestado (idPaciente,status,nomeLaboratorio,idFuncionario,dataCadastro) VALUES ('$idPaciente','$status','$laboratorio','$idUsuario','$dataAtual')";

    $conexao2->Executa($sql2);
    $conexao2->Desconecta();
    header('location:fichaSuspeitos.php?msg=' . $msg);
}
//fim confirmado
/* * *************** */
if (@$_POST['idExcluiUsuario']) {
    //$_POST['idExcluiUsuario'];
    $conexao = new ConexaoMysql();
    $conexao->Conecta();
    $sql = "UPDATE usuarios SET atv = 0 WHERE user_cod =" . $_POST['idExcluiUsuario'];
    $conexao->Executa($sql);
    $conexao->Desconecta();
    $msg = md5('excluir');
    header('location:sistemaUsuarios.php?msg=' . $msg);
}
//ativar
if (@$_POST['ativarUsuario']) {
    $conexao = new ConexaoMysql();
    $conexao->Conecta();
    $sql = "UPDATE usuarios SET atv = 1 WHERE user_cod =" . $_POST['ativarUsuario'];
    $conexao->Executa($sql);
    $conexao->Desconecta();
    $msg = md5('excluir');
    header('location:sistemaUsuarios.php?msg=' . $msg);
}
if (@$_POST['idExcluiCidade']) {

    $conexao = new ConexaoMysql();
    $conexao->Conecta();
    $sql = 'DELETE FROM cidadeatuacao WHERE idCidade =' . $_POST['idExcluiCidade'];
    $conexao->Executa($sql);
    $conexao->Desconecta();
    $msg = md5('excluir');
    header('location:sistemaCidades.php?msg=' . $msg);
}

//Formulário isolamento
if (@$_POST['enviarFormularioIs']) {

    function limpar_texto($str)
    {
        return preg_replace("/[^0-9]/", "", $str);
    }

    function ConvertToDate($data)
    {
        $data = explode('/', $data);
        return ' ' . $data[2] . '-' . $data[1] . '-' . $data[0];
    }

    date_default_timezone_set('America/Sao_Paulo');


    $cpf1 = $_POST['cpf'];
    $cns1 = $_POST['cns'];
    $cpfAtual = limpar_texto($cpf1);
    $cnsAtual = limpar_texto($cns1);
    $idFuncionario = $_SESSION['idUsuario'];
    $nomeCompleto = strtoupper($_POST['nomeCompleto']);
    $cpf = $cpfAtual;
    $cns = $cnsAtual;
    $dataNascimento = ConvertToDate($_POST['dataNascimento']);
    $nacionalidade = strtoupper($_POST['nacionalidade']);
    $endereco = strtoupper($_POST['endereco']);
    $respostaWPP = $_POST['respostaWPP'];
    $telefone = "55" . (limpar_texto($_POST['telefone']));
    $sexo = $_POST['sexo'];
    $dataAtual = date('Y-m-d H:i:s');
    $idCidade = $_POST['idCidade'];
    $zonaOndeMora = $_POST['zonaOndeMora'];


    $conexao = new ConexaoMysql();
    $conexao->Conecta();

    echo $sql = "INSERT INTO `pacientesisolamento`(
            `cpfPaciente`,
            `cns`,
            `nomePaciente`,
            `sexoPaciente`,
            `dataNascPaciente`,
            `nacionalidadePaciente`,
            idCidade,
            zonaOndeMora,
            `respostaWhatsApp`,
            `telefonePaciente`,
            `enderecoPaciente`,
            `dataCadastroPaciente`,
            idFuncionario
            )
        VALUES(
            '$cpf',
            '$cns',
            '$nomeCompleto ',
            '$sexo',
            '$dataNascimento',
            '$nacionalidade',
            '$idCidade',
            '$zonaOndeMora',
            '$respostaWPP',
            '$telefone',
            '$endereco',
            '$dataAtual',
            '$idFuncionario')";

    $conexao->Executa($sql);
    $conexao->Desconecta();
    $msg = md5('cadastro');
    header('location:enfIsolamento.php?msg=' . $msg);
}
