

@php
    $uid = uniqid();
@endphp


<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{$titulo}}</h3>
    </div>
    <div class="panel-body" id="hg-{{ $uid  }}">

        <div id="img-destaque-{{ $uid }}">Upload </div>

        <div class="row">
            <div class="col-md-12 _item @if(!$urlImgMax) {{'hide'}} @endif ">
                <div>
                    <a class="link-img" data-fancybox="destaque" href="{{ $urlImgMax ?? ''}}">
                        <img class="total" src="{{ $urlImgMini ?? ''}}">
                    </a>
                </div>
                <div>
                    <a class="remover-arquivo" data-tipo="box" data-item="{{ $img['arquivo'] ?? ''}}">Remover</a>
                </div>
            </div>
        </div>
        {{$img['arquivo'] ?? ''}}
        <script>
            $(document).ready(function () {
                $("#img-destaque-{{$uid}}").uploadFile({
                    url: "{{url('painel/upload')}}",
                    multiple: false,
                    dragDrop: false,
                    acceptFiles: ".jpeg,.png,.jpg",
                    fileName: "myfile",
                    returnType: "json",
                    formData: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        "ref": '{{ $ref}}',
                        "tipo": '{{ $tipo}}',
                        "unico": '{{ $arquivoUnico}}'
                    },
                    onSuccess: function (files, data, xhr, pd) {

                        let box = '#hg-{{$uid}}';

                
                        console.log(data);

                        $(box).find('.link-img').attr('href', `${data['max']}`);
                        $(box).find('img').attr('src', `${data['miniatura']}`);
                        $(box).find('.remover-arquivo').attr('data-item',`${data['arquivo']}`);

                        $(box).find('._item').removeClass('hide').fadeIn(300);


                    },
                    afterUploadAll: function (obj) {
                        $(".ajax-file-upload-container").html('');
                    },

                });
            });
        </script>

    </div>
</div>