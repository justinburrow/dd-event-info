angular.module 'ddEventInfo'
  .directive 'navButtons', () ->
    restrict: 'AE'
    templateUrl: 'app/components/nav-buttons/nav-buttons.html'
    bindToController: true