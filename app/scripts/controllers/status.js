'use strict';


angular.module('tesisApp')
  .controller('StatusCtrl', function ($scope,status,$cookieStore) {	
  	status.get(
      {id:$cookieStore.get('id')}).$promise.then(function(data){
  		console.log(data);
  		$scope.charge = data.PAYMENT;
  		$scope.debt = data.LATEPAYMENT - data.PAYMENT
  		$scope.totalDebt = data.CHARGES - data.PAYMENT;
  	}).catch(function(err){
  		console.log(err);
  	})
    
  });
