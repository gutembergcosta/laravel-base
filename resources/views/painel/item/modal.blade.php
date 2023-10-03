<div class="row">
    <form id="form-modal"  action="{{actionForm}}" method="post">

        
        <input type="hidden" name="ref" value="{{ dataForm.ref }}">
        <input type="hidden" name="id" value="{{ dataForm.id }}">
        <input type="hidden" name="tipo" value="{{ dataForm.tipo }}">

        <div class="form-group col-md-6  ">
            <label>Nome:</label>
            <input type="text" class="form-control" name='nome' value='{nomeItem}'>
        </div>

        <div class="form-group col-md-3 ">
            <label>Categorias:</label>
            <select class="form-control" name='categoria'>

                <option value=""></option>
                {categoriasItem}
                    <option value="{id}" {selected} >{nome}</option>
                {/categoriasItem}

            </select>
        </div>

        <div class="form-group col-md-12">
            <label>Texto:</label>
            <textarea id="texto" class="form-control editorx" placeholder="textarea" rows="12"  >{texto}</textarea>
        </div>

        <div class="form-group col-md-12">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>

    </form>

    <script>
        $(document).ready(function () {
            $("#form-modal").submit(function (e) {
                e.preventDefault();
                var data = $(this).serializeArray();
                data.push({name: "texto",value: tinymce.get('texto').getContent()});
                $(this).find('[type=submit]').attr('disabled', 'disabled');
                enviaForm(data, $(this).attr('action'));
                $(this).find('[type=submit]').removeAttr('disabled');
            });

        });
    </script>


</div>
