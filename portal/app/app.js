var appControllers = angular.module('appControllers', []);
var app        = angular.module('angularJSBaseFramework', [
    'ngRoute',
    'ngCookies',
    'appControllers'
]);

// set the app url
var APP_URL     = "/angularJSBaseFramework/portal/";
var API_URL     = '../API/';

/**
 * Initialize the app
 */
app.run(function($rootScope, $route, $location, $cookies, $http) {

    $rootScope.user = {
        getSessionID: function(){
            return $cookies.get("sessionID");
        }
    };

    $rootScope.callAPI = function(action, params) {
        if(!params.hasOwnProperty('session')) params.session = $rootScope.user.getSessionID();

        return $http.get(API_URL + "?action=" + action, {params: params});
    };
});

/**
 * Configure the app
 */
app.config(function($routeProvider, $locationProvider ) {

    $locationProvider.html5Mode(true).hashPrefix('!');

    $routeProvider.
    when('/', {
        templateUrl: 'pages/home.html',
        controller: 'homeController'
    }).
    otherwise({
        redirectTo: '/'
    });

});

