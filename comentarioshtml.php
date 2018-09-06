<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, user-scalable=no,initial-scale=1.0,
maximum-scale=1.0,minimum-scale=1.0"/> 
<title>Comentarios</title>
<link rel="stylesheet" type="text/css" href="comentarios.css" />
</head>
<body>
<header>
	<h1>Comentarios</h1>
	<ul>
		<li>Inicio</li>
		<li>Artículos</li>
		<li>Imágenes</li>
		<li>Comentarios</li>
		<li>Contacto</li>
	</ul>
</header>
<div class="contenedor">
<h2 class="titulo" >Deja tu comentario.</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form1">
<?php if ($edicion === true): ?>
<input type="hidden" name="idoculto" value="<?php echo $id; ?>" />
<?php endif; ?>
<label for="nombre">Tu nombre: </label>
<input type="text" class="nombre" id="nombre" name="nombre" value="<?php
	if ($edicion === true) {
		echo $nombre;
	} else {
		echo '';
	}
?>" />
<label for="texto">Tu comentario: </label>
<textarea name="texto" ><?php
	if ($edicion === true) {
		echo $texto;
	} else {
		echo '';
	}
?></textarea>
<input type="submit" class="enviar" id="enviar" name="<?php 
		if ($edicion === false) {
			echo 'enviar';
		} else {
			echo 'confirmaredicion';
		}
	?>" value="<?php 
		if ($edicion === false) {
			echo 'Enviar';
		} else {
			echo 'Confirmar edición';
		}
	?>" />
</form>
<?php foreach ($comentarios as $comentario): ?>
<div class="comentarios">
<div class="comentario">
<p class="pretexto"><?php echo 'Escrito por ' . $comentario['nombre'] . 
 ' el ' . fecha($comentario['fecha']) . '.'; ?></p>
<p class="comment"><?php echo $comentario['texto']; ?></p>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form2">
	<input type="hidden" name="ocultoed" 
	value="<?php echo $comentario['ID']; ?>" />
	<input type="submit" class="editar" id="editar" name="editar" value="Editar" />
</form>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form3">
	<input type="hidden" name="ocultoel" 
	value="<?php echo $comentario['ID']; ?>" />
	<input type="submit" class="eliminar" id="eliminar" name="eliminar" 
	value="Eliminar" />
</form>
<hr>
</div>
</div>
<?php endforeach; ?>
</div>
<footer>
<p>Creado por _______ ___________</p>
</footer>
</body>
</html>