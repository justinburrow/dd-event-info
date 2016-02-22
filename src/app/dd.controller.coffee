angular.module('ddEventInfo')
  .controller 'ddCtrl', [
    'deviceDetector', '$state', '$http', '$scope',
    (deviceDetector, $state, $http, $scope) ->
      vm = this
      vm.deviceDetector = deviceDetector
      
      vm.eventOptions = ['Party', 'Wedding', 'Corporate Event', 'Other']
      vm.sizeOptions = ['10-50', '50-75', '75-100', '100-200', 'Queen - Live at Wembley Stadium']
      vm.eventLengthOptions = ['Less than one hour', '1 to 2 hours', '2 to 4 hours']
      vm.bandOptions = ['Duo', 'Trio', 'Quartet', 'Five Piece', '6-8 Pieces Including Horns']
      
      vm.submitCheck = false
      vm.infoSubmitSuccess = false
          
      if vm.deviceDetector.isMobile()
        vm.isMobile = true
      else
        vm.isMobile = false
      
      vm.start = (isFormValid) ->
        if isFormValid
          vm.submitCheck = false
          $state.go('event-details.venue')
        else
          vm.submitCheck = true
      
      vm.submitter = (isFormValid) ->
        data =
          eventDetails: vm.eventDetails
          eventInfo: vm.eventInfo
        if isFormValid
          response = $http.post('scripts/mailer.php', data)
          response.success (data, status, headers, config) ->
            if data == 'sent'
              $state.go('end')
          $scope.dd.submitCheck = false
        else
          $scope.dd.submitCheck = true
        response.error (error, status) ->
          vm. infoSubmitSuccess = false
          console.log error + ' ' + status
      return
    ]