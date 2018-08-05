<?php
session_start();
include_once "kernel/dbconect.php";
include_once "kernel/seguranca.php";

$title = "Nova Ocôrrencia";

?>

<div class="border-bottom">
    <h1><?php echo $title?></h1>
</div>

<form action="index.php?link=gravar-ocorrencia" method="post" enctype="multipart/form-data">
    <div class="mt-4">
        <div class="card">
            <div class="card-header alert-info">
                <div class="row">
                    <div class="col-3">
                        Ocôrrencia: <strong>00000</strong>
                    </div>
                    <div class="col-6">
                        Criado: <strong> <?php echo "" ?></strong>
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
                                    ?>
                                    <option value="<?php echo $usuarios['userid'] ?>"<?php if($usuarios['userid'] == $_SESSION['userid']){echo "selected"; } ?> ><?php echo $usuarios['usernome']?></option>

                            <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold" id="inputGroup-sizing-sm2">Programador:</span>
                            </div>
                            <select class="form-control" name="programador_id" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm2">
                                <option value="" selected>...</option>
                                <?php
                                $queryUsuarios = mysqli_query($dbConect, "select * from usuarios");
                                while ($programador = mysqli_fetch_array($queryUsuarios)){
                                    echo '<option value="'.$programador['usernome'].'">'.$programador['usernome'].'</option>';
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
                                <option value="1" selected>Testar</option>
                                <option value="2" >Analisar</option>
                                <option value="3" >Programar</option>
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
                            <input type="text" class="form-control" name="nome_cliente" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm2">
                        </div>
                    </div>
                </div>
                <h1 class="h5 font-weight-bold mt-2">Solicitação:</h1>
                <textarea class="form-control" rows="10" name="solicitacao"></textarea>

                <div class="input-group mb-3 mt-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01"><i class="fas fa-paperclip mr-1"></i>Anexo</span>
                    </div>
                    <div class="custom-file">
                        <label class="custom-file-label" for="inputGroupFile01">Nenhum arquivo selecionado...</label>
                        <input type="file" class="custom-file-input" name="anexos" id="inputGroupFile01">
                    </div>
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
</script>