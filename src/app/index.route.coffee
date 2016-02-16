angular.module 'ddEventInfo'
  .config ($stateProvider, $urlRouterProvider, $locationProvider) ->
    $stateProvider
      .state 'start',
        url: '/event-details'
        templateUrl: 'app/main/main.html'

    $urlRouterProvider.otherwise '/event-details'
    
    $locationProvider.html5Mode {
      enabled: true,
      requireBase: false
    }
