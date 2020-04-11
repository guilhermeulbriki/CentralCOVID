<?php
require_once '../.././services/ConexaoMysql.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Equipe turma 1º semestre SI - UFSM FW 2020" />
    <meta name="description" content="O projeto tem o objetivo da criação de um site para ajudar a sociedade frederiquense a lidar com a crise do novo coronavírus. Nele está contido informações relevantes sobre a Covid-19 e contatos úteis sobre hospitais, farmácias, supermercados e demais estabelecimentos. O site é fruto do trabalho conjunto dos alunos de Sistemas de Informação da Universidade Federal de Santa Maria, campus de Frederico Westphalen, que ingressaram no primeiro semestre de 2020 e estão interessados em promover o bem-estar social diante da pandemia da doença." />
    <meta name="abstract" content="" />
    <meta name="keywords" content="coronavírus, ufsm fw, UFSM, site central covid-19, covid-19, frederico westphalen" />
    <title>Visualizar solicitação - Central Covid-19</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>

</head>

<body>
    <header>
        <nav class="navbar navbar-dark bg-dark">
            <a class="navbar-brand" href="#"><span>
                    <img src="../.././assets/images/logos/logo_covid_branco.png" style="width: 100px" alt="logo-solidariza">
                </span></a>
            <a class="navbar-brand" href="./index.php">Voltar ao formulário</a>
        </nav>
    </header>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="card">
                    <div class="card-header">
                        Visualizar avaliação <button class="btn btn-danger btn-sm ml-2" data-toggle="modal" data-target="#help-modal"><i class="far fa-question-circle"></i> Ajuda!</button>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Dados pessoais</h5>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="cpf">CPF</label>
                                    <input type="text" autocomplete="off" class="form-control" id="cpf" name="cpf" placeholder="Ex. : 000.000.000-00">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="dataNascimento">Data Nascimento</label>
                                    <input type="date" autocomplete="off" class="form-control" name="dataNascimento" id="dataNascimento">
                                </div>
                            </div>
                            <input type="submit" name="visualizaInformacao" class="btn btn-primary" value="Buscar"></input>
                        </form>
                    </div>
                </div>
                <br>
                <?php
                if (@$_POST['visualizaInformacao']) {
                    $conexao = new ConexaoMysql();
                    $conexao->Conecta();
                    $cpf = $conexao->limpar_texto($_POST['cpf']);
                    $sql = "SELECT * FROM formulariopacientes WHERE cpfPaciente ='" . $cpf . "'AND dataNascPaciente ='" . $_POST['dataNascimento'] . "'";
                    $resultado = $conexao->Consulta($sql);
                    $row = $resultado->fetch_assoc();

                    $status = $row['suspeitoPaciente'];
                    $nome = $row['nomePaciente'];

                ?>
                    <div class="card">
                        <div class="card-header">
                            Visualizar status de avaliação
                        </div>
                        <div class="card-body">
                            <p>Olá! <?php echo $nome ?></p>
                            <?php if ($status == 'EMANALISE') { ?>
                                <div class="alert alert-danger" role="alert">
                                    Seu formulário ainda <strong>não foi avaliado</strong>! O mais breve possivel os profissionais irão analisar e entrar em contato com você... Enquanto leia as dicas e ajuda de como se manter prevenido!
                                </div>
                            <?php } ?>

                            <?php if ($status == 'SIM' or $status == 'NAO') { ?>
                                <div class="alert alert-success" role="alert">
                                    Seu formulário <strong>foi avaliado</strong>!<BR><strong> Caso for relevante para COVID-19 entraremos o mais breve possível para dar as orientações, enquanto isso leia as dicas e ajuda de como se manter prevenido!</strong>


                                </div>
                            <?php } else { ?>
                                <p>Infome todos os parâmetros acima!</p>
                            <?php } ?>

                            <a href="../.././components/help/index.html" class="btn btn-warning" aria-pressed="true">Ajuda e orientações</a>
                        </div>
                    </div>
                <?php } ?>
                <br>
            </div>
        </div>
    </div>

    <!-- Modal Ajuda -->
    <div class="modal fade" id="help-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajuda antes de consultar.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Preencha os campos abaixo com o número do seu CPF e a data de seu nascimento para verificar se seu formulário já foi avaliado.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>
