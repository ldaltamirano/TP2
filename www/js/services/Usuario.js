angular.module('redSocial.services')
.factory('Usuario', [
	'$http',
	'API_SERVER',
	'Auth',
	function($http, API_SERVER, Auth) {
		function getLoggedUser() {
			return $http.get(API_SERVER + '/usuario', {
				headers: {
					'X-Token': Auth.getToken()
				}
			});
		}
		return {
			getLoggedUser: getLoggedUser,
		};
	}
]);