@extends('templates.portal.index_adm')

@section('content')

<!-- DataTAbles - CSS ---->
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.0/css/responsive.bootstrap4.min.css">

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2 align="left"><strong>Criar Quiz</strong></h2><br/><br/>
        </div>
        <!--------------- Alerta----------------->
        <div class="col-md-4">
            <div class="flash-message">

                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))

                        <div class="alert alert-{{ $msg }}">
                            {{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        </div>
                    @endif
                @endforeach

            </div>
        </div><br><br><br><br><br><br>
        <!--------------- Form criar quiz----------------->
        <form method="POST">
            <div class="col-md-4">
                <label>Título</label>
                <input class="form-control" name="quiz_name" id="quiz_name" required>
            </div>
            <div class="col-md-6">
                <label>Descrição</label>
                <input class="form-control" name="quiz_desc" id="quiz_desc" required>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary btn-lg" formaction="../public/add_quiz" type="submit" style="margin-top: 15px">Criar</button>
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>
    </div><br/><br/><br/>
    <!--------------- Lista informações do quiz----------------->
    <table id="example" class="table table-bordered table-hover display responsive no-wrap">
            <thead>
            <tr>
                <th>Título</th>
                <th>Descrição</th>
                <th>Qtd. Perguntas</th>
                <th>Data de Criação</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            @if (count($value) > 0)
                @foreach ($value as $value)

                    <tr>
                        <td>{{$value->name}}</td>
                        <td>{{$value->description}}</td>
                        <td>{{$value->qtd}}</td>
                        <td>{{date('d-m-Y h:m:s', strtotime($value->created_at))}}</td>
                        <td>
                            <a href="../public/edit_quiz/{{$value->id}}"><button class="btn btn-success">Editar</button></a>
                            <a href="../public/delete_quiz/{{$value->id}}" ><button class="btn btn-danger" >Excluir</button></a>
                            <a href="../public/result/{{$value->id}}" ><button class="btn btn-info" >Relatório</button></a>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
    </table>
</div>
@endsection
@section('post-script')
    <!-- DataTAbles - JS ---->
    <script src="https://cdn.datatables.net/responsive/2.2.0/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.0/js/dataTables.responsive.min.js"></script>



    <script>
        ////////datatables/////////
       $(document).ready(function() {
           $('#example').DataTable({
               'paging'      : true,
               'lengthChange': false,
               'ordering'    : true,
               'info'        : true,
               'autoWidth'   : false,
               'responsive': true
           });
       } );

    </script>
@endsection