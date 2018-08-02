<?php
$title = "Cadastro de Usuários ";
$tipo = "novo";
$linhas = array(
    'userid' => '',
    'userdatainclusao' => '',
    'userdataalteracao' => '',
    'usernome' => '',
    'userusuario' => '',
    'usersenha' => '',
    'useremail' => '',
    'nivel_acesso' => '',

);

if($_GET['link'] == 'editar-usuario'){
    $userid = $_GET['id'];
    $title = "Editar Usuário";
    $tipo = "edit";

//CONSULTAR USUARIO
    $resultado = mysqli_query($dbConect, "select * from usuarios where userid = $userid limit 1");
    $linhas = mysqli_fetch_assoc($resultado);
    /*
    $campos = array();
    $campos['userid'] = 'value="'.$linhas['userid'].'"';
    $campos['userdatainclusao'] = 'value="'.$linhas['userdatainclusao'].'"';
    $campos['userdataalteracao'] = 'value="'.$linhas['userdataalteracao'].'"';
    $campos['usernome'] = 'value="'.$linhas['usernome'].'"';
    $campos['userusuario'] = 'value="'.$linhas['userusuario'].'"';
    $campos['usersenha'] = 'value="'.$linhas['usersenha'].'"';
    $campos['useremail'] = 'value="'.$linhas['useremail'].'"';
    $campos['nivel_acesso'] = 'value="'.$linhas['nivel_acesso'].'"';
    */
}

?>

<div class="border-bottom">
    <h1><?php echo $title?></h1>
</div>

<form class="needs-validation" action="index.php?link=gravar-usuario" method="post" novalidate>
    <input type="hidden" name="userid" value="<?php echo $linhas['userid']?>">
    <input type="hidden" name="tipo" value="<?php echo $tipo ?>">
    <fieldset disabled>
        <div class="form-row mt-2">  <!--USUARIOS E DATA DE INCLUSAO-->
            <div class="col-md-4 mb-3">
                <label for="id_userid">Código</label>
                <input type="text" class="form-control form-control-sm" id="id_userid" name="userid" value="<?php echo $linhas['userid']?>" >
            </div>
            <div class="col-md-4 mb-3">
                <label for="id_datainclusao">Data de Inclusão</label>
                <input type="text" class="form-control form-control-sm" id="id_datainclusao" value="<?php echo $linhas['userdatainclusao']?>">
            </div>
            <div class="col-md-4 mb-3">
                <label for="id_dataalteracao">Data de Alteração</label>
                <input type="text" class="form-control form-control-sm" id="id_dataalteracao"  value="<?php echo $linhas['userdataalteracao']?>">
            </div>
        </div>
    </fieldset>
    <div class="form-row mt-2">
        <div class="col-md-4 mb-3">
            <label for="id_usernome">Nome</label>
            <div class="input-group">
            <input type="text" class="form-control" id="id_usernome" placeholder="Nome" name="usernome" value="<?php echo $linhas['usernome']?>" required>
            <div class="invalid-feedback">
                Campo Obrigatório!!!
            </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="id_userusuario">Usuário</label>
            <input type="text" class="form-control" id="id_userusuario" placeholder="Usuário" name="userusuario" value="<?php echo $linhas['userusuario']?>" required>
            <div class="invalid-feedback">
                Campo Obrigatório !!!
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="id_usersenha">Username</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" title="Clique para revelar senha" id="inputGroupPrepend" onclick="revelaSenha('id_usersenha')"><i class="far fa-eye"></i></span>
                </div>
                <input type="password" class="form-control" id="id_usersenha" name="usersenha" placeholder="Senha" aria-describedby="inputGroupPrepend" value="<?php echo $linhas['usersenha']?>" required>
                <div class="invalid-feedback">
                    Campo Obrigatório !!!
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-6 mb-3">
            <label for="id_useremail">Email</label>
            <input type="text" class="form-control" id="id_useremail" name="useremail" placeholder="Email" value="<?php echo $linhas['useremail']?>" >
        </div>
        <div class="col-md-3 mb-3">
            <label for="id_usernivel">Nivel</label>
            <select class="form-control" name="nivel_acesso">
                <option value="1" <?php if($linhas['nivel_acesso'] == 1) echo "selected"?> >Administrador</option>
                <option value="2" <?php if($linhas['nivel_acesso'] == 2) echo "selected"?> >Operador</option>
                <option value="3" <?php if($linhas['nivel_acesso'] == 3) echo "selected"?> >Usuário</option>
            </select>
        </div>
    </div>
    <div class="border-top">
        <button class="btn btn-primary mt-2" id="send" name="btn-gravar-usuario" type="submit">Gravar</button>
        <button class="btn btn-danger mt-2" type="button" onclick="confirmCancelar()">Cancelar</button>
    </div>

</form>

<script src="static/js/custom.js">
</script>
<script>
    // CONFIRMA SAIR SEM GRAVAR
    function confirmCancelar() {
        if(confirm("Deseja realmente sair sem Gravar ?")){
            window.location.href=("index.php?link=usuarios");
            return true;
        }
    }
/*
    //NAO PERMITE CLICAR 2X SEGUIDAS NO BOTAO GRAVAR
    $(document).ready(function () {
        $('#send').click(function () {
            var formID = document.getElementById("fmcadusuario");
            var send = $("#send");

            $(formID).submit(function(event){
                if (formID.checkValidity()) {
                    send.attr('disabled', 'disabled');
                }
            });
        })
    })
*/

    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>