@extends('painel.layouts.layout-painel')

@section('pagina')

<div class="row">
    <form id="formulario" class="formulario w-100" action="{{$actionForm}}" method="{{$metodo}}">


        <div class="col-md-12 area">

            <div class="panel">
                <div class="panel-heading d-flex justify-content-between">
                    <h3 class="panel-title">Formulário</h3>
                    @include('painel/blocos/partials/dropdown-delete')
                </div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-12">
                            <h4>Dados de acesso</h4>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nome:</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>  
    
                        <div class="form-group col-md-6">
                            <label>Email:</label>
                            <input type="text" class="form-control" name="email" required>
                        </div>  
                    
                        <div class="form-group col-md-3">
                            <label>Status:</label>
                            <select class="form-control seletor-simples" name="status" required>
                                <option value=""></option>
                                <option value="autorizado">Autorizado</option>
                                <option value="bloqueado">Bloqueado</option>
                            </select>
                        </div> 
                        <div class="form-group col-md-3">
                            <label>Senha:</label>
                            <input type="password" class="form-control w-100" name="password" value="" required>

                        </div> 
                    </div> 
                        

                    <div class="row">
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 side-area">
            {!! $blocoImgDestaque !!}

            
            
        </div>
    </form>


  

    <script>
        $(document).ready(function () {

            $("#formulario").submit(function (e) {
                e.preventDefault();

                var data = $(this).serializeArray();

                $(this).find('[type=submit]').attr('disabled', 'disabled');
                enviaForm(data, $(this).attr('action'),$(this).attr('method'));
                $(this).find('[type=submit]').removeAttr('disabled');

            });

            $("#formulario02").submit(function (e) {
                e.preventDefault();

                var data = $(this).serializeArray();

                $(this).find('[type=submit]').attr('disabled', 'disabled');
                enviaForm(data, $(this).attr('action'),$(this).attr('method'));
                $(this).find('[type=submit]').removeAttr('disabled');

            });


        });
    </script>


</div>
@endsection