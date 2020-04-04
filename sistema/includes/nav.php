		<nav>
			<ul>
				<li><a href="index.php">Inicio</a></li>

			<?php
				if($_SESSION['rol'] == 1){
			 ?>
				<li class="principal">

					<a href="#">Usuarios</a>
					<ul>
						<li><a href="registro_usuario.php">Nuevo usuarios</a></li>
						<li><a href="lista_usuarios.php">Lista de usuarios</a></li>
					</ul>

				</li>

				<li class="principal">

					<a href="#">Estudiantes</a>
					<ul>
						<li><a href="registro_estudiante.php">Nuevo Estudiante</a></li>
						<li><a href="lista_estudiante.php">Lista de Estudiante</a></li>
					</ul>

				</li>
			<?php } ?>


			<?php
				if($_SESSION['rol'] == 2){
			 ?>
				<li class="principal">

					<a href="#">Estudiantes</a>
					<ul>
						<li><a href="registro_estudiante.php">Registrar Nuevo Estudiante</a></li>
					</ul>

				</li>
			<?php } ?>

		</ul>
	</nav>
