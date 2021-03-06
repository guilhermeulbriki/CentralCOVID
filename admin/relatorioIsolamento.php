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
        <title>Relatório pac. suspeitos - Portal Coopera</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />

        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    </head>

    <body>
        <?php include_once('menu.php'); ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Relatório pac. suspeitos | Isolamento</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                        <li class="breadcrumb-item active">Relatório pac. suspeitos | Isolamento</li>
                    </ol>


                    <!--Tabela-->
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fas fa-table"></i>
                            Relatório pac. suspeitos | Isolamento</div>
                        <div class="card-body">
                            <?php
                            $cidade = $_SESSION['idCidade'];

                            $conexao = new ConexaoMysql();
                            $conexao->Conecta();

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
                            `telefonePaciente`,
                            `enderecoPaciente`,
                            `dataCadastroPaciente`,
                            cidadeatuacao.nomeCidade as municipioPaciente,
                            cidadeatuacao.estado as estadoPaciente,
                            cidadeatuacao.pais as paisPaciente,
                            usuarios.user_nome as nomeAvaliador,
                            usuarios.descricao as descricao
                        FROM
                            pacientesisolamento
                        INNER JOIN cidadeatuacao ON pacientesisolamento.idCidade = cidadeatuacao.idCidade
                        INNER JOIN usuarios ON pacientesisolamento.idFuncionario = usuarios.user_cod
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
                                            <th>Municipio</th>
                                            <th>Telefone:</th>
                                            <th>Cadastrado por:</th>
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
                            echo $dataLocal = date('d/m/Y H:i:s', time());
                            ;
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
            $(document).ready(function () {
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