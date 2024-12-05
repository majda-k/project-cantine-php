<?php 
$host = "localhost";
$user = "root";
$password = "";
$db = "data";



try{
    $connexion = new PDO("mysql:host=$host; dbname=$db" , $user , $password);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOEXCEPTION $e){
echo "pas de connexion !!!" . $e->getMessage() ;
}

?>