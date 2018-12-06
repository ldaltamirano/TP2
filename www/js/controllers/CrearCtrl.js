angular.module('redSocial.controllers')
.controller('CrearCtrl', [
	'$scope',
	'$state',
	'$ionicPopup',
	'Publicacion',
	'Usuario',
	function($scope, $state, $ionicPopup, Publicacion, Usuario) {
		Usuario.getLoggedUser().then(function(resp) {
			$scope.publicacion = {
				creadoPor: null,
				creadoPorNombre: null,
				titulo: null,
				descripcion: null
			};
			$scope.publicacion.creadoPor = resp.data.data.id;
			$scope.publicacion.creadoPorNombre = resp.data.data.nombre + ' ' + resp.data.data.apellido;
			$scope.crear = function(publicacion) {
				Publicacion.crear(publicacion)
					.then(function(response) {
						let responseInfo = response.data;
						if(responseInfo.status == 1) {
							$ionicPopup.alert({
								title: 'Éxito!',
								template: 'Publicado'
							}).then(function() {
								$state.go('tab.publicacion');
							});
						} else if(responseInfo.status == 0) {
							$ionicPopup.alert({
								title: 'Error',
								template: 'Oops! Error al publicar. Intenta mas tarde.'
							});
						}
					});
			};
		});
    }
]);