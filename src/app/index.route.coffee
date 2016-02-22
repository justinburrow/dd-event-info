angular.module 'ddEventInfo'
  .config ($stateProvider, $urlRouterProvider, $locationProvider) ->
    $stateProvider
      .state 'start',
        url: '/'
        templateUrl: 'app/main/main.html'
      .state 'end',
        url: '/'
        templateUrl: 'app/main/end.html'

    $urlRouterProvider.otherwise '/'
    
    $locationProvider.html5Mode {
      enabled: true
    }
