<?php
require_once 'autentica.php';
require_once 'ConexaoMysql.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="icon" href="../assets/images/icons/central.png" type="image/icon type">
  <title>Cadastro Isolamento - Central Covid-19</title>
  <link href="css/styles.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
  <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="js/scripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
  <script src="assets/demo/chart-area-demo.js"></script>
  <script src="assets/demo/chart-bar-demo.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
  <script src="assets/demo/datatables-demo.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

</head>

<body>
  <?php include_once('menu.php'); ?>
  <div id="layoutSidenav_content">
    <main>
      <div class="container-fluid">
        <h1 class="mt-4">Manual do sistema</h1>
        <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
          <li class="breadcrumb-item active">Cadastro de pacientes</li>
        </ol>
      </div>
      <!-- AQui-->
      <div class="container">
        <div class="row">
          <div class="col-sm">
            <h5 class="card-title">Dados pessoais</h5>
            <form method="POST" action="../../services/fichaModel.php" enctype="multipart/form-data">
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="nomeCompleto">Nome completo</label>
                  <input type="text" autocomplete="off" required class="form-control" name="nomeCompleto" id="nomecompleto" placeholder="Nome completo">
                </div>
                <div class="form-group col-md-2">
                  <label for="cns">Nº Cartão SUS</label>
                  <input type="text" autocomplete="off" class="form-control" id="cns" name="cns" placeholder="Somente Nº">
                </div>
                <div class="form-group col-md-2">
                  <label for="cpf">CPF</label>
                  <input type="text" autocomplete="off" required class="form-control" id="cpf" name="cpf" placeholder="Ex. : 000.000.000-00">
                </div>
                <div class="form-group col-md-2">
                  <label for="dataNascimento">Data Nascimento</label>
                  <input type="text" autocomplete="off" required class="form-control" name="dataNascimento" id="dataNascimento" placeholder="Ex. : 00/00/0000">
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
                <div class="form-group col-md-4">
                  <label for="idCidade">Município de residência</label>
                  <select id="idCidade" name="idCidade" class="form-control">
                    <?php
                    $conexao = new ConexaoMysql();
                    $conexao->Conecta();
                    $sql = "SELECT * FROM cidadeatuacao WHERE cidadeatuacao.nomeCidade <> 'TODAS';";
                    $resultado = $conexao->Consulta($sql);
                    if ($conexao->total != 0) {
                      while ($row = $resultado->fetch_assoc()) {
                        echo '<option value="' .  $row["idCidade"] . '">' . $row["nomeCidade"] . ' - ' . $row["estado"] . ', ' . $row["pais"] . '</option>';
                      }
                    } else {
                      echo '<option>Nenhuma cidade cadastrada. </option>';
                    }
                    $conexao->Desconecta();
                    ?>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label for="zonaOndeMora">Localidade</label>
                  <select id="zonaOndeMora" name="zonaOndeMora" class="form-control">
                    <option value="URBANA" selected>URBANA</option>
                    <option value="RURAL" selected>RURAL</option>
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
                  <label><strong>Você possui alguma comorbidade?</strong></label>
                  <div class="form-check">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="semComorbidade" id="apresentar" value="SIM">
                      <label class="form-check-label" for="apresentar">
                        Sim
                      </label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="semComorbidade" id="ocultar" value="NÃO">
                      <label class="form-check-label" for="ocultar">
                        Não
                      </label>
                    </div>
                    <div id="exemplo1">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="diabete" value="SIM" name="diabete">
                        <label class="form-check-label" for="diabete">
                          Diabetes Mellitus
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="hipertensao" value="SIM" name="hipertensao">
                        <label class="form-check-label" for="hipertensao">
                          Hipertensão Arterial Sistêmica/Pressão Alta
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="cardiopatias" value="SIM" name="cardiopatias">
                        <label class="form-check-label" for="cardiopatias">
                          Cardiopatias
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="imunodeprimido" value="SIM" name="imunodeprimido">
                        <label class="form-check-label" for="imunodeprimido">
                          Imunodeprimidos (uso contínuo de corticoides, HIV, diálise/hemodiálise, quimioterapia)
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gestante" value="SIM" name="gestante">
                        <label class="form-check-label" for="gestante">
                          Gestante
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="puerpera" value="SIM" name="puerpera">
                        <label class="form-check-label" for="puerpera">
                          Puérpera (mulher que teve filho até 42º dia pós parto)
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="doencaRespiratoria" value="SIM" name="doencaRespiratoria">
                        <label class="form-check-label" for="doencaRespiratoria">
                          Doenças respiratórias crônicas (enfisema pulmonar, asma, bronquite)
                        </label>
                      </div>
                      <div class="form-group col-md-5">
                        <input type="textarea" class="form-control" id="outrasComorbidades" name="outrasComorbidades" placeholder="Outras comorbidades...">
                      </div>
                    </div>

                  </div>

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

      </div>
    </main>
    <?php include_once('footer.php'); ?>
  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="js/scripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
  <script src="assets/demo/chart-area-demo.js"></script>
  <script src="assets/demo/chart-bar-demo.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
  <script src="assets/demo/datatables-demo.js"></script>
</body>

</html>
