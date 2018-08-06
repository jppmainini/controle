<?php
session_start();
include_once "../../kernel/seguranca.php";
include_once "../../kernel/dbconect.php";

var_dump($_POST);

//CADASTRO E ALTERACAO
if(isset($_POST['btn-gravar-ocorrencia'])){
    $ocor_id = $_POST['ocor_id'];
    $analista_id = $_POST['analista_id'];
    $programador_id = $_POST['programador_id'];
    $situacao_id = $_POST['situacao_id'];
    $nome_cliente = $_POST['nome_cliente'];
    $solicitacao = $_POST['solicitacao'];
    //$solicitacao = filter_input(INPUT_POST, 'solicitacao', FILTER_SANITIZE_SPECIAL_CHARS);


    //VERIFICA SE É NOVO
    if($_POST['tipo'] == 'novo'){
        $id = mysqli_query($dbConect, "select max(ocor_id) as id from ocorrencias") or die(mysqli_error($dbConect)) ;
        $result = mysqli_fetch_assoc($id);
        $maxid = ++$result['id'];
        //$query2 = "insert into ocorrencias(ocor_id, ocor_cliente, ocor_analista, ocor_programador, ocor_situacao, ocor_solicitacao, ocor_datacriacao) values ($maxid, '$nome_cliente', $analista_id, $programador_id, $situacao_id, '$solicitacao',NOW())";
        //echo $query2;
        $query = mysqli_query($dbConect, "insert into ocorrencias(ocor_id, ocor_cliente, ocor_analista, ocor_programador, ocor_situacao, ocor_solicitacao, ocor_datacriacao) values ($maxid, '$nome_cliente', $analista_id, $programador_id, $situacao_id, '$solicitacao',NOW())") or die(mysqli_error($dbConect));
        echo '<br>';
        echo $query2;
        if(mysqli_affected_rows($dbConect) != 0){
            $_SESSION['cad-ocor-sucess'] = "<div class=\"alert alert-primary alert-dismissible fade show text-center\" role=\"alert\">
                                              Ocôrrencia <strong>$maxid</strong> incluido com Sucesso
                                              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                                <span aria-hidden=\"true\">&times;</span>
                                              </button>
                                            </div>";
            header("Location: index.php?link=ocorrencias");
        }
    }
    if($_POST['tipo'] == 'edit'){

    }


}

if($_GET['link'] == 'deleta-ocorrencia'){
    $id = $_GET['del_id'];
    $queryDeleta = mysqli_query($dbConect, "delete from ocorrencias where ocor_id = $id") or die(mysqli_error($dbConect));
    if (mysqli_affected_rows($dbConect) != 0) {
        $_SESSION['cad-ocor-sucess'] = "<div class=\"alert alert-danger alert-dismissible fade show text-center\" role=\"alert\">
                                                 Ocôrrencia <strong>$id</strong> Excluido com Sucesso.
                                                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                                    <span aria-hidden=\"true\">&times;</span>
                                                  </button>
                                                </div>";
        header("Location: index.php?link=ocorrencias");

    }
}