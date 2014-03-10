'use strict';
var index;
angular.module('tesisApp')
  .controller('ScheduleCtrl', function ($scope,$http,$cookieStore){
    $scope.range = function(n) {
        return new Array(n);
    };
    $scope.setIndex= function(index2){
        index = index2 +1;
    };
    $scope.getIndex = function(){
        return index;
    };
    $http.get('../serverSide/schedule.php',{params:{user:$cookieStore.get('user')}}).success(function(data){
        console.log(data);
        $scope.courses = data;
    }).error(function(data){
         $('#alertDanger').show('slow');
                setTimeout(function() {
                    $('#alertDanger').hide('slow');
                 }, 3000);
    });
  });
