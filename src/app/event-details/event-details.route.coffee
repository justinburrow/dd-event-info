angular.module 'ddEventInfo'
  .config ($stateProvider, $urlRouterProvider, $locationProvider) ->
    $stateProvider
      .state 'event-details',
        abstract: true
        views: {
          '': {
            templateUrl: 'app/event-details/event-details.html'
            controller: 'EventDetailsController'
            controllerAs: 'eventDetails'
          }
        }
    .state 'event-details.venue',
      views: {
        'steps@event-details': {
          templateUrl: 'app/event-details/steps/venue.html'
        }
      }
    .state 'event-details.reqs',
      views: {
        'steps@event-details': {
          templateUrl: 'app/event-details/steps/reqs.html'
        }
      }
    .state 'event-details.wedding',
      views: {
        'steps@event-details': {
          templateUrl: 'app/event-details/steps/wedding.html'
        }
      }
    .state 'event-details.customer',
      views: {
        'steps@event-details': {
          templateUrl: 'app/event-details/steps/customer.html'
        }
      }
      
    $locationProvider.html5Mode true