<!DOCTYPE html>
<html>
<head>
    <title>Email</title>
</head>
<body>
    <h2 style="color:navy">Cadastro realizado com sucesso</h2>
    <p>
        Olá <strong>{{ $data['name'] }}</strong>.<br>
        Seu cadastro foi realizado com sucesso, <br> para validar e ter acesso ao nosso painel de controle clique no link abaixo.<br>
    </p>

    <p>
        <a href="{{url('validar-cadastro')  }}?usuario={{mdx($data['email'])}} ">
            {{url('validar-cadastro')}}/usuario-{{mdx($data['email'])}}
        </a>
    </p>
   
    <p>
        Att.<br>
        {{env('APP_NAME')}}

    </p>
</body>
</html>