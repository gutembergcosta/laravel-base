@extends('painel.layouts.layout-painel')

@section('pagina')
<div class="row area-btn-novo">
    <div class="col-md-12">
        <a href="{{$pagina}}/novo" class="btn btn-success btn-xs"> 
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
                                <th style="width: 80px">Email</th>
                                <th style="width: 80px">Cadastro</th>
                                <th style="width: 80px">Tipo</th>
                                <th style="width: 80px">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lista as $item)
                                <tr id="linha-{{$item->id}}">
                                    <td><a class="tb_link" href="{{$pagina}}/edit/{{ $item->id}}">{{  $item->name }}</a> </td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->databr }}</td>
                                    <td>{{ $item->tipo }}</td>
                                    <td>{!! $item->status !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
