'use strict';

angular.module('tesisApp')
  .controller('CoursesCtrl', function ($scope,$cookieStore,courses) {
        var count = 0;
        var data;
        angular.element('#mydiv').show();
        courses.get({
            id:window.localStorage.getItem("id")
        }).$promise.then(function(courses){
            console.log('Courses are here');
            console.log(courses);
            angular.element('#mydiv').hide();
            $scope.courses = courses.Courses;
        }).catch(function(err){
            console.log(err);
            angular.element('#mydiv').hide();
            $('#alertDanger').show("slow");
             setTimeout(function() {
                $('#alertErr').hide('slow');
            }, 3000);
            
        });
    	$scope.qualificationClass = function(qualification){
    		console.log(count++);
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
