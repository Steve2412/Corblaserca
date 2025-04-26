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
    <title>Lista Usuarios en cursos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script type="text/javascript" src="Scripts/code.jquery.com_jquery-3.7.0.min.js"></script>
</head>
<body>
    <div class="container my-9">
        <form method="GET   ">
            <input type="text" class="form-control me-2" id="getData" placeholder="Buscar estudiante" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>">
            <button class="btn btn-dark btn-sm"> Buscar</button>
        </form>
        <h2>Lista Estudiantes en cursos</h2>  
        <a class="btn btn-primary" role="button" href="crud-admin-usuario-tiene-cursos-crear.php" name="sumbit">Nuevo usuario en el curso</a>
        <a class="btn btn-info" role="button" href="administrador.php" name="sumbit">Regresar</a>

        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Cédula usuario</th>
                    <th>ID Curso</th>
                    <th>ID Periodo</th>
                    <th>Calificación</th>
                    <th>Rol</th>
                    <th>Estado</th>
                </tr>
            </thead>

            <tbody id="showdata">
            <?php
            require "php/conexion.php";

            if (isset($_GET['search'])){

                

                $filtervalues=$_GET['search'];
                $query = "SELECT * FROM usuario_has_cursos WHERE CONCAT(Usuario_ID_user ,Cursos_ID_cur,estado_usuario_has_cursos) LIKE '%$filtervalues%' AND Usuario_rol!='Administrador'";
                $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
            
                    foreach ($result as $row){
                    echo"
                    <tr>
                        <td>$row[Usuario_ID_user]</td>
                        <td>$row[Cursos_ID_cur]</td>
                        <td>$row[Periodo_ID_peri]</td>
                        <td>$row[calificacion_user]</td>
                        <td>$row[Usuario_rol]</td>
                        <td>$row[estado_usuario_has_cursos]</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='crud-admin-usuario-tiene-cursos-editar.php?editarid=$row[Usuario_ID_user]'>Editar</a>
                            <a class='btn btn-danger btn-sm' href='php/eliminar-usuario-curso.php?deleteid=$row[Usuario_ID_user]' onclick='return checkdelete();'>Eliminar</a>
                        </td>
                    </tr>
                    ";}
            }
            else{
            $query = "SELECT * FROM usuario_has_cursos WHERE Usuario_rol!='Administrador' AND estado_usuario_has_cursos!='Finalizado'";
            $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);

            foreach ($result as $row){
                echo"
                    <tr>
                        <td>$row[Usuario_ID_user]</td>
                        <td>$row[Cursos_ID_cur]</td>
                        <td>$row[Periodo_ID_peri]</td>
                        <td>$row[calificacion_user]</td>
                        <td>$row[Usuario_rol]</td>
                        <td>$row[estado_usuario_has_cursos]</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='crud-admin-usuario-tiene-cursos-editar.php?editarid=$row[Usuario_ID_user]'
                            >Editar</a>
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