
<div class="container is-fluid mb-6">
	<h1 class="title">Usuarios</h1>
	<h2 class="subtitle">Lista de usuario</h2>
</div>
<div class="container pb-6 pt-6">
	<?php
		use app\controllers\userController;

		$insUsuario = new userController();

		echo $insUsuario -> listarUsuarioControlador($url[1], 15, $url[0], "");
	?>
</div>
