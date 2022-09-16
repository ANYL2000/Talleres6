<?php
require_once 'assets/conexion/servidor.php';
$conexion = connect($host, $port, $db_name, $db_username, $db_password);
$query =$conexion->prepare("SELECT idTalleres,NombreTallerista,NombreTaller, Calendario, Capacidad, Turno, Tipo,Dia,Registrados,Lugares_Faltantes
FROM mostrar_talleres;");

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
<link rel="stylesheet" href="assets/css/estilo_taller1.1.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
    


<div class="fondo">

<h1 class="titulo_taller">Talleres registrados</h1>

<table class="table-responsive">
    <thead>
<tr class="fila_principal">
    <td>Nombre del taller</td>
    <td>Calendario</td>
    <td>Capacidad</td>
    <td>Turno</td>
    <td>Tipo</td>
    <td>Dia</td>
    <td>Registrados</td>
    <td>Faltantes</td>
</tr>
</thead>
<?php  foreach($resultado as $taller):  ?>

    <!--taller1.2.php?idtaller='<?php //echo $taller['NombreTaller']?>'-->

<tr class="filas_secundarias" id="color_gris" >
    <td> <a href="taller1.2.php?tallerista=<?php echo $taller['NombreTallerista']?>&taller=<?php echo $taller['NombreTaller']?>&calendario=<?php echo $taller['Calendario']?>&turno=<?php echo $taller['Turno']?>&dia=<?php echo $taller['Dia']?>"> <?php echo $taller['NombreTaller']?> </a></td>
    <td> <a href="taller1.2.php?tallerista=<?php echo $taller['NombreTallerista']?>&taller=<?php echo $taller['NombreTaller']?>&calendario=<?php echo $taller['Calendario']?>&turno=<?php echo $taller['Turno']?>&dia=<?php echo $taller['Dia']?>"> <?php echo $taller['Calendario']?></a></td>
    <td><a href="taller1.2.php?tallerista=<?php echo $taller['NombreTallerista']?>&taller=<?php echo $taller['NombreTaller']?>&calendario=<?php echo $taller['Calendario']?>&turno=<?php echo $taller['Turno']?>&dia=<?php echo $taller['Dia']?>"><?php echo $taller['Capacidad']?></a></td>
    <td><a href="taller1.2.php?tallerista=<?php echo $taller['NombreTallerista']?>&taller=<?php echo $taller['NombreTaller']?>&calendario=<?php echo $taller['Calendario']?>&turno=<?php echo $taller['Turno']?>&dia=<?php echo $taller['Dia']?>"><?php echo $taller['Turno']?></a></td>
    <td><a href="taller1.2.php?tallerista=<?php echo $taller['NombreTallerista']?>&taller=<?php echo $taller['NombreTaller']?>&calendario=<?php echo $taller['Calendario']?>&turno=<?php echo $taller['Turno']?>&dia=<?php echo $taller['Dia']?>"><?php echo $taller['Tipo']?></a></td>
    <td><a href="taller1.2.php?tallerista=<?php echo $taller['NombreTallerista']?>&taller=<?php echo $taller['NombreTaller']?>&calendario=<?php echo $taller['Calendario']?>&turno=<?php echo $taller['Turno']?>&dia=<?php echo $taller['Dia']?>"><?php echo $taller['Dia']?></a></td>
    <td><a href="taller1.2.php?tallerista=<?php echo $taller['NombreTallerista']?>&taller=<?php echo $taller['NombreTaller']?>&calendario=<?php echo $taller['Calendario']?>&turno=<?php echo $taller['Turno']?>&dia=<?php echo $taller['Dia']?>"><?php echo $taller['Registrados']?></a></td>
    <td><a href="taller1.2.php?tallerista=<?php echo $taller['NombreTallerista']?>&taller=<?php echo $taller['NombreTaller']?>&calendario=<?php echo $taller['Calendario']?>&turno=<?php echo $taller['Turno']?>&dia=<?php echo $taller['Dia']?>"><?php echo $taller['Lugares_Faltantes']?></a></td>
</tr>
</a>

<?php   endforeach; ?>

</table>

</div>

<script src="assets/js/jquery-3.6.0.min.js"></script>

</body>
</html>
<?php $conexion = null;?>