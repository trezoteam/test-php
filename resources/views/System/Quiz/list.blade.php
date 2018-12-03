@extends('theme.base')

@section('title')
    Listar Quiz
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <a href="{{route('quiz.create')}}" class="btn btn-sm btn-flat btn-primary pull-right">Novo</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th width="20%" scope="col">Operações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($quiz as $q)
                            <tr>
                                <td>{{$q->name}}</td>
                                <td>
                                    <form method="POST" action="{{route('quiz.destroy', $q->id)}}">
                                        {{csrf_field()}}
                                        {{ method_field('DELETE') }}
                                        <a href="{{route('quiz.edit', $q->id)}}" class="btn btn-sm btn-flat btn-info">Editar</a>
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