<?php

header("Content-Type: application/json") ;
include_once "./DBSetup/db.php";

extract($_GET); 

$sql = "select note from to_do where id=?";
$rs = $db->prepare($sql);
$rs->execute([$todoId]);
$data = ["detail" => $rs->fetch(PDO::FETCH_ASSOC)];

vardump($data);

if(isset($data)){
  json_encode($data) ;
}