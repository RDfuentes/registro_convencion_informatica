<?php
	session_start();
	if($_SESSION['rol'] != 1)
	{
		header("location: ./");
	}

	include "../conexion.php";

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>LISTA - ESTUDIANTES</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<br>
		<h1>Lista de Estudiantes</h1>
		<a href="registro_estudiante.php" class="btn_new">Nuevo Estudiante</a>

		<form action="buscar_estudiante.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
			<input type="submit" value="Buscar" class="btn_search">
		</form>

		<table>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Carnet</th>
				<th>Semestre</th>
				<th>Talla_Playera</th>
        <th>Tipo_Pago</th>
				<th>Cantidad_Pago</th>
				<th>Acciones</th>
			</tr>
		<?php
			//Paginador
			$sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM estudiante WHERE estatus = 1 ");
			$result_register = mysqli_fetch_array($sql_registe);
			$total_registro = $result_register['total_registro'];

			$por_pagina = 7;

			if(empty($_GET['pagina']))
			{
				$pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}

			$desde = ($pagina-1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);

			$query = mysqli_query($conection,"SELECT u.idestudiante, u.nombre, u.carnet, u.semestre, u.talla, u.pago, u.cantidad FROM estudiante u ORDER BY u.idestudiante ASC LIMIT $desde,$por_pagina
				");

			mysqli_close($conection);

			$result = mysqli_num_rows($query);
			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {

			?>
				<tr>
					<td><?php echo $data["idestudiante"]; ?></td>
					<td><?php echo $data["nombre"]; ?></td>
					<td><?php echo $data["carnet"]; ?></td>
					<td><?php echo $data["semestre"]; ?></td>
					<td><?php echo $data['talla']; ?></td>
          <td><?php echo $data['pago']; ?></td>
					<td><?php echo $data['cantidad']; ?></td>
					<td>
						<a class="link_edit" href="editar_estudiante.php?id=<?php echo $data["idestudiante"]; ?>">Editar</a>

						<?php if($data["idestudiante"] != 1){ ?>
							|
							<a class="link_delete" href="eliminar_confirmar_estudiante.php?id=<?php echo $data["idestudiante"]; ?>">Eliminar</a>
						<?php } ?>

					</td>
				</tr>

		<?php
				}

			}
		 ?>


		</table>
		<div class="paginador">
			<ul>
			<?php
				if($pagina != 1)
				{
			 ?>
				<li><a href="?pagina=<?php echo 1; ?>">|<</a></li>
				<li><a href="?pagina=<?php echo $pagina-1; ?>"><<</a></li>
			<?php
				}
				for ($i=1; $i <= $total_paginas; $i++) {
					# code...
					if($i == $pagina)
					{
						echo '<li class="pageSelected">'.$i.'</li>';
					}else{
						echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
					}
				}

				if($pagina != $total_paginas)
				{
			 ?>
				<li><a href="?pagina=<?php echo $pagina + 1; ?>">>></a></li>
				<li><a href="?pagina=<?php echo $total_paginas; ?> ">>|</a></li>
			<?php } ?>
			</ul>
		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>
