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
        id:$cookieStore.get('id')}).$promise.then(function(data){
            console.log(data.Schedule);
            $scope.courses = data.Schedule;
    }).catch(function(data){

    });
  });
