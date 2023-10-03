<!-- index.blade.php -->

@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
    @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}  
        </div><br />
    @endif

    <div class="mb-3">
        <a href="{{ route('post.novo')}}" class="btn btn-success">Novo</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
            <td>ID</td>
            <td>Nome</td>
            <td>Info</td>
            <td colspan="2">Action</td>
            </tr>
        </thead>
        <tbody>
            @foreach($lista as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->nome}}</td>
                <td>{{$item->info}}</td>
                <td style="width: 80px">
                    <a href="{{ route('post.show', $item->id)}}" class="btn btn-primary">Edit</a>
                </td>
                <td style="width: 80px">
                    <form action="{{ route('post.delete', $item->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
<div>
@endsection