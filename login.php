<?php
session_start()
?>

<!doctype html>
<html lang="pt-br">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="static/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="static/css/float-label.css">

    <title>Login | Dellasta Informática</title>
</head>
<body>
<?php
    unset(
            $_SESSION['usuarionome'],
            $_SESSION['usuariousuario']
    );
    session_destroy();
?>

<form class="form-signin small" action="kernel/valida_login_usuarios.php" method="post">

        <?php
            if(isset($_SESSION['login_erro'])){//verifica se existe variavel com o indice login_erro
                echo $_SESSION['login_erro'];//imprime erro na tela
                unset($_SESSION['login_erro']);//destroi a variavel criada do erro
            }
        ?>

    <div class="text-center mb-4">
        <img class="mb-4 rounded-circle" src="img/perfil_usuarios/banco3.jpg" alt="" width="120" height="120">
        <h1 class="h3 mb-3 font-weight-normal">Controle de Ocorrencia</h1>
        <p>Bem Vindo ao Sistema de Controle de Ocorrências</p>
    </div>
    <!--
    <div class="mb-3">
        <select class="custom-select custom-select-lg" name="empresa">
            <option value="1">Empresa 1</option>
            <option value="2">Empresa 2</option>
        </select>
    </div>
    -->
    <div class="form-label-group">
        <input type="text" id="id_usuario" name="usuario" class="form-control form-control-sm" placeholder="Usuário" required autofocus>
        <label for="id_usuario">Usuários</label>
    </div>

    <div class="form-label-group">
        <input type="password" id="id_password" name="senha" class="form-control form-control-sm" placeholder="Senha" required>
        <label for="id_password">Senha</label>
    </div>

    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> Manter Conectado.
        </label>
    </div>
    <button class="btn btn-l btn-sm g btn-primary btn-block" type="submit" name="btn_login" >Entrar</button>
    <p class="mt-5 mb-3 text-muted text-center">&copy; 2018</p>
</form>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="static/bootstrap/js/jquery-3.3.1.slim.min.js"></script>
<script src="static/bootstrap/js/popper.min.js"></script>
<script src="static/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>