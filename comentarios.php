
<?php 
try {
	$conexion = new PDO('mysql:host=localhost;dbname=comentarios;charset=utf8',
	'root','');
} catch (PDOException $e) {
	echo "Error: " . $e;
}

$statement = $conexion->prepare('SELECT * FROM comentarios');
$statement->execute();
$comentarios = $statement->fetchAll();

function fecha($fecha) {
		$timestamp = strtotime($fecha);
		$meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto',
		'Septiembre','Octubre','Noviembre','Diciembre'];
		$segundo = date('s', $timestamp);
		$minuto = date('i', $timestamp);
		$hora = date('h', $timestamp);
		$dia = date('d', $timestamp);
		$mes = date('m', $timestamp) - 1;
		$year = date('Y', $timestamp);
		$fecha = $dia . ' de ' . $meses[$mes] . ' del ' . $year . 
		' a las ' . $hora . ':' . $minuto . ':' . $segundo;
		return $fecha;
	}
function limpiardatos($datos){
	$datos = trim($datos);
	$datos = stripcslashes($datos);
	$datos = htmlspecialchars($datos);
	return $datos;
}

/* ENVIAR COMENTARIO */

$edicion = false;
if (isset($_POST['enviar'])) {
	$nombre = limpiardatos($_POST['nombre']);
	if ($nombre == '') {
		$nombre = 'Anónimo';
	}
	$texto = limpiardatos($_POST['texto']);
	$statement = $conexion->prepare('INSERT INTO comentarios (ID, nombre, 
	texto) VALUES (null, :nombre, :texto)');
	$statement->execute(array(':nombre' => $nombre, ':texto' => $texto));
	header ('Location: comentarios.php');
}

/* EDITAR */

if (isset($_POST['editar'])) {
	$id = $_POST['ocultoed'];
	$statement = $conexion->prepare('SELECT * FROM comentarios WHERE ID = :id');
	$statement->execute(array(':id'=>$id));
	$resultado = $statement->fetchAll();
	$resultado = $resultado[0];
	$nombre = $resultado['nombre'];
	$texto = $resultado['texto'];
	$edicion = true;
}
if (isset($_POST['confirmaredicion'])) {
		$id = $_POST['idoculto'];
		$nombre = limpiardatos($_POST['nombre']);
		if ($nombre == '') {
			$nombre = 'Anónimo';
		}
		$texto = limpiardatos($_POST['texto']);
		$statement = $conexion->prepare('UPDATE comentarios SET nombre = :nombre, 
		texto = :texto WHERE ID = :id');
		$statement->execute(array(':nombre' => $nombre, ':texto' => $texto, 
		':id' => $id));
		$edicion = false;
		header ('Location: comentarios.php');
	}

/* ELIMINAR */

if (isset($_POST['eliminar'])) {
	$id = $_POST['ocultoel'];
	$statement = $conexion->prepare('DELETE FROM comentarios WHERE ID = :id');
	$statement->execute(array(':id'=>$id));
	header ('Location: comentarios.php');
}



require 'comentarioshtml.php';
?>