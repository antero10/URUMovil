'use strict';

angular.module('tesisApp')
  .controller('CoursesCtrl', function ($scope,$http,$cookieStore) {
    	$http.get('../serverSide/index.php/getCourses',{params:{user:$cookieStore.get('user')}}).success(function(data){
    		console.log(data);
    		$scope.courses = data;
    	});
    	$scope.qualificationClass = function(qualification){
    		
    		if(qualification == 'DIF'){
    			
    			return 'label label-warning';
    		}
    		else if(parseInt(qualification)>10 || qualification == 'AP'){
    			
    			return 'label label-success';

    		}
    		else if(parseInt(qualification)<10 || qualification == 'APL'){
    			
    			return 'label label-danger';
    		}
    	}
  });
