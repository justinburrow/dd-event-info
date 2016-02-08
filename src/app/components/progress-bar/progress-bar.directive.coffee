angular.module 'ddEventInfo'
  .directive 'progressBar', () ->
    restrict: 'AE'
    templateUrl: 'app/components/progress-bar/progress-bar.html'
    link: (scope, element, attributes) ->
    