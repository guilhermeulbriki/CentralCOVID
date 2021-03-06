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
  <title>Administração - Central Covid-19</title>
  <link href="css/styles.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
  <?php include_once('menu.php'); ?>
  <div id="layoutSidenav_content">
    <main>
      <div class="container-fluid">
        <?php if ($_SESSION['idTipo'] == 3) { ?><h1 class="mt-4">Bem-vinda equipe médica!</h1>
        <?php } else { ?>
          <h1 class="mt-4">Bem-vindo (a)!</h1>
        <?php } ?>
        <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item active">
            Estatisticas do dia: <?php
                                  date_default_timezone_set('America/Sao_Paulo');
                                  $dataLocal = date('d/m/Y H:i:s', time());
                                  echo $dataLocal . ' '; ?></li>
        </ol>
        <div class="row">
          <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
              <div class="card-body"><strong>
                  <?php
                  $conexao = new ConexaoMysql();
                  $conexao->Conecta();

                  $sql = "SELECT
                                            TIMESTAMPDIFF(
                                            YEAR,
                                                dataNascPaciente,
                                                CURDATE()) AS idade,
                                                `idPaciente`
                                            FROM
                                                formulariopacientes
                                            WHERE
                                                suspeitoPaciente = 'EMANALISE' OR suspeitoPaciente = NULL;";
                  $resultado = $conexao->Consulta($sql);

                  $row = $resultado->fetch_assoc();
                  if ($row['idade'] >= 0 and $row['idade'] <= 18) {
                    echo $conexao->total;
                  } else {
                    echo '0';
                  }

                  $conexao->Desconecta();
                  ?>
                </strong></div>
              <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link">Solicitações faixa etária <strong> 0 a 18 anos </strong></a>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
              <div class="card-body"><strong>
                  <?php
                  $conexao = new ConexaoMysql();
                  $conexao->Conecta();

                  $sql = "SELECT
                                            TIMESTAMPDIFF(
                                            YEAR,
                                                dataNascPaciente,
                                                CURDATE()) AS idade,
                                                `idPaciente`
                                            FROM
                                                formulariopacientes
                                            WHERE
                                                suspeitoPaciente = 'EMANALISE' OR suspeitoPaciente = NULL;";
                  $resultado = $conexao->Consulta($sql);
                  $row = $resultado->fetch_assoc();
                  if ($row['idade'] >= 19 and $row['idade'] <= 35) {
                    echo $conexao->total;
                  } else {
                    echo '0';
                  }
                  $conexao->Desconecta();
                  ?>
                </strong></div>
              <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link">Solicitações faixa etária <strong> 19 a 35 anos </strong></a>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
              <div class="card-body"><strong>
                  <?php
                  $conexao = new ConexaoMysql();
                  $conexao->Conecta();

                  $sql = "SELECT
                                            TIMESTAMPDIFF(
                                            YEAR,
                                                dataNascPaciente,
                                                CURDATE()) AS idade,
                                                `idPaciente`
                                            FROM
                                                formulariopacientes
                                            WHERE
                                                suspeitoPaciente = 'EMANALISE' OR suspeitoPaciente = NULL;";
                  $resultado = $conexao->Consulta($sql);
                  $row = $resultado->fetch_assoc();
                  if ($row['idade'] >= 36 and $row['idade'] <= 59) {
                    echo $conexao->total;
                  } else {
                    echo '0';
                  }


                  $conexao->Desconecta();
                  ?>
                </strong></div>
              <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link">Solicitações faixa etária <strong> 36 a 59 anos </strong></a>

              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
              <div class="card-body"><strong>
                  <?php
                  $conexao = new ConexaoMysql();
                  $conexao->Conecta();

                  $sql = "SELECT
                                            TIMESTAMPDIFF(
                                            YEAR,
                                                dataNascPaciente,
                                                CURDATE()) AS idade,
                                                `idPaciente`
                                            FROM
                                                formulariopacientes
                                            WHERE
                                                suspeitoPaciente = 'EMANALISE' OR suspeitoPaciente = NULL;";
                  $resultado = $conexao->Consulta($sql);
                  $row = $resultado->fetch_assoc();
                  if ($row['idade'] >= 60) {
                    echo $conexao->total;
                  } else {
                    echo '0';
                  }


                  $conexao->Desconecta();
                  ?>
                </strong></div>
              <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link">Solicitações faixa etária <strong> 60+ </strong></a>

              </div>
            </div>
          </div>
        </div>
        <iframe width="800" height="800" src="https://datastudio.google.com/embed/reporting/6a4314ea-37c6-4363-9088-8e062f330f48/page/1M" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>
    </main>
    <footer class="py-4 bg-light mt-auto">
      <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between small">
          <div class="text-muted">&copy; Central Covid-19 - <?php echo date('Y') ?></div>
        </div>
      </div>
    </footer>
  </div>
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
