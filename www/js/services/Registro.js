angular.module('redSocial.services')
.factory('Registro', [
	'$http',
	'API_SERVER',
	function($http, API_SERVER) {
		let	userData 	= null;

		function registrar(user) {
			return $http.post(API_SERVER + '/registrar', user).then(function(response) {
				let responsePayload = response.data;
				if(responsePayload.status == 1) {
					return true;
				} else {
					return false;
				}
			});
		}

		return {
			registrar: registrar,
		};
	}
]);