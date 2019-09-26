@extends('templates.portal.index')
<style>
</style>
@section('content')
<div class="container">
    <div class="row">
        <h1 align="center"><span></span><strong> {{$quiz->name}}</strong></h1>
    </div><br/>

    <div id="resultado" class="table-responsive">
        <div class="col-md-3"></div>
        <div class="col-md-6" style="border: solid "><br/>
            <form method="post">

                <input type="hidden" id="soccer_id" name="soccer_id" value="{{$lastid}}">
                <ol>

                @for($i=0; $i < count($question);$i++)

                    <div id="div{{$i}}" class="div-{{$question[$i]['mul_choice']}}">

                        <li style="font-size: 18px;" class="count">
                            @if($question[$i]['mul_choice'] == 'Y')
                                {{$question[$i]['question']}} <p style="font-size: 14px;">(Mais de uma resposta)</p>
                            @else
                               {{$question[$i]['question']}}
                            @endif
                        </li>

                        @for($j=0; $j<count($answer); $j++)

                            @if($answer[$j]['question_id'] == $question[$i]['id'])

                                <input type="checkbox"  name="alt[]"  id="alt{{$i}}" value="{{$answer[$j]['id']}}">
                                <label>{{$answer[$j]['answer']}}</label><br/>

                            @endif

                        @endfor

                    </div><br/>

                @endfor
                </ol>
                <hr/>

                <div align="center">
                   <button class="btn  btn-primary btn-lg"  formaction="../public/result" id="btn">Finalizar</button>
                    <input type="hidden"  name="quiz_id" value="{{$quiz->id}}">
                    <input type="hidden"  name="quiz_name" value="{{$quiz->name}}">
                </div><br/>

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>

        </div>

        <div class="col-md-3"></div>
    </div><br/>
</div>
@endsection
@section('post-script')
    <script>




        $(document).ready(function () {


            count = $('.count').length

            /// Verificando checkbox que tem mais de uma resposta////

            for (i = 0; i < count; i++) {

                div = $( "#div"+i ).hasClass( 'div-N')
                if(div == true){
                    $("#div"+i).on('click', 'input', function() {
                        $(this).siblings().prop('checked', false);
                    });
                }
            }


            var selecionados = 0;

            $( "input" ).change(function() {

                var $input = $( this );

                    if($input.prop( "checked" )) {

                        selecionados++
                    }

            });

            $('#btn').click(function () {


                if(selecionados >= count){
                   return true
                }
                alert('Por favor, preencha todas as perguntas!')
                return false;
            })

        })
    </script>
@endsection