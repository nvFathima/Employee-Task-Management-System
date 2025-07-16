<?php  

$sName = "sql12.freesqldatabase.com";
$uName = "sql12790381";
$pass  = "fAtLlXpcTS";
$db_name = "sql12790381";

try {
	$conn = new PDO("mysql:host=$sName;dbname=$db_name", $uName, $pass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOExeption $e){
	echo "Connection failed: ". $e->getMessage();
	exit;
}