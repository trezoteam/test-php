@extends('templates.portal.index')

@section('content')
    <div class="container">
        <div class="row" ><div class="col-md-2"></div>
            <div class="col-md-4" align="left">
                <div class="box box-info" align="center" id="pergunta" name="pergunta" style="display: block">

                    <h3>Deseja anunciar o seu serviço?</h3>
                    <hr/>
                    <button class="btn btn-success" id="sim" name="sim">SIM</button> <button class="btn btn-Danger" id="nao" name="nao">Não</button>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-info" align="center" id="pergunta" name="pergunta" style="display: block">

                    <h3>Deseja contratar algum serviço?</h3>
                    <hr/>
                    <button class="btn btn-success" id="sim" name="sim">SIM</button> <button class="btn btn-Danger" id="nao" name="nao">Não</button>
                </div>
            </div>
            <div class="col-md-1"></div>

        </div>
    </div>

@endsection