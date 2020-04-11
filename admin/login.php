<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - Portal Coopera</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-ufsm">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4"><img src="../assets/images/logos/logo_covid.png " height="60px"></h3>
                                </div>
                                <div class="card-body">
                                    <?php
                                    if ($_REQUEST) {

                                        if (@$_REQUEST['msg'] == md5('expirou')) {

                                            echo '<div class="alert alert-info">

                    <strong>Você encerrou a sessão! Informe o usuário e senha novamente.</strong> 

                    </div>';
                                        }

                                        if (@$_REQUEST['msg'] == md5('admin')) {

                                            echo '<div class="alert alert-info">

                    <strong>Você não é admin! <br>Tente com outro usuário!</strong> 

                    </div>';
                                        }

                                        if (@$_REQUEST['msg'] == md5('logout')) {

                                            echo '<div class="alert alert-info">

                    <strong>Tchau!!</strong> 

                    </div>';
                                        }
                                    }
                                    ?>
                                    <form method="POST" role="form">
                                        <div class="form-group"><label class="small mb-1" for="inputEmailAddress">Usuário</label>
                                            <input class="form-control py-4" id="inputEmailAddress" name="user" type="text" placeholder="Informe seu usuário" /></div>
                                        <div class="form-group"><label class="small mb-1" for="inputPassword">Senha</label>
                                            <input class="form-control py-4" id="inputPassword" name="senha" type="password" placeholder="Insira sua senha" /></div>

                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0"><a class="small" href="malito:suporte@solidarizafw.com">Caso tenha esquecido o usuário entre em contato com o suporte@cooperanors.tk</a>
                                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                                    </form>
                                    <?php
                                    if (@$_POST) {
                                        $usr = $_POST['user'];
                                        $senha = $_POST['senha'];
                                        require_once 'ConexaoMysql.php';
                                        $conexao = new ConexaoMysql();
                                        $conexao->Conecta();
                                        $sql = 'SELECT * FROM usuarios;';
                                        $resultado = $conexao->Consulta($sql);
                                        while ($row = $resultado->fetch_assoc()) {
                                            if ($usr == $row['user_login'] && md5($senha) == $row['user_senha']) {
                                                //delimita o tempo de vida da sessão
                                                //  session_cache_expire(600);
                                                //avisa o server que irei utilizar sessões
                                                //ativa as sessoes do servidor
                                                @session_start();
                                                //em uma sessão posso armazenar:
                                                //variáveis
                                                $_SESSION['usuario'] = $usr;
                                                $_SESSION['idUsuario'] = $row['user_cod'];
                                                $_SESSION['nome'] = $row['user_nome'];
                                                $_SESSION['idTipo'] = $row['user_tipo'];

                                                //redireciona para a página
                                                function getUserIpAddr()
                                                {
                                                    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                                                        //ip from share internet
                                                        $ip = $_SERVER['HTTP_CLIENT_IP'];
                                                    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                                                        //ip pass from proxy
                                                        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                                                    } else {
                                                        $ip = $_SERVER['REMOTE_ADDR'];
                                                    }
                                                    return $ip;
                                                }

                                                date_default_timezone_set('America/Sao_Paulo');
                                                $date = date('Y-m-d H:i');
                                                require_once 'ConexaoMysql.php';
                                                $conexao = new ConexaoMysql();
                                                $conexao->Conecta();
                                                echo $sql = "INSERT INTO acessoHistorico(nomeAcesso, ip, dataHora) VALUES ('" . $_SESSION['nome'] . "','" . getUserIpAddr() . "','" . $date . "');";
                                                $conexao->Executa($sql);
                                                header('location:index.php');
                                            }
                                        }

                                        $conexao->Desconecta(); //fim if....
                                    }


                                    ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-footerSite  mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-footer">Copyright &copy; Sistemas de Informação - UFSM FW 2019</div>
                        <!--<div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div> -->
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>
