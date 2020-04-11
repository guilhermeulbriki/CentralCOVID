<?php
function mensagem($url, $mensagem)
{
    $envio = '<form id="formulario" name="formulario" method="post" action="' . $url . '">
      
      <input id="btnenviar" name="btnenviar" type="submit" value="Enviar Dados" />
     </form>';

    return $envio;
}
