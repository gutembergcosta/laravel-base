@extends('painel.layouts.layout-painel')

@section('pagina')

<div class="row">
    <form id="formulario" class="formulario" action="{{$actionForm}}" method="{{$metodo}}">

        
        <input type="hidden" name="ref" value="{{ $dataForm->ref ?? $ref }}">
        <input type="hidden" name="id" value="{{ $dataForm->id ?? '' }}">


        <div class="col-md-12 area">

            <div class="panel">
                <div class="panel-heading d-flex justify-content-between">
                    <h3 class="panel-title">Formulário</h3>
                    
                    @include('painel/blocos/partials/dropdown-delete')
  
                </div>
                <div class="panel-body">

                    <div id="msgz"></div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Nome:</label>
                            <input type="text" class="form-control" name="nome" value="{{ $dataForm->nome ?? '' }}" requiredx>
                        </div>  
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Texto:</label>
                            <textarea id="texto" class="form-control editorx" placeholder="textarea" rows="12">{{ $dataForm->texto ?? ''}}</textarea>
                        </div>

                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </div>

                </div>

                
            </div>

            {!! $blocoGaleria !!}
            
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
                
                data.push({name: "texto",value: tinymce.get('texto').getContent()});

                $(this).find('[type=submit]').attr('disabled', 'disabled');
                enviaForm(data, $(this).attr('action'),$(this).attr('method'));
                $(this).find('[type=submit]').removeAttr('disabled');

            });


        });
    </script>


</div>
@endsection