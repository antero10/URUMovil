'use strict';
angular.module('tesisApp')
	.factory('courses', ['$resource', function ($resource) {
		
	
		return $resource("http://200.35.84.135/slim.php/getCourses/:id",null,null);
		
	}])