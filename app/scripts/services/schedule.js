'use strict';
angular.module('tesisApp')
	.factory('schedule', ['$resource', function ($resource) {
		
	
		return $resource("http://192.168.80.100/urumovil/slim.php/getSchedule/:id",null,null);
		
	}])