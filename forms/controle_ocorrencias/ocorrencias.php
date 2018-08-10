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
    '' => ''
);

if($_GET['link'] == 'editar-ocorrencia'){
    $title = "Editando Ocorrencia";
    $tipo = "edit";
    $ocor_id = $_GET['id'];
    $queryOcorrencia = mysqli_query($dbConect,"select * from ocorrencias where ocor_id = $ocor_id limit 1");
    $linhas = mysqli_fetch_assoc($queryOcorrencia);
    //var_dump($linhas);

}

?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-1 border-bottom ">
    <h1 class="h3"><?php echo $title?></h1>
</div>

<form action="index.php?link=gravar-ocorrencia" method="post" enctype="multipart/form-data">
    <input type="hidden" name="ocor_id" value="<?php echo $ocor_id?>">
    <input type="hidden" name="tipo" value="<?php echo $tipo?>">

    <div class="mt-4 small">
        <div class="card">
            <div class="card-header alert-info">
                <div class="row">
                    <div class="col-3">
                        Ocôrrencia: <strong><?php echo $linhas['ocor_id']?></strong>
                    </div>
                    <div class="col-6">
                        Criado: <strong> <?php echo $linhas['ocor_datacriacao'] ?></strong>
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
                                <option value="1" <?php echo (($linhas['ocor_situacao'] == 1)? 'selected':'') ?>>Testar</option>
                                <option value="2" <?php echo (($linhas['ocor_situacao'] == 2)? 'selected':'') ?> >Analisar</option>
                                <option value="3" <?php echo (($linhas['ocor_situacao'] == 3)? 'selected':'') ?>>Programar</option>
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
                    <input type="file" class="form-control form-control-sm" name="upFiles[]" id="upFiles" multiple>
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
            window.location.href=("index.php?link=ocorrencias");
            return true;
        }
    }

    $(document).ready(function () {
        $(document).click(function () {
            var files = $("#upFiles")[0].files;
            for (var i = 0; i < files.length; i++){
                alert(files[i].name);
            }
        })
    })
</script>