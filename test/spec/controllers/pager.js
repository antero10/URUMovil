'use strict';

describe('Controller: PagerCtrl', function () {

  // load the controller's module
  beforeEach(module('tesisApp'));

  var PagerCtrl,
    scope;

  // Initialize the controller and a mock scope
  beforeEach(inject(function ($controller, $rootScope) {
    scope = $rootScope.$new();
    PagerCtrl = $controller('PagerCtrl', {
      $scope: scope
    });
  }));

  it('should attach a list of awesomeThings to the scope', function () {
    expect(scope.awesomeThings.length).toBe(3);
  });
});
