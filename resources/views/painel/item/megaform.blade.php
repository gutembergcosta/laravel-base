@extends('painel.layouts.layout-painel')

@section('pagina')

<div class="row">
    <form id="formulario" class="formulario" action="" method="post">

        
        <input type="hidden" name="ref" value="">
        <input type="hidden" name="id" value="">
        <input type="hidden" name="tipo" value="">


        <div class="col-md-12 area">

            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Formulário</h3>
                </div>
                <div class="panel-body">

                    <div id="msgz"></div>

                    <div class="row">
                        <div class="form-group col-md-8">
                            <label>Nome:</label>
                            <input type="text" class="form-control" name="nome" value="" required>
                        </div>
                        <div class="form-group col-md-3 wd-150">
                            <label>Preço:</label>
                            <input type="text" class="form-control realFomato" name="preco" value="" required>
                        </div>

                    </div>

                    <div class="row">
                            <div class="form-group col-md-3 wd-200">
                                <label>Categorias:</label>
                                <select class="form-control seletor-simples" name='categoria_id' data-select="01">
                                    <option value="00">00</option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                </select>
                            </div>
                        <div class="form-group col-md-5">
                            <label>Cidade:</label>
                            <input type="text" class="form-control" name="cidade" value="" required>
                        </div>
                        <div class="form-group col-md-3 wd-220">
                            <label>Estado:</label>
                            <select class="form-control seletor-simples" name='uf' data-select="">

                                <option value=""></option>

                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Texto:</label>
                            <textarea id="texto" class="form-control editorx" placeholder="textarea" rows="12"></textarea>
                        </div>

                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </div>

                </div>
            </div>

            {!! $blocoGaleria !!}

            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Mega Form</h3>
                </div>
                <div class="panel-body">

                    <div id="msgz"></div>

                    <input type="hidden" name="token" value="{token}" >
                    <input type="hidden" name="action" value="{action}" >
                    
                    <div class='row'>
                        <div class="form-group col-md-6  wd-300">
                            <label>Nome:</label>
                            <input type="text" class="form-control" name='nome' value='{nomeItem}'>
                        </div>

                        <div class="form-group col-md-3 wd-200">
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
                    

                        <div class="form-group col-md-4">
                            <label>Número:</label>
                            <input type="text" class="form-control" onkeypress="return isNumberKey(event)"
                                placeholder="text field">
                        </div>

                        <div class="form-group col-md-4">
                            <label>Moeda:</label>
                            <input type="text" class="form-control money" placeholder="text field">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Date Picker:</label>
                            <input type="text" name="data-br" class="form-control datepicker-here" data-language='pt-BR' autocomplete="off" data-position="bottom left">
                        </div>

                        <div class="form-group col-md-4">
                            <label>CPF:</label>
                            <input type="text" class="form-control cpf" placeholder="text field">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Hora:</label>
                            <input type="text" class="form-control hora" placeholder="text field">
                        </div>



                        <div class="form-group col-md-4">
                            <label>Item:</label>
                            <input type="password" class="form-control" value="asecret">
                        </div>

                        <div class="form-group col-md-12">
                            <label>Item:</label>
                            <textarea class="form-control" placeholder="textarea" rows="4"></textarea>
                        </div>

                        <div class="form-group col-md-12">
                            <label>Txto 02:</label>
                            <textarea id="" class="form-control editorx" placeholder="textarea"
                                rows="12"></textarea>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Item:</label>
                            <select class="form-control">
                                <option value="cheese">Cheese</option>
                                <option value="tomatoes">Tomatoes</option>
                                <option value="mozarella">Mozzarella</option>
                                <option value="mushrooms">Mushrooms</option>
                                <option value="pepperoni">Pepperoni</option>
                                <option value="onions">Onions</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Select 2:</label>
                            <select class="form-control js-example-basic-single">
                                <option value="cheese">Cheese</option>
                                <option value="tomatoes">Tomatoes</option>
                                <option value="mozarella">Mozzarella</option>
                                <option value="mushrooms">Mushrooms</option>
                                <option value="pepperoni">Pepperoni</option>
                                <option value="onions">Onions</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Select 2:</label>
                            <select class="form-control js-example-basic-multiple" name="states[]"
                                multiple="multiple">
                                <option value="cheese">Cheese</option>
                                <option value="tomatoes">Tomatoes</option>
                                <option value="mozarella">Mozzarella</option>
                                <option value="mushrooms">Mushrooms</option>
                                <option value="pepperoni">Pepperoni</option>
                                <option value="onions">Onions</option>
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label>Item:</label>
                            <label class="fancy-checkbox">
                                <input type="checkbox">
                                <span>Fancy Checkbox 1</span>
                            </label>
                            <label class="fancy-checkbox">
                                <input type="checkbox">
                                <span>Fancy Checkbox 2</span>
                            </label>
                            <label class="fancy-checkbox">
                                <input type="checkbox">
                                <span>Fancy Checkbox 3</span>
                            </label>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Item:</label>
                            <label class="fancy-radio">
                                <input name="gender" value="male" type="radio">
                                <span><i></i>Male</span>
                            </label>
                            <label class="fancy-radio">
                                <input name="gender" value="female" type="radio">
                                <span><i></i>Female</span>
                            </label>
                        </div>

                        <div class="form-group  col-md-4">
                            <label>Direção:</label>
                            <div class="cks total  left">
                                
                                <label class="ck-button">
                                    <input type="checkbox" name="matriz[]" value="59"><span>01</span>
                                </label>
                            
                                <label class="ck-button">
                                    <input type="checkbox" name="matriz[]" value="60"><span>02</span>
                                </label>
                            
                                <label class="ck-button">
                                    <input type="checkbox" name="matriz[]" value="102"><span>03</span>
                                </label>
                            
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Switch:</label>
                            <label class="switch">
                                <input type="checkbox" checked>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>

                    <button type="button" class="btn btn-default">Default</button>
                    <button type="button" class="btn btn-primary">Primary</button>
                    <button type="button" class="btn btn-info">Info</button>
                    <button type="button" class="btn btn-success">Success</button>
                    <button type="button" class="btn btn-warning">Warning</button>
                    <button type="button" class="btn btn-danger">Danger</button>

                </div>
            </div>
            
        </div>

        <div class="col-md-3 side-area">
            {!! $blocoImgDestaque !!}


            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Modal </h3>
                </div>
                <div class="panel-body" id="hg-01">

                    <p>Dimensôes recomendadas: <br>900x450px</p>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <button id="abrir-modal" data-url="{{$urlModal}}" type="button" class="btn btn-success">Alterar senha</button>
                        </div>
                    </div>

                    <script>


                        function getHtmlByUrl(url){
                            let html = '';
                            $.ajax({
                                url: url,
                                type:'GET',
                                dataType: "html",
                                async: false,
                                success: function(data) {
                                    html = data;
                                }
                            });
                            return html;
                        }

                        $(document).ready(function () {

                            $("#abrir-modal").click(function (e) {

                                let modalConfig = {
                                    'nome': 'Alterar senha',
                                    'size': [800,600],
                                    'tipo': 'formulario',
                                }
                                let data = getHtmlByUrl($(this).data('url'));
                                abrirModal(data,modalConfig);
                            });
                        });

                    </script>


                </div>
            </div>
        </div>

    </form>

    <script>
        $(document).ready(function () {

            $("#formulario").submit(function (e) {
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
@endsection