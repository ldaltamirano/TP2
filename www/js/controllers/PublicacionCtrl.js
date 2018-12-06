angular.module('redSocial.controllers')
.controller('PublicacionCtrl', [
    '$scope',
    '$ionicPopup',
	'Publicacion',
    'Auth',
	function($scope, $ionicPopup, Publicacion, Auth) {
		$scope.publicaciones = [];
		$scope.$on('$ionicView.beforeEnter', function() {
			$scope.userLogged = Auth.isLogged();
	        Publicacion.datos()
			.then(function(response) {
				console.log(response);
				$scope.publicaciones = response.data;
			}, function() {
                $ionicPopup.alert({
                    title: 'Error',
                    template: 'Oops! Hubo un error en nuestro servidor. Intenta mas tarde.'
                });
			});
	    });		
	}
]);