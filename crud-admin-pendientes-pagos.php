<?php
require "php/conexion.php";
session_start();
if(!isset($_SESSION['usuario'])){
  echo '<script language="javascript">
  window.location = "index.html"
  </script>';
  die();
  session_destroy(); 
}
$usuario = $_SESSION['usuario'];
$query = "SELECT * FROM usuario_has_cursos WHERE Usuario_ID_user = '$usuario'"; 
$result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
foreach ($result as $row){
    $Rol_usuario = $row['Usuario_rol'];

}
if($Rol_usuario=="Profesor"||$Rol_usuario=="Estudiante"){
  echo "<script> location.href='home.php' </script>";

} 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagos Pendientes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script type="text/javascript" src="Scripts/code.jquery.com_jquery-3.7.0.min.js"></script>
</head>
<body>
    <div class="container my-9" id="Exportar">

        <form method="GET   ">
            <input type="text" class="form-control me-2" id="getData" placeholder="Buscar usuario" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>">
            <button class="btn btn-dark btn-sm"> Buscar</button>
        </form>
        <h2>Lista Pagos pendientes</h2>  
        <a class="btn btn-info" role="button" href="administrador.php" name="sumbit">Regresar</a> 
        <br>    <br>     
        <table class="table">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Banco</th>
                    <th>Titular de la cuenta</th>
                    <th>Fecha del pago</th>
                    <th>Referencia</th>
                    <th>Monto del pago</th>
                    <th>Motivo</th>
                    <th>Estado</th>
                </tr>
            </thead>

            <tbody id="showdata">
            <?php
            require "php/conexion.php";

            if (isset($_GET['search'])){    
                $filtervalues=$_GET['search'];
                $query = "SELECT * FROM notifipago WHERE CONCAT(referencia_notifipago,usuario_notifipago) LIKE '%$filtervalues%' AND estado_notifipago='Pendiente'";
                $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
            
                    foreach ($result as $row){
                    echo"
                    <tr>
                        <td>$row[usuario_notifipago]</td>
                        <td>$row[banco_notifipago]</td>
                        <td>$row[cedu_titular_notifipago]</td>
                        <td>$row[fecha_notifipago]</td>
                        <td>$row[referencia_notifipago]</td>
                        <td>$row[monto_notifipago]</td>
                        <td>$row[motivo_notifipago]</td>
                        <td>$row[estado_notifipago]</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='crud-admin-usuario-editar.php?editarid=$row[id_notifipago]'>Editar</a>
                            <a class='btn btn-danger btn-sm' href='php/rechazar-pago.php?deleteid=$row[id_notifipago]' onclick='return checkdelete();'>Eliminar</a>
                        </td>
                    </tr>
                    ";}
            }
            else{

            $query = "SELECT * FROM notifipago WHERE estado_notifipago='Pendiente'";
            $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);

            foreach ($result as $row){
                echo"
                    <tr>
                        <td>$row[usuario_notifipago]</td>
                        <td>$row[banco_notifipago]</td>
                        <td>$row[cedu_titular_notifipago]</td>
                        <td>$row[fecha_notifipago]</td>
                        <td>$row[referencia_notifipago]</td>
                        <td>$row[monto_notifipago]</td>
                        <td>$row[motivo_notifipago]</td>
                        <td>$row[estado_notifipago]</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='php/aceptar-pago.php?editarid=$row[id_notifipago]' onclick='return aceptar();'>Aceptar</a>
                            <a class='btn btn-danger btn-sm' href='php/rechazar-pago.php?deleteid=$row[id_notifipago]' onclick='return checkdelete();'>Rechazar</a>
                        </td>
                    </tr>
                ";
            }

        }

            ?>
            </tbody>

        </table>

    </div>
    
</body>

    <script>
    function checkdelete(){
        return confirm('¿Estas seguro deseas rechazar este pago?');
    }

    function aceptar(){
        return confirm('¿Estas seguro deseas aceptar este pago?');
    }
    </script>
</html>