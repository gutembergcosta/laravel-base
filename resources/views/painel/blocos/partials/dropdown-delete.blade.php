@if(isset($dataForm->id) && $permiteExcluir)
<div class="dropdown dropdown-menu-lateral ">
    <button class="btn dropdown-toggle" type="button" id="dropdownMenu-options01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        <i class="fas fa-ellipsis-v"></i>
    </button>
    <ul class="dropdown-menu " aria-labelledby="dropdownMenu-options01" style="min-width: 110px;left: -74px;" >
        <li>
            <a data-url="{{$pagina}}/destroy/{{$dataForm->id}}" data-id="{{$dataForm->id}}" data-destino="{{$pagina}}" class="deletar text-danger" >
                <small>
                    <i class="far fa-times-circle"></i>
                </small>Excluir
            </a>
        </li>
    </ul>
</div>
@endif