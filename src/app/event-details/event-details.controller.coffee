angular.module 'ddEventInfo'
  .controller 'EventDetailsController', ($state, $scope) ->
    vm = this
    
    states = $state.get()
    vm.stepList = []
    
    getStepList = ->
      vm.stepList = []
      for state in states
        if $scope.dd.eventInfo.eventType == 'Wedding'
          if state.abstract != true && state.name != 'start'
            vm.stepList.push state.name
        else
          if state.abstract != true && state.name != 'start' && state.name != 'event-details.wedding'
            vm.stepList.push state.name
        
    
    getCurrentStep = ->
      vm.currentStep = $state.current.name
      vm.currentStepIndex = vm.stepList.indexOf(vm.currentStep)
      vm.next = vm.stepList[vm.currentStepIndex + 1]
      vm.prev = vm.stepList[vm.currentStepIndex - 1]
    
    getCurrentStep()
    getStepList()
    
    $scope.$on '$stateChangeSuccess', ->
      getCurrentStep()
      getStepList()
    
    vm.goNext = (isFormValid) ->
      if isFormValid
        $state.go(vm.next)
        $scope.dd.submitCheck = false
      else
        $scope.dd.submitCheck = true
        
    vm.goPrev = ->
      if vm.prev
        $state.go(vm.prev)
      else
        $state.go('start')
      
    return
    
    
    
    