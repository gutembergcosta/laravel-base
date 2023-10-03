@extends('painel.layouts.layout-login')

@section('pagina')
<div id="wrapper">
    <div class="vertical-align-wrap">
        <div class="vertical-align-middle">
            <div class="auth-box ">
                <div class="content">
                    <div class="header">
                        <div class="logo text-center"><img src="{{ asset('assets/img/logo-dark.png') }}" width="139" alt="Logo"></div>
                        <p class="lead">Redefinir senha</p>
                    </div>
                    <form id="form-login" class="form-auth-small" action="{{ route('nova-senha.enviar-token') }}">
                        <div class="form-group">
                            <label for="signin-email" class="control-label sr-only">Email</label>
                            <input type="email" name="email" class="form-control" id="signin-email" value="" placeholder="Email" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block">SOLICITAR NOVA SENHA</button>
                        <div class="bottom">
                            <span class="helper-text"><i class="fa fa-lock"></i> <a href="{{ route('login') }}">Voltar</a></span>
                        </div>
                    </form>

                    <script>
                        $(document).ready(function () {
                            $("#form-login").submit(function (e) {
                                e.preventDefault();
                                preloader('add'); 
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


