<?php
$username = 'u1063074_losta';
$password = '4n9I)e_M.Y1&xX,s';
try 
	{
    $connection = new PDO('mysql:host=192.168.137.106;dbname=db1063074_losta', $username, $password, array(
    PDO::ATTR_PERSISTENT => true));
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $connection->prepare("SET NAMES 'utf8'");
	$stmt->execute();
	} 
		catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
?>