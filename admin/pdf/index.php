<?php
require_once '../ConexaoMysql.php';
require_once '../autentica.php';

date_default_timezone_set('America/Sao_Paulo');
$dataLocal = date('d/m/Y H:i:s', time());
$id = $_REQUEST['id'];
$conexao = new ConexaoMysql();
$conexao->Conecta();

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
 cidadeatuacao.pais as paisPaciente,
 usuarios.user_nome as nomeAvaliador,
usuarios.descricao as descricao
FROM
                            formulariopacientes
INNER JOIN cidadeatuacao ON formulariopacientes.idCidade = cidadeatuacao.idCidade
INNER JOIN usuarios ON formulariopacientes.idUsuarioAtualizado = usuarios.user_cod
WHERE idPaciente = $id;";
$resultado = $conexao->Consulta($sql);
$row = $resultado->fetch_assoc();

$nome = $row['nomePaciente'];

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

if ($row['sintomasExtraPaciente'] == NULL) {
  $sintExtra = "NÃO APRESENTOU DEMAIS SINTOMAS";
} else {
  $sintExtra = $row['sintomasExtraPaciente'];
}

if ($row['outrasComorbidades'] == NULL) {
  $comExtra = "NÃO APRESENTOU DEMAIS COMORBIDADES";
} else {
  $comExtra = $row['outrasComorbidades'];
}
$html = "
<title>Ficha paciente TESTE [" . $nome . "]</title>
<style>
        h1 {
            text-align: center;
        }

        p.sub-titulo {
            font-size: 20px;
        }

        .direita {
            text-align: right;
        }

        .esquerda {
            text-align: left;
        }

        .tamanho {
            width: 95px;
        }

        p {
            font-size: 15px;
        }

        .centro {
            text-align: center;
        }
        .img1 {
            height:60px;
          }
          .img2 {
            height:60px;
          }
          .timbre{
            font-size: 10px;
          }
          .margem{
          //  margin-top:-10px;
          }
    </style>
        <p class='timbre'>
        Impressa por: " .
  $_SESSION['nome']
  . " - " . $dataLocal  . "</p>
    <table class='margem' style='width:100%' >
    
    <tr>
        <th class='center' colspan='3'><img  colspan='3' class='img1 direita' src='https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Logo_SUS.svg/1200px-Logo_SUS.svg.png' /><img  colspan='4' class='img2 esquerda' src='https://www.ufsm.br/unidades-universitarias/ccr/wp-content/uploads/sites/370/2019/04/LOGO-UFSM.jpg' /><strong>
        <h1 class='margem'>Ficha do paciente MODELO</h1>            </strong> </th>
    </tr>
    </table>
    <table class='margem' style='width:100%'>
        <tr>
            <th class='center' colspan='3'><strong>
                    <h2>Identificação do paciente</h2>
                </strong> </th>
        </tr>
        <tr>
            <td colspan='2'><strong>Nome completo do paciente: </strong>" . $nome . " </td>
            <td></strong>CPF: </strong>" . $row['cpfPaciente'] . "</td>
        </tr>
        <tr>
            <td><strong>Sexo: </strong> " . $row['sexoPaciente'] . "</td>
            <td><strong>Data de nascimento: </strong>" . date("d/m/Y", strtotime($row['dataNascPaciente'])) . "</td>
            <td><strong>Nacionalidade: </strong> " . $row['nacionalidadePaciente'] . " </td>
        </tr>
        <tr>
            <td colspan='3'><strong>Endereço completo: </strong>" . $row['enderecoPaciente'] . "</td>
        </tr>
        <tr>
            <td><strong>Município de residência: </strong>" . $row['municipioPaciente'] . "</td>
            <td><strong>Estado de residência: </strong>" . $row['estadoPaciente'] . "</td>
            <td><strong>País de residência: </strong>" . $row['paisPaciente'] . "</td>
        </tr>
        <tr>
            <td><strong>Possui WhatsApp? </strong>" . $row['respostaWhatsApp'] . "</td>
            <td colspan='2'><strong>Telefone do paciente: </strong> " . $row['telefonePaciente'] . "</td>
        </tr>
    </table>
    <hr>
    <table style='width:100%'>
        <tr>
            <th class='center' colspan='4'><strong>
                    <h2>Quadro sintomático</h2>
                </strong> </th>
        </tr>
        <tr>
            <td colspan='2'><strong>Data dos primeiros sintomas: </strong></td>
            <td>" . date("d/m/Y", strtotime($row['dataPrimSintomasPaciente']))  . "</td>
        </tr>
        <tr>
            <td colspan='2'><strong>Temperatura aferida:</strong> </strong></td>
            <td> " . $row['temperaturaAferidaPaciente'] . " ºC</td>
        </tr>
        <tr>
            <td colspan='4'><strong>Comorbidades apresentadas </strong></td>
        </tr>
        <tr>
            <td class='tamanho'>Diabetes Mellitus</td>
            <td class='tamanho'>" . $row['diabete'] . "</td>
            <td class='tamanho'>Gestante</td>
            <td class='tamanho'>" . $row['gestante'] . "</td>
        </tr>
        <tr>
            <td>Hipertensão Arterial Sistêmica/Pressão Alta</td>
            <td class='tamanho'>" . $row['hipertensao'] . "</td>
            <td>Cardiopatias</td>
            <td class='tamanho'>" . $row['cardiopatias'] . "</td>
        </tr>
        <tr>
            <td class='tamanho'>Imunodeprimidos (uso contínuo de corticoides, HIV, diálise/hemodiálise, quimioterapia)</td>
            <td class='tamanho'>" . $row['imunodeprimido'] . "</td>
            <td class='tamanho'>Puérpera (mulher que teve filho até 42º dia pós parto)</p>
            <td class='tamanho'>" . $row['puerpera'] . "</td>
        </tr>
        <tr>
            <td class='tamanho'>Doenças respiratórias crônicas (enfisema pulmonar, asma, bronquite)</td>
            <td class='tamanho'>" . $row['doencaRespiratoria'] . "</td>
        </tr>
        </table>
        <strong>
        <p>Comorbidades não descritas acima:</p>
        </strong>
        <fieldset> " . $comExtra . "</fieldset>
        <br>
        <table style='width:100%'>
        <tr>
            <td colspan='4'><strong>Sintomas apresentados: </strong></td>
        </tr>
        <tr>
            <td class='tamanho'>Febre</td>
            <td class='tamanho'>" . $row['febrePaciente'] . "</td>
            <td class='tamanho'>Náusea/vômitos</td>
            <td class='tamanho'>" . $row['nauseaVomitosPaciente'] . "</td>
        </tr>
        <tr>
            <td>Tosse</td>
            <td class='tamanho'>" . $row['tossePaciente'] . "</td>
            <td>Cefaleia (dor de cabeça)</td>
            <td class='tamanho'>" . $row['dorCabecaPaciente'] . "</td>
        </tr>
        <tr>
            <td class='tamanho'>Dor de garganta</td>
            <td class='tamanho'>" . $row['dorGargantaPaciente'] . "</td>
            <td class='tamanho'>Coriza</p>
            <td class='tamanho'>" . $row['corizaPaciente'] . "</td>
        </tr>
        <tr>
            <td class='tamanho'>Dificuldade de respirar</td>
            <td class='tamanho'>" . $row['dificuldadeRespirarPaciente'] . "</td>
            <td class='tamanho'>Irritabilidade/confusão</td>
            <td class='tamanho'>" . $row['confusaoPaciente'] . "</td>
        </tr>
        <tr>
            <td class='tamanho'>Diarreia</td>
            <td class='tamanho'>" . $row['diarreiaPaciente'] . "</td>
            <td class='tamanho'> Adinamia (fraqueza)</td>
            <td class='tamanho'>" . $row['fraquesaPaciente'] . "</td>
        </tr>
        <tr>
            <td class='tamanho'>Calafrios</td>
            <td class='tamanho'>" . $row['calafriosPaciente'] . "</td>
            <td class='tamanho'>Dificuldade para deglutir</td>
            <td class='tamanho'>" . $row['deglutirPaciente'] . "</td>
        </tr>
        <tr>
            <td class='tamanho'>Congestão nasal</td>
            <td class='tamanho'>" . $row['congestaonasalPaciente'] . "</td>
            <td class='tamanho'>Dispneia</td>
            <td class='tamanho'>" . $row['dispneiaPaciente'] . "</td>
        </tr>
    </table>
    <strong>
        <p>Sintomas não descritas acima:</p>
    </strong>
    <fieldset> " . $sintExtra . "</fieldset>
    <hr>
    <table style='width:100%'>
        <tr>
            <th class='center' colspan='5'><strong>
                    <h2>Dados de exposição e viagens</h2>
                </strong> </th>
        </tr>
        <tr>
        <td colspan='4'>
        <p><strong>Paciente tem histórico de viagem para fora do Brasil até 14 dias antes do início dos sintomas?</strong> 
        <td>" . $pais  . "</p></td>
        </td>
        </tr>
        <tr>
        <td colspan='4'>
        <p><strong>O paciente teve contato próximo com uma pessoa que seja caso SUSPEITO de Novo Coronavírus (COVID-19)?</strong> 
        <td>" . $row['contatosuspeitoPaciente'] . "</p></td>
        </td></tr>
        <tr>
        <td colspan='4'>
        <p><strong>O paciente teve contato próximo com uma pessoa que seja caso CONFIRMADO de Novo Coronavírus (COVID-19)?</strong> 
        <td>" . $row['contatoconfirmadoPaciente'] . "</p></td>

        </td></tr>
        <tr>
        <td colspan='4'>
        <p><strong>Esteve em alguma unidade de saúde nos 14 dias antes do início dos sintomas?</strong> 
        <td>" . $ubs . "</p></td>
        </td></tr>

        <tr>
        <td colspan='5'>
        <br>
        <p class='centro'>......................................................................................................................................</p>
        <p class='centro'>Assinatura do responsável pela avaliação</p></strong> 
        <p class='centro'>    " . $row['nomeAvaliador'] . "(" . $row['descricao'] . ")</p>

        </td></tr>
    <table>";
/* Carrega a classe DOMPdf */
require_once('./dompdf/dompdf_config.inc.php');

/* Cria a instância */
$dompdf = new DOMPDF();

/* Carrega seu HTML */
//$css = file_get_contents('css/estilo.css');
//$dompdf->load_html($css, 1);
$dompdf->load_html($html);
//$dompdf->load_html('<p>Adicione seu HTML aqui.</p>');
/* Renderiza */
$dompdf->render();

/* Exibe */
$dompdf->stream(
  $nome . $dataLocal . '.pdf', /* Nome do arquivo de saída */
  array(
    'Attachment' => false /* Para download, altere para true */
  )
);
