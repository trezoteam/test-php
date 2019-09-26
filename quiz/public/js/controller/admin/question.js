var objAplication = angular.module('AppAngular', []);
objAplication.controller('adminQuizController', function($scope,$http) {

    $scope.arrType = []
    $scope.arrQuestion = [];
    $scope.question_id = null;
    $scope.formQuestion  ={
        subject:null,
        type_id:null,
        id:null,
        create_at:null,
        update_at:null,
    }
    $scope.arrQuestionOption = [];

    $scope.objQuestionOption = {
        id:null,
        question_id:null,
        answer:null,
    }

    $scope.clearForm = function()
    {
        $scope.formQuestion  ={
            subject:null,
            type_id:null,
            id:null,
            create_at:null,
            update_at:null,
        }



    }


    $scope.saveQuestion = function()
    {

        var ds_url = "/admin/save-question/"+$scope.question_id;
        $http.post(ds_url,$scope.formQuestion).then(
            function sucesso(objRetorno){
                console.log(objRetorno);
                $scope.loadQuestion();
            },
            function erro(objRetorno){
                console.log(objRetorno);
            }
        );
    }




    $scope.setArrType = function(ds_name,cd_id)
    {
        var arrType = {
            id:cd_id,
            name:ds_name
        }

        console.log(arrType);
        $scope.arrType.push(arrType);
    }


    $scope.loadQuestion = function()
    {
        var ds_url = "/admin/load-question/"+$scope.question_id;
        $http.get(ds_url).then(
            function sucesso(objRetorno)
            {
                if(objRetorno.data.sn_status == true){
                    $scope.arrQuestion = objRetorno.data.arrQuestion;
                }
            },
            function erro(objRetorno)
            {
                console.log(objRetorno);
            }
        );
    }


    $scope.loadOptionQuestion = function(objQuestion)
    {
        var ds_url = "/admin/load-question-options/"+$scope.question_id;


        $scope.objQuestionOption.question_id = objQuestion.id;
        console.log(objQuestion);

        $http.post(ds_url,objQuestion).then(
            function sucesso(objRetorno){
                if(objRetorno.data.sn_status == true){
                    $scope.arrQuestionOption = objRetorno.data.arrQuestionOption;

                }
            },
            function erro(objRetorno){

            }
        );
    }

    $scope.addQuestionOption = function()
    {
        console.log($scope.objQuestionOption);

        var ds_url = "/admin/add-question-options/"+$scope.question_id;
        $http.post(ds_url,$scope.objQuestionOption).then(
            function sucesso(objRetorno){
                if(objRetorno.data.sn_status == true){
                    $scope.arrQuestionOption.push(objRetorno.data.objRetorno);
                    $scope.objQuestionOption.id = null;
                    $scope.objQuestionOption.answer = null;

                }
            },
            function erro(objRetorno){

            }
        );
    }

    $scope.removeAsw = function(objAsw,index)
    {
            var ds_url = "/admin/remove-question-options/"+$scope.question_id;
            $http.post(ds_url,objAsw).then(
            function sucesso(objRetorno){
                if(objRetorno.data.sn_status == true){

                    $scope.arrQuestionOption.splice(index,1);

                }
            },
            function erro(objRetorno){

            }
        );
    }

    $scope.isCorrect = function(objAsw,$index)
    {
        var ds_url = "/admin/correct-question-options/"+$scope.question_id;
        $http.post(ds_url,objAsw).then(
            function sucesso(objRetorno){
                if(objRetorno.data.sn_status == true){

                        $scope.arrQuestionOption[$index].is_correct = objRetorno.data.objRetorno.is_correct;

                }
            },
            function erro(objRetorno){

            }
        );
    }


});