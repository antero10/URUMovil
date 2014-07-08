'use strict';

angular.module('tesisApp')
  .controller('StatusCtrl', function ($scope,status,$cookieStore) {
    angular.element('#mydiv').show();
  	status.get(
      {id:window.localStorage.getItem("id")}).$promise.then(function(data){
      angular.element('#mydiv').hide();
      console.log(data);
      
      var totalDebt = data.Status.CHARGES - data.Status.PAYMENT;
      var amount = data.Status.AMOUNT;
      var count = 2;
      $scope.fees = data.Status.fees; 
      $scope.totalDebt = totalDebt.toFixed(2);
      $scope.latePayment = (data.Status.LATEPAYMENT - data.Status.PAYMENT).toFixed(2);
      $scope.paymentClass = function( ){
        if(count<0){
            count = 2;
          }
          if(amount * count <= totalDebt){
            console.log(amount*count);
            count--;
            return 'label label-danger';
          }
          else{
            console.log(amount*count);
            count--;
            return 'label label-success';
          }
          

      }


  	}).catch(function(err){
  		console.log(err);
      angular.element('#mydiv').hide();
      $('#alertDanger').show("slow");
             setTimeout(function() {
                $('#alertDanger').hide('slow');
            }, 3000);
  	})
    
  });
