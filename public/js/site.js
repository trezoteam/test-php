var url_base = $('link[rel="url"]').attr('href');

$(document).ready(function () {

    /*Confirmar Exclusão*/
    $(".confirmExclude").on('click', function () {
        var con = confirm("Deseja prosseguir com a exlusão?");
        if (con != true) {
            return false;
        }
    });

    /*Add Resposta*/
    $(".addAnswer").on('click', function () {
        var question = "" +
                "<li class='mt-4 answer'>" +
                "   <input type='text' name='answer[]' class='form-control' placeholder='Resposta' value=''>" +
                "   <input type='hidden' name='answer_id[]' class='form-control' value=''>" +
                "   <label class='answer-value'>" +
                "       <input name='is_correct[]' type='hidden' value=''>" +
                "       <span>Resposta</span>" +
                "   </label>" +
                "   <label class='answer-exclude'>" +
                "       <input name='is_exclude[]' type='hidden' value=''>" +
                "       <span>Excluir</span>" +
                "   </label>" +
                "   <div class='clear'></div>" +
                "</li>";

        $(".answers").append(question);
    });

    $("body").on('click', '.answer-value', function () {
        var correctResponse = ($(this).find('input').val() == '1') ? null : '1';
        $(this).find('input').attr("value", correctResponse);
        $(this).toggleClass("answer-correct");
    });

    $("body").on('click', '.answer-exclude', function () {
        var excludeResponse = ($(this).find('input').val() == '1') ? null : '1';
        $(this).find('input').attr("value", excludeResponse);
        $(this).toggleClass("answer-del");
    });

    if ($(".answers").html() != undefined) {
        $(".addAnswer").click();
    }

    $(".list-questoes li").on("click", function () {
        $(this).closest(".list-questoes").find("li").each(function (index) {
            $(this).removeClass("question-active");
        });

        $(this).closest('.question-item').find(".question-response").val($(this).data('id'));
        $(this).addClass("question-active");
    });




});



