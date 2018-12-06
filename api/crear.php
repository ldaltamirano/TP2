<?php
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;
use Lcobucci\JWT\Signer\Hmac\Sha256;

require __DIR__ . '/../vendor/autoload.php';

$token = $_SERVER['HTTP_X_TOKEN'];

if($token == "null" || empty($token)) {
	echo json_encode([
		'status' => -1,
		'msg' => 'Inicia Sesion'
	]);
	exit;
}

$parser = new Parser;

$token = $parser->parse((string) $token);
$valData = new ValidationData;
$valData->setIssuer('JulietaLucio');

if(!$token->validate($valData)) {
	echo json_encode([
		'status' => -1,
		'msg' => 'Informacion incorrecta.'
	]);
	exit;
}

$signer = new Sha256;

if(!$token->verify($signer, 'holaSanti')) {
	echo json_encode([
		'status' => -1,
		'msg' => 'Firma incorrecta.'
	]);
	exit;
}


header("Content-Type: application/json; charset=utf-8");

$db = mysqli_connect('localhost', 'root', '', 'DW4_ALTAMIRANO_LUCIO_PALMIERI_JULIETA');

mysqli_set_charset($db, 'utf8');

$input = file_get_contents('php://input');
$postData = json_decode($input, true);

/*$imagen	= mysqli_real_escape_string($db, $postData['IMG']);*/
$creadoPor = mysqli_real_escape_string($db, $postData['FKID_USUARIO']);
$titulo = mysqli_real_escape_string($db, $postData['TITULO']);
$descripcion = mysqli_real_escape_string($db, $postData['DESCRIPCION']);
$fecha = mysqli_real_escape_string($db, $postData['FECHA_PUBLICACION']); 


$query = "INSERT INTO publicacion ( FKID_USUARIO, TITULO, DESCRIPCION, FECHA_PUBLICACION)
		VALUES ( '$creadoPor', '$titulo', '$descripcion', '$fecha')";

$exito = mysqli_query($db, $query);

if($exito) {
	$postData['id_producto'] = mysqli_insert_id($db);
	echo json_encode([
		'status' => 1,
		'msg' => 'Publicado',
		'data' => $postData
	]);
} else {
	echo json_encode([
		'status' => 0,
		'msg' => 'Oops! Ocurrió un problema al subir la publicacion. Intenta mas tarde.'
	]);
}