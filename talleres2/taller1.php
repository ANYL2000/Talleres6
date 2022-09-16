<?php
require_once 'assets/conexion/servidor.php';
$conexion = connect($host, $port, $db_name, $db_username, $db_password);

$con=mysqli_connect($host,$db_username,$db_password,$db_name);
$query =$conexion->prepare("SELECT FechaInicial, FechaFinal FROM calendario;");

$query->execute();
$resultado =$query->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>

<header>
    <title>Talleres</title>
</header>

<div class="titulo_pagina"><h1 class="titulo">TALLERES</h1></div>
<link rel="stylesheet" href="assets/css/estilo_taller1.css">
</head>
<body>
    


<div class="fondo">

<h1 class="titulo_registrar">Registrar Taller</h1>

<form action="" method="POST">
  <ul>

  <li>  
                    <label for="tallerista" >Nombre Completo del Tallerista
                    <input class="entrada_texto" id="nombre_tallerista" type="text" name="nombre_tallerista" required></label>
                    </li> 
            <li>  
                    <label for="name" >Nombre del Taller           
                    <input class="entrada_texto" id="nombre_taller" type="text" name="nombre_taller" required></label>
                    </li> 

                    <li> 
                    <label for="calendario">Calendario   
                    <select name="calendario" id="calendario" required>

                        <option value="">Elige una opción</option>
                        <?php foreach($resultado as $ciclo): ?>
                                <option value='<?php echo $ciclo["FechaInicial"]?> -> <?php echo $ciclo["FechaFinal"]?>'><?php echo $ciclo['FechaInicial']?> -> <?php echo $ciclo['FechaFinal']?></option>
                           <?php  endforeach ?>
                            </select>
                            </label> 
                            </li>       

                            <li> 
                    <label  for="capacidad">Capacidad
                    <input class="entrada_texto" id="capacidad" type="text"  name="capacidad" required></label> 
                    </li> 

                    <li>
                        <div class="radio_opcion"><input type="radio" name="turno" id="turno" value="Matutino" required>
                    <label for="nombre_turno">Matutino</label>   
                    </div>

                       <div class="radio_opcion"> <input type="radio" name="turno" id="turno" value="Vespertino" required>
                  <label for="nombre_turno">Vespertino</label>
                    </div>

                          </li>
                          <li>
                          <label for="tipo_taller">Tipo   
                    <select name="tipo_taller" id="tipo_taller" required>

                        <option value="">Elige una opción</option>
                                <option value="Deportivo">Deportivo</option>
                                <option value="Artistico">Artistico</option>
                                <option value="Cultural">Cultural</option>
                            </select>
                            </label> 
                          </li>

                          <li>
                          <div class="radio_opcion"><input type="radio" name="dia" id="dia" value="Martes" required>
                    <label for="dia">Martes</label>   
                    </div>

                       <div class="radio_opcion"> <input type="radio" name="dia" id="dia" value="Jueves" required>
                  <label for="dia">jueves</label>
                    </div>
                          </li>
            <div class="botones">
                          <li>
                            <button type="reset" id="resetear"><img src="assets/img/borrar.png" alt="assets/img/borrar.png">Limpiar Campos</button>
                            <button type="submit" id="enviar" name ="enviar"><img src="assets/img/registrar.png" alt="assets/img/registrar.png">Registrar Taller</button>
                    
                            <a href="taller1.1.php"><button type="button" id="mostrar_talleres"><img src="assets/img/mostrar_tablas.png" alt="assets/img/mostrar_tablas.png">Mostrar</button></a>
                          
                          </li>

                         
                          </div>
                    </ul>
                    </form>
</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="assets/js/sweetalert.js"></script>
<?php
//include "assets/conexion/servidor.php";
if(isset($_POST['enviar'])){
 
$tallerista = $_POST['nombre_tallerista'];
$nombre_taller = $_POST['nombre_taller'];
$calendario  = $_POST['calendario'];
$capacidad = $_POST['capacidad'];
$turno = $_POST['turno'];
$tipo_taller = $_POST['tipo_taller'];
$dia = $_POST['dia'];

$consultar_repetidos = "SELECT * FROM registrar_taller WHERE NombreTaller= '$nombre_taller' AND Calendario= '$calendario' AND Turno = '$turno' AND Dia = '$dia'";

$filas = mysqli_query($con,$consultar_repetidos);

//print_r($filas);

if(mysqli_num_rows($filas)>0){

  echo '<script>alertaeNoti("Ya existe ese taller")</script>';

}else{

$conexion->query("INSERT INTO registrar_taller (NombreTallerista,NombreTaller,Calendario,Capacidad,Turno,Tipo,Dia) values ('$tallerista','$nombre_taller','$calendario',$capacidad,'$turno','$tipo_taller','$dia')");

$conexion->query("INSERT INTO mostrar_talleres (NombreTallerista,NombreTaller,Calendario,Capacidad,Turno,Tipo,Dia,Lugares_Faltantes) values ('$tallerista','$nombre_taller','$calendario',$capacidad,'$turno','$tipo_taller','$dia',$capacidad)");
    
if($conexion){
 
//echo 'Registrado con exito';
echo '<script>alertaNoti("Se ha registrado el taller con exito")</script>';
 
}

}

$filas=0;
//sleep(2);
//echo "<script> location.href=\"taller1.php\" </script>"; 

}

?>

</body>
</html>
<?php $con->close(); $conexion=null; ?>