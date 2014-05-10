'use strict';

angular.module('tesisApp')
  .controller('StudentCtrl', function ($scope,$cookieStore,$location) {
    console.log('Welcome To UruMovil');
  	$scope.options = [{
  		'link' :'#/courses',
  		'img':'images/courses.png'
  	},{
  		'link':'#/status',
  		'img':'images/status2.png'
  	},{
  		'link':"#/schedule",
  		'img':'images/schedule.png'
  	}];
    $scope.closeSession = function(){
      console.log('Closing....');
      localStorage.clear();
    }
  });
