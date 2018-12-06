<?php
namespace RedSocial\Controllers;

use Exception;
use RedSocial\Models\Publicacion;
use RedSocial\Core\View;
use RedSocial\Core\Route;

class PublicacionController extends BaseController{
	public function datos(){
		$publicacion = new Publicacion;
		$publicaciones = $publicacion->datos();
		View::renderJson($publicaciones);
	}

	public function detalle(){
		$params = Route::getUrlParameters();
		$id = $params['id'];

		$publicacion = new Publicacion;
		$publicacion->datosPorId($id);
		View::renderJson($publicacion);
	}

	public function crear(){
		$userId = $this->checkUserIsLogged();

		$input = file_get_contents('php://input');
		$postData = json_decode($input, true);

		try {
			$publicacion = new Publicacion;
			$exito = $publicacion->crear([
				'FECHA_PUBLICACION' => $postData['fecha'],
				'FKID_USUARIO' => $userId,
				'TITULO' => $postData['titulo'],
				'DESCRIPCION' => $postData['descripcion'],
			]);
			if($exito) {
				View::renderJson([
					'status' => 1,
					'msg' => 'Publicado',
					'data' => $postData
				]);
			} else {
				throw new Exception;
			}
		} catch(Exception $e) {
			View::renderJson([
				'status' => 0,
				'msg' => 'Oops! Ocurrió un problema al subir la publicacion. Intentelo mas tarde.'
			]);
		}
	}

	public function editar(){
		$params = Route::getUrlParameters();
		$id = $params['id'];
		$input = file_get_contents('php://input');
		$putData = json_decode($input, true);

		try {
			$publicacion = new Publicacion;
			$exito = $publicacion->editar([
				'id_publicacion' => $id,
				'creadoPor' => $postData['FKID_USUARIO'],
				'titulo' => $postData['TITULO'],
				'descripcion' => $postData['DESCRIPCION'],
				'fecha' => $postData['FECHA_PUBLICACION'],
			]);
			if($exito) {
				View::renderJson([
					'status' => 1,
					'msg' => 'Se edito.',
					'data' => $producto
				]);
			} else {
				throw new Exception;
			}
		} catch(Exception $e) {
			View::renderJson([
				'status' => 0,
				'msg' => 'Oops! Ocurrió un problema al querer editar. Intentelo mas tarde.'
			]);
		}
	}

	public function eliminar(){
		$params = Route::getUrlParameters();
		$id = $params['id'];

		try {
			$publicacion = new Publicacion;
			$exito = $publicacion->eliminar($id);
			if($exito) {
				View::renderJson([
					'status' => 1,
					'msg' => 'Se elimino la publicación.',
				]);
			} else {
				throw new Exception;
			}
		} catch(Exception $e) {
			View::renderJson([
				'status' => 0,
				'msg' => 'Oops! Ocurrió un problema al querer eliminarla publicacion. Intentelo mas tarde.'
			]);
		}
	}
}