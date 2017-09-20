var objAplication = angular.module('AppAngular', []);
objAplication.controller('listarQuizController', function($scope,$http) {


    $scope.loadQuiz = function()
    {
        $http.get('/application/load').then(
            function sucesso(objRetorno){

            },
            function erro(objRetorno){

            }
        );
    }

});