<div id="modal-item" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <p>Aguarde...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<script>
    function enviaForm(dataform, destino, metodo) {

        if(!metodo) return;
       
        $.ajax({
            url: destino,
            type: metodo,
            dataType: "json",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: dataform,
            success: function (data) {
                if (data['msg']) alert(data['msg']); $("#msgz").text('');
                if (data['tipo']=='modal-close') $('.modal').modal('hide');
                if (data['excluido']) return 1;
                if (data['errors']) msgAlerta(data);
                if (data['destino']) {
                    if (data['destino'] == 'reload') {
                        location.reload();
                    } else {
                        window.location.href = data['destino'];
                    }
                }
            },
            error: function (data) {
                msgAlerta(JSON.parse(data.responseText))
            },
            complete: function (data) {
                preloader('remove'); 
            }
        });
    }

    function blocoErroMsg(msg) {
        return `<li><strong>${msg}</strong></li>`;
    }
    function blocoListMsg(msg) {
        return `<li class='text-danger font-weight-bold mb-1'><i class="far fa-times-circle"></i> ${msg}</li>`;
    }

    

    function msgAlerta(matriz) {

        let tipo = matriz.tipo;

        if(tipo == 'html'){
            let divHtml = '';

            Object.values(matriz.errors).forEach(val => {
                divHtml += blocoErroMsg(val)
            });

            let alertHtml = `<div class='alert alert-danger alert-dismissible'>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            <ul>
                                ${divHtml}
                            </ul>
                         </div>`;
            $("#msgz").text('').html(alertHtml);
            alert('Erro');
            gotop();
        }

        if(tipo == 'alert'){
            alert(matriz.msg);
            if(matriz.destino){
                window.location.href = matriz.destino;
            }

        }

        if(tipo == 'modal'){

            let modalConfig = {
                'nome': 'Alerta',
                'size': 400,
            }

            let divHtml = '';
            Object.values(matriz.errors).forEach(val => {
                divHtml += blocoListMsg(val)
            });
            let textoModal = `<ul>${divHtml}</ul>`;
            abrirModal(textoModal,modalConfig);                
        }
    }

    
        $(document).on('click', '.remover-arquivo', function () {
            if (confirm("Deseja realmente deletar este item?") == true) {

                let excluido = 0;

                if ($(this).data('item')) {
                    $.ajax({
                        url: "url(painel/deletar-arquivo/)"+$(this).data('item'),
                        dataType: "json",
                        async: false,
                        type: "DELETE",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        success: function (data) {
                            if (data == 1) {
                                excluido = 1;
                            } else {
                                alert("Erro");
                            }
                        },
                        error: function () {
                            alert("Erro");
                        }
                    });
                }

                if (excluido == 1) {
                    $(this).closest('._item').fadeOut(300);
                    return;
                }

            }
        });
    

    function deletarUrl(url,destinoUrl=false){
        $.ajax({
            url: url,
            type: 'DELETE',
            dataType: "json",
            async: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                alert(data.msg);
                if (data.destino){
                    if (data.destino == 'reload')location.reload();
                    destinoUrl = data['destino'];
                }
                if (destinoUrl) window.location.href = destinoUrl;
            },
            error: function () {
                alert("Erro");
            }
        });
    }

    $(document).on('click', '.deletar', function () {
        if (confirm("Deseja realmente deletar este item?") == true) {
            var linha = $(this).closest('tr');
            deletarUrl($(this).data('url'),$(this).data('destino'));
            linha.fadeOut(300);
            return;   
        }
    });

    $(document).on('click', '.deletar-linha', function () {
        if (confirm("Deseja realmente deletar este item?") == true) {
            var linha = $(this).closest('tr');
            deletarUrl($(this).data('url'));
            linha.fadeOut(300);
            return;   
        }
    });

    $(".seletor-simples").map(function () {

        let selecionado = $(this).data('select');
        if (selecionado) $(this).val(selecionado)

    });


    $(".seletor-radio").map(function () {

        let selecionado = $(this).data('select');
        if (selecionado) $(this).val(selecionado);
        if (!selecionado) return;

        $(this).find("[value=" + selecionado + "]").prop('checked', true);

        //$("input[name="+nome_radio+"][value=" + selecionado + "]").prop('checked', true);

    });


    function abrirModal(html,config){

        $("#modal-item .modal-footer").removeClass('hide');


        if(config.size) $("#modal-item .modal-dialog").removeAttr('style').css('max-width', config.size+'px' );
        if(config.hideFooter) $("#modal-item .modal-dialog").removeAttr('style').css('max-width', config.size+'px' );

        if(config.tipo == 'formulario'){
            $("#modal-item .modal-footer").addClass('hide');
            $("#modal-item").attr('data-backdrop', 'static').attr('data-keyboard', 'false');
        }
        if(config.altura){
            let altura = config.altura+'px';
            $("#modal-item").css('max-height', altura);
        }

        

        $("#modal-item .modal-title").text('').text(config.nome);
        $("#modal-item .modal-body").text('').html(html);
        $("#modal-item").modal();
    }

                        

</script>


