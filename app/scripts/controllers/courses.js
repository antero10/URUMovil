'use strict';

angular.module('tesisApp')
  .controller('CoursesCtrl', function ($scope,$http,$cookieStore,courses) {
    	courses.get({
            id: $cookieStore.get('id')
        }).$promise.then(function(data){
            $scope.courses = data.Courses;
        }).catch(function(err){
            console.log(err);
        })
    	$scope.qualificationClass = function(qualification){
    		
    		if(qualification == 'DIF' || qualification == 'I' || qualification == 'SI'){
    			
    			return 'label label-warning';
    		}
    		else if(parseInt(qualification) >=10 || qualification == 'AP'.trim()){
    			
    			return 'label label-success';

    		}
    		else if(parseInt(qualification)<10 || qualification == 'APL'|| qualification == 'API'){
    			
    			return 'label label-danger';
    		}
    	}
  });
