{% extends "painel/layouts/layout-painel.htm" %}


{% block pagina %}

        <div class="row area-btn-novo">
            <div class="col-md-12">
                <a href="http://localhost/painel03/admin/pagina/add" class="btn btn-success btn-xs"> 
                    <i class="fas fa-plus-circle"></i> Novo 
                </a>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Páginas</h3>
                    </div>
                    <div class="panel-body">


                        <div class="">
                            <table class="table table-bordered tabela">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Img</th>
                                        <th>Qte</th>

                                        <th style="width: 80px"></th>

                                    </tr>

                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a class="tb_link" href="admin/artigos/edit/">Nome</a> </td>
                                        <td>Item</td>
                                        <td>Item</td>
                                        <td>
                                            <a data-id="id" data-url="artigo" class="btn btn-danger btn-xs deletar">
                                                Excluir
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        {% endblock %}
