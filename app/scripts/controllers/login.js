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
            $http.post("../serverSide/login.php",{'id':id,'pass':pass}).success(function(data){
                console.log('Entrando...');
                $cookieStore.put('user',id);
                $location.path('/student');
            }).error(function(data){
                console.log(id);
                console.log(pass);
                console.log(data);
                $('#alertDanger').show('slow');
                setTimeout(function() {
                    $('#alertDanger').hide('slow');
                 }, 3000);
            })
            

        }
        
    
	

    }
  });
