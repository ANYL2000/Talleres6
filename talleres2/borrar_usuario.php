<?php

include 'assets/conexion/servidor.php';



$idusuario = $_GET['id'];
$tallerista_seleccionado = $_GET['tallerista'];
 $taller_seleccionado = $_GET['taller'];
 $calendario_seleccionado = $_GET['calendario'];
 $turno_seleccionado = $_GET['turno'];
$dia_seleccionado = $_GET['dia'];

$con=mysqli_connect($host,$db_username,$db_password,$db_name);

$lugares_talleres = "SELECT * FROM mostrar_talleres WHERE Calendario = '$calendario_seleccionado' AND 
    NombreTaller = '$taller_seleccionado' AND NombreTallerista = '$tallerista_seleccionado' AND Turno= '$turno_seleccionado' AND 
    Dia = '$dia_seleccionado'";

$filas_talleres = mysqli_query($con,$lugares_talleres);

while($informacion_taller = mysqli_fetch_array($filas_talleres)){
  $registrados = $informacion_taller['Registrados'];
  $faltantes = $informacion_taller['Lugares_Faltantes'];
}


mysqli_query($conexion, "DELETE FROM usuarios_talleres WHERE idUsuarios = $idusuario");

if($conexion){

    $regitrado_menos = $registrados-1;
    $faltantes_mas = $faltantes+1;

    

    $conexion->query("UPDATE mostrar_talleres SET Registrados= $regitrado_menos, Lugares_Faltantes = $faltantes_mas WHERE Calendario = '$calendario_seleccionado' AND 
NombreTaller = '$taller_seleccionado' AND NombreTallerista = '$tallerista_seleccionado' AND Turno= '$turno_seleccionado' AND 
Dia = '$dia_seleccionado'");

}

echo "<script type='text/javascript'>
window.location='taller1.2.php?tallerista=$tallerista_seleccionado&taller=$taller_seleccionado&calendario=$calendario_seleccionado&turno=$turno_seleccionado&dia=$dia_seleccionado'
</script>";
//echo "<script> window.history.back();</script>";


?>