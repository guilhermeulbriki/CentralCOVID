<?php

require './connection.php';

try {
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
  echo json_encode($locations2, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
  echo $e->getMessage();
}
