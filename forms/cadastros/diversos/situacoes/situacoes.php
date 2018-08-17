<?php
$title = "Nova Situação";
$tipo = 'novo';
$linhas = array(
    'situac_id' => '',
    'situac_datainclusao' => '',
    'situac_dataalteracao' => '',
    'situac_descricao' => ''
);

if($_GET['link'] == 'editar-situacao'){
    $title = 'Editar Situação';
    $tipo = 'editar';
    $situac_id = $_GET['id'];
    $query = "select * from situacoes where situac_id = $situac_id limit 1";
    $resultPrincipal = mysqli_query($dbConect, $query) or die(mysqli_error($dbConect));
    $linhas = mysqli_fetch_array($resultPrincipal);
}

?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-1 border-bottom ">
    <h1 class="h3"><?php echo $title?></h1>
</div>

<form action="gravar-situacao" method="post" enctype="multipart/form-data">
    <input type="hidden" name="situac_id" value="<?php echo $situac_id?>">
    <input type="hidden" name="tipo" value="<?php echo $tipo?>">

    <div class="mt-4 small">
        <div class="card">
            <div class="card-header alert-info">
                <div class="row">
                    <div class="col-3">
                        Ocôrrencia: <strong><?php echo $linhas['situac_id']?></strong>
                    </div>
                    <div class="col-3">
                        Data Inclusão: <strong> <?php echo $linhas['situac_datainclusao'] ?></strong>
                    </div>
                    <div class="col-3">
                        Data Inclusão: <strong> <?php echo $linhas['situac_dataalteracao'] ?></strong>
                    </div>
                </div>
            </div>
            <div class="card-body mt-2">
                <div class="row">
                    <div class="col-6 mt-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text" for="situac_descricao" id="situacao_id">Situação</span>
                            </div>
                            <input type="text" class="form-control" name="situac_descricao" id="situac_descricao" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="<?php echo $linhas['situac_descricao']?>" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-sm btn-primary mr-1" name="btn-gravar-situacao">Gravar</button>
                <button type="button" class="btn btn-sm btn-danger mr-1" onclick="confirmCancelar()">Cancelar</button>
            </div>
        </div>
    </div>
</form>
<script>
    // CONFIRMA SAIR SEM GRAVAR
    function confirmCancelar() {
        if(confirm("Deseja realmente sair sem Gravar ?")){
            window.location.href=("situacoes");
            return true;
        }
    }
</script>