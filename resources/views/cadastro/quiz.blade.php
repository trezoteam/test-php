@extends('templates.portal.index_adm')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-4">
            <!----- Alert--------->
            <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))

                        <div class="alert alert-{{ $msg }}">
                            {{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <!--------------- Nome do quiz----------------->
        <div class="col-md-4">
            <h2 align="left"><strong>Quiz:     {{$quiz->name}}</strong></h2>
        </div>

        <div class="col-md-4"></div><br><br><br>
        <!--------------- Quantidade de perguntas já cadastradas----------------->
        <label>Quantidade de perguntas: {{$quiz->qtd}}</label>
        <hr>
        <form method="POST">
            <div class="col-md-3"></div>
            <!--------------- Form de perguntas----------------->
            <div class="col-md-6">
                <label>Pergunta</label>
                <input class="form-control" type="text" name="quiz_question" id="quiz_question" required>
                <input class="form-control" type="hidden" name="quiz_id" id="quiz_id" value="{{$quiz->id}}">
                <div class="col-md-12" id="find"><br>
                    <div class="col-md-3" align="right">
                        <label>Alternativa 1:</label>
                    </div>
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="quiz_alt[]" id="quiz_alt1" required>
                    </div>
                    <div class="col-md-3">
                        <input type="checkbox"  name="quiz_box1" id="quiz_box1">&nbsp;&nbsp;Correta
                    </div><br/><br/>
                    <div class="col-md-3" align="right">
                        <label>Alternativa 2:</label>
                    </div>
                    <div class="col-md-6">
                        <input class="form-control" name="quiz_alt[]" id="quiz_alt2" required>
                    </div>
                    <div class="col-md-3">
                        <input type="checkbox" name="quiz_box2" id="quiz_box2">&nbsp;&nbsp;Correta
                    </div><br/><br/>
                    <div class="col-md-3" align="right">
                        <label>Alternativa 3:</label>
                    </div>
                    <div class="col-md-6">
                        <input class="form-control" name="quiz_alt[]" id="quiz_alt3" required>
                    </div>
                    <div class="col-md-3">
                        <input type="checkbox" name="quiz_box3" id="quiz_box3">&nbsp;&nbsp;Correta
                    </div><br/><br/>
                    <div class="col-md-3" align="right">
                        <label>Alternativa 4:</label>
                    </div>
                    <div class="col-md-6">
                        <input class="form-control" name="quiz_alt[]" id="quiz_alt4" required>
                    </div>
                    <div class="col-md-3">
                        <input type="checkbox"  name="quiz_box4" id="quiz_box4">&nbsp;&nbsp;Correta
                    </div><br/><br/>

                </div>
                <div class="col-md-2"></div>
                <div class="col-md-4"><br>
                    <button class="btn btn-primary btn-lg" id="add_question" formaction="../add_question" type="submit" >Adicionar Questão</button>
                </div>
                <div class="col-md-4"><br>
                        <button class="btn btn-success btn-lg" id="finish" type="submit" >Concluir Quiz</button>
                </div>
            </div>


            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>
    </div>
    <hr/>
</div>
@endsection
@section('post-script')
    <script>
        ///////verifica se pelo menos uma alternativa é correta/////////////
        $(document).ready(function () {

            $('#add_question').click(function () {

                var checado1 = $("#find").find("input[name='quiz_box1']:checked").length > 0;
                var checado2 = $("#find").find("input[name='quiz_box2']:checked").length > 0;
                var checado3 = $("#find").find("input[name='quiz_box3']:checked").length > 0;
                var checado4 = $("#find").find("input[name='quiz_box4']:checked").length > 0;

                if(checado1 == true || checado2 == true||checado3 == true||checado4 == true){


                    return true

                }else{

                    alert("Deve ser selecionado uma opção correta!");
                    return false;

                }
            })
            ////////////retorna home/////////
            $('#finish').click(function () {
                window.location="../finish";
            })


        });
    </script>
@endsection