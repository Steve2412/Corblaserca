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
    <title>Lista Usuarios</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script type="text/javascript" src="Scripts/code.jquery.com_jquery-3.7.0.min.js"></script>
</head>
<body>
    <div class="container my-9" id="Exportar">

        <form method="GET   ">
            <input type="text" class="form-control me-2" id="getData" placeholder="Buscar usuario" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>">
            <button class="btn btn-dark btn-sm"> Buscar</button>
        </form>
        <h2>Lista usuarios</h2>  
        <a class="btn btn-primary" role="button" href="crud-admin-usuario-crear.php" name="sumbit">Nuevo usuario</a>
        <a class="btn btn-info" role="button" href="administrador.php" name="sumbit">Regresar</a> 
        <br>    <br>     
        <form action="php/exportar-usuarios.php" method="post" class="mb-2">
            <input type="submit" name="submit" class="btn btn-outline-danger" value="Exportar PDF lista completa">
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Dirección</th>
                    <th>Telefono</th>
                    <th>Fecha Nacimiento</th>
                    <th>Genero</th>
                    <th>Estado</th>
                </tr>
            </thead>

            <tbody id="showdata">
            <?php
            require "php/conexion.php";

            if (isset($_GET['search'])){    
                $filtervalues=$_GET['search'];
                $query = "SELECT * FROM usuario WHERE CONCAT(cedu_user,nomb_user,apelli_user,estado_user) LIKE '%$filtervalues%'";
                $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
            
                    foreach ($result as $row){
                    echo"
                    <tr>
                        <td>$row[cedu_user]</td>
                        <td>$row[nomb_user]</td>
                        <td>$row[apelli_user]</td>
                        <td>$row[correo_user]</td>
                        <td>$row[dirre_user]</td>
                        <td>$row[numer_user]</td>
                        <td>$row[fech_naci_user]</td>
                        <td>$row[sexo_user]</td>
                        <td>$row[estado_user]</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='crud-admin-usuario-editar.php?editarid=$row[cedu_user]'>Editar</a>
                            <a class='btn btn-danger btn-sm' href='php/eliminar.php?deleteid=$row[cedu_user]' onclick='return checkdelete();'>Eliminar</a>
                        </td>
                    </tr>
                    ";}
            }
            else{

            $query = "SELECT * FROM usuario WHERE estado_user!='Eliminado'";
            $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);

            foreach ($result as $row){
                echo"
                    <tr>
                        <td>$row[cedu_user]</td>
                        <td>$row[nomb_user]</td>
                        <td>$row[apelli_user]</td>
                        <td>$row[correo_user]</td>
                        <td>$row[dirre_user]</td>
                        <td>$row[numer_user]</td>
                        <td>$row[fech_naci_user]</td>
                        <td>$row[sexo_user]</td>
                        <td>$row[estado_user]</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='crud-admin-usuario-editar.php?editarid=$row[cedu_user]'
                            >Editar</a>
                            <a class='btn btn-danger btn-sm' href='php/eliminar.php?deleteid=$row[cedu_user]' onclick='return checkdelete();'>Eliminar</a>
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
        return confirm('¿Estas seguro deseas borrar este usuario?');
    }
    </script>
</html>