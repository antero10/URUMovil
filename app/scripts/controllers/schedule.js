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
   
    schedule.get({
        id:window.localStorage.getItem("id")}).$promise.then(function(data){
            console.log('Schedule is here!!!');
            console.log(data);
            $scope.courses = data.Schedule;
    }).catch(function(data){

    });
  });
