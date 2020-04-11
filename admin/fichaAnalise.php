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
  <title>Análise paciente - Central Covid-19</title>
  <link href="css/styles.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
  <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />

</head>

<body>
  <?php include_once('menu.php'); ?>
  <div id="layoutSidenav_content">
    <main>
      <div class="container-fluid">
        <h1 class="mt-4">Análise de pacientes</h1>
        <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
          <li class="breadcrumb-item active">Análise de pacientes</li>
        </ol>

        <!--Tabela-->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Análise de pacientes</div>
          <div class="card-body">
            <?php
            $cidade = $_SESSION['idCidade'];

            $conexao = new ConexaoMysql();
            $conexao->Conecta();
            if ($cidade == 1) {
              $where = "WHERE
                            suspeitoPaciente = 'EMANALISE'";
            } else {
              $where = "WHERE
                             formulariopacientes.idCidade = $cidade
                             AND
                             (suspeitoPaciente = 'EMANALISE')";
            }
            $sql = "SELECT
                           TIMESTAMPDIFF(
                            YEAR,
                            dataNascPaciente,
                            CURDATE()) AS idade,
                            `idPaciente`,
                            dataNascPaciente,
                            `cpfPaciente`,
                            `nomePaciente`,
                            `sexoPaciente`,
                            `nacionalidadePaciente`,
                            zonaOndeMora,
                            `respostaWhatsApp`,
                            `telefonePaciente`,
                            `enderecoPaciente`,
                            `dataCadastroPaciente`,
                            `dataPrimSintomasPaciente`,
                            semComorbidade,
                            diabete, 
                            hipertensao, 
                            cardiopatias, 
                            imunodeprimido,
                            gestante,
                            puerpera,
                            doencaRespiratoria, 
                            outrasComorbidades, 
                            `febrePaciente`,
                            `tossePaciente`,
                            `dorGargantaPaciente`,
                            `dificuldadeRespirarPaciente`,
                            `diarreiaPaciente`,
                            `nauseaVomitosPaciente`,
                            `dorCabecaPaciente`,
                            `corizaPaciente`,
                            `confusaoPaciente`,
                            `fraquesaPaciente`,
                            `calafriosPaciente`,
                            `congestaonasalPaciente`,
                            `deglutirPaciente`,
                            `dispneiaPaciente`,
                            `sintomasExtraPaciente`,
                            `temperaturaAferidaPaciente`,
                            `viajouPaciente`,
                            `paisViajado`,
                            `contatosuspeitoPaciente`,
                            `contatoconfirmadoPaciente`,
                            `visitaUbsPaciente`,
                            `ondeVisitou`,
                            `suspeitoPaciente`,
                            `contatadoPaciente`,
                            cidadeatuacao.nomeCidade as municipioPaciente,
                            cidadeatuacao.estado as estadoPaciente,
                            cidadeatuacao.pais as paisPaciente
                        FROM
                            formulariopacientes
                        INNER JOIN cidadeatuacao ON formulariopacientes.idCidade = cidadeatuacao.idCidade " .
              $where . "
                        order by idade desc;";
            $resultado = $conexao->Consulta($sql);
            ?>
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Nome</th>
                    <th>Prioridade</th>
                    <th>Idade</th>
                    <th>#</th>
                  </tr>
                </thead>
                <tbody><?php
                        if ($conexao->total != 0) {
                          foreach ($resultado as $row) {
                            if ($row['viajouPaciente'] == 'SIM') {
                              $pais = $row['viajouPaciente'] . ' - Viajou para: ' . $row['paisViajado'];
                            } else {
                              $pais = $row['viajouPaciente'];
                            }
                            if ($row['visitaUbsPaciente'] == 'SIM') {
                              $ubs = $row['visitaUbsPaciente'] . ' - Visitou: ' . $row['ondeVisitou'];
                            } else {
                              $ubs = $row['visitaUbsPaciente'];
                            }
                        ?>
                      <tr>
                        <td><?php echo $row['nomePaciente'] ?></td>
                        <td><?php
                            if ($row['idade'] >= 60 and $row['semComorbidade'] = "SIM" and $row['doencaRespiratoria'] = "SIM" and $row['temperaturaAferidaPaciente'] > 35 or $row['idade'] >= 60 and $row['semComorbidade'] = "NAO" and $row['temperaturaAferidaPaciente'] > 35) {
                              echo 'MUITO ALTA';
                            } else if ($row['idade'] >= 60 and $row['semComorbidade'] = "NAO" or $row['idade'] >= 60 and $row['semComorbidade'] = "SIM" and $row['doencaRespiratoria'] = "SIM") {
                              echo 'ALTA';
                            }
                            if ($row['idade'] <= 59 and $row['semComorbidade'] = "SIM" and $row['doencaRespiratoria'] = "SIM" and $row['temperaturaAferidaPaciente'] > 35 or $row['idade'] <= 59 and $row['semComorbidade'] = "NAO" and $row['temperaturaAferidaPaciente'] > 35) {
                              echo 'MUITO ALTA';
                            } else if ($row['idade'] <= 59 and $row['semComorbidade'] = "SIM" and $row['doencaRespiratoria'] = "SIM") {
                              echo 'ALTA';
                            } else if ($row['idade'] <= 59) {
                              echo 'BAIXA';
                            }
                            ?>

                        </td>
                        <td><?php echo $row['idade']; ?></td>
                        <td>
                          <button type="submit" class="btn btn-xs btn-info" name="idExcluiUsuario" type="hidden" class="form-control" data-toggle="modal" data-target="#myModal<?php echo $row['idPaciente']; ?>"><i class="fas fa-eye"></i></button>
                          <button type="submit" class="btn btn-xs btn-info" name="idExcluiUsuario" type="hidden" class="form-control" data-toggle="modal" data-target="#modalTelefone<?php echo $row['idPaciente']; ?>"><i class="fas fa-phone"></i></button>
                        </td>
                      </tr>
                      <!-- Inicio Modal -->
                      <div class="modal fade bd-example-modal-lg" id="myModal<?php echo $row['idPaciente']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title text-center" id="myModalLabel">Identificação do paciente <?php
                                                                                                              if ($row['suspeitoPaciente'] === 'EMANALISE') {
                                                                                                                echo " - EM ANALISE";
                                                                                                              }
                                                                                                              ?></h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                              <div>

                                <p><strong>Nome: </strong> <?php echo $row['nomePaciente']; ?><strong> CPF: </strong> <?php echo $row['cpfPaciente']; ?></p>
                                <p><strong>Sexo: </strong><?php echo $row['sexoPaciente']; ?><strong> Data de nascimento: </strong><?php echo date("d/m/Y", strtotime($row['dataNascPaciente'])); ?> <strong> Nacionalidade: </strong><?php echo $row['nacionalidadePaciente']; ?></p>
                                <p><strong>Endereço completo: </strong><?php echo $row['enderecoPaciente']; ?></p>
                                <p><strong> Município de residência: </strong><?php echo $row['municipioPaciente'] . ' - ' . $row['estadoPaciente'] . ', ' . $row['paisPaciente']; ?></p>
                                <p><strong>Possui WhatsApp? </strong><?php echo $row['respostaWhatsApp']; ?> <strong>Telefone do paciente: </strong><?php echo $row['telefonePaciente']; ?></p>
                                <h3>Dados do caso</h3>
                                <hr>
                                <p><strong>Data dos primeiros sintomas: </strong> <?php echo date("d/m/Y", strtotime($row['dataPrimSintomasPaciente'])); ?></p>
                                <p><strong>Temperatura aferida: </strong> <?php echo $row['temperaturaAferidaPaciente'] . ' ºC'; ?></p>
                                <h5>Comorbidades apresentadas</h5>
                                <?php if ($row['semComorbidade'] == "SIM") { ?>
                                  <hr>
                                  <div class="container">
                                    <div class="row">
                                      <div class="col-sm">
                                        <strong> Diabetes Mellitus
                                        </strong>
                                      </div>
                                      <div class="col-sm">
                                        <?php echo $row['diabete']; ?>
                                      </div>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="container">
                                    <div class="row">
                                      <div class="col-sm">
                                        <strong> Gestante
                                        </strong>
                                      </div>
                                      <div class="col-sm">
                                        <?php echo $row['gestante']; ?>
                                      </div>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="container">
                                    <div class="row">
                                      <div class="col-sm">
                                        <strong> Hipertensão Arterial Sistêmica/Pressão Alta
                                        </strong>
                                      </div>
                                      <div class="col-sm">
                                        <?php echo $row['hipertensao']; ?>
                                      </div>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="container">
                                    <div class="row">
                                      <div class="col-sm">
                                        <strong> Cardiopatias </strong>
                                      </div>
                                      <div class="col-sm">
                                        <?php echo $row['cardiopatias']; ?>
                                      </div>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="container">
                                    <div class="row">
                                      <div class="col-sm">
                                        <strong> Imunodeprimidos (uso contínuo de corticoides, HIV, diálise/hemodiálise, quimioterapia) </strong>
                                      </div>
                                      <div class="col-sm">
                                        <?php echo $row['imunodeprimido']; ?>
                                      </div>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="container">
                                    <div class="row">
                                      <div class="col-sm">
                                        <strong> Puérpera (mulher que teve filho até 42º dia pós parto) </strong>
                                      </div>
                                      <div class="col-sm">
                                        <?php echo $row['puerpera']; ?>
                                      </div>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="container">
                                    <div class="row">
                                      <div class="col-sm">
                                        <strong> Doenças respiratórias crônicas (enfisema pulmonar, asma, bronquite) </strong>
                                      </div>
                                      <div class="col-sm">
                                        <?php echo $row['doencaRespiratoria']; ?>
                                      </div>
                                    </div>
                                  </div>

                                <?php } else { ?>
                                <?php
                                  echo 'Não apresentadas comorbidades!';
                                }
                                ?>
                                <br>
                                <h5>Sintomas apresentados</h5>
                                <hr>
                                <div class="container">
                                  <div class="row">
                                    <div class="col-sm">
                                      <strong> Febre </strong>
                                    </div>
                                    <div class="col-sm">
                                      <?php echo $row['febrePaciente']; ?>
                                    </div>
                                  </div>
                                </div>
                                <hr>
                                <div class="container">
                                  <div class="row">
                                    <div class="col-sm">
                                      <strong> Tosse </strong>
                                    </div>
                                    <div class="col-sm">
                                      <?php echo $row['tossePaciente']; ?>
                                    </div>

                                  </div>
                                </div>
                                <hr>
                                <div class="container">
                                  <div class="row">
                                    <div class="col-sm">
                                      <strong> Dor de garganta </strong>
                                    </div>
                                    <div class="col-sm">
                                      <?php echo $row['dorGargantaPaciente']; ?>
                                    </div>

                                  </div>
                                </div>
                                <hr>
                                <div class="container">
                                  <div class="row">
                                    <div class="col-sm">
                                      <strong> Dificuldade de respirar </strong>
                                    </div>
                                    <div class="col-sm">
                                      <?php echo $row['dificuldadeRespirarPaciente']; ?>
                                    </div>

                                  </div>
                                </div>
                                <hr>
                                <div class="container">
                                  <div class="row">
                                    <div class="col-sm">
                                      <strong> Diarreia </strong>
                                    </div>
                                    <div class="col-sm">
                                      <?php echo $row['diarreiaPaciente']; ?>
                                    </div>

                                  </div>
                                </div>
                                <hr>
                                <div class="container">
                                  <div class="row">
                                    <div class="col-sm">
                                      <strong> Náusea/vômitos </strong>
                                    </div>
                                    <div class="col-sm">
                                      <?php echo $row['nauseaVomitosPaciente']; ?>
                                    </div>

                                  </div>
                                </div>
                                <hr>
                                <div class="container">
                                  <div class="row">
                                    <div class="col-sm">
                                      <strong> Cefaleia (dor de cabeça) </strong>
                                    </div>
                                    <div class="col-sm">
                                      <?php echo $row['dorCabecaPaciente']; ?>
                                    </div>

                                  </div>
                                </div>
                                <hr>
                                <div class="container">
                                  <div class="row">
                                    <div class="col-sm">
                                      <strong>Coriza </strong>
                                    </div>
                                    <div class="col-sm">
                                      <?php echo $row['corizaPaciente']; ?>
                                    </div>

                                  </div>
                                </div>
                                <hr>
                                <div class="container">
                                  <div class="row">
                                    <div class="col-sm">
                                      <strong>Irritabilidade/confusão </strong>
                                    </div>
                                    <div class="col-sm">
                                      <?php echo $row['confusaoPaciente']; ?>
                                    </div>

                                  </div>
                                </div>
                                <hr>
                                <div class="container">
                                  <div class="row">
                                    <div class="col-sm">
                                      <strong>Adinamia (fraqueza) </strong>
                                    </div>
                                    <div class="col-sm">
                                      <?php echo $row['fraquesaPaciente']; ?>
                                    </div>

                                  </div>
                                </div>
                                <hr>
                                <div class="container">
                                  <div class="row">
                                    <div class="col-sm">
                                      <strong>Calafrios</strong>
                                    </div>
                                    <div class="col-sm">
                                      <?php echo $row['calafriosPaciente']; ?>
                                    </div>

                                  </div>
                                </div>
                                <hr>
                                <div class="container">
                                  <div class="row">
                                    <div class="col-sm">
                                      <strong>Congestão nasal </strong>
                                    </div>
                                    <div class="col-sm">
                                      <?php echo $row['congestaonasalPaciente']; ?>
                                    </div>

                                  </div>
                                </div>
                                <hr>
                                <div class="container">
                                  <div class="row">
                                    <div class="col-sm">
                                      <strong>Dificuldade para deglutir </strong>
                                    </div>
                                    <div class="col-sm">
                                      <?php echo $row['deglutirPaciente']; ?>
                                    </div>

                                  </div>
                                </div>
                                <hr>
                                <div class="container">
                                  <div class="row">
                                    <div class="col-sm">
                                      <strong>Dispneia </strong>
                                    </div>
                                    <div class="col-sm">
                                      <?php echo $row['dispneiaPaciente']; ?>
                                    </div>
                                  </div>
                                </div>
                                <hr>
                                <div class="container">
                                  <div class="row">
                                    <div class="col-sm">
                                      <strong>Sintomas extras </strong>
                                    </div>
                                    <div class="col-sm">
                                      <fieldset>
                                        <?php echo $row['sintomasExtraPaciente']; ?>
                                      </fieldset>
                                    </div>
                                  </div>
                                </div>
                                <hr>
                                <br>
                                <h3>Dados de exposição e viagens</h3>
                                <hr>
                                <div class="container">
                                  <div class="row">
                                    <div class="col-md-10">
                                      <strong> Paciente tem histórico de viagem para fora do Brasil até 14 dias antes do início dos sintomas?</strong>
                                    </div>
                                    <div class="col-sm">
                                      <fieldset>
                                        <?php echo $pais; ?>
                                      </fieldset>
                                    </div>
                                  </div>
                                </div>
                                <hr>

                                <div class="container">
                                  <div class="row">
                                    <div class="col-md-10">
                                      <strong> O paciente teve contato próximo com uma pessoa que seja caso SUSPEITO de Novo Coronavírus (COVID-19)?</strong>
                                    </div>
                                    <div class="col-sm">
                                      <fieldset>
                                        <?php echo $row['contatosuspeitoPaciente']; ?>
                                      </fieldset>
                                    </div>
                                  </div>
                                </div>
                                <hr>

                                <div class="container">
                                  <div class="row">
                                    <div class="col-md-10">
                                      <strong>O paciente teve contato próximo com uma pessoa que seja caso CONFIRMADO de Novo Coronavírus (COVID-19)?</strong>
                                    </div>
                                    <div class="col-sm">
                                      <fieldset>
                                        <?php echo $row['contatoconfirmadoPaciente']; ?>
                                      </fieldset>
                                    </div>
                                  </div>
                                </div>
                                <hr>

                                <div class="container">
                                  <div class="row">
                                    <div class="col-md-10">
                                      <strong>Esteve em alguma unidade de saúde nos 14 dias antes do início dos sintomas?</strong>
                                    </div>
                                    <div class="col-sm">
                                      <fieldset>
                                        <?php echo $ubs; ?>
                                      </fieldset>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <hr>
                              <h3>Avaliação</h3>
                              <hr>
                              <div class="container">
                                <div class="row">
                                  <div class="col-md-6">
                                    <form name="pacienteSuspeito" method="POST" action="indexModel.php">
                                      <div class="form-group col-md-5">
                                        <label for="wpp">Selecione o tipo: </label>
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
                                      <div class="form-group col-md-12">
                                        <label for="laboratorio">Informe o link gerado</label>

                                        <input type="text" autocomplete="off" required class="form-control" name="laboratorio" id="laboratorio" placeholder="Link ou código gerado">

                                      </div>

                                      <button type="submit" class="btn btn-danger btn-lg" name="idPacienteSuspeito" type="hidden" value="<?php echo $row['idPaciente']; ?>">Suspeito</button>
                                    </form>
                                  </div>
                                  <div class="col-md-6">
                                    <form name="naoSuspeito" method="POST" action="indexModel.php">
                                      <button type="submit" class="btn btn-success btn-lg" name="idPacienteSuspeitoN" type="hidden" value="<?php echo $row['idPaciente']; ?>">Não suspeito</button>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal fade" id="modalTelefone<?php echo $row['idPaciente']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title text-center" id="myModalLabel"></h4>
                            </div>
                            <div class="modal-body">
                              <h3><?php echo $row['telefonePaciente']; ?></h3>
                              <hr>
                              <?php if ($row['respostaWhatsApp'] == "SIM") { ?>
                                <p> <a class="text-center btn btn-xs btn-info" target="_blank" href="https://wa.me/<?php echo $row['telefonePaciente']; ?>?text=Olá!">Enviar mensagem no WhatsApp</a></p>
                              <?php } else { ?>
                              <?php
                                echo "Paciente sem WhatsApp!";
                              }
                              ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- -->
                  <?php
                          }
                        }
                        $conexao->Desconecta();
                  ?>
                </tbody>
              </table>


            </div>
          </div>
          <div class="card-footer small text-muted">
            Atualizado em: <?php
                            date_default_timezone_set('America/Sao_Paulo');
                            echo $dataLocal = date('d/m/Y H:i:s', time());;
                            ?>
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
