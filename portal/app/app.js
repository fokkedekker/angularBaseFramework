// Main angular js app
var appControllers = angular.module('appControllers', []);
var app        = angular.module('appName', [
    'ngRoute',
    'ngCookies',
    'appControllers',
]);

// set the app url
var APP_URL     = "";
var API_URL     = '../API/';

/**
 * Initialize the app
 */
app.run(function($rootScope, $route, $location, $cookies, $http) {

    /**
     * User object
     * @type {{logout: Function, isLoggedIn: Function, getAuth: Function, getLevel: Function}}
     */
    $rootScope.user = {

        /**
         * Log uit
         */
        logout: function(){

            $rootScope.callAPI("logout", {}).
            then(function() {
                $cookies.remove("sessionID");
                $cookies.remove("companyID");
                $cookies.remove("companyNumber");

                $route.reload();
                $location.path("/login");
            }.bind(this));
        },

        /**
         *
         */
        getSessionID: function(){

            return $cookies.get("sessionID");
        },
        /**
         *
         */
        getCompanyID: function(){

            return $cookies.get("companyID");
        },

        /**
         *
         */
        getCompanyNumber: function(){

            return $cookies.get("companyNumber");
        },

        getLoginStatus: function() {
            return $rootScope.callAPI('getLoginStatus', {});
        }

    };

    $rootScope.callAPI = function(action, params) {
        if(!params.hasOwnProperty('session')) params.session = $rootScope.user.getSessionID();
        if(!params.hasOwnProperty('company')) params.company = $rootScope.user.getCompanyNumber();

        return $http.get(API_URL + "?action=" + action, {params: params});
    };

    $rootScope.refreshUserData = function() {
        $rootScope.callAPI("getCurrentUserData", {}).then(function(result) {
            $rootScope.user.data = result.data;
            $rootScope.$broadcast("currentUserDataUpdated", result.data);
        });

    };

    $rootScope.refreshUserData();

    $rootScope.user.getLoginStatus().then(function(result) {
        if(result.data.isLoggedIn == false && $location.path() != "/login") {
            $location.path("/login");
        }
    });

});

/**
 * Configure the app
 */
app.config(function($routeProvider, $locationProvider ) {

    $locationProvider.html5Mode(true).hashPrefix('!');

    // add a route for every page
    $routeProvider.
    when('/', {
        templateUrl: 'pages/home.html',
        controller: 'homeController'
    }).
    otherwise({
        redirectTo: '/'
    });

});

/**
 * Filter
 */
app.filter('orderObjectBy', function() {
    return function(items, field, reverse) {
        var filtered = [];
        angular.forEach(items, function(item) {
            filtered.push(item);
        });
        filtered.sort(function (a, b) {
            return (a[field] > b[field] ? 1 : -1);
        });
        if(reverse) filtered.reverse();
        return filtered;
    };
});