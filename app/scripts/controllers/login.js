'use strict';

angular.module('tesisApp')
  .controller('LoginCtrl', function ($scope,$location,$cookieStore,$http,login) {
    $scope.button = 'Ingresar';
    
    $scope.login = function(id,pass){
        if(typeof id =='undefined' || typeof pass =='undefined'){
            $('#alert').show("slow");
             setTimeout(function() {
                $('#alert').hide('slow');
            }, 3000);
        }
        else{
          login.save({id:id,pass:window.btoa(pass)}).$promise.then(function(data){
            console.log('Login....');
            console.log(data);
            window.localStorage.setItem("id",id);
            $location.path('/student');
          }).catch(function(err){
            console.log(err);
            $('#alertErr').show("slow");
             setTimeout(function() {
                $('#alertErr').hide('slow');
            }, 3000);
          });
           
          
          
        }
        
    
	

    }
  });
