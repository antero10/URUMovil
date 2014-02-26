'use strict';
var courses = [{
	'name':'Matematica 1',
	'semester':'2010A',
	'code':'252T21',
	'qualification':20
},{
	'name':'Programacion I',
	'semester':'2010B',
	'code':'252F23',
	'qualification':2
},{
	'name':'Programacion II',
	'semester':'2010C',
	'code':'252F24',
	'qualification':15
},{
	'name':'Programacion III',
	'semester':'2011A',
	'code':'252F25',
	'qualification':9
}]
angular.module('tesisApp')
  .controller('CoursesCtrl', function ($scope,$http) {
    	$scope.courses = courses;
  });
