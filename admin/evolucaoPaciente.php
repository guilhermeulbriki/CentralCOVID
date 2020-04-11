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
  <title>Suspeitos - Central Covid-19</title>
  <link href="css/styles.css" rel="stylesheet" />
  <link href="css/styles.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>


</head>

<body>
  <?php include_once('menu.php'); ?>
  <div id="layoutSidenav_content">
    <main>
      <div class="container-fluid">
        <h1 class="mt-4">Evolução</h1>
        <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
          <li class="breadcrumb-item active">Evolução</li>
        </ol>
        <div class="container">
          <div class="row">
            <a type="submit" class="btn btn-xs btn-info" name="imprimir" class="form-control" href="fichaSuspeitos.php"><i class="fas fa-exclamation-triangle"></i></a>
            <p style=color:#fff;>||</p> <a type="submit" class="btn btn-xs btn-info" name="imprimir" class="form-control" href="fichaConfirmados.php"><i class="fas fa-check-square"></i></a>
            <p style=color:#fff;>||</p><button type="submit" class="btn btn-xs btn-info" type="hidden" class="form-control" data-toggle="modal" data-target="#modalEvolucao"><i class="fas fa-history"></i></button>
          </div>
        </div>

        <br>
        <!--Tabela-->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Histórico de evoluções</div>
          <div class="card-body">
            <?php
            $idPaciente = $_REQUEST['id'];

            $conexao = new ConexaoMysql();
            $conexao->Conecta();

            $sql = "SELECT
                                    evolucaopaciente.mensagemEvolucao AS msg,
                                    evolucaopaciente.dataEvolucao AS dt,
                                    usuarios.user_nome AS nomeAvaliador,
                                    usuarios.descricao AS descricao,
                                    formulariopacientes.nomePaciente as nomePac
                                FROM
                                    evolucaopaciente
                                INNER JOIN usuarios ON evolucaopaciente.idFuncionario = usuarios.user_cod
                                INNER JOIN formulariopacientes ON evolucaopaciente.idPaciente = formulariopacientes.idPaciente
                                WHERE evolucaopaciente.idPaciente = $idPaciente
                                ORDER BY dataEvolucao DESC";
            $resultado = $conexao->Consulta($sql);
            ?>

            <div class="table-responsive">

              <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="dataTable">
                <thead>
                  <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Data</th>
                    <th>Avaliado por:</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if ($conexao->total != 0) {
                    foreach ($resultado as $row) {
                  ?> <tr>
                        <td><?php echo $row['nomePac'];  ?></td>
                        <td><?php echo $row['msg'];  ?></td>
                        <td><?php echo $row['dt'];  ?></td>
                        <td>
                          <?php echo $row['nomeAvaliador'] . '(' . $row['descricao'] . ')';
                          ?></td>
                      </tr>
                  <?php
                    }
                  } else {
                    echo 'Evoluçao não iniciada, clique no ícone acima para iniciar.';
                  }
                  $conexao->Desconecta();
                  ?>
                </tbody>
              </table>
              <?php
              ?>
            </div>

          </div>


        </div>
      </div>
      <div class="card-footer small text-muted">
        Atualizado em: <?php
                        date_default_timezone_set('America/Sao_Paulo');
                        echo $dataLocal = date('d/m/Y H:i:s', time());;
                        ?>
      </div>
  </div>
  <!-- Modal evoluções -->
  <div class="modal fade" id="modalEvolucao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title text-center" id="myModalLabel">Evoluir</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <label for="outrosSintomas"><strong>Descreva a Evolução do paciente</strong></label>
                <input type="textarea" class="form-control" id="outrosSintomas" name="outrosSintomas" placeholder="Outros sintomas..."><br>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-danger btn-lg" name="idPacienteConfirmado" type="hidden" value="<?php echo $row['id']; ?>">Evolução</button>

        </div>
      </div>
    </div>
  </div>
  <!-- -->
  </div>
  </main>
  <?php include_once('footer.php'); ?>


  </div>

  <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="js/scripts.js"></script>

  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
  <script src="assets/demo/datatables-demo.js"></script>
</body>

</html>
