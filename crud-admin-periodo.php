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
    <title>Lista Periodo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script type="text/javascript" src="Scripts/code.jquery.com_jquery-3.7.0.min.js"></script>
</head>
<body>
    <div class="container my-9" id="Exportar">

        <form method="GET   ">
            <input type="text" class="form-control me-2" id="getData" placeholder="Buscar periodo" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>">
            <button class="btn btn-dark btn-sm"> Buscar</button>
        </form>
        <h2>Lista periodos</h2>  
        <a class="btn btn-primary" role="button" href="crud-admin-periodo-crear.php" name="sumbit">Nuevo periodo</a>
        <a class="btn btn-info" role="button" href="administrador.php" name="sumbit">Regresar</a> 
        <br>    <br>     
        <table class="table">
            <thead>
                <tr>
                    <th>Id del periodo</th>
                    <th>Nombre del periodo</th>
                    <th>Fecha inicio del periodo</th>
                    <th>Fecha fin del periodo</th>
                    <th>Estado</th>
                </tr>
            </thead>

            <tbody id="showdata">
            <?php
            require "php/conexion.php";

            if (isset($_GET['search'])){    
                $filtervalues=$_GET['search'];
                $query = "SELECT * FROM periodo WHERE CONCAT(ID_peri,nomb_peri,estado_peri) LIKE '%$filtervalues%'";
                $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
            
                    foreach ($result as $row){
                    echo"
                    <tr>
                        <td>$row[ID_peri]</td>
                        <td>$row[nomb_peri]</td>
                        <td>$row[fech_ini_peri]</td>
                        <td>$row[fech_fin_peri]</td>
                        <td>$row[estado_peri]</td>
                        <td>
                        <a class='btn btn-primary btn-sm' href='crud-admin-periodo-editar.php?editarid=$row[ID_peri]'
                        >Editar</a>
                        <a class='btn btn-danger btn-sm' href='php/eliminar-periodo.php?deleteid=$row[ID_peri]' onclick='return checkdelete();'>Finalizado</a>
                        </td>
                    </tr>
                    ";}
            }
            else{

            $query = "SELECT * FROM periodo WHERE estado_peri!='Finalizado'";
            $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);

            foreach ($result as $row){
                echo"
                    <tr>
                        <td>$row[ID_peri]</td>
                        <td>$row[nomb_peri]</td>
                        <td>$row[fech_ini_peri]</td>
                        <td>$row[fech_fin_peri]</td>
                        <td>$row[estado_peri]</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='crud-admin-periodo-editar.php?editarid=$row[ID_peri]'
                            >Editar</a>
                            <a class='btn btn-danger btn-sm' href='php/eliminar-periodo.php?deleteid=$row[ID_peri]' onclick='return checkdelete();'>Finalizado</a>
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
        return confirm('¿Estas seguro deseas finalizar este periodo?');
    }
    </script>
</html>