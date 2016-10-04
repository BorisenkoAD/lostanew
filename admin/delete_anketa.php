<?php
include "dbLib.php";
$id = $_GET['id'];
$stmt = $connection->prepare('UPDATE anketa SET deleted = 1 WHERE id = ?');
$stmt->bindValue(1, $id, PDO::PARAM_INT);
$stmt->execute();
header ("location: index.php#anketa");
?>
