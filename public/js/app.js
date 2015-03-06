'use strict';

var myApp = angular.module('xubliminal-new-clients', []);

myApp.factory('submitService', ['$http', function($http) {
  return {
    newClients: function(data, successCallback, errorCallback) {
      $http({
        method: 'POST',
        url: 'process.php',
        data: $.param(data),
        headers : { 
          'Content-Type': 'application/x-www-form-urlencoded'
        }
      })

      .success(function(data, status, headers, config) {
        successCallback(data, status, headers, config);
      })

      .error(function(data, status, headers, config) {
        errorCallback(data, status, headers, config);
      });
    }
  };
}]);

myApp.controller('NewClientsController', ['$scope', '$log', 'submitService', function($scope, $log, submitService) {
  $scope.formData = {};
  $scope.showSuccess = false;
  $scope.showError = false;
  $scope.showSpinner = false;
  $scope.title = '$500';

  $scope.submit = function (isValid) {
    if (isValid) {
      $scope.showSpinner = true;
      submitService.newClients($scope.formData, $scope.successCallback, $scope.errorCallback);
    }
  };

  $scope.successCallback = function (data) {
    $scope.showSpinner = false;
    
    if (data.success) {
      $scope.showSuccess = true;
      $scope.showError = false;
    } else {
      $scope.showSuccess = false;
      $scope.showError = true;
    }
  };

  $scope.errorCallback = function (data) {
    $scope.showSpinner = false;
    $scope.showSuccess = false;
    $scope.showError = true;
  };
}]);