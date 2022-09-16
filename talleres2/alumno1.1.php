<?php
require_once 'assets/conexion/servidor.php';
$conexion = connect($host, $port, $db_name, $db_username, $db_password);

$tallerista_seleccionado = $_GET["tallerista"];
$taller_seleccionado = $_GET["taller"];
$calendario_seleccionado = $_GET['calendario'];
$turno_seleccionado = $_GET['turno'];
$dia_seleccionado = $_GET['dia'];

if(empty($_GET['tallerista'])){
  echo "<script> window.location='alumno1.php';</script>";
}

$con=mysqli_connect($host,$db_username,$db_password,$db_name);



//$query =$conexion->prepare("SELECT FechaInicial, FechaFinal FROM calendario;");


//$query->execute();
//$resultado =$query->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>

<header>
    <title>Talleres</title>
</header>

<div class="titulo_pagina"><h1 class="titulo">TALLERES</h1></div>
<link rel="stylesheet" href="assets/css/estilo_alumno1.1.css">
<!--<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body>
    


<div class="fondo">

<h1 class="titulo_taller">Taller seleccionado</h1>
<div class="taller_informacion">
<p id="subtitulo">  TALLERISTA: <p class="subtitulo_informacion"><?php echo "$tallerista_seleccionado"?></p> </p>
<p id="subtitulo">  TALLER: <p class="subtitulo_informacion"><?php echo "$taller_seleccionado"?></p> </p>
<p id="subtitulo">  CALENDARIO: <p class="subtitulo_informacion"> <?php echo "$calendario_seleccionado"?></p></p>
<p id="subtitulo">  TURNO: <p class="subtitulo_informacion"> <?php echo "$turno_seleccionado "?></p></p>
<p id="subtitulo">  DIA: <p class="subtitulo_informacion"> <?php echo " $dia_seleccionado" ?></p></p>
</div>


<script>
function validar(frm) {
  frm.buscar.disabled = true;
  //for (i=0; i<3; i++)
  if(frm['codigo'].value.length >=8){
    if (frm['codigo'].value ==''  ) return
  frm.buscar.disabled = false;
  }
}
</script>




<button type="button"  class="btn btn-primary" id="consultar" name ="consultar" data-toggle="modal" data-target="#suscribeModal"><img src="assets/img/consulta.png" alt="assets/img/consulta.png" >Consultar tus datos</button>
                   
                   


</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="assets/js/sweetalert.js"></script>

<!--Seccion del modal de la informacion de la persona-->

<!-- Modal -->
<div class="modal fade" id="suscribeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Información del estudiante</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="" method="POST">
        <div class="form-group">
          <!--onclick="buscar_ahora($('#codigo').val());"      onkeyup = "validar(this.form)"-->
        <input type="text" class="form-control" id="codigo" name="codigo" onkeyup = "validar(this.form)" autocomplete="off" autofocus placeholder="Escribe tu Codigo">
            <button type="button" class="btn btn-primary" id="buscar" name="buscar"  disabled>Buscar</button>   </div>
           
            <div id="datos_buscador">
         
          </div>
         
        </form>
      </div>
      </div>
  </div>
</div>
     



<?php
if(isset($_POST['inscribir'])){

 

  $codigo = $_POST['codigo'];

  $consulta_existencia = "SELECT * FROM personas WHERE codigo= '$codigo'";
  
  $usuario_repetido = "SELECT * FROM usuarios_talleres WHERE Codigo= '$codigo' AND Ingreso = '$calendario_seleccionado' AND 
  NombreTaller = '$taller_seleccionado' AND NombreTallerista = '$tallerista_seleccionado' AND Turno= '$turno_seleccionado' AND 
  Dia = '$dia_seleccionado'";
  
  $esta_registrado = mysqli_query($con,$usuario_repetido);

  $filas = mysqli_query($con,$consulta_existencia);
  
  if(mysqli_num_rows($esta_registrado)==0){
  
  if(mysqli_num_rows($filas)==0){
  
    echo '<script>alertaeNoti("No estás en el sistema")</script>';
  
  }else{

    
    $lugares_talleres = "SELECT * FROM mostrar_talleres WHERE Calendario = '$calendario_seleccionado' AND 
    NombreTaller = '$taller_seleccionado' AND NombreTallerista = '$tallerista_seleccionado' AND Turno= '$turno_seleccionado' AND 
    Dia = '$dia_seleccionado'";

$filas_talleres = mysqli_query($con,$lugares_talleres);

while($informacion_taller = mysqli_fetch_array($filas_talleres)){
  $registrados = $informacion_taller['Registrados'];
  $faltantes = $informacion_taller['Lugares_Faltantes'];
}

    while($informacion_persona = mysqli_fetch_array($filas)){

     $nombre = $informacion_persona['nombre'];

     $carrera = $informacion_persona['carrera'];

    }

    if($faltantes>=1){

    $conexion->query("INSERT INTO usuarios_talleres (Codigo,Nombre,Carrera,Nombretallerista,NombreTaller,Ingreso,Turno,Dia) values ('$codigo','$nombre','$carrera','$tallerista_seleccionado','$taller_seleccionado','$calendario_seleccionado','$turno_seleccionado','$dia_seleccionado')");

    if($conexion){

      $regitrado_mas = $registrados+1;
      $faltantes_menos = $faltantes-1;

      

      $conexion->query("UPDATE mostrar_talleres SET Registrados= $regitrado_mas, Lugares_Faltantes = $faltantes_menos WHERE Calendario = '$calendario_seleccionado' AND 
  NombreTaller = '$taller_seleccionado' AND NombreTallerista = '$tallerista_seleccionado' AND Turno= '$turno_seleccionado' AND 
  Dia = '$dia_seleccionado'");



    echo '<script>alertaNoti("Se ha inscrito con exito")</script>';
    }
  }else{
    echo '<script>alertaeNoti("Ya no hay lugares para este taller")</script>';
  }
  }
}else{
  echo '<script>alertaeNoti("Ya estas registrado en este Taller")</script>';
}
  



}

?>
     
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!--<script src="assets/js/onKeyup.js"></script>-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="assets/js/jquery-3.6.0.min.js"></script> 
<script src="assets/js/Buscar.js"></script>
</body>
</html>
<?php $con->close(); $conexion=null; ?>