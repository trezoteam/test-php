@extends('theme.base')

@section('title')
    Início
@endsection

@section('content')
    <div class="row">
        @foreach($quiz as $q)
            <div class="col-md-3">
                <div class="card-group">
                    <div class="card">
                        <img class="card-img-top" src="{{asset('img/question.png')}}">
                        <div class="card-body">
                            <h4 class="card-title">{{$q->name}}</h4>
                            <p class="card-text" title="{{$q->description}}">{{substr($q->description,0, 39)}}...</p>
                            <p class="card-text">
                                @if(Session('name') && Session('email') != null)
                                    <a href="{{route('quiz.answer', $q->id)}}" class="btn btn-sm btn-flat btn-primary">Responder</a>
                                @else
                                    <button type="button" data-id="{{$q->id}}" class="btn btn-sm btn-flat btn-primary answerQuiz" data-toggle="modal">
                                        Responder
                                    </button>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        @include('Site.Quiz.modal.user_email')
    </div>
@endsection

@section('js')
    <script>
        $(".answerQuiz").click(function () {
           var quiz_id = $(this).data('id');
            $("#quiz_id").val(quiz_id);
            $("#userEmailModal").modal();
        });

        $("#storeUser").click(function() {
            if($("#nameUserQuiz").val() == '' || $("#emailUserQuiz").val() == '') {
                $("#errorMessage").show();
                return false;
            } else {
                $("#errorMessage").hide();
                $("#indentify").submit();
            }
        });
    </script>
@endsection