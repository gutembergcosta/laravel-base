{% extends "painel/layouts/layout-painel.htm" %}


{% block pagina %}

<div class="row">
    <form id="formulario" class="formulario" action="baseUrladmin/salvar-artigo" method="post">

        <input type="hidden" name="_token" value="JKzgDdlUsZu8h6YhYCiBAfOd3Q5QNh6teCJaV2zy">
        <input type="hidden" name="id" value="34"> <input type="hidden" name="ref" value="6256a4658a6d9">
        <input type="hidden" name="action" value="edit">


        <div class="col-md-9 area">

            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Formulário</h3>
                </div>
                <div class="panel-body">

                    <div id="msgz"></div>

                    <div class="row">
                        <div class="form-group col-md-8">
                            <label>Nome:</label>
                            <input type="text" class="form-control" name="nome" value="Título do artigo 32"
                                data-dashlane-rid="958dab9526be34fa" data-form-type="other">
                        </div>

                        <div class="form-group col-md-12">
                            <label>Texto:</label>
                            <textarea id="texto" class="form-control editorx" placeholder="textarea"
                                rows="12">{texto}</textarea>
                        </div>

                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary" data-dashlane-rid="6829adbf4e8f46e6"
                                data-dashlane-label="true" data-form-type="action">Salvar</button>
                        </div>
                    </div>

                </div>
            </div>

            {{ include('painel/blocos/upload-galeria.htm') }}

            
        </div>

        <div class="col-md-3 side-area">
            {{ include('painel/blocos/upload-destaque.htm') }}
        </div>

    </form>

    <script>
        $(document).ready(function () {

            $("#formulario").submit(function (e) {
                e.preventDefault();

                var data = $(this).serializeArray();
                data.push({
                    name: "texto",
                    value: tinymce.get('texto').getContent()
                });

                $(this).find('[type=submit]').attr('disabled', 'disabled');
                enviaForm(data, $(this).attr('action'));
                $(this).find('[type=submit]').removeAttr('disabled');

            });


        });
    </script>


</div>
{% endblock %}