<!DOCTYPE html>
<html>
<head>
    <title>Email</title>
</head>
<body>
    <h2 style="color:navy">Cadastro de nova senha</h2>
    <p>
        Olá <strong>{{ $data['nome'] }}</strong>.<br>

        Para cadastrar uma nova senha clique no link abaixo:
    </p>

    <p>
        <a href="{{route('nova-senha.redefinir',$data['token'])}}">
            {{route('nova-senha.redefinir',$data['token'])}}
        </a>
    </p>

    <p>
        Caso não tenha solicitado uma nova senha favor desconsiderar este e-email.
    </p>
   
    <p>
        Att.<br>
        {{env('APP_NAME')}}

    </p>
</body>
</html>