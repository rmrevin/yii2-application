"use strict";

angular.module('YiiApp', [
  'ngCookies', 'ngAnimate', 'ngResource', 'ngSanitize', 'ngMaterial',
  'ui.bootstrap',
  'angular-loading-bar'
])

  .config([
    '$httpProvider', '$locationProvider',
    function ($httpProvider) {
      $httpProvider.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
      $httpProvider.defaults.headers.common['X-CSRF-Token'] = yii.getCsrfToken();

      var $token = jQuery('meta[name=token]');
      if ($token.length > 0) {
        $httpProvider.defaults.headers.common['Authorization'] = 'Bearer ' + $token.prop('content');
      }
    }
  ]);