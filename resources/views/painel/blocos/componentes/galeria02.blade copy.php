{% set uid = random() %}

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{titulo}}</h3>
    </div>
    <div class="panel-body">

        <div class="total left">

            <div id="fileuploader-{{tipo}}">Upload</div>

            <div>
                <p>{{texto}}</p>
            </div>

            <div class="hayagal">

                <div class="row" id="galeria-{{tipo}}">
                    {% for item in galeria %}
                        <div class="col-xs-6 col-md-3 _item">
                            <div>
                                <a class="link-img" data-fancybox="gallery" href="{{baseUrl}}uploads/max-{{item.arquivo}}">
                                    <img class="total" src="{{baseUrl}}uploads/thumb-{{item.arquivo}}">
                                </a>
                            </div>
                            <div>
                                <a class="remover-arquivo" data-item="{{item.arquivo}}">Remover</a>
                            </div>
                        </div>
                    {% endfor %}
                </div>

            </div>

        </div>

        <script>
            $(document).ready(function () {
                $("#fileuploader-{{tipo}}").uploadFile({
                    url: "{{baseUrl}}painel/upload",
                    multiple: true,
                    dragDrop: true,
                    maxFileCount: 20,
                    acceptFiles: ".jpg,.jpeg,.png",
                    fileName: "myfile",
                    returnType: "json",
                    formData: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        "ref": "{{ref}}",
                        "tipo": "{{tipo}}",
                    },
                    onSuccess: function (files, data, xhr, pd) {

                        let template = $("#box-galeria-01").clone().removeAttr('id').removeClass('hide');

                        template.find('.link-img').attr('href', `${data['max']}`);
                        template.find('img').attr('src', `${data['miniatura']}`);
                        template.find('.remover-arquivo').attr('data-item',`${data['arquivo']}`);
                        template.find('._item').fadeIn(300);

                        $("#galeria-{{tipo}}").append(template);

                    },
                    afterUploadAll: function (obj) {
                        $(".ajax-file-upload-container").html('');
                    },

                });
            });
        </script>

    </div>
</div>