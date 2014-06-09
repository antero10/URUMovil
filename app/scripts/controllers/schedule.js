'use strict';
var index;
angular.module('tesisApp')
  .controller('ScheduleCtrl', function ($scope,$http,$cookieStore,schedule){

    $scope.range = function(n) {
        return new Array(n);
    };
    $scope.setIndex= function(index2){
        index = index2 +1;
    }; 
    $scope.getIndex = function(){
        return index;
    };
    angular.element('#mydiv').show();
    schedule.get({
        id:window.localStorage.getItem("id")}).$promise.then(function(data){
            console.log('Schedule is here!!!');
            angular.element('#mydiv').hide();
            console.log(data);
            $scope.courses = data.Schedule;
    }).catch(function(data){
            console.log(data);
            angular.element('#mydiv').hide();
            $('#alertDanger').show("slow");
             setTimeout(function() {
                $('#alertErr').hide('slow');
            }, 3000);
    });
  });
