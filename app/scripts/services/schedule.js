'use strict';
angular.module('tesisApp')
	.factory('schedule', ['$resource', function ($resource) {
		
	
		return $resource("http://200.35.84.135/slim.php/getSchedule/:id",null,null);
		
	}])