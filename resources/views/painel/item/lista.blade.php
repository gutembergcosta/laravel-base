@extends('painel.layouts.layout-painel')

@section('pagina')
<div class="row area-btn-novo">
    <div class="col-md-12">
        <a href="{{ $pagina }}/novo" class="btn btn-success btn-xs"> 
            <i class="fas fa-plus-circle"></i> Novo 
        </a>

    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Páginas</h3>
            </div>
            <div class="panel-body">
                <div class="">
                    <table class="table table-bordered tabela">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th style="width: 80px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lista as $item)
                                <tr id="linha-{{ $item->id}}">
                                    <td><a class="tb_link" href="{{$pagina}}/edit/{{ $item->id}}">{{  $item->nome }}</a> </td>
                                    <td>
                                        <a data-url="{{$pagina}}/destroy/{{ $item->id}}" class="btn btn-danger btn-xs deletar">
                                            Excluir
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Páginas</h3>
            </div>
            <div class="panel-body">
                <div class="">
                    <table id="datatable" class="table table-bordered tabela">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th style="width: 80px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lista as $item)
                                <tr id="linha-{{ $item->id}}">
                                    <td><a class="tb_link" href="{{$pagina}}/edit/{{ $item->id}}">{{  $item->nome }}</a> </td>
                                    <td>
                                        <a data-url="{{$pagina}}/destroy/{{ $item->id}}" class="btn btn-danger btn-xs deletar">
                                            Excluir
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <script>
                        $(document).ready(function () {
                            $('#datatable').DataTable({
                                
                                language: {
                                    url:"{{url('assets/datatable/pt_br.json')}}",
                                
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Páginas</h3>
            </div>
            <div class="panel-body">
                <div class="">
                    <table id="yajra-datatable" class="table table-bordered tabela">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th style="width: 80px"></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                    <script type="text/javascript">
                        $(function () {
                      
                            var table = $('#yajra-datatable').DataTable({
                                language: {
                                    url:"{{url('assets/datatable/pt_br.json')}}",
                                },
                                processing: true,
                                serverSide: true,
                                ajax: "{{ route('item.datatable') }}",
                                columns: [
                                    {data: 'link', name: 'link'},
                                    {
                                        data: 'action', 
                                        name: 'action', 
                                        orderable: false, 
                                        searchable: false
                                    },
                              ]
                          });
                      
                        });
                      </script>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
