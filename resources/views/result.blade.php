@extends('templates.portal.index')

@section('content')
<div class="container">
    <div class="row">
        <h1 align="center"><span></span><strong> </strong></h1>
    </div><br/>
    <div id="resultado" class="table-responsive">
        <div class="col-md-2"></div>
        <!--------------- Resultado ----------------->
        <div class="col-md-8"><br/>
        <h1 align="center"><strong>Parabéns!!!</strong></h1>
            <h1 align="center"> Você acertou  <strong>{{$value}}%</strong> do quiz <strong>{{$quiz_name}}</strong>!</h1>
        </div>
        <div class="col-md-2">

        </div>
    </div>
</div>
@endsection