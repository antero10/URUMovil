'use strict';
angular.module('tesisApp')
	.factory('status', ['$resource', function ($resource) {
		
	
		return $resource("http://200.35.84.135/slim.php/getStatus/:id",null,null);
		
	}])