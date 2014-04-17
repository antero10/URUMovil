'use strict';

angular.module('tesisApp')
  .controller('LoginCtrl', function ($scope,$http,$location,$cookieStore) {
    $scope.login = function(id,pass){
        if(typeof id =='undefined' || typeof pass =='undefined'){
            $('#alert').show("slow");
             setTimeout(function() {
                $('#alert').hide('slow');
            }, 3000);
        }
        else{
            $http({
                method:'GET',
                url:'http://192.168.80.100/slim.php/get',
                headers:{'Content-Type':'application/json'}
            }).success(function(data){
                console.log(data);
            });
            

        }
        
    
	

    }
  });
