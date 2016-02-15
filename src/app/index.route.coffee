angular.module 'ddEventInfo'
  .config ($stateProvider, $urlRouterProvider, $locationProvider) ->
    $stateProvider
      .state 'start',
        url: '/'
        templateUrl: 'app/main/main.html'

    $urlRouterProvider.otherwise '/'
    
    $locationProvider.html5Mode {
      enabled: true,
      requireBase: false
    }
