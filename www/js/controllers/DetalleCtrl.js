angular.module('redSocial.controllers')
.controller('DetalleCtrl', [
	'$scope',
	'$stateParams',
	'Publicacion',
	function($scope, $stateParams, Publicacion){
		$scope.publicaciones = {
			id: null,
			fecha: null,
			creadoPor: null,
			titulo: null,
			descripcion: null
		};
		Publicacion.detalle($stateParams.id)
			.then(function(response){
				$scope.publicaciones = response.data;
			});
	}
]);