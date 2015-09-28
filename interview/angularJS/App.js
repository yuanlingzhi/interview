
var myApp=angular.module('myApp',['ngRoute','infinite-scroll','ngSanitize']);


myApp.config(['$routeProvider',function ($routeProvider) {
      $routeProvider
      .when('/go',{
        templateUrl: 'view/search.php',
        controller: 'showSearchPage'
      }) 
      .when('/search/:info',{
        templateUrl: 'view/searchResult.php',
        controller: 'showResult'
      })
      .when('/detail/:detail',{
        templateUrl: 'view/resultDetail.php',
        controller: 'resultDetail'
      })
      .otherwise({
    	  redirectTo: '/go'
      });
}]);