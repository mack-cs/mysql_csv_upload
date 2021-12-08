<?php
	$dbHost = "localhost";
	$dbName = "ppp_db";
	$dbChar = "utf8";
	$dbUser = "root";
	$dbPass = "";
		try {
		  $pdo = new PDO(
		    "mysql:host=".$dbHost.";dbname=".$dbName.";charset=".$dbChar,
		    $dbUser, $dbPass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
		  );
		} catch (Exception $ex) { exit($ex->getMessage()); }

function checkIfEntryExists($connection, $barcode){
	$sql = "SELECT * FROM product_dimens WHERE barcode = :barcode";
	$stmt = $connection->prepare($sql);
	$stmt->bindParam(":barcode", $barcode);
	$stmt->execute();
	$result = $stmt->fetch();
	if($result){
		return $result;
	}else{
		return false;
	}
}
 
