@extends('templates.portal.index')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong> Preencher informações necessárias</strong></div>

                    <div class="panel-body">
                        <!--------------- Form de criar jogador----------------->
                        <form class="form-horizontal" method="POST">

                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Nome</label>
                                <input type="hidden" name="quiz_id" value="{{$id}}">
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="" required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" required>
                                </div>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button class="btn btn-success"  type="submit" formaction="../play">Começar o jogar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection