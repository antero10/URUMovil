'use strict';

angular.module('tesisApp')
  .controller('LoginCtrl', function ($scope,$http,$location,$cookieStore) {
    $scope.login = function(id,pass){
        if(typeof id =='undefined' || typeof pass =='undefined'){
            $('#alert').show("slow");
             setTimeout(function() {
                $('#alertInfo').hide('slow');
            }, 3000);
        }
        else{
            $location.path("/student")
            /*
            $http({
            method: "POST",
            url:'../serverSide/index.php/login',
            data:{id:id,pass:pass}
            }).success(function(data){
                console.log(data);
                $location.path("/student");
             }).error(function(data){
                console.log(data);
            });
             */
            

        }
        
    
	

    }
  });
