@extends('templates.portal.index')
<style>
    .title{
        color:red;
    }
</style>
@section('content')
<div class="container">
    <div class="row">
        <h1 align="center"><b class="title">Q</b>uiz</h1>
    </div><br/>
    <div id="resultado" class="table-responsive">
        <div class="col-md-12">
            <!--------------- Monta quiz----------------->
            @foreach($quiz as $value)
                <div class="box box-default box-solid collapsed-box">

                    <div class="box-header with-border">
                        <!--------------- Nome do quiz----------------->
                        <h3 class="box-title"><strong>{{$value->name}}</strong> </h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="box-body" style="display: none;">
                        <div class="col-md-11">
                            <!--------------- Descrição do quiz ----------------->
                            <b>Descrição : </b>{{$value->description}}
                        </div>
                        <form >
                            <div class="col-md-1">
                                <button class="btn btn-success" type="submit" formaction="../public/account/{{$value->id}}">Jogar</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection