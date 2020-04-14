<!DOCTYPE html>
<html lang="en">
<?php
require_once './ConexaoMysql.php';
require_once 'autentica.php';
?>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="icon" href="../assets/images/icons/central.png" type="image/icon type">
  <title>Histórico Acesso - Central Covid-19</title>
  <link href="css/styles.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body>
  <?php include_once('menu.php'); ?>
  <div id="layoutSidenav_content">
    <main>
      <div class="container-fluid">
        <h1 class="mt-4">Histórico Acesso</h1>
        <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
          <li class="breadcrumb-item active">Histórico Acesso</li>
        </ol>
        <!--Tabela-->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Histórico Acesso</div>
          <div class="card-body">
            <div class="table-responsive">
              <?php
              $conexao = new ConexaoMysql();
              $conexao->Conecta();

              $sql = "SELECT * FROM acessohistorico";
              $resultado = $conexao->Consulta($sql);
              ?>
              <table class="table table-bordered" id="dataTable" width="60%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Nome</th>
                    <th>Data/Hora</th>
                  </tr>
                </thead>
                <tbody><?php
                        if ($conexao->total != 0) {
                          foreach ($resultado as $row) {
                        ?>
                      <tr>
                        <td><?php echo $row['nomeAcesso']; ?></td>
                        <td><?php echo $row['dataHora']; ?></td>

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
    <footer class="py-4 bg-light mt-auto">
      <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between small">
          <div class="text-muted">Copyright &copy; Solidariza <?php echo date('Y'); ?></div>
        </div>
      </div>
    </footer>

  </div>
  <script type="text/javascript">
    /* Máscaras ER */
    function mascara(o, f) {
      v_obj = o
      v_fun = f
      setTimeout("execmascara()", 1)
    }

    function execmascara() {
      v_obj.value = v_fun(v_obj.value)
    }

    function mtel(v) {
      v = v.replace(/D/g, ""); //Remove tudo o que não é dígito
      v = v.replace(/^(d{2})(d)/g, "($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
      v = v.replace(/(d)(d{4})$/, "$1-$2"); //Coloca hífen entre o quarto e o quinto dígitos
      return v;
    }

    function id(el) {
      return document.getElementById(el);
    }
    window.onload = function() {
      id('telefone').onkeypress = function() {
        mascara(this, mtel);
      }
    }
  </script>
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
