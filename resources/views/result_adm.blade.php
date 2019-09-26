@extends('templates.portal.index_adm')

@section('content')

    <!-- DataTAbles - CSS ---->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.0/css/responsive.bootstrap4.min.css">

    <div class="container">
        <div id="resultado" class="table-responsive">
            <div class="col-md-12">
            <!---------------------------------Monta os jogadores do quiz -------------------------->
                <?php $i=0?>
                @foreach($qtd_soccer as $soccer)
                    <div class="box box-default box-solid collapsed-box">

                        <div class="box-header with-border">
            <!---------------------------------Nome do jogador------------------------------>
                            <h3 class="box-title"><strong>{{$soccer->name}}</strong> </h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" id="mais_{{$i}}" name="mais" onclick="MeuMetodo({{$i}})" value="{{$soccer->id}}" data-widget="collapse"><i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="box-body" id="display_{{$i}}" style="display: none;">

         <!---------------------------------Dados do jogador -------------------------->
                            <label>Nome: </label> {{$soccer->name}}<br/>
                            <label>Email: </label> {{$soccer->email}}<br/>
                            <div class="col-md-11">
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div align="center" id="direct_result_{{$i}}" class="col-md-8" style="border:solid">


                                        <div class="col-md-6" id="ini"></div>
                                        <div class="col-md-6" id="fim"></div>
                                    </div>
                                </div><br/>
                                <hr/>
                                <ol>

                                    @for($i=0; $i < count($qtd_question);$i++)

                                        <div id="div{{$i}}" class="div-{{$qtd_question[$i]['mul_choice']}}">

                 <!---------------------------------Monta as perguntas -------------------------->
                                            <li style="font-size: 18px;" class="count">
                                                @if($qtd_question[$i]['mul_choice'] == 'Y')
                                                    {{$qtd_question[$i]['question']}} <p style="font-size: 14px;">(Mais de uma resposta)</p>
                                                @else
                                                    {{$qtd_question[$i]['question']}}
                                                @endif
                                            </li>

                                            @for($j=0; $j<count($qtd_answer); $j++)

                 <!---------------------------------Monta as alternativas -------------------------->
                                                @if($qtd_answer[$j]['question_id'] == $qtd_question[$i]['id'])
                                                    @if($qtd_answer[$j]['is_correct'] == true)
                                                        <label style="color: green">{{$qtd_answer[$j]['answer']}}</label><br/>
                                                    @else
                                                        <label>{{$qtd_answer[$j]['answer']}}</label><br/>
                                                    @endif

                                                @endif

                                            @endfor

                                        </div><br/>

                                    @endfor
                                </ol>
                            </div>
                        </div>
                    </div>
                    <?php $i++; ?>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('post-script')

    <script>

        ////////Monta o relatório via ajax de cada jogador na div oculta/////////
        function MeuMetodo(inteiro){

            $('#direct_result_'+inteiro).empty();
            id = $('#mais_'+inteiro).val();
            if($('#display_'+inteiro).css('display') == 'none'){

                $('#direct_result_'+inteiro).append(
                    "<h3>Respostas</h3>"
                )

                $.get("{{ url('/dropdown')}}",
                    { id: id},
                    function(data) {
                        $.each(data, function(key, element) {
                            a = element['is_correct'];
                            ini = element['dt_ini'];
                            fim = element['dt_fim'];
                            if( a == true){
                                $('#direct_result_'+inteiro).append(

                                    "<label>"+element['question'] +"</label> R: "+element['answer']+"    <span class='label h4 bg-green'><i class='fa fa-check'></i> </span><br/>"
                                );
                            }
                            else{
                                $('#direct_result_'+inteiro).append(
                                    "<label>"+element['question'] +"</label> R: "+element['answer']+"    <span class='label h4 bg-red'><i class='fa fa-close'></i> </span><br/>"
                                );
                            }
                        });

                        $('#direct_result_'+inteiro).append(
                            "<br/><br/><labe><strong>Inicio:</strong> "+ini+"</label><br><labe><strong>Fim:</strong> "+fim+"</label>"
                        )
                    });
            }
        }

    </script>
@endsection