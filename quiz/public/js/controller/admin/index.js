var objAplication = angular.module('AppAngular', []);
objAplication.controller('adminQuizController', function($scope,$http) {

    $scope.arrQuiz = [];


    $scope.objQuiz = {
        id:null,
        name:null,
        description:null,
        create_at:null,
        update_at:null
    }

    $scope.loadQuiz = function()
    {
        $http.get('/application/load').then(
            function sucesso(objRetorno){
                $scope.arrQuiz = objRetorno.data.arrQuiz;
            },
            function erro(objRetorno){
                alert('Ocorreu um erro ao carregar a lista de quiz. Tente novamente mais tarde.')
            }
        );
    }

    $scope.loadQuiz();

    $scope.clearForm = function()
    {
        $scope.objQuiz = {
            id:null,
            name:null,
            description:null,
            create_at:null,
            update_at:null
        }

        $('#formQuiz').modal('hide');
    }


    $scope.saveQuiz = function()
    {

        $http.post('/admin/save',$scope.objQuiz).then(
            function sucesso(objRetorno){
                if(objRetorno.data.sn_status == true){
                    $scope.clearForm();
                    $scope.loadQuiz();
                };
            },
            function erro(objRetorno){
                alert('Desculpe ocorreu um erro e não foi possível salvar esse quiz.');
            }
        )
    }

    $scope.setEdit = function(objQuiz)
    {

        $scope.objQuiz = objQuiz;
        $('#formQuiz').modal('show');
    }

});