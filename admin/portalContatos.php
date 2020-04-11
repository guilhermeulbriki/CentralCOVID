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

<body>
  <?php include_once('menu.php'); ?>
  <div id="layoutSidenav_content">
    <main>
      <div class="container-fluid">
        <h1 class="mt-4">Contatos</h1>
        <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
          <li class="breadcrumb-item active">Contatos</li>
        </ol>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong"><i class="fas fa-plus-square"></i></button>


        <?php
        if ($_REQUEST) {
          if (@$_REQUEST['msg'] == md5('cadastro')) {
        ?>
            <br> <br>
            <div class="alert alert-success" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Sucesso!</strong> Cadatrado com sucesso!
            </div>

        <?php
          }
          if (@$_REQUEST['msg'] == md5('erro')) {

            echo '<div class="row"><div class="container"><div class="alert alert-danger col-md-5" role="alert">
                    Complete todos os campos.
                  </div></div></div>';
          }
          if (@$_REQUEST['msg'] == md5('agendado')) {

            echo '<div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Success!</strong> You have been signed in successfully!
                    </div>';
          }
        }
        ?>
        <br><br>
        <!--Tabela-->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Contatos</div>
          <div class="card-body">
            <div class="table-responsive">
              <?php
              $conexao = new ConexaoMysql();
              $conexao->Conecta();

              $sql = "SELECT cont_contato, cont_descricao FROM contatos";
              $resultado = $conexao->Consulta($sql);
              ?>
              <table class="table table-bordered" id="dataTable" width="60%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Contato</th>
                    <th>Descrição</th>
                    <th>#</th>
                  </tr>
                </thead>
                <tbody><?php
                        if ($conexao->total != 0) {
                          foreach ($resultado as $row) {
                        ?>
                      <tr>
                        <td><?php echo $row['cont_contato']; ?></td>
                        <td><?php echo $row['cont_descricao']; ?></td>
                        <td>
                          <form name="excluir" method="POST" action="indexModel.php">
                            <button type="submit" class="btn btn-xs btn-danger" name="idExcluiUsuario" type="hidden" class="form-control" value="<?php echo $row['idUsuario']; ?>">Apagar</button>
                          </form>
                        </td>
                      </tr>
                  <?php
                          }
                        }

                        $conexao->Desconecta();
                  ?>
                </tbody>
              </table>
            </div>

          </div>
          <div class="card-footer small text-muted">Atualizado em: <?php
                                                                    date_default_timezone_set('America/Sao_Paulo');
                                                                    echo $dataLocal = date('d/m/Y H:i:s', time());;
                                                                    ?>
          </div>
        </div>

      </div>
    </main>
    <?php include_once('footer.php'); ?>

    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Cadastro de usuário</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container">
              <form class="tabela" method="post" autocomplete="off" action="indexModel.php">
                <div class="form-group col-md-12">
                  <label for="contato">Contato:</label>
                  <input type="text" maxlength="15" id="contato" data-mask="(00) 0000-0000" data-mask-selectonfocus="true" name="contato" class="form-control phone-ddd-mask" placeholder="Ex.: (00) 0000-0000">
                  <label for="descricao">Descrição: </label>
                  <input id="descricao" name="descricao" class="form-control">
                  <br><input name="cadastroContato" type="submit" value="Cadastrar" class="btn btn-primary">
                </div>
              </form>


            </div>
          </div>
          <!--
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                -->
        </div>
      </div>

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
