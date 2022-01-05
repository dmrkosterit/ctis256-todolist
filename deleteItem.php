<?php
require_once "./DBSetup/db.php";

extract($_GET["todoId"]);
$sql = "delete from to_do where id=?";
$rs = $db->prepare($sql);
$rs->execute(["id" => $todoId]);

include_once "todoview.php";
