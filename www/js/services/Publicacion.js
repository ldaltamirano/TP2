angular.module('redSocial.services')
.factory('Publicacion', [
	'$http',
	'API_SERVER',
	'Auth',
	function($http, API_SERVER, Auth) {
		return {
			datos: function() {
				return $http.get(API_SERVER + '/publicacion');
			},
			detalle: function(id) {
				return $http.get(API_SERVER + '/publicacion/' + id);
			},
			crear: function(datos) {
				return $http.post(API_SERVER + '/publicacion', datos, {
					headers: {
						'X-Token': Auth.getToken()
					}
				});
			},
			editar: function(id) {
				return $http.put(API_SERVER + '/publicacion/' + id);
			},
			eliminar: function(id) {
				return $http.delete(API_SERVER + '/publicacion/' + id);
			}
		};
	}
]);