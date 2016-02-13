angular.module 'ddEventInfo'
  .controller 'ddCtrl', ($filter, $state) ->
    vm = this
    
    vm.eventOptions = ['Party', 'Wedding', 'Corporate Event', 'Other']
    vm.sizeOptions = ['10-50', '50-75', '75-100', '100-200', 'Queen - Live at Wembley Stadium']
    vm.eventLengthOptions = ['Less than one hour', '1 to 2 hours', '2 to 4 hours', 'All night long!']
    vm.bandOptions = ['Duo', 'Trio', 'Quartet', 'Five Piece', '6-8 Pieces Including Horns']
    
    vm.submitCheck = false
    
    vm.start = (isFormValid) ->
      if isFormValid
        vm.submitCheck = false
        $state.go('event-details.venue')
      else
        vm.submitCheck = true
    
    return
  