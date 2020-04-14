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
  <title>Relatório pac. suspeitos - Central Covid-19</title>
  <link href="css/styles.css" rel="stylesheet" />
  <link href="css/styles.css" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body>
  <?php include_once('menu.php'); ?>
  <div id="layoutSidenav_content">
    <main>
      <div class="container-fluid">
        <h1 class="mt-4">Relatório pac. suspeitos</h1>
        <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
          <li class="breadcrumb-item active">Relatório pac. suspeitos</li>
        </ol>


        <!--Tabela-->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Relatório pac. suspeitos</div>
          <div class="card-body">
            <?php
            $cidade = $_SESSION['idCidade'];

            $conexao = new ConexaoMysql();
            $conexao->Conecta();
            if ($cidade == 1) {
              $where = "WHERE
                            suspeitoPaciente = 'SIM'";
            } else {
              $where = "WHERE
                             formulariopacientes.idCidade = $cidade
                             AND
                             (suspeitoPaciente = 'SIM')";
            }
            $sql = "SELECT
                           TIMESTAMPDIFF(
                            YEAR,
                            dataNascPaciente,
                            CURDATE()) AS idade,
                            `idPaciente`,
                            cns,
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
                            cidadeatuacao.pais as paisPaciente,
                            usuarios.user_nome as nomeAvaliador,
                            usuarios.descricao as descricao
                        FROM
                            formulariopacientes
                        INNER JOIN cidadeatuacao ON formulariopacientes.idCidade = cidadeatuacao.idCidade
                        INNER JOIN usuarios ON formulariopacientes.idUsuarioAtualizado = usuarios.user_cod " .
              $where . "
                        order by idade desc;";
            $resultado = $conexao->Consulta($sql);
            ?>
            <div class="table-responsive">
              <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th>CNS</th>
                    <th>CPF</th>
                    <th>Nome</th>
                    <th>Idade</th>
                    <th>Data Nasc.</th>
                    <th>Prioridade</th>
                    <th>Municipio</th>
                    <th>Telefone:</th>
                    <th>Avaliado por:</th>
                  </tr>
                </thead>
                <tbody><?php
                        if ($conexao->total != 0) {
                          foreach ($resultado as $row) {
                        ?>
                      <tr>
                        <td><?php echo $row['cns']; ?></td>
                        <td><?php echo $row['cpfPaciente']; ?></td>
                        <td><?php echo $row['nomePaciente']; ?></td>
                        <td><?php echo $row['idade']; ?></td>
                        <td><?php echo $row['dataNascPaciente']; ?></td>
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
                        <td><?php echo $row['municipioPaciente'] . ' - ' . $row['estadoPaciente'] . ', ' . $row['paisPaciente']; ?></td>
                        <td><?php echo $row['telefonePaciente']; ?></td>
                        <td><?php echo $row['nomeAvaliador'] . '(' . $row['descricao'] . ')';
                            ?></td>
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
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
  <script>
    $(document).ready(function() {
      var table = $('#example').DataTable({
        lengthChange: false,
        buttons: ['copy', 'excel', 'csv', 'pdf', 'colvis']
      });

      table.buttons().container()
        .appendTo('#example_wrapper .col-md-6:eq(0)');
    });
  </script>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="js/scripts.js"></script>



</body>

</html>
