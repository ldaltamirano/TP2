<?php
header("Content-Type: application/json; charset=utf-8");

$db = mysqli_connect('localhost', 'root', '', 'DW4_ALTAMIRANO_LUCIO_PALMIERI_JULIETA');

mysqli_set_charset($db, 'utf8');

$id = mysqli_real_escape_string($db, $_GET['id']);
            
$query = "SELECT * FROM publicacion
          INNER JOIN comentario
            ON publicacion.FKID_USUARIO = comentario.FKID_USUARIO
          INNER JOIN usuario
            ON publicacion.FKID_USUARIO = usuario.ID_USUARIO
          WHERE publicacion.ID_PUBLICACION = '$id'
          ORDER BY publicacion.ID_PUBLICACION";

$res = mysqli_query($db, $query);

$fila = mysqli_fetch_assoc($res);

echo json_encode($fila);