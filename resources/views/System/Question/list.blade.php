@extends('theme.base')

@section('title')
    Perguntas Cadastradas
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <a href="{{route('question.create')}}" class="btn btn-sm btn-flat btn-primary pull-right">Nova</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Pergunta</th>
                        <th scope="col">Quiz Atrelado</th>
                        <th scope="col">Tipo da Pergunta</th>
                        <th scope="col">Operações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($questions as $q)
                        <tr>
                            <td>{{$q->subject}}</td>
                            <td>{{$q->quiz->name}}</td>
                            <td>{{$q->typeLabel}}</td>
                            <td>
                                <form method="POST" action="{{route('question.destroy', $q->id)}}">
                                    {{csrf_field()}}
                                    {{ method_field('DELETE') }}
                                    <a href="{{route('question.edit', $q->id)}}" class="btn btn-sm btn-flat btn-info">Editar</a>
                                    <button type="submit" class="btn btn-sm btn-flat btn-danger">Excluir</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection