angular.module('ddEventInfo')
  .controller 'ddCtrl', [
    'deviceDetector', '$state', '$http',
    (deviceDetector, $state, $http) ->
      vm = this
      vm.deviceDetector = deviceDetector
      
      vm.eventOptions = ['Party', 'Wedding', 'Corporate Event', 'Other']
      vm.sizeOptions = ['10-50', '50-75', '75-100', '100-200', 'Queen - Live at Wembley Stadium']
      vm.eventLengthOptions = ['Less than one hour', '1 to 2 hours', '2 to 4 hours', 'All night long!']
      vm.bandOptions = ['Duo', 'Trio', 'Quartet', 'Five Piece', '6-8 Pieces Including Horns']
      
      vm.submitCheck = false
      
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
      
      vm.submitter = ->
        console.log 'click submit'
        data =
          eventDetails: vm.eventDetails
          eventInfo: vm.eventInfo
          test: 'test'
        response = $http.post('scripts/mailer.php', data)
        response.success (data, status, headers, config) ->
          console.log 'success'
      return
    ]