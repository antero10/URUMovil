'use strict';

angular.module('tesisApp')
  .controller('CoursesCtrl', function ($scope,$cookieStore,courses) {
    	courses.get({
            id:window.localStorage.getItem("id")
        }).$promise.then(function(data){
            console.log('Courses are here');
            console.log(data);
            $scope.courses = data.Courses;
        }).catch(function(err){
            console.log(err);
        })
    	$scope.qualificationClass = function(qualification){
    		
    		if(qualification.trim() == 'DIF' || qualification.trim() == 'I'|| qualification.trim() == 'SI'){
    			
    			return 'label label-warning';
    		}
    		else if(parseInt(qualification) >=10 || qualification.trim() == 'AP'){
    			
    			return 'label label-success';

    		}
    		else if(parseInt(qualification)<10 || qualification.trim() == 'APL'|| qualification.trim() == 'API'){
    			
    			return 'label label-danger';
    		}
    	}
  });
