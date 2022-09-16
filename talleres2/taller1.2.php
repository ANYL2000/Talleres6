<?php
require_once 'assets/conexion/servidor.php';

$tallerista_seleccionado = $_GET['tallerista'];
 $taller_seleccionado = $_GET["taller"];
 $calendario_seleccionado = $_GET['calendario'];
 $turno_seleccionado = $_GET['turno'];
$dia_seleccionado = $_GET['dia'];

//print_r($taller_seleccionado);
$con = connect($host, $port, $db_name, $db_username, $db_password);
$conexion = mysqli_connect($host, $db_username, $db_password,$db_name );
//$query =$conexion->prepare("SELECT * FROM usuarios_talleres WHERE Ingreso = '$calendario_seleccionado' AND NombreTaller = '$taller_seleccionado' AND Dia = '$dia_seleccionado' AND Turno = '$turno_seleccionado';");



$sql = "SELECT * FROM usuarios_talleres WHERE Ingreso = '$calendario_seleccionado' AND NombreTaller = '$taller_seleccionado' AND Dia = '$dia_seleccionado' AND Turno = '$turno_seleccionado';";

$result = mysqli_query($conexion,$sql);

//$query->execute();
//$resultado =$query->fetchAll();

//echo "<script> console.log('$taller_seleccionado') </script>";

?>
<!DOCTYPE html>
<html lang="en">
<head>

<header>
    <title>Talleres</title>
</header>

<div class="titulo_pagina"><h1 class="titulo">TALLERES</h1></div>
<link rel="stylesheet" href="assets/css/estilo_taller1.2.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    


<div class="fondo">

<h1 class="titulo_taller">Alumnos registrados</h1>
<div class="taller_informacion">
<p id="subtitulo"> TALLERISTA: <p><?php echo "$tallerista_seleccionado"?></p> </p>
<p id="subtitulo">  TALLER: <p><?php echo "$taller_seleccionado"?></p> </p>
<p id="subtitulo">  CALENDARIO: <p> <?php echo "$calendario_seleccionado"?></p></p>
<p id="subtitulo">  TURNO: <p> <?php echo "$turno_seleccionado "?></p></p>
<p id="subtitulo">  DIA: <p> <?php echo " $dia_seleccionado" ?></p></p>
</div>


<table class="table-responsive">
    <thead>
<tr class="fila_principal">
    <td>Codigo</td>
    <td>Nombre Completo</td>
    <td>Carrera</td>
    <td>Calendario</td>
    <td>NombreTaller</td>
    <td>Dia</td>
    <td>Turno</td>
</tr>
</thead>

<tbody>


