'use strict';

var balances =[{
	'balance':1237.21,
	'debt':1200.00
}];
angular.module('tesisApp')
  .controller('StatusCtrl', function ($scope) {
  	$scope.balances = balances
    
  });
