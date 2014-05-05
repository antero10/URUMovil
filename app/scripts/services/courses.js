'use strict';
angular.module('tesisApp')
	.factory('courses', ['$resource', function ($resource) {
		
	
		return $resource("http://192.168.80.100/urumovil/slim.php/getCourses/:id",null,null);
		
	}])