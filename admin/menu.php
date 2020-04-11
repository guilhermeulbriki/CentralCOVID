<?php
require_once 'autentica.php';
?>
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php"><img src="./assets/images/logos/logo_covid_branco.png " height="50px"></a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
  <!-- Navbar Search-->
  <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
    <div class="input-group">
      <div class="input-group-append">
      </div>
    </div>
  </form>
  <!-- Navbar-->
  <ul class="navbar-nav ml-auto ml-md-0">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Sair</a>
      </div>
    </li>
  </ul>
</nav>
<div id="layoutSidenav">
  <div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
      <div class="sb-sidenav-menu">
        <div class="nav">
          <a class="nav-link" href="index.php">
            <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
            Inicio
          </a>
          <?php if ($_SESSION['idTipo'] == 1 or $_SESSION['idTipo'] == 2) { ?>
            <div class="sb-sidenav-menu-heading">Adm. Portal</div>
            <a class="nav-link" href="portalTipoEstabelecimento.php">
              <div class="sb-nav-link-icon"><i class="fas fa-tags"></i></div>
              Tipos de estabelecimentos
            </a>
            <a class="nav-link" href="portalEstabelecimentos.php">
              <div class="sb-nav-link-icon"><i class="fas fa-store"></i></div>
              Estabelecimentos
            </a>
            <a class="nav-link" href="portalContatos.php">
              <div class="sb-nav-link-icon"><i class="fas fa-phone-square"></i></div>
              Contatos Úteis
            </a>
          <?php
          }

          if ($_SESSION['idTipo'] == 1 or $_SESSION['idTipo'] == 3) {
          ?>
            <div class="sb-sidenav-menu-heading">Adm. Formulário</div>

            <a class="nav-link" href="fichaAnalise.php">
              <div class="sb-nav-link-icon"><i class="fas fa-user-clock"></i></div>
              Análise
            </a>
            <a class="nav-link" href="fichaSuspeitos.php">
              <div class="sb-nav-link-icon"><i class="fas fa-exclamation-triangle"></i></div>
              Suspeitos
            </a>
            <a class="nav-link" href="fichaConfirmados.php">
              <div class="sb-nav-link-icon"><i class="fas fa-check-square"></i></div>
              Confirmados
            </a>
            <a class="nav-link" href="fichaAnalisada.php">
              <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
              Fichas já avaliadas
            </a>


            <div class="sb-sidenav-menu-heading">Contr. Enfermagem</div>
            <a class="nav-link" href="cadastroPaciente.php">
              <div class="sb-nav-link-icon"><i class="fa fa-hospital-user"></i></div>
              Cadastro paciente
            </a>
            <a class="nav-link" href="enfIsolamento.php">
              <div class="sb-nav-link-icon"><i class="fas fa-user-clock"></i></div>
              Cad. Isolamento Dom.
            </a>
            <div class="sb-sidenav-menu-heading">Rel. Enfermagem</div>
            <a class="nav-link" href="relatorioSuspeito.php">
              <div class="sb-nav-link-icon"><i class="fas fa-exclamation-triangle"></i></div>
              Suspeitos
            </a>
            <a class="nav-link" href="relatorioConfirmado.php">
              <div class="sb-nav-link-icon"><i class="fas fa-check-square"></i></div>
              Confirmados
            </a>
            <a class="nav-link" href="relatorioIsolamento.php">
              <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
              Isolamento domiciliar
            </a>
            <!--
                        <a class="nav-link" href="relatorioTela.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Telas
                        </a>
                    -->
            <div class="sb-sidenav-menu-heading">Extra</div>
            <a class="nav-link" href="manualSistema.php">
              <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
              Manual
            </a>
            <a class="nav-link" href="manualSistema.php">
              <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
              Notas da versão
            </a>
          <?php } ?>
          <?php if ($_SESSION['idTipo'] == 1) { ?>
            <div class="sb-sidenav-menu-heading">ADM. Sistema</div>
            <a class="nav-link" href="relatorioAcesso.php">
              <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
              Histórico de acesso
            </a>
            <a class="nav-link" href="sistemaUsuarios.php">
              <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
              Usuários
            </a>

            <a class="nav-link" href="sistemaCidades.php">
              <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
              Cidades de abrangência
            </a>
          <?php } ?>
        </div>
      </div>
      <div class="sb-sidenav-footer">
        <div class="small">Bem vindo(a):</div>
        <?php
        date_default_timezone_set('America/Sao_Paulo');
        $dataLocal = date('d/m/Y H:i:s', time());
        if (@$_SESSION) {
          echo @$_SESSION['nome'] . '&nbsp';
        }
        echo '<br>' . $dataLocal . ' ';
        ?>
      </div>

    </nav>
  </div>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Você deseja sair?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Selecione "Sair" para encerrar a sessão"</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Sair</a>
        </div>
      </div>
    </div>
  </div>
