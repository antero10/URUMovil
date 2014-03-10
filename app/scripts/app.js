'use strict';
  
angular.module('tesisApp', [
  'ngCookies',
  'ngResource',
  'ngSanitize',
  'ngRoute'
])
  .config(function ($routeProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'views/login.html',
        controller: 'LoginCtrl'
      })
      .when('/student', {
        templateUrl: 'views/student.html',
        controller: 'StudentCtrl'
      })
      .when('/courses', {
        templateUrl: 'views/courses.html',
        controller: 'CoursesCtrl'
      })
      .when('/status', {
        templateUrl: 'views/status.html',
        controller: 'StatusCtrl'
      })
      .when('/schedule', {
        templateUrl: 'views/schedule.html',
        controller: 'ScheduleCtrl'
      })
      .otherwise({
        redirectTo: '/'
      });
  });