angular.module('redSocial.services')
.factory('Publicacion', [
	'$http',
	'API_SERVER',
	function($http, API_SERVER) {
		return {
			todos: function() {
				return $http.get(API_SERVER + '/publicaciones');
			},
			uno: function(id) {
				return $http.get(API_SERVER + '/publicaciones/' + id);
			},
			crear: function(datos) {
				return $http.post(API_SERVER + '/publicaciones', datos, {
					headers: {
						'X-Token': Auth.getToken()
					}
				});
			}
		};
	}
]);