<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Equipe turma 1º semestre SI - UFSM FW 2020" />
    <meta name="description" content="O projeto tem o objetivo da criação de um site para ajudar a sociedade frederiquense a lidar com a crise do novo coronavírus. Nele está contido informações relevantes sobre a Covid-19 e contatos úteis sobre hospitais, farmácias, supermercados e demais estabelecimentos. O site é fruto do trabalho conjunto dos alunos de Sistemas de Informação da Universidade Federal de Santa Maria, campus de Frederico Westphalen, que ingressaram no primeiro semestre de 2020 e estão interessados em promover o bem-estar social diante da pandemia da doença." />
    <meta name="abstract" content="" />
    <meta name="keywords" content="coronavírus, ufsm fw, UFSM, site coopera noroeste, covid-19, frederico westphalen" />
    <title>Ficha de pré-atendimento - Coopera Noroeste</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>


</head>

<body>
    <header>
        <nav class="navbar navbar-dark bg-dark">
            <a class="navbar-brand" href="#"><span>
                    <img src="../.././assets/images/logos/coopera.png" style="width: 100px" alt="logo-solidariza">
                </span></a>
            <a href="./visualizaSolicitacao.php" class="btn btn-primary" aria-pressed="true"><i class="fas fa-search"></i></a>

            <a class="navbar-brand" href="#" data-toggle="modal" data-target="#logoutModal">Sair do formulário</a>
        </nav>
    </header>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="card">
                    <?php
                    if ($_REQUEST) {
                        if (@$_REQUEST['msg'] == md5('enviado')) {
                            echo '<div class="alert alert-info">
                    <strong>Você enviou a ficha para avaliação, o mais breve possivel a secretaria de saúde entrará em contato com você. </strong> 
                    </div>';
                        }
                        if (@$_REQUEST['msg'] == md5('existe')) {
                            echo '<div class="alert alert-danger">
                    <strong>Você já solicitou um pré-atendimento.</strong> Verifique o status. 
                    </div>';
                        }
                    }
                    ?>
                    <div class="card-header">
                        Formulário para avaliação<button class="btn btn-danger btn-sm ml-2" data-toggle="modal" data-target="#help-modal"><i class="far fa-question-circle"></i> Leia antes de responder</button>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Dados pessoais</h5>
                        <form method="POST" action="../../services/fichaModel.php" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="nomeCompleto">Nome completo</label>
                                    <input type="text" required class="form-control" name="nomeCompleto" id="nomecompleto" placeholder="Nome completo">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="cpf">CPF</label>
                                    <input type="text" required class="form-control" id="cpf" name="cpf" placeholder="Ex. : 000.000.000-00">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="dataNascimento">Data Nascimento</label>
                                    <input type="text" required class="form-control" name="dataNascimento" id="dataNascimento" placeholder="Ex. : 00/00/0000">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="sexo">Sexo</label>
                                    <select id="sexo" name="sexo" class="form-control">
                                        <option selected>Selecionar</option>
                                        <option value="MASC">MASCULINO</option>
                                        <option value="FEM">FEMININO</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="nacionalidade">Nacionalidade</label>
                                    <input type="text" class="form-control" id="nacionalidade" name="nacionalidade" placeholder="Ex: Brasileiro">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label for="endereco">Endereço</label>
                                    <input type="text" required class="form-control" id="endereco" name="endereco" placeholder="Rua Exemplo, nº 0">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="municipio">Município de residência</label>
                                    <select id="municipio" name="municipio" class="form-control">
                                        <option value="Frederico Westphalen" selected>Frederico Westphalen</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputEstado">Estado de residência</label>
                                    <select id="inputEstado" name="estado" class="form-control">
                                        <option value="RS" selected>RS</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="pais">País de residência</label>
                                    <!-- <input type="text" class="form-control" name="pais" id="pais" placeholder="Ex: Brasil">-->
                                    <select name="pais" id="pais" class="form-control">
                                        <option value="Brasil" selected>Brasil</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label for="wpp">Possui WhatsApp?</label>
                                    <div class="form-check">
                                        <input name="respostaWPP" value="SIM" class="form-check-input" type="radio" id="wpp">
                                        <label class="form-check-label" for="wpp">
                                            Sim
                                        </label>
                                    </div>
                                    <div class="form-check col-md-3">
                                        <input name="respostaWPP" value="NÃO" class="form-check-input" type="radio" id="wpp2">
                                        <label class="form-check-label" for="wpp2">
                                            Não
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="telefone">Telefone</label>
                                    <input required name="telefone" type="text" class="form-control" id="telefone" placeholder="(DDD) 9 0000-0000">
                                </div>
                            </div>
                            <hr>
                            <h5 class="card-title">Dados do caso</h5>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="temperaturaAferidaPaciente">Temperatura aferida:</label>
                                    <input type="text" required class="form-control" name="temperaturaAferidaPaciente" placeholder="Somente nº Ex: 39.5" id="temperaturaAferidaPaciente">
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="dataPrimeiroS">Data dos primeiros sintomas</label>
                                    <input type="date" required class="form-control" name="dataPrimeiroS" id="dataPrimeiroS">
                                </div>
                                <div class="form-group col-md-12">
                                    <label><strong>Selecione os sintomas apresentados</strong></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="febre" value="SIM" name="febre">
                                        <label class="form-check-label" for="febre">
                                            Febre
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="SIM" name="tosse" id="tosse">
                                        <label class="form-check-label" for="tosse">
                                            Tosse
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="dorGarganta" name="dorGarganta" value="SIM">
                                        <label class="form-check-label" for="dorGarganta">
                                            Dor de garganta
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="difRespirar" value="SIM" name="difRespirar">
                                        <label class="form-check-label" for="difRespirar">
                                            Dificuldade de respirar
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="diarreia" name="diarreia" value="SIM">
                                        <label class="form-check-label" for="diarreia">
                                            Diarréia
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="vomito" name="vomito" value="SIM">
                                        <label class="form-check-label" for="vomito">
                                            Náusea/vômitos
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="dorCabeca" name="dorCabeca" value="SIM">
                                        <label class="form-check-label" for="dorCabeca">
                                            Cefaléia (dor de cabeça)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="coriza" name="coriza" value="SIM">
                                        <label class="form-check-label" for="coriza">
                                            Coriza
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="confusao" name="confusao" value="SIM">
                                        <label class="form-check-label" for="confusao">
                                            Irritabilidade/confusão
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="fraqueza" name="fraqueza" value="SIM">
                                        <label class="form-check-label" for="fraqueza">
                                            Adinamia (fraqueza)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="Calafrios" name="Calafrios" value="SIM">
                                        <label class="form-check-label" for="Calafrios">
                                            Calafrios
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="congestaoNasal" name="congestaoNasal" value="SIM">
                                        <label class="form-check-label" for="congestaoNasal">
                                            Congestão nasal
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="difDegludir" name="difDegludir" value="SIM">
                                        <label class="form-check-label" for="difDegludir">
                                            Dificuldade para deglutir
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="dispneia" name="dispneia" value="SIM">
                                        <label class="form-check-label" for="dispneia">
                                            Dispnéia
                                        </label>
                                    </div>

                                </div>
                                <div class="form-group col-md-5">
                                    <label for="outrosSintomas"><strong>Descreva sintomas não descritos acima</strong></label>
                                    <input type="textarea" class="form-control" id="outrosSintomas" name="outrosSintomas" placeholder="Outros sintomas...">
                                </div>
                            </div>
                            <hr>
                            <h5 class="card-title">Dados de exposição e viagens</h5>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="viajouPaciente"> <strong> Tem histórico de viagem para fora do Brasil até 14 dias antes do início dos sintomas?
                                        </strong></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="viajouPaciente" id="viajouPaciente1" onclick="exibeOutros()" value="SIM" checked>
                                        <label class="form-check-label" for="viajouPaciente1">
                                            Sim
                                            <input type="text" class="form-control" name="paisViajado" id="pais2" placeholder="País para onde viajou?">
                                        </label>
                                    </div>
                                    <div class="form-check col-md-3">
                                        <input class="form-check-input" type="radio" name="viajouPaciente" id="viajouPaciente2" onclick="exibeOutros2()" value="NÃO">
                                        <label class="form-check-label" for="viajouPaciente2">
                                            Não
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="contatosuspeitoPaciente"><strong>O paciente teve contato próximo com uma pessoa que seja caso SUSPEITO de Novo Coronavírus (COVID-19)?
                                        </strong>
                                    </label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="contatosuspeitoPaciente" id="contatosuspeitoPaciente1" value="SIM" checked>
                                        <label class="form-check-label" for="contatosuspeitoPaciente1">
                                            Sim
                                        </label>
                                    </div>
                                    <div class="form-check col-md-3">
                                        <input class="form-check-input" type="radio" name="contatosuspeitoPaciente" id="contatosuspeitoPaciente2" value="NÃO">
                                        <label class="form-check-label" for="contatosuspeitoPaciente2">
                                            Não
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="contatoconfirmadoPaciente">
                                        <strong>O paciente teve contato próximo com uma pessoa que seja caso CONFIRMADO de Novo Coronavírus (COVID-19)?
                                        </strong>
                                    </label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="contatoconfirmadoPaciente" id="contatoconfirmadoPaciente1" value="SIM" checked>
                                        <label class="form-check-label" for="contatoconfirmadoPaciente1">
                                            Sim
                                        </label>
                                    </div>
                                    <div class="form-check col-md-3">
                                        <input class="form-check-input" type="radio" name="contatoconfirmadoPaciente" id="contatoconfirmadoPaciente2" value="NÃO">
                                        <label class="form-check-label" for="contatoconfirmadoPaciente2">
                                            Não
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="visitaUbsPaciente">
                                        <strong>Esteve em alguma unidade de saúde e/ou hospital (UBS) nos 14 dias antes do início dos sintomas?
                                        </strong>
                                    </label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="visitaUbsPaciente" id="visitaUbsPaciente1" value="SIM" onclick="unidadeVisitada()" checked>
                                        <label class="form-check-label" for="visitaUbsPaciente1">
                                            Sim
                                            <input type="text" class="form-control" name="ubsVistada" id="unidade" placeholder="UBS e/ou hosp. visitada?">

                                        </label>
                                    </div>
                                    <div class="form-check col-md-3">
                                        <input class="form-check-input" type="radio" name="visitaUbsPaciente" id="visitaUbsPaciente2" value="NÃO" onclick="unidadeVisitada2()">
                                        <label class="form-check-label" for="visitaUbsPaciente2">
                                            Não
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input required class="form-check-input" type="checkbox" id="gridCheck">
                                    <label class="form-check-label" for="gridCheck">
                                        Declaro que todas as informações prestadas neste formulário são verdadeiras, pelas quais me responsabilizo. Declaro estar ciente que é crime, previsto no Código Penal Brasileiro: "Omitir, em documento público ou particular, declaração que dele devia constar, ou nele inserir declaração falsa ou diversa da que deveria ser escrita, com fim de prejudicar, criar obrigação ou alterar a verdade sobre o fato juridicamente relevante" (Art. 299).
                                    </label>
                                </div>
                            </div>
                            <input type="submit" name="enviarFormulario" class="btn btn-primary" value="Enviar formulário"></input>
                        </form>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
    <!-- Modal Ajuda -->
    <div class="modal fade" id="help-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajuda antes de responder o formulário</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Se você estiver suspeitando ter contraído Covid-19, leia atentamente cada pergunta do formulário abaixo e responda com sinceridade para que possamos ajudá-lo(a) da melhor forma possível.</p>

                    <p>Primeiramente, insira seus dados pessoais com exatidão. Logo abaixo, informe-nos sua temperatura, a data em que passou a sentir os primeiros sintomas e selecione os sintomas apresentados. Em seguida, diga-nos com sinceridade se viajou para fora do país ou se teve contato com alguém que está com suspeita ou confirmação de ter contraído a doença. Informe-nos, ainda, se esteve em alguma unidade de saúde nos últimos 14 dias antes do início dos sintomas.</p>

                    <p><strong>Atenção! Não omita nenhuma informação relevante e não minta no formulário. Para o seu próprio bem, você deve preencher todos os campos corretamente.</strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Iniciar formulário</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Você deseja sair?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Selecione "Sair" para sair do formulário e voltar para tela inicial"</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="../.././index.html">Sair</a>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function exibeOutros() {
            document.getElementById("pais2").style.visibility = "visible";
        }

        function exibeOutros2() {
            document.getElementById("pais2").style.visibility = "hidden";
        }

        function unidadeVisitada() {
            document.getElementById("unidade").style.visibility = "visible";
        }

        function unidadeVisitada2() {
            document.getElementById("unidade").style.visibility = "hidden";
        }
        $(document).ready(function() {
            $('#dataNascimento').mask('00/00/0000');
            $('#temperaturaAferidaPaciente').mask('35.4');
            $('#telefone').mask('(00) 00000-0000');
            $('#cpf').mask('000.000.000-00');
        });
    </script>


</body>

</html>