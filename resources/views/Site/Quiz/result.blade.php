@extends('theme.base')

@section('title')
    Resultado
@endsection

@section('content')
    <div class="text-center">
        <div class="card-block">
            <h4 class="card-title">{{$quiz->name}} - Resultado</h4>
            <p class="card-text">{{$quiz->description}}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>Perguntas Respondidas: {{$answers_count}}</h3>
        </div>
        <div class="col-md-12">
            <h3>Acertos: {{$hits}}</h3>
        </div>
        <div class="col-md-12">
            <h3>Erros: {{$errors}}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10">
            @php $count = 0; @endphp
            @foreach($quiz->questions as $q)
                @php $count++ @endphp
                <div class="container" style="padding: 10px 10px 10px 10px;margin:20px;border: 1px solid #b9bbbe;">
                    <p>{{$count}}. {{$q->subject}}</p>
                    @forelse($q->answer as $qa)
                        @foreach($answers as $key => $value)
                            @if($key == $q->id)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        @if($qa->is_correct && $qa->answer == $value)
                                            <div class="com-md-12" style="background: #a3ff8b; padding: 10px;">
                                                <input type="radio" disabled value="{{$qa->answer}}" name="questions[{{$q->id}}]">{{$qa->answer}}
                                            </div>
                                        @else
                                            @if($qa->answer == $value)
                                                <div class="com-md-12" style="background: red; padding: 10px;">
                                                    <input type="radio" checked disabled value="{{$qa->answer}}" name="questions[{{$q->id}}]">{{$qa->answer}}
                                                </div>
                                            @else
                                                @if($qa->is_correct)
                                                    <div class="com-md-12" style="background: #a3ff8b; padding: 10px;">
                                                        <input type="radio"  disabled value="{{$qa->answer}}" name="questions[{{$q->id}}]">{{$qa->answer}}
                                                    </div>
                                                @else
                                                    <input type="radio"  disabled value="{{$qa->answer}}" name="questions[{{$q->id}}]">{{$qa->answer}}
                                                @endif
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @empty
                        <div class="form-group">
                            @foreach($answers as $key => $value)
                                @if($key == $q->id)
                                    <input type="text" disabled  value="{{$value}}" name="questions[{{$q->id}}]" class="form-control">
                                @endif
                            @endforeach
                        </div>
                    @endforelse
                </div>
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a href="{{route('site.index')}}" class="btn btn-sm btn-flat btn-primary pull-right">Voltar</a>
        </div>
    </div>
@endsection