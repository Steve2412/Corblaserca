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
    <title>Lista Cursos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script type="text/javascript" src="Scripts/code.jquery.com_jquery-3.7.0.min.js"></script>
</head>
<body>
    <div class="container my-9">
        <form method="GET   ">
            <input type="text" class="form-control me-2" id="getData" placeholder="Buscar curso" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>">
            <button class="btn btn-dark btn-sm"> Buscar</button>
        </form>
        <h2>Lista Cursos</h2>  
        <a class="btn btn-primary" role="button" href="crud-admin-cursos-crear.php" name="sumbit">Nuevo Curso</a>
        <a class="btn btn-info" role="button" href="administrador.php" name="sumbit">Regresar</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Horas</th>
                    <th>Precio</th>
                    <th>Cupo mínimo</th>
                    <th>Cupo máximo</th>
                </tr>
            </thead>

            <tbody id="showdata">
            <?php
            require "php/conexion.php";

            if (isset($_GET['search'])){

                

                $filtervalues=$_GET['search'];
                $query = "SELECT * FROM cursos WHERE CONCAT(ID_cur,nomb_cur,estado_cur) LIKE '%$filtervalues%'";
                $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
            
                    foreach ($result as $row){
                    echo"
                    <tr>
                        <td>$row[ID_cur]</td>
                        <td>$row[nomb_cur]</td>
                        <td>$row[horar_cur]</td>
                        <td>$row[prec_cur]</td>
                        <td>$row[cupos_cur_min]</td>
                        <td>$row[cupos_cur_max]</td>
                        <td>
                        <a class='btn btn-primary btn-sm' href='crud-admin-cursos-editar.php?editarid=$row[ID_cur]'>Editar</a><br>
                        <a class='btn btn-danger btn-sm' href='php/eliminar-curso.php?deleteid=$row[ID_cur]' onclick='return checkdelete();'>Eliminar</a>
                        <form action='php/exportar-crud-alumnos.php?exportarid=$row[ID_cur]' method='post' class='mb-2'>
                        <input type='submit' name='submit' class='btn btn-outline-danger' value='Lista usuarios'>
                        </td>
                    </tr>
                    ";}
            }
            else{
            $query = "SELECT * FROM cursos WHERE estado_cur='Activo'";
            $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);

            foreach ($result as $row){
                echo"
                    <tr>
                        <td>$row[ID_cur]</td>
                        <td>$row[nomb_cur]</td>
                        <td>$row[horar_cur]</td>
                        <td>$row[prec_cur]</td>
                        <td>$row[cupos_cur_min]</td>
                        <td>$row[cupos_cur_max]</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='crud-admin-cursos-editar.php?editarid=$row[ID_cur]'>Editar</a><br>
                            <a class='btn btn-danger btn-sm' href='php/eliminar-curso.php?deleteid=$row[ID_cur]' onclick='return checkdelete();'>Eliminar</a>
                            <form action='php/exportar-crud-alumnos.php?exportarid=$row[ID_cur]' method='post' class='mb-2'>
                            <input type='submit' name='submit' class='btn btn-outline-danger' value='Lista usuarios'>
                        </form>
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
        return confirm('¿Estas seguro deseas borrar este curso?');
    }
    </script>
</html>