<?php
	require_once __DIR__ . '/../php/sesion.php';
	require __DIR__ . '/../php/conexion.php';
	require_once __DIR__ . '/../php/seguridad.php';
	requerir_rol($conectar, ['Administrador']);

	//include our function
	include 'function.php';

	if(isset($_POST['restore'])){
		
		//get post data
		$server = $_POST['server'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$dbname = $_POST['dbname'];

		// Solo se aceptan archivos .sql, y se leen desde la carpeta temporal de PHP
		// (nunca se copian a una carpeta pública donde podrían ejecutarse)
		$filename = $_FILES['sql']['name'];
		if(strtolower(pathinfo($filename, PATHINFO_EXTENSION)) !== 'sql' || !is_uploaded_file($_FILES['sql']['tmp_name'])){
			$_SESSION['error'] = 'Solo se permiten archivos .sql';
			header('location:index.php');
			exit;
		}
		$file_location = $_FILES['sql']['tmp_name'];

		//restore database using our function
		$restore = restore($server, $username, $password, $dbname, $file_location);

		if($restore['error']){
			$_SESSION['error'] = $restore['message'];
		}
		else{
			$_SESSION['success'] = $restore['message'];
		}

	}
	else{
		$_SESSION['error'] = 'Rellena todos los datos primero';
	}

	header('location:index.php');

?>