<?php
	session_start();
	if($_SESSION['rol'] != 1)
	{
		header("location: ./");
	}
	include "../conexion.php";

	if(!empty($_POST))
	{
		if($_POST['idestudiante'] == 1){
			header("location: lista_estudiante.php");
			mysqli_close($conection);
			exit;
		}
		$idestudiante = $_POST['idestudiante'];

		//$query_delete = mysqli_query($conection,"DELETE FROM usuario WHERE idusuario =$idusuario ");
		$query_delete = mysqli_query($conection,"UPDATE estudiante SET estatus = 0 WHERE idestudiante = $idestudiante ");
		mysqli_close($conection);
		if($query_delete){
			header("location: lista_estudiante.php");
		}else{
			echo "Error al eliminar estudiante";
		}

	}




	if(empty($_REQUEST['id']) || $_REQUEST['id'] == 1 )
	{
		header("location: lista_estudiante.php");
		mysqli_close($conection);
	}else{

		$idestudiante = $_REQUEST['id'];

		$query = mysqli_query($conection,"SELECT u.nombre,u.carnet,u.pago
												FROM estudiante u
												WHERE u.idestudiante = $idestudiante ");

		mysqli_close($conection);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
				# code...
				$nombre = $data['nombre'];
				$carnet = $data['carnet'];
				$pago     = $data['pago'];
			}
		}else{
			header("location: lista_estudiante.php");
		}


	}


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Eliminar Estudiante</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
		<section id="container">
			<div class="data_delete">
				<br><br><br>
				<div class="centro">
					<br>
						<h2>¿Está seguro de eliminar el siguiente registro?</h2>
						<p>Nombre: <span><?php echo $nombre; ?></span></p>
						<p>Carnet: <span><?php echo $carnet; ?></span></p>

						<form method="post" action="">
							<input type="hidden" name="idestudiante" value="<?php echo $idestudiante; ?>">
							<a href="lista_estudiante.php" class="btn_cancel">Cancelar</a>
							<input type="submit" value="Aceptar" class="btn_ok">
						</form>
				</div>
			</div>
		</section>


	<?php include "includes/footer.php"; ?>
</body>
</html>
