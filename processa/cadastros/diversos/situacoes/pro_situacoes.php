<?php
include_once "kernel/seguranca.php";
include_once "kernel/dbconect.php";

if(isset($_POST['btn-gravar-situacao'])){
    $tipo = $_POST['tipo'];
    $situac_descricao = $_POST['situac_descricao'];

    //VERIFICA SE É NOVO
    if($_POST['tipo'] == 'novo'){
        $id = mysqli_query($dbConect, "select max(situac_id) as id from situacoes") or die(mysqli_error($dbConect));
        $result = mysqli_fetch_assoc($id);
        $maxid = ++$result['id'];
        $query = mysqli_query($dbConect,"INSERT INTO situacoes(situac_id, situac_descricao, situac_datainclusao) VALUES ($maxid, '$situac_descricao', NOW())") or die(mysqli_error($dbConect));
        //$query = "INSERT INTO situacoes(situac_id, situac_descricao, situac_datainclusao) VALUES ($maxid, '$situac_descricao', NOW())";
        if(mysqli_affected_rows($dbConect) != 0){
            $_SESSION['cad-situac-sucess'] = "<div class=\"alert alert-primary alert-dismissible fade show text-center\" role=\"alert\">
                                              Situação <strong>".$situac_descricao."</strong> incluido com Sucesso
                                              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                                <span aria-hidden=\"true\">&times;</span>
                                              </button>
                                            </div>";
            header("Location: index.php?link=situacoes");
        }
    }

    //EDITANDO
    if($_POST['tipo'] == 'editar'){
        $situac_id = $_POST['situac_id'];
        $query = mysqli_query($dbConect, "UPDATE situacoes SET situac_descricao = '$situac_descricao', situac_dataalteracao = NOW() WHERE situac_id = $situac_id;") or die(mysqli_error($dbConect));
        if(mysqli_affected_rows($dbConect) != 0){
            $_SESSION['cad-situac-sucess'] = "<div class=\"alert alert-warning alert-dismissible fade show text-center\" role=\"alert\">
                                              Situação $situac_id foi alterado para <strong>".$situac_descricao."</strong>
                                              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                                <span aria-hidden=\"true\">&times;</span>
                                              </button>
                                            </div>";
            header("Location: index.php?link=situacoes");
        }
    }
}

if($_GET['link'] == 'deleta-situacao'){
    $situac_id = $_GET['del_id'];
    $query = mysqli_query($dbConect, "delete from situacoes where situac_id = $situac_id");
    if(mysqli_affected_rows($dbConect) != 0){
        $_SESSION['cad-situac-sucess'] = "<div class=\"alert alert-danger alert-dismissible fade show text-center\" role=\"alert\">
                                              Situação <strong>$situac_id</strong> foi excluido com sucesso
                                              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                                <span aria-hidden=\"true\">&times;</span>
                                              </button>
                                            </div>";
        header("Location: index.php?link=situacoes");
    }
}