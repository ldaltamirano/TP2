angular.module('redSocial.services')
.factory('Auth', [
	'$http',
	'API_SERVER',
	function($http, API_SERVER) {
		let token 		= null, 
			userData 	= null;

		function login(user) {
			return $http.post(API_SERVER + '/login', user).then(function(response) {
				let responsePayload = response.data;

				if(responsePayload.status == 1) {
					token = responsePayload.data.token;
					userData = {
						id		: responsePayload.data.id,
						usuario : responsePayload.data.usuario
					};
					return true;
				} else {
					return false;
				}
			});
		}

		function isLogged() {
			if(token != null) {
				return true;
			} else {
				return false;
			}
			//return token != null;
		}
		return {
			login: login,
			isLogged: isLogged,
		};
	}
]);