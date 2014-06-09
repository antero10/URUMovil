'use strict';
angular.module('tesisApp')
	.factory('login', ['$resource', function ($resource,$http) {
		
		 //$http.defaults.headers.post["Content-Type"] = "application/json";
		return $resource("http://192.168.80.100/urumovil/slim.php/login/:id/:pass",{
				id:"@id",
				pass:"@pass"
		},null);
	}])