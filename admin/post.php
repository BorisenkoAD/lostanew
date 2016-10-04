<?php
include "dbLib.php";
$id = $_GET['id'];
$stmt = $connection->prepare('UPDATE reviews SET status = 1 WHERE id = ?');
$stmt->bindValue(1, $id, PDO::PARAM_INT);
$stmt->execute();
$stmt = $connection->prepare('UPDATE reviews SET deleted = 0 WHERE id = ?');
$stmt->bindValue(1, $id, PDO::PARAM_INT);
$stmt->execute();
header ("location: index.php");
?>