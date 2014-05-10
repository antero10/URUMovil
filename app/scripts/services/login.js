'use strict';
angular.module('tesisApp')
	.factory('login', ['$resource', function ($resource,$http) {
		
		 //$http.defaults.headers.post["Content-Type"] = "application/json";
		return $resource("http://200.35.84.135/slim.php/login/:id/:pass",{
				id:"@id",
				pass:"@pass"
		},null);
	}])