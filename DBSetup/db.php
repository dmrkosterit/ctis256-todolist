<?php

//$dsn = "mysql:host=localhost;port=3308;dbname=gamesdb" ;
$user = "std" ;
$pass = "erdemsert7" ;
$dbname = "ctis256project";

$dsn = "mysql:host=localhost;dbname=$dbname" ;
try {
  $db = new PDO($dsn, $user, $pass) ;
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;
} catch( PDOException $ex) {
    echo "<p>Connection Error:</p>" ;
    echo "<p>", $ex->getMessage(), "</p>" ;
    exit ;
}
