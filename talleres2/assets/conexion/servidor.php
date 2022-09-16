<?php

                     // usuario de base de datos en hosting

$host = 'localhost';                //usuario de base de datos en localhost
$port = '3306';
$db_username = 'root';
$db_password = '';
$db_name = 'talleres';

function connect($s, $p, $d, $u, $pa){
    try{
        $con = new PDO("mysql:host=$s;port=$p;dbname=$d", $u, $pa);
        return $con;
    }catch(PDOException $e){
        return false;
    }
}

$conexion = mysqli_connect($host,$db_username,$db_password,$db_name) or die ("Ha fallado la conexion".mysql_error());


/*if($conexion){
	echo "Conectado";
}
*/
?>