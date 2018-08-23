<?php
//session_start();
//include_once "../../kernel/seguranca.php";
//include_once "../../kernel/dbconect.php";

//var_dump($_POST);
echo '<br>';
//var_dump($_FILES);


//CADASTRO E ALTERACAO
if(isset($_POST['btn-gravar-ocorrencia'])){
    $ocor_id = $_POST['ocor_id'];
    $analista_id = $_POST['analista_id'];
    $programador_id = $_POST['programador_id'];
    $situacao_id = $_POST['situacao_id'];
    $nome_cliente = $_POST['nome_cliente'];
    $solicitacao = $_POST['solicitacao'];
    $prioridade = $_POST['prioridade'];
    //$solicitacao = filter_input(INPUT_POST, 'solicitacao', FILTER_SANITIZE_SPECIAL_CHARS);


    //VERIFICA SE É NOVO
    if($_POST['tipo'] == 'novo'){
        $id = mysqli_query($dbConect, "select max(ocor_id) as id from ocorrencias") or die(mysqli_error($dbConect)) ;
        $result = mysqli_fetch_assoc($id);
        $maxid = ++$result['id'];
        //$query2 = "insert into ocorrencias(ocor_id, ocor_cliente, ocor_analista, ocor_programador, ocor_situacao, ocor_solicitacao, ocor_datacriacao) values ($maxid, '$nome_cliente', $analista_id, $programador_id, $situacao_id, '$solicitacao',NOW())";
        //echo $query2;
        uploadFiles($maxid);
        $query = mysqli_query($dbConect, "insert into ocorrencias(ocor_id, ocor_cliente, ocor_analista, ocor_programador, ocor_situacao, ocor_solicitacao, ocor_prioridade, ocor_datacriacao) values ($maxid, '$nome_cliente', $analista_id, $programador_id, $situacao_id, '$solicitacao', $prioridade, NOW())") or die(mysqli_error($dbConect));
        if(mysqli_affected_rows($dbConect) != 0){
            $_SESSION['cad-ocor-sucess'] = "<div class=\"alert alert-primary alert-dismissible fade show text-center\" role=\"alert\">
                                          Ocôrrencia <strong>$maxid</strong> incluido com Sucesso
                                          <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                            <span aria-hidden=\"true\">&times;</span>
                                          </button>
                                        </div>";
            header("Location: ocorrencias");
        }

    }
    if($_POST['tipo'] == 'edit'){
        $ocor_id = $_POST['ocor_id'];
        $query = mysqli_query($dbConect, "UPDATE ocorrencias SET ocor_cliente = '$nome_cliente', ocor_analista = $analista_id, ocor_programador = $programador_id, ocor_situacao = $situacao_id , ocor_solicitacao = '$solicitacao', ocor_prioridade = $prioridade WHERE ocor_id = $ocor_id ") or die(mysqli_error($dbConect));
        uploadFiles($ocor_id);
        if(mysqli_affected_rows($dbConect) != 0){
            $_SESSION['cad-ocor-sucess'] = "<div class=\"alert alert-warning alert-dismissible fade show text-center\" role=\"alert\">
                                              Ocôrrencia <strong>$ocor_id</strong> foi alterado com Sucesso
                                              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                                <span aria-hidden=\"true\">&times;</span>
                                              </button>
                                            </div>";
            header("Location: ocorrencias");
        }
    }


}

if($_GET['link'] == 'deleta-ocorrencia'){
    $id = $_GET['del_id'];
    $queryDeletaArquivos = mysqli_query($dbConect, "delete from ocorrencias_arquivos where ocor_id = $id");
    $queryDeleta = mysqli_query($dbConect, "delete from ocorrencias where ocor_id = $id") or die(mysqli_error($dbConect));
    if (mysqli_affected_rows($dbConect) != 0) {
        $_SESSION['cad-ocor-sucess'] = "<div class=\"alert alert-danger alert-dismissible fade show text-center\" role=\"alert\">
                                                 Ocôrrencia <strong>$id</strong> Excluido com Sucesso.
                                                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                                    <span aria-hidden=\"true\">&times;</span>
                                                  </button>
                                                </div>";
        header("Location: ocorrencias");

    }
}

function uploadFiles($ocor_id){
    $diretorio = "arquivos/ocorrencias/".$ocor_id."/";
    mkdir($diretorio, 0777, true);
    if(!is_dir($diretorio)){
        echo "nao existe";
    }else{
        if(is_dir($diretorio)){
            $arquivos = isset($_FILES['arquivos'])? $_FILES['arquivos']: FALSE;
            for($controle = 0; $controle < count($arquivos['name']); $controle++){
                $destino = $diretorio.$arquivos['name'][$controle];
                if(move_uploaded_file($arquivos['tmp_name'][$controle], $destino)){
                    $id = mysqli_query($GLOBALS['dbConect'], "select max(arq_id) as id from ocorrencias_arquivos");
                    $result = mysqli_fetch_assoc($id);
                    $maxid = ++$result['id'];
                    echo $maxid;
                    $query = mysqli_query($GLOBALS['dbConect'], "INSERT INTO ocorrencias_arquivos(arq_id, ocor_id, arq_caminho, arq_datainclusao) VALUES ($maxid, $ocor_id, '$destino', NOW())");
                    echo "efetuado com sucesso<br>";
                }else{
                    echo "erro ao enviar os arquivos<br>";
                }
            }
        }
    }
}