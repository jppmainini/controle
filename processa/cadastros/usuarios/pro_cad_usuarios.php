<?php
session_start();
include_once "../../../kernel/seguranca.php";
include_once "../../../kernel/dbconect.php";

var_dump($_POST);

//CADASTRO E ALTERAÇÃO
if(isset($_POST['btn-gravar-usuario'])){
    $userid = $_POST['userid'];
    $usernome = $_POST['usernome'];
    $userusuario = $_POST['userusuario'];
    $usersenha = $_POST['usersenha'];
    $useremail = $_POST['useremail'];
    $nivel_acesso = $_POST['nivel_acesso'];

    //VERIFICA SE É NOVO
    if($_POST['tipo'] == "novo"){
        $id = mysqli_query($dbConect, "select max(userid) as id from usuarios") or die(mysqli_error($dbConect)) ;
        $result = mysqli_fetch_assoc($id);
        $maxid = ++$result['id'];
        $query = mysqli_query($dbConect, "insert into usuarios(userid,usernome,useremail,userusuario,usersenha,nivel_acesso,userdatainclusao) values ($maxid,'$usernome','$useremail','$userusuario','$usersenha',$nivel_acesso,NOW())") or die(mysqli_error($dbConect));
        if(mysqli_affected_rows($dbConect) != 0){
            $_SESSION['cad-user-sucess'] = "<div class=\"alert alert-primary alert-dismissible fade show text-center\" role=\"alert\">
                                              <strong>$usernome</strong> - Cadastrado com Sucesso
                                              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                                <span aria-hidden=\"true\">&times;</span>
                                              </button>
                                            </div>";
            header("Location: index.php?link=usuarios");
        }
    }
    //VERIFICA SE É ALTERACAO
    if($_POST['tipo'] == "edit"){
        $query = mysqli_query($dbConect, "update usuarios set usernome = '$usernome', useremail = '$useremail', userusuario = '$userusuario', usersenha = '$usersenha', nivel_acesso = $nivel_acesso,userdataalteracao = NOW() where userid = $userid") or die(mysqli_error($dbConect));
        if(mysqli_affected_rows($dbConect) != 0){
            $_SESSION['cad-user-sucess'] = "<div class=\"alert alert-warning alert-dismissible fade show text-center\" role=\"alert\">
                                              <strong>$usernome</strong> - Alterado com Sucesso.
                                              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                                <span aria-hidden=\"true\">&times;</span>
                                              </button>
                                            </div>";
            header("Location: index.php?link=usuarios");
        }
    }
}

//DELETA USUARIO UNICO
var_dump($_GET);
if($_GET['link'] == 'deleta-usuario'){
    $id = $_GET['del_id'];

    if($id == 1){
        $_SESSION['cad-user-sucess'] = "<div class=\"alert alert-danger alert-dismissible fade show text-center\" role=\"alert\">
                                              Nao é possivel excluir esse usuario.
                                              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                                <span aria-hidden=\"true\">&times;</span>
                                              </button>
                                            </div>";
        header("Location: index.php?link=usuarios");
    }
    else {
        $query = mysqli_query($dbConect, "delete from usuarios where userid = $id");
        if (mysqli_affected_rows($dbConect) != 0) {
            $_SESSION['cad-user-sucess'] = "<div class=\"alert alert-danger alert-dismissible fade show text-center\" role=\"alert\">
                                                  Excluido com Sucesso.
                                                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                                    <span aria-hidden=\"true\">&times;</span>
                                                  </button>
                                                </div>";
            header("Location: index.php?link=usuarios");
        }
    }
}

//DELETA VARIOS nao esta funcionando
    if(isset($_POST["id"])){
        foreach ($_POST["id"] as $id){
            if($id != 1){
                $sql = "delete from usuarios where userid = $id";
                mysqli_query($dbConect, $sql);
            }

        }
    }



else{
    echo "nao clicou";
}