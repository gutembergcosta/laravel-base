@extends('painel.layouts.layout-login')

@section('pagina')

<div id="wrapper">
    <div class="vertical-align-wrap">
        <div class="vertical-align-middle">
            <div class="auth-box ">
                <div class="content">
                    <div class="header">
                        <div class="logo text-center"><img src="{{ asset('assets/img/logo-dark.png') }}" width="139" alt="Logo"></div>
                        <p class="lead">Novo usuário</p>
                    </div>
                    <form id="form-login" class="form-auth-small" action="{{ route('cadastro.salvar') }}">
                        <div class="form-group">
                            <label for="signin-nome" class="control-label sr-only">Nome</label>
                            <input type="text" name="name" class="form-control" id="signin-nome" value="" placeholder="Nome" required>
                        </div>
                        <div class="form-group">
                            <label for="signin-email" class="control-label sr-only">Email</label>
                            <input type="email" name="email" class="form-control" id="signin-email" value="" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <label for="signin-password" class="control-label sr-only">Senha</label>
                            <input type="password"  name="password" class="form-control" id="signin-password" value="" placeholder="Senha" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Cadastrar</button>
                        <div class="bottom">
                            <span class="helper-text"><i class="fa fa-lock"></i> <a href="{{ route('nova-senha.solicitar') }}">Redefinir senha</a></span>
                        </div>
                    </form>

                    <script>
                        $(document).ready(function () {
                            $("#form-login").submit(function (e) {
                                e.preventDefault();
                                var data = $(this).serializeArray();
                                $(this).find('[type=submit]').attr('disabled', 'disabled');
                                enviaForm(data, $(this).attr('action'),'POST');
                                $(this).find('[type=submit]').removeAttr('disabled');
                            });
                        });
                    </script>
                </div>


                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
	
@endsection


