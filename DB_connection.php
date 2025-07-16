<?php  

$sName = "dpg-d1rsd96uk2gs73b2j7ug-a";
$uName = "task_management_z0z2_user";
$pass  = "DP5WvJQwiiFD9XhklxoH8l7TCaixCx82";
$db_name = "task_management_z0z2";
$port = 5432;

try {
	$conn = new PDO("pgsql:host=$sName;port=$port;dbname=$db_name", $uName, $pass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOExeption $e){
	echo "Connection failed: ". $e->getMessage();
	exit;
}