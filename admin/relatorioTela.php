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
        <h1 class="mt-4">Avaliados</h1>
        <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
          <li class="breadcrumb-item active">Avaliados</li>
        </ol>
        <p>
          <div class="alert alert-success" role="alert">
            <strong> Legenda tabela <br>(SIM = SUSPEITO | NAO = NÃO SUSPEITO) </strong>
          </div>
        </p>
        <p>
          <div class="alert alert-danger" role="alert">
            <strong>Somente altere o status novamente do paciente caso ocorra algum problema!</strong>
          </div>
        </p>
        <!-- AQui-->
        <div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="nomeCompleto">Nome completo</label>
              <input type="text" autocomplete="off" required class="form-control" name="nomeCompleto" id="nomecompleto" placeholder="Nome completo">
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
