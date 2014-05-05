'use strict';
angular.module('tesisApp')
	.factory('status', ['$resource', function ($resource) {
		
	
		return $resource("http://192.168.80.100/urumovil/slim.php/getStatus/:id",null,null);
		
	}])