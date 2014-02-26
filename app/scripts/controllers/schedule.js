'use strict';
var index;
angular.module('tesisApp')
  .controller('ScheduleCtrl', function ($scope,$location) {
    var courses = [{
    	'curso': '692110',
    	'descripcion': 'Matematica I',
    	'dia': '1',
    	'inicio': '8:40',
    	'fin': '11:20',
    	'salon': 'M3 2-7'
    },{
    	'curso': '692112',
    	'descripcion':'Introduccion a la Ingenieria',
    	'dia': '1',
    	'inicio': '2:50',
    	'fin': '4:30',
    	'salon':'M4 2-4'
    },{
    	'curso':'702221',
    	'descripcion':'Teoria de la Informacion',
    	'dia':'1',
    	'inicio':'3:40',
    	'fin':'5:20',
    	'salon': 'M2 2-1'

    },{
    	'curso': '702221',
    	'descripcion':'Sistemas Operativos',
    	'dia':'2',
    	'inicio': '11:15',
    	'fin': '2:50',
    	'salon': 'M4 4-0'
    },{
    	'curso':'8002221',
    	'descripcion':'Programacion para Internet',
    	'dia': '2',
    	'inicio': '3:40',
    	'fin': '5:20',
    	'salon':'M5 3-1'
    },{
    	'curso':'9002221',
    	'descripcion':'Programacion Visual',
    	'dia': '3',
    	'inicio': '11:15',
    	'fin': '2:50',
    	'salon':'M4 2-6'
    },{
    	'curso':'3002221',
    	'descripcion':'ProgramacionII',
    	'dia': '3',
    	'inicio': '11:15',
    	'fin': '2:50',
    	'salon':'M1 2-1'
    },{
        'curso':'33322',
        'descripcion':'Arquitectura Del Computador',
        'dia':'4',
        'inicio':'2:40',
        'fin':'3:40',
        'salon':'M3 2-2'
    },{
        'curso':'11122',
        'descripcion':'Microprocesadores',
        'dia':'5',
        'inicio':'2:40',
        'fin':'3:40',
        'salon':'M5 2-1'
    }];
    console.log(courses);
    $scope.range = function(n) {
        return new Array(n);
    };
    $scope.setIndex= function(index2){
        index = index2 +1;
    };
    $scope.getIndex = function(){
        return index;
    };

    $scope.courses = courses;
  });
