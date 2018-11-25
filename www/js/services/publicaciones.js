angular.module('redSocial.services')
/*.factory('publicaciones', [
	'$http',
	'API_SERVER',
	function($http, API_SERVER) {
		return {
			todos: function() {
				return $http.get(API_SERVER + '/publicaciones.php');
			},
			uno: function(id) {
				return $http.get(API_SERVER + '/detalle.php?id=' + id);
			},
			crear: function(datos) {
				return $http.post(API_SERVER + '/crear_publicaciones.php', datos);
			}
		};
	}
]);*/