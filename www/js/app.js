angular.module('redSocial', ['ionic', 'redSocial.controllers', 'redSocial.services'])

.run(function($ionicPlatform, $rootScope, Auth) {
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
      }
    }
  });
})

.config(function($stateProvider, $urlRouterProvider) {

  $stateProvider

  .state('menu', {
    url: '/menu',
    abstract: true,
    templateUrl: 'template/menu.html'
  })
 
  .state('menu.publicaciones', {
    url: '/publicaciones',
    views: {
      'menu-publicaciones': {
        templateUrl: 'template/publicaciones.html',
        controller: 'publicacionesCtrl'
      }
    },
    data: {
      requiresAuth: true
    }
  })
  .state('menu.crear_publicaciones', {
    url: '/publicaciones/crear',
    views: {
      'menu-publicacion': {
        templateUrl: 'template/crear_publicacion.html',
        controller: 'crear_publicacionCtrl'
      }
    },
    data: {
      requiresAuth: true
    }
  })
    .state('menu.detalle', {
      url: '/publicaciones/:id',
      views: {
        'menu-publicaciones': {
          templateUrl: 'template/detalle.html',
          controller: 'detalleCtrl'
        }
      },
      data: {
        requiresAuth: true
      }
    })

  .state('menu.perfil', {
    url: '/perfil',
    views: {
      'menu-perfil': {
        templateUrl: 'template/perfil.html',
        controller: 'perfilCtrl'
      }
    },
    data: {
      requiresAuth: true
    }
  })

  .state('menu.login', {
    url: '/login',
    views: {
      'menu-login': {
        templateUrl: 'templates/login.html',
        controller: 'loginCtrl'
      }
    }
  });

  $urlRouterProvider.otherwise('/menu/publicaciones');

})

.constant('API_SERVER', 'http://localhost/TP2/api');
