<?php



$content = http_build_query(array(
    'mensg' => 'teste',
));

$context = stream_context_create(array(
    'http' => array(
        'method' => 'POST',
        'content' => $content,
    )
));

$result = file_get_contents('http://localhost/covid-19/admin/testeM.php', null, $context);

