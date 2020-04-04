<?php
	session_start();
	if($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2)
	{
		header("location: ./");
	}

	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['nombre']) || empty($_POST['carnet']) || empty($_POST['semestre']) || empty($_POST['talla']) || empty($_POST['pago']) || empty($_POST['cantidad']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$nombre = $_POST['nombre'];
			$carnet  = $_POST['carnet'];
			$semestre   = $_POST['semestre'];
			$talla  = $_POST['talla'];
			$pago    = $_POST['pago'];
			$cantidad    = $_POST['cantidad'];


			$query = mysqli_query($conection,"SELECT * FROM estudiante WHERE carnet = '$carnet'");
			$result = mysqli_fetch_array($query);

			if($result > 0){
				$alert='<p class="msg_error">El correo o el usuario ya existe.</p>';
			}else{

				$query_insert = mysqli_query($conection,"INSERT INTO estudiante(nombre,carnet,semestre,talla,pago,cantidad)
																	VALUES('$nombre','$carnet','$semestre','$talla','$pago','$cantidad')");
				if($query_insert){
					$alert='<p class="msg_save">Estudiante registrado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al registrar al estudiante.</p>';
				}

			}


		}

	}



 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>REGISTRO - ESTUDIANTES</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">

		<div class="form_register">
			<br><br>
			<h1>Registro Estudiantes</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" placeholder="Nombre completo">
        <label for="carnet">Numero de Carnet</label>
        <input type="number" name="carnet" id="carnet" placeholder="Numero de carnet">
        <label for="semestre">Semestre</label>
        <select name="semestre" id="semestre" placeholder="Semestre">
          <option>2do</option>
          <option>4to</option>
          <option>6to</option>
          <option>8vo</option>
          <option>10mo</option>
        </select>
        <label for="talla">Talla Playera</label>
				<select name="talla" id="talla" placeholder="Talla Camisa">
          <option>Talla S</option>
          <option>Talla M</option>
          <option>Talla L</option>
          <option>Talla XL</option>
          <option>Talla XXL</option>
        </select>
				<label for="pago">Tipo Pago</label>
				<select name="pago" id="pago" placeholder="Tipo del pago">
          <option>Anticipo</option>
          <option>Cancelado</option>
        </select>
				<label for="cantidad">Cantidad del Pago</label>
        <input type="number" name="cantidad" id="cantidad" placeholder="Cantidad Pago">
				<input type="submit" value="Crear Estudiante" class="btn_save">

			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>
