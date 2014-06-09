'use strict';

describe('Service: Httpinterceptor', function () {

  // load the service's module
  beforeEach(module('tesisTestApp'));

  // instantiate service
  var Httpinterceptor;
  beforeEach(inject(function (_Httpinterceptor_) {
    Httpinterceptor = _Httpinterceptor_;
  }));

  it('should do something', function () {
    expect(!!Httpinterceptor).toBe(true);
  });

});
