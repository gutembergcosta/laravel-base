@extends('painel.layouts.layout-painel')

@section('pagina')

<div class="row">
    <form id="formulario" class="formulario w-100" action="{{$actionForm}}" method="{{$metodo}}">

        
        <input type="hidden" name="ref" value="{{ $dataForm->ref }}">
        @if(isAdmin())
            <input type="hidden" name="id" value="{{ $dataForm->id }}">
        @endif


        <div class="col-md-12 area">

            <div class="panel">
                <div class="panel-heading d-flex justify-content-between">
                    <h3 class="panel-title">Formulário</h3>
                    @include('painel/blocos/partials/dropdown-delete')
                </div>
                <div class="panel-body">

                    <div id="msgz"></div>

                    <div class="row">
                        <div class="col-md-12">
                            <h4>Dados de acesso</h4>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nome:</label>
                            <input type="text" class="form-control" name="name" value="{{$dataForm->name}}" required>
                        </div>  
    
                        <div class="form-group col-md-6">
                            <label>Email:</label>
                            <input type="text" class="form-control" name="email" value="{{$dataForm->email}}" required>
                        </div>  
                    </div>

                    <div class="row">
                         
                        @if(isAdmin() && auth()->user()->id != $dataForm->id )
                            <div class="form-group col-md-3">
                                <label>Status:</label>
                                <select class="form-control seletor-simples" name="status" data-select="{{$dataForm->status}}" required>
                                    <option value=""></option>
                                    <option value="autorizado">Autorizado</option>
                                    <option value="bloqueado">Bloqueado</option>
                                    <option value="pendente">Pendente</option>
                                </select>
                            </div> 
                        @endif

                        @if($dataForm->id == false)
                            <div class="form-group col-md-4">
                                <label>Email:</label>
                                <input type="password" class="form-control w-100" name="password" value="" required>
                            </div> 
                        @endif

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

            
            @if($dataForm->id)
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Alterar senha</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <a id="abrir-modal-senha" class="btn btn-primary mx-auto">Alterar senha</a>
                        </div>
                        <script>
                            $("#abrir-modal-senha").click(function(){
                                $("#modal-senha input[name='password']").val('');
                                $("#modal-senha").modal();
                            });
                        </script>
                    </div>
                </div>
            @endif
            
        </div>
    </form>


    <div id="modal-senha" class="modal fade " tabindex="-1" role="dialog">
        <div class="modal-dialog mx-auto" role="document" style="max-width: 260px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Alterar senha</h4>
                </div>
                <div class="modal-body">
                    <form id="formulario02" class="formulario d-flex" action="{{route('painel.salvar-senha')}}" method="{{$metodo}}">
                        
                        @if(isAdmin())
                            <input type="hidden" name="id" value="{{ $dataForm->id }}">
                        @endif

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Nova senha:</label>
                                <input type="password" class="form-control w-100" name="password" value="" requiredx>
                            </div>  
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

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