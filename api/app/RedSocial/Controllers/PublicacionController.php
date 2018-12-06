<?php
namespace RedSocial\Controllers;

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
			if(!$exito) {
				View::renderJson([
					'status' => 1,
					'msg' => 'Publicado',
					'data' => $postData
				]);
			} else {
				View::renderJson([
					'status' => 0,
					'msg' => 'Oops! Ocurrió un problema al subir la publicacion. Intentelo mas tarde.',
				]);
			}
		} catch(Exception $e) {
			View::renderJson([
				'status' => 0,
				'msg' => 'Oops! Ocurrió un problema al subir la publicacion. Intentelo mas tarde.'
			]);
		}
	}

	public function editar(){
		$userId = $this->checkUserIsLogged();
		$params = Route::getUrlParameters();
		$id = $params['id'];
		$input = file_get_contents('php://input');
		$putData = json_decode($input, true);

		try {
			$publicacion = new Publicacion;
			$publicacion->editar([
				'id_publicacion' => $id,
				'creadoPor' => $userId ,
				'titulo' => $postData['titulo'],
				'descripcion' => $postData['descripcion'],
				'fecha' => $postData['fecha'],
			]);
			View::renderJson([
				'status' => 1,
				'msg' => 'Se edito.',
				'data' => $publicacion
			]);
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
			$publicacion->eliminar($id);

			View::renderJson([
				'status' => 1,
				'msg' => 'Se elimino.',
			]);
		} catch(Exception $e) {
			View::renderJson([
				'status' => 0,
				'msg' => 'Oops! Ocurrió un problema al querer eliminarla publicacion. Intentelo mas tarde.'
			]);
		}
	}
}