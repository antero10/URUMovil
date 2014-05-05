'use strict';

angular.module('tesisApp')
  .controller('LoginCtrl', function ($scope,$location,$cookieStore,login) {
    $scope.button = 'Ingresar';
    
    $scope.login = function(id,pass){
        if(typeof id =='undefined' || typeof pass =='undefined'){
            $('#alert').show("slow");
             setTimeout(function() {
                $('#alert').hide('slow');
            }, 3000);
        }
        else{
          $location.path('/student');
        /*
            login.save({
              id:id,
              pass:window.btoa(pass)
            }).$promise.then(function(data){
              $cookieStore.put('id',id);
              $location.path('/student');
            }).catch(function(err){
              $('#alertErr').show("slow");
             setTimeout(function() {
                $('#alertErr').hide('slow');
            }, 3000);
            });
           
           $http.post("http://192.168.1.128/urumovil/slim.php/login/19415408",{withCredential: true}).success(function(data){
                console.log(data);
           });
          */
        }
        
    
	

    }
  });
