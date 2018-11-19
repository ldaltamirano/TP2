angular.module('redSocial.controllers')
.controller('publicacionesCtrl', [
	'$scope',
	'publicaciones',
	function($scope, publicaciones) {
		$scope.publicaciones = [];
		$scope.$on('$ionicView.beforeEnter', function() {
	        Producto.todos()
			.then(function(response) {
				console.log(response);
				$scope.productos = response.data;
			}, function() {
				alert("TODO MAL AAAHHHHHH");
			});
	    });		
	}
]);