'use strict';

angular.module('tesisApp')
  .controller('StudentCtrl', function ($scope,$cookieStore,$location) {
  	console.log('hola');
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
  });
