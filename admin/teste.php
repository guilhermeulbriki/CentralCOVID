<?php
try {
    $wsdlUrl = 'https://servicoshm.saude.gov.br/cadsus/CadsusService/v5r0?wsdl';
    $wsUser = 'CADSUS.CNS.PDQ.PUBLICO';
    $passWs = 'kUXNmiiii#RDdlOELdoe00966';
    $soapClientOptions = array(
	'trace' => 1,
	'cache_wsdl' => WSDL_CACHE_NONE
    );
    $client = new SoapClient($wsdlUrl, $soapClientOptions);
    $xmlheader = '
<wsse:Security SOAP-ENV:mustUnderstand="1" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" 
xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
    <wsse:UsernameToken wsu:Id="UsernameToken-F6C95C679D248B6E3F143032021465917">
        <wsse:Username>' . $wsUser . '</wsse:Username>
        <wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">' . $passWs . '</wsse:Password>
    </wsse:UsernameToken>
</wsse:Security>
';
    $header = new SoapHeader('http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd', 'Security', new \SoapVar($xmlheader, XSD_ANYXML), false);
    $client->__setSoapHeaders($header);

    $requestPesquisar = new stdClass();
    $requestPesquisar->CNESUsuario = new stdClass();
    $requestPesquisar->CNESUsuario->CNES = '6963447';
    $requestPesquisar->CNESUsuario->Usuario = 'LEONARDO';
    $requestPesquisar->CNESUsuario->Senha = '?';
    $requestPesquisar->FiltroPesquisa = new stdClass();
    $requestPesquisar->FiltroPesquisa->nomeCompleto = new stdClass();
    $requestPesquisar->FiltroPesquisa->nomeCompleto->Nome = 'SERGIO ARAUJO CORREIA LIMA';
    $requestPesquisar->FiltroPesquisa->tipoPesquisa = 'IDENTICA';
    $requestPesquisar->higienizar = '0';
    $result = $client->pesquisar($requestPesquisar);
    if ($result) {
	echo '<pre>', print_r($result), '</pre>';
    } else {
	echo '<h2>Request:</h2>';
	echo '<pre>', print_r($client->__getLastRequest()), '</pre>';
	echo '<h2>Header:</h2>';
	echo '<pre>', print_r($client->__getLastRequestHeaders()), '</pre>';
	echo '<h2>Response:</h2>';
	echo '<pre>', print_r($client->__getLastResponse()), '</pre>';
    }
} catch (Exception $e) {
    echo '<pre>', print_r($e), '<pre>';
}