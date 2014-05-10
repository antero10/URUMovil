'use strict';


angular.module('tesisApp')
  .controller('StatusCtrl', function ($scope,status,$cookieStore) {	
  	status.get(
      {id:window.localStorage.getItem("id")}).$promise.then(function(data){
      console.log('Status is here!');
  		console.log(data);
  		//$scope.charge = data.PAYMENT;
  		var debt = data.LATEPAYMENT - data.PAYMENT
  		var totalDebt = data.CHARGES - data.PAYMENT;
      


      if(debt<0){
        $scope.debt = 0;
      }
      else{
        $scope.debt = Math.round(debt * 100) / 100;
      }
      if(totalDebt<0){
        $scope.totalDebt = 0;
      }
      else{
        $scope.totalDebt = Math.round(totalDebt * 100) / 100;
      }
  	}).catch(function(err){
  		console.log(err);
  	})
    
  });
