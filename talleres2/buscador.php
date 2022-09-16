<?php
include('assets/conexion/servidor.php');

$mysqli = new mysqli("localhost","root","","Talleres");

$cod = $_POST["buscar"];

$buscador = "SELECT * FROM personas WHERE codigo = '$cod'";
$resultado = $mysqli->query($buscador);


$salida= "";
if($resultado->num_rows > 0 ){
?>

<?php while($fila = $resultado->fetch_assoc() ){ 

  $salida.=  "
                <div class='form-group'>
            <label for='recipient-name' class='col-form-label'>Nombre Completo:</label>
            <p style='font-size: x-large; font-weight: bold'>".$fila['nombre']."</p>
          </div>
          <div class='form-group'>
            <label for='recipient-name' class='col-form-label'>Carrera:</label>
            <p style='font-size: x-large; font-weight: bold'>".$fila['carrera']."<p>
            
          </div> 
          <div class='modal-footer'>
          <button type='submit' class='btn btn-secondary'  >Cerrar</button>
          <button type='submit' class='btn btn-success' id='inscribir' name='inscribir'>Inscribirse</button>
        </div>
          ";


   }
   //data-dismiss='modal'
   //<input type='text' class='form-control' id='recipient_nombre' name='recipient_nombre' value=".$fila['nombre']." disabled>
   //<input type='text' class='form-control' id='recipient-carrera' value=".$fila['carrera']." disabled>


}else{
    $salida.="No hay datos";
    } 

    echo $salida;
    
    ?>