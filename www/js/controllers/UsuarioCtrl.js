angular.module('redSocial.controllers')
.controller('UsuarioCtrl', [
	'$scope',
	'Usuario',
	function($scope, Usuario) {
		$scope.user = {
			nombre: null,
			apellido: null,
			dni: null,
			email: null
		};

		Usuario.getLoggedUser().then(function(response) {
			let responsePayload = response.data;
			if(responsePayload.status == 1) {
				$scope.user = {
					nombre: responsePayload.data.nombre,
					apellido: responsePayload.data.apellido,
					dni: responsePayload.data.dni,
					email: responsePayload.data.email,
				}
			}
		});
	}
]);