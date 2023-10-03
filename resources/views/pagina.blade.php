<!-- create.blade.php -->

@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
    width: 400px;
  }
</style>
<div class="card uper ">
    <div class="card-header">
        Formulário
    </div>
    <div class="card-body ">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br />
        @endif
        <form class="" method="post" action="{{ $actionForm }}">

            @isset($item['id']) 
                @method('PUT')
                <input type="hiddenx" name="id" value="{{ $item['id'] }}"> 
            @endisset
            
            <div class="form-group">
                @csrf
                <label>Nome:</label>
                <input type="text" class="form-control" name="nome" value="{{ $item->nome ?? '' }}" />
            </div>
            <div class="form-group">
                <label>Info :</label>
                <input type="text" class="form-control" name="info" value="{{ $item->info ?? '' }}" />
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</div>
@endsection