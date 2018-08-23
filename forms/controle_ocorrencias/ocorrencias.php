<?php

include_once "kernel/dbconect.php";
include_once "kernel/seguranca.php";

$title = "Nova Ocôrrencia";
$tipo = "novo";
$linhas = array(
    'ocor_id' => '',
    'ocor_datacriacao' => '',
    'ocor_situacao' => '',
    'ocor_solicitacao' => '',
    'ocor_cliente' => '',
    'ocor_prioridade' => 1,
);

if($_GET['link'] == 'editar-ocorrencia'){
    $title = "Editando Ocorrencia";
    $tipo = "edit";
    $ocor_id = $_GET['id'];
    $queryOcorrencia = mysqli_query($dbConect,"select * from ocorrencias where ocor_id = $ocor_id limit 1");
    $linhas = mysqli_fetch_assoc($queryOcorrencia);
    ///var_dump($linhas);

}

?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-1 border-bottom ">
    <h1 class="h3"><?php echo $title?></h1>
</div>

<form action="gravar-ocorrencia" method="post" enctype="multipart/form-data">
    <input type="hidden" name="ocor_id" value="<?php echo $ocor_id?>">
    <input type="hidden" name="tipo" value="<?php echo $tipo?>">

    <div class="mt-4 small">
        <div class="card">
            <div class="card-header alert-info p-0">
                <div class="row">
                    <div class="col-3 mt-2 ml-2">
                        Ocôrrencia: <strong><?php echo $linhas['ocor_id']?></strong>
                    </div>
                    <div class="col-7 mt-2 ml-2">
                        Criado: <strong> <?php echo $linhas['ocor_datacriacao'] ?></strong>
                    </div>
                    <div class="col float-right">
                        <label class="m-0">Prioridade:</label>
                        <select class="form-control form-control-sm" name="prioridade">
                            <option value="1" <?php echo (($linhas['ocor_prioridade'] == 1)? ' selected':'') ?>>Normal</option>
                            <option class="table-warning" value="2" <?php echo (($linhas['ocor_prioridade'] == 2)? ' selected':'') ?>>Alta</option>
                            <option class="table-danger" value="3" <?php echo (($linhas['ocor_prioridade'] == 3)? ' selected':'') ?>>Urgente</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body mt-2">
                <div class="row border-bottom">
                    <div class="col-4 mb-2">
                        <div class="input-group input-group-sm ">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold" id="inputGroup-sizing-sm">Analista:</span>
                            </div>
                            <select class="form-control" name="analista_id" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                <?php
                                $queryUsuarios = mysqli_query($dbConect, "select * from usuarios");
                                while ($usuarios = mysqli_fetch_array($queryUsuarios)){
                                    //echo '<option value="'.$usuarios['userid'].'">'.$usuarios['usernome'].'</option>';
                                    if($tipo == 'edit'){
                                        echo "<option value=".$usuarios['userid']." ".(($usuarios['userid'] == $linhas['ocor_analista'])? ' selected':'')." >".$usuarios['usernome']."</option>";
                                    }
                                    if($tipo == 'novo'){
                                        echo "<option value=".$usuarios['userid']." ".(($usuarios['userid'] == $_SESSION['userid'])? ' selected':'')." >".$usuarios['usernome']."</option>";
                                    }
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold" id="inputGroup-sizing-sm2">Programador:</span>
                            </div>
                            <select class="form-control" name="programador_id" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm2">
                                <?php
                                $queryProgramador = mysqli_query($dbConect, "select * from usuarios");
                                while ($programador = mysqli_fetch_array($queryProgramador)){
                                    if($tipo == 'edit'){
                                        echo "<option value=".$programador['userid']." ".(($programador['userid'] == $linhas['ocor_programador'])? ' selected':'')." >".$programador['usernome']."</option>";
                                    }
                                    if($tipo == 'novo'){
                                        echo "<option value=".$programador['userid']." ".(($programador['userid'] == $_SESSION['userid'])? ' selected':'')." >".$programador['usernome']."</option>";
                                    }
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold" id="inputGroup-sizing-sm2">Situação:</span>
                            </div>
                            <select class="form-control" name="situacao_id" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm2">
                                <?php
                                $querySituacoes = mysqli_query($dbConect, "select * from situacoes");
                                while ($situacoes = mysqli_fetch_array($querySituacoes)){
                                    if($tipo == 'edit'){
                                        echo "<option value=".$situacoes['situac_id']." ".(($situacoes['situac_id'] == $linhas['ocor_situacao'])? ' selected':'')." >".$situacoes['situac_descricao']."</option>";
                                    }
                                    else{
                                        echo "<option value=".$situacoes['situac_id'].">".$situacoes['situac_descricao']."</option>";
                                    }
                                } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row border-bottom mt-2">
                    <div class="col-4 mb-2">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold" id="inputGroup-sizing-sm2">Cliente:</span>
                            </div>
                            <input type="text" class="form-control" name="nome_cliente" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm2" value="<?php echo $linhas['ocor_cliente']?>" required>
                        </div>
                    </div>
                </div>
                <h1 class="h5 font-weight-bold mt-2">Solicitação:</h1>
                <textarea class="form-control" rows="10" name="solicitacao" required><?php echo $linhas['ocor_solicitacao']?></textarea>

                <div class="input-group mb-3 mt-4">
                    <input type="file" class="form-control form-control-sm" name="arquivos[]" id="arquivos_id" multiple>
                </div>
                <div>
                    <?php
                        if(isset($ocor_id)){
                            $queryArquivos = mysqli_query($dbConect, "select * from ocorrencias_arquivos where ocor_id = $ocor_id");
                            while ($arquivos = mysqli_fetch_array($queryArquivos)){
                                //echo "<img src=\"".$arquivos['arq_caminho']."\" class=\"img-thumbnail mt-2\" style=\"width: 150px; height: 150px\">";
                                ?>

                                <img src="<?php echo $arquivos['arq_caminho']?>" class="img-thumbnail mt-2" data-toggle="modal" data-target=".bd-example-modal-lg<?php echo $arquivos['arq_id']?>" style="width: 150px; height: 150px">
                                <!--INICIO MODAL-->
                                <div class="modal fade bd-example-modal-lg<?php echo $arquivos['arq_id']?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <img src="<?php echo $arquivos['arq_caminho']?>">
                                        </div>
                                    </div>
                                </div>

                                <?php
                            }
                        }
                    ?>

                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-sm btn-primary mr-1" name="btn-gravar-ocorrencia">Gravar</button>
                <button type="button" class="btn btn-sm btn-danger mr-1" onclick="confirmCancelar()">Cancelar</button>
            </div>
        </div>
    </div>
</form>
<script>
    // CONFIRMA SAIR SEM GRAVAR
    function confirmCancelar() {
        if(confirm("Deseja realmente sair sem Gravar ?")){
            window.location.href=("ocorrencias");
            return true;
        }
    }

    $(document).ready(function () {
        $(document).click(function () {
            var files = $("#arquivos_id")[0].files;
            for (var i = 0; i < files.length; i++){
                alert(files[i].name);
            }
        })
    })
</script>