<?php  
while($fila = mysqli_fetch_array($result)){ 
//foreach($resultado as $taller):  
 //$id = $fila['Codigo'];


?>

<tr class="filas_secundarias" id="color_gris" >
    <td><?php echo $fila['Codigo']; ?></td>
    <td><?php echo $fila['Nombre']; ?></td>
    <td><?php echo $fila['Carrera']; ?></td>
    <td><?php echo $fila['Ingreso']; ?></td>
    <td><?php echo $fila['NombreTaller']; ?></td>
    <td><?php echo $fila['Turno']; ?></td>
    <td><?php echo $fila['Dia']; ?></td>
  <td><button type='submit' class='boton_editar' id='abrir_editar' name='abrir_editar' data-toggle='modal' data-target="#editModal<?php echo $fila['idUsuarios']; ?>">Editar</button></td>
<td><button type='submit' class='boton_borrar' data-toggle='modal' data-target="#deleteModal<?php echo $fila['idUsuarios']; ?>">Eliminar</button></td>
</tr>

</tbody>
<!--Seccion del modal de la informacion de la persona-->

<!-- Modal Editar-->
<div class="modal fade" id="editModal<?php echo $fila['idUsuarios']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar información</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
        <!--<div class="form-group">
            <label for="recipient-name" class="col-form-label">Codigo:</label>
          
            <input type="text" class="form-control" id="recipient_codigo" name="recipient_codigo" value="<?php echo $fila["Codigo"]; ?>" required autocomplete="off">
          </div>   data-dismiss="modal"-->
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nombre Completo:</label>
            <input type="text" class="form-control" id="recipient_id" name="recipient_id" value="<?php echo $fila["idUsuarios"]; ?>" hidden="true" autocomplete="off">
            <input type="text" class="form-control" id="recipient_nombre"  name = "recipient_nombre" value="<?php echo $fila["Nombre"]; ?>" required autocomplete="off">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Carrera:</label>
            <input type="text" class="form-control" id="recipient_carrera" name="recipient_carrera" value="<?php echo $fila["Carrera"]; ?>" required autocomplete="off">
          </div>

          <div class="modal-footer"> 
        <button type="submit" class="btn btn-secondary"  >Cerrar</button>
        <button type="submit" class="btn btn-primary" id="btneditar" name="btneditar">Guardar cambios</button>
      </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

<!--Seccion del modal de la informacion de la persona-->

<!-- Modal Borrar-->
<div class="modal fade" id="deleteModal<?php echo $fila['idUsuarios'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Desea eliminar a: </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="borrar_usuario.php?id=<?php echo $fila['idUsuarios'] ?>&tallerista=<?php echo $fila['NombreTallerista'] ?>&taller=<?php echo $fila['NombreTaller'] ?>&calendario=<?php echo $fila['Ingreso'] ?>&turno=<?php echo $fila['Turno'] ?>&dia=<?php echo $fila['Dia'] ?>" method="POST">
        <div class="form-group">
            <label for="recipient-name" class="col-form-label"><?php echo $fila["Nombre"] ?></label>
      
          </div>
       
          <div class="modal-footer">
        <button type="submit" class="btn btn-secondary"  data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger" id="eliminar" name="eliminar">Eliminar</button>
      </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

 <?php
//include ("modal_editar.php");
?>
<?php
//include ("modal_eliminar.php");
?>

<?php



}
?>


</table>

<button class="btn_imprimir"><i class="fa fa-print fa-2x fa-lg" ></i><p>Imprimir lista</p></button>

<?php 
        //if(isset($_POST['abrir_editar'])){
       // print_r("abrir modal editar = $id");
    
          ?>
<!--editar_usuario.php?id=<?php// echo $fila['idUsuarios'] ?>&tallerista=<?php //echo $fila['NombreTallerista'] ?>&taller=<?php //echo $fila['NombreTaller'] ?>&calendario=<?php //echo $fila['Ingreso'] ?>&turno=<?php //echo $fila['Turno'] ?>&dia=<?php //echo $fila['Dia'] ?>&codnuevo=<?php //echo $fila['Codigo'] ?>-->
         
<?php
if(isset($_POST['btneditar'])){

    $id = $_POST['recipient_id'];
    $nombrenuevo = $_POST['recipient_nombre'];
    $carreranuevo = $_POST['recipient_carrera'];


    $conexion->query("UPDATE usuarios_talleres SET Nombre = '$nombrenuevo', Carrera= '$carreranuevo' WHERE idUsuarios= $id AND NombreTallerista = '$tallerista_seleccionado' AND 
    NombreTaller = '$taller_seleccionado' AND Ingreso = '$calendario_seleccionado'  AND Turno= '$turno_seleccionado' AND 
    Dia = '$dia_seleccionado'");

//$result_update = mysqli_query($conexion,$update_usuario);

if($conexion){
    echo "<script type='text/javascript'>
    window.location='taller1.2.php?tallerista=$tallerista_seleccionado&taller=$taller_seleccionado&calendario=$calendario_seleccionado&turno=$turno_seleccionado&dia=$dia_seleccionado'
    </script>";
}else{
    echo '<script>alertaeNoti("No se pudo actualizar la informacion")</script>';
}
    
    //header("Refresh:1");
         
        }

?>



</div>
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</body>
</html>
<?php  $conexion=null; ?>