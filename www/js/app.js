angular.module('redSocial', ['ionic', 'redSocial.controllers', 'redSocial.services'])

.run(function($ionicPlatform, $rootScope, $ionicPopup, $state, Auth) {
  $ionicPlatform.ready(function() {
    if (window.cordova && window.cordova.plugins && window.cordova.plugins.Keyboard) {
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
      cordova.plugins.Keyboard.disableScroll(true);

    }
    if (window.StatusBar) {
      StatusBar.styleDefault();
    }
  });

  $rootScope.$on('$stateChangeStart', function(event, toState){
    if(toState.data != undefined && toState.data.requiresAuth == true) {
      if(!Auth.isLogged()) {
        event.preventDefault();
        $ionicPopup.alert({
          title: 'Acceso denegado',
          template: 'Tenés que estar logueado para poder acceder a esta pantalla.'
        }).then(function() {
					$state.go('tab.login');
				})
      }
    } else if(toState.data != undefined && toState.data.requiresGuest == true) {
      if(Auth.isLogged()) {
        event.preventDefault();
        $state.go(toState.data.redirectTo);
      }
    }
  });
})

.config(function($stateProvider, $urlRouterProvider) {

  $stateProvider

  .state('tab', {
    url: '/tab',
    abstract: true,
    templateUrl: 'template/tab.html'
  })
 
  .state('tab.publicaciones', {
    url: '/publicaciones',
    views: {
      'tab-publicaciones': {
        templateUrl: 'template/tab-publicaciones.html',
        controller: 'PublicacionesCtrl'
      }
    },
    data: {
      //requiresAuth: true
    }
  })
  /*.state('tab.crear_publicaciones', {
    url: '/publicaciones/crear',
    views: {
      'tab-publicacion': {
        templateUrl: 'template/crear_publicacion.html',
        controller: 'crear_publicacionCtrl'
      }
    },
    data: {
      requiresAuth: true
    }
  })
    .state('tab.detalle', {
      url: '/publicaciones/:id',
      views: {
        'tab-publicaciones': {
          templateUrl: 'template/detalle.html',
          controller: 'detalleCtrl'
        }
      },
      data: {
        requiresAuth: true
      }
    })*/
  .state('tab.editarUsuario', {
    url: '/editarUsuario',
    views: {
      'tab-usuario': {
        templateUrl: 'template/tab-editarUsuario.html',
        controller: 'EditarUsuarioCtrl'
      }
    },
    data: {
      //requiresAuth: true
    }
  })
  .state('tab.usuario', {
    url: '/usuario',
    views: {
      'tab-usuario': {
        templateUrl: 'template/tab-usuario.html',
        controller: 'UsuarioCtrl'
      }
    },
    data: {
      requiresAuth: true
    }
  })
  .state('tab.registro', {
    url: '/registro',
    views: {
      'tab-perfil': {
        templateUrl: 'template/tab-registro.html',
        controller: 'RegistroCtrl'
      }
    }
  })

  .state('tab.login', {
    url: '/login',
    views: {
      'tab-perfil': {
        templateUrl: 'template/tab-login.html',
        controller: 'LoginCtrl'
      }
    }
  });

  $urlRouterProvider.otherwise('/tab/publicaciones');

})

.constant('API_SERVER', 'http://localhost/TP2/api/public');
