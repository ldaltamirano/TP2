angular.module('redSocial.controllers')
.controller('RegistroCtrl', [
	'$scope',
	'$ionicPopup',
    '$state',
    'Registro',
	function($scope, $ionicPopup, $state, Registro) {
		$scope.user = {
			nombre: null,
			apellido: null,
			dni: null,
			email: null,
			password: null,
			perfil: null,
		};

		$scope.registrar = function(user) {
            Registro.registrar(user).then(function(exito) {
                if(exito) {
					$ionicPopup.alert({
						title: 'Éxito',
						template: 'Se ha registrado exitosamente. Debe iniciar sesion para finalizar el proceso'
					}).then(function() {
						$state.go('tab.login');
					});
				} else {
					$ionicPopup.alert({
						title: 'Error',
						template: 'No se podido registrar el usuario.'
					});
				}
            })
		};
	}
]);