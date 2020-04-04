<?php

require './connection.php';

try {
  //converts recursively all values of an array to UTF8
  function utf8_converter($array)
  {
    array_walk_recursive($array, function (&$item, $key) {
      if (!mb_detect_encoding($item, 'utf-8', true)) {
        $item = utf8_encode($item);
      }
    });

    return $array;
  }
  $db = new PDO($dsn, $username, $password);
  $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

  $sth = $db->query("SELECT * FROM locations");
  $locations = $sth->fetchAll();
  
  $locations2 = utf8_converter($locations);
  //http://php.net/manual/pt_BR/json.constants.php
  echo  json_encode($locations2, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
  echo $e->getMessage();
}
