'use strict';
  

angular.module('tesisApp', [
  'ngCookies',
  'ngResource',
  'ngSanitize',
  'ngRoute'
])

  .config(function ($routeProvider,$httpProvider,$resourceProvider) {
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
      //$httpProvider.defaults.withCredentials = true;
      $httpProvider.defaults.headers.put['Content-Type'] = $httpProvider.defaults.headers.post['Content-Type'] =
        'application/x-www-form-urlencoded; charset=UTF-8';
      delete $httpProvider.defaults.headers.common["X-Requested-With"];
  });
