@extends('theme.base')

@section('title')
Criar Perguntas
@endsection

@section('content')
    <div class="container">
        @if(isset($question))
            <form name="form" method="POST" action="{{route('question.update', $question->id)}}">
            <input type="hidden" name="_method" value="PUT">
        @else
            <form name="form" method="POST" action="{{route('question.store')}}">
        @endif
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group {{ ($errors->has('subject') ? 'has-error' : null ) }}">
                        <label for="subject" class="control-label">Pergunta</label>
                        {!! $errors->first('subject', '<span class="text-danger"> ( :message )</span>') !!}

                        <input type="text" name="subject" value="{{$question->subject or old('subject')}}" id="answer" class="form-control" placeholder="Pergunta">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="quiz_id" class="control-label">Quiz da Pergunta</label>

                        <select name="quiz_id" class="form-control">
                            @foreach($quiz as $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="type" class="control-label">Tipo da Pergunta</label>
                        <select name="type" class="form-control" id="type">
                            <option value="1">Múltipla Escolha</option>
                            <option value="2">Caixa de Texto</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="multiple-choose">
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label for="answer" class="control-label">Resposta</label>
                            <input type="text" name="answer" placeholder="Resposta" class="form-control" id="inputAnswer">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="checkbox" class="form-control" name="is_correct" id="is_correct" style="margin-top:31px;"> está Correta?
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <button type="button" name="addAnswer" class="btn btn-flat btn-primary" id="addAnswer" style="margin-top:31px;">Adicionar</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table" id="answer_table">
                            <thead>
                            <tr>
                                <th scope="col">Resposta</th>
                                <th width="20%" scope="col">Operações</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(isset($question))
                                    @foreach($question->answer as $an)
                                        <tr id="answer{{$an->id}}">
                                            <td>{{$an->answer}}
                                                <input type="hidden" name="answers[{{$an->id}}][answer]" value="{{$an->answer}}">
                                                <input type="hidden" name="answers[{{$an->id}}][is_correct]" value="{{$an->is_correct}}">
                                            </td>
                                            <td>
                                                <button type="button" onclick="removeAjax($(this),{{$an->id}})" class="btn btn-sm btn-flat btn-danger" name="deleteAnswer" id="deleteAnswer">
                                                    Deletar
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <button type="submit" name="save" id="saveQuestion" class="btn btn-sm btn-flat btn-success">
                    Salvar
                </button>
            </div>
        </form>
    </div>
@endsection
@section('js')
    <script>
        typeSelect();
        verifyTable();

        function verifyTable() {
            if($("#type").val() == '1') {
                if ($("#answer_table > tbody > tr").length >= 1)
                    $("#saveQuestion").removeAttr('disabled');
                else
                    $("#saveQuestion").attr('disabled', 'disabled');
            } else {
                $("#saveQuestion").removeAttr('disabled');
            }
        }

        $("#type").change(function () {
            typeSelect();
        });

        $("#addAnswer").click(function() {
            if($("#inputAnswer").val() != '')
                addAnswer();
            else
                alert('Preencha a Respsta Antes de Adicionar!');
        });

        function typeSelect(select) {
            if($("#type").val() == '1') {
                $(".multiple-choose").show();
                verifyTable();
            } else {
                $(".multiple-choose").hide();
                verifyTable();
            }
        }

        function addAnswer() {
            var answer = $("#inputAnswer").val();
            var is_correct = $("#is_correct").is(":checked");

            console.log(is_correct);

            var count = $("#answer_table > tbody").children().length + 1;

            var html = '<tr id="answer'+count+'">'+
                        '<td>'+answer+'</td>' +
                        '</td>' +
                        '<td>' +
                            '<a href="#" onclick="remover($(this))" data-toggle="tooltip" title="Remover" class="btn btn-danger btn-sm btn-flat">Remover</i>' +
                        '</td>' +
                        '<input type="hidden" name="answers['+count+'][answer]" value="'+answer+'">' +
                        '<input type="hidden" name="answers['+count+'][is_correct]" value="'+is_correct+'">'+
                        '</tr>';

            $("#answer_table tbody").append(html);
            $("#answer").attr('readonly','readonly');

            $("#inputAnswer").val('');

            verifyTable();
        }

        function remover(item) {
            var tr = $(item).closest('tr');
            tr.remove();
            verifyTable();
        }

        function removeAjax(item, answer_id) {
            $.ajax({
                type: "POST",
                url: '{{ route('question.destoyAnswer') }}',
                data: {
                    answer_id: answer_id
                },
                success: function (obj) {
                    var tr = $(item).closest('tr');
                    tr.remove();
                },
                erro: function (obj) {

                }
            });
            verifyTable();
        }
    </script>
@endsection