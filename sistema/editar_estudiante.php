<?php

	session_start();
	if($_SESSION['rol'] != 1)
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

			$idEstudiante = $_POST['idEstudiante'];
      $nombre = $_POST['nombre'];
			$carnet  = $_POST['carnet'];
			$semestre   = $_POST['semestre'];
			$talla  = $_POST['talla'];
			$pago    = $_POST['pago'];
			$cantidad    = $_POST['cantidad'];


			$query = mysqli_query($conection,"SELECT * FROM estudiante
													   WHERE (carnet = '$carnet' AND idestudiante != $idEstudiante)");

			$result = mysqli_fetch_array($query);

			if($result > 0){
				$alert='<p class="msg_error">El carnet ya existe.</p>';
			}else{

				if(empty($_POST['carnet'])) // POSIBLE ERROR
				{

					$sql_update = mysqli_query($conection,"UPDATE estudiante
															SET nombre = '$nombre', carnet='$carnet',semestre='$semestre',talla='$talla',pago='$pago',cantidad='$cantidad'
															WHERE idestudiante= $idEstudiante ");
				}else{
					$sql_update = mysqli_query($conection,"UPDATE estudiante
															SET nombre = '$nombre', carnet='$carnet',semestre='$semestre',talla='$talla',pago='$pago',cantidad='$cantidad'
															WHERE idestudiante= $idEstudiante ");

				}

				if($sql_update){
					$alert='<p class="msg_save">Estudiate actualizado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar el Estudiante.</p>';
				}

			}


		}

	}

	//Mostrar Datos
	if(empty($_REQUEST['id']))
	{
		header('Location: lista_estudiante.php');
		mysqli_close($conection);
	}
	$idestudiante = $_REQUEST['id'];

	$sql= mysqli_query($conection,"SELECT u.idestudiante,u.nombre,u.carnet,u.semestre,u.talla,u.pago,u.cantidad
									FROM estudiante u
									WHERE idestudiante= $idestudiante ");
	mysqli_close($conection);
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header('Location: lista_estudiante.php');
	}else{
		$option = '';
		while ($data = mysqli_fetch_array($sql)) {
			# code...
			$idestudiante  = $data['idestudiante'];
			$nombre  = $data['nombre'];
			$carnet  = $data['carnet'];
			$semestre = $data['semestre'];
      $talla = $data['talla'];
			$pago    = $data['pago'];
      $cantidad    = $data['cantidad'];
		}
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>ACTUALIZAR - ESTUDIANTE</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">

		<div class="form_register">
			<br><br>
			<h1>Actualizar Estudiante</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

      <form action="" method="post">
				<input type="hidden" name="idEstudiante" value="<?php echo $idestudiante; ?>">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombres" value="<?php echo $nombre; ?>">
				<label for="carnet">Carnet</label>
				<input type="number" name="carnet" id="carnet" placeholder="Carnet" value="<?php echo $carnet; ?>">
				<label for="semestre">Semestre</label>
				<select name="semestre" id="semestre" value="<?php echo $semestre; ?>">
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
				</select>
        <label for="cantidad">Cantidad</label>
        <input type="number" name="cantidad" id="cantidad" placeholder="Cantidad" value="<?php echo $cantidad; ?>">
        <input type="submit" value="Actualizar Estudiante" class="btn_save">

			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>
