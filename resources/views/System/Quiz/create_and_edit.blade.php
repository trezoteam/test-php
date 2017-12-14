@extends('theme.base')

@section('title')
Criar Quiz
@endsection

@section('content')
    <div class="container">
        @if(isset($quiz))
            <form name="form" method="POST" action="{{route('quiz.update', $quiz->id )}}">
            <input type="hidden" name="_method" value="PUT">
        @else
            <form name="form" method="POST" action="{{route('quiz.store')}}">
        @endif
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group {{ ($errors->has('name') ? 'has-error' : null ) }}">
                        <label for="name" class="control-label">Nome</label>
                        {!! $errors->first('name', '<span class="text-danger"> ( :message )</span>') !!}

                        <input type="text" name="name" value="{{$quiz->name or old('name')}}" class="form-control" placeholder="Nome">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group {{ ($errors->has('description') ? 'has-error' : null ) }}">
                        <label for="description" class="control-label">Desicrção</label>
                        {!! $errors->first('description', '<span class="text-danger"> ( :message )</span>') !!}

                        <textarea class="form-control" name="description" rows="5" placeholder="Descrição do Quiz">{{$quiz->description or old('description')}}</textarea>
                    </div>
                </div>

                <div class="col-md-2">
                    <button type="submit" name="save" class="btn btn-sm btn-flat btn-success">
                        Salvar
                    </button>
                </div>

            </div>
        </form>
    </div>
@endsection