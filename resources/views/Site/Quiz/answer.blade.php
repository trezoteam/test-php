@extends('theme.base')

@section('title')
    Responder Quiz
@endsection

@section('content')
    <div class="text-center">
        <div class="card-block">
            <h4 class="card-title">{{$quiz->name}}</h4>
            <p class="card-text">{{$quiz->description}}</p>
        </div>
    </div>
    <form name="quizanswer" method="POST" action="{{route('quiz.sendQuiz')}}">
        <input type="hidden" name="quiz_id" value="{{$quiz->id}}">
        <div class="row">
            <div class="col-md-10">
                {{csrf_field()}}
                @php $count = 0; @endphp
                @foreach($quiz->questions as $q)
                    @php $count++ @endphp
                    <div class="container" style="padding: 10px 10px 10px 10px;margin:20px;border: 1px solid #b9bbbe;">
                        <p>{{$count}}. {{$q->subject}}</p>
                        @forelse($q->answer as $qa)
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="radio" value="{{$qa->answer}}" name="questions[{{$q->id}}]">{{$qa->answer}}
                                </div>
                            </div>
                        @empty
                            <div class="form-group">
                                <input type="text" name="questions[{{$q->id}}]" class="form-control">
                            </div>
                        @endforelse
                    </div>
                @endforeach
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <input type="submit" class="btn btn-sm btn-flat btn-success pull-right" name="sendQuiz" value="Enviar Quiz">
                </div>
            </div>
        </div>
    </form>
@endsection