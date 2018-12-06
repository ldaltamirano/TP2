<?php 
header("Content-Type: application/json; charset=utf-8");

$db = mysqli_connect('localhost', 'root', '', 'DW4_ALTAMIRANO_LUCIO_PALMIERI_JULIETA');

mysqli_set_charset($db, 'utf8');

$query = "SELECT * FROM publicacion";

$res = mysqli_query($db, $query);

$salida = [];

while($fila = mysqli_fetch_assoc($res)) {
	$salida[] = $fila;
}

echo json_encode($salida);