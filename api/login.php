<?php
require 'vendor/autoload.php';

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;

header('Content-Type: application/json; charset=utf-8');

$db = mysqli_connect('localhost', 'root', '', 'DW4_ALTAMIRANO_LUCIO_PALMIERI_JULIETA');

mysqli_set_charset($db, 'utf8');

$input = file_get_contents('php://input');
$datosPost = json_decode($input, true);

if(isset($datosPost['EMAIL']) && isset($datosPost['CLAVE'])) {

    $query = "SELECT * FROM usuario
            WHERE EMAIL = '" . mysqli_real_escape_string($db, $datosPost['EMAIL']) . "'
            AND CLAVE = '" . mysqli_real_escape_string($db, SHA1($datosPost['CLAVE'])) . "'";

    $res = mysqli_query($db, $query);

    if($fila = mysqli_fetch_assoc($res)) {
        $builder = new Builder();

        $builder->setIssuer('JulietaLucio');
        $builder->set('id', $fila['ID_USUARIO']);

        $signer = new Sha256();
        $builder->sign($signer, 'holaSanti');

        $token = $builder->getToken();

        echo json_encode([
            'status' => 1,
            'data' => [
                'token' 	=> "" . $token,
                'id' 		=> $fila['ID_USUARIO'],
                'email' 	=> $fila['EMAIL'],
            ]
        ]);
    } else {
        echo json_encode([
            'status' => 0,
            'msg' => 'Las credenciales ingresadas no coinciden con ningún registro. Verficá los datos nuevamente y volvé a intentar.'
        ]);
    }
} else {
    echo json_encode([
        'status' => -1,
        'msg' => 'Error en el sistema.'
    ]);
}