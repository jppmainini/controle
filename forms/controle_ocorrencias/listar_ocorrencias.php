<?php
$query = "select ocorrencias.ocor_id, ocorrencias.ocor_cliente, ocorrencias.ocor_analista, ocorrencias.ocor_programador, 
            ocorrencias.ocor_situacao, ocorrencias.ocor_solicitacao, ocorrencias.ocor_datacriacao,ocor_datafinalizacao  , usuarios.userid, usuarios.usernome 
            from ocorrencias
            inner join usuarios
            on ocorrencias.ocor_analista = usuarios.userid order by ocorrencias.ocor_id";
$result = mysqli_query($dbConect, $query);
$totalOcorrencias = mysqli_num_rows($result);

?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-1 border-bottom ">
    <h1 class="h3">Ocôrrencias - <?php echo $totalOcorrencias ?></h1>
    <div class="btn-toolbar mb-1 mb-md-0">
        <div class="btn mr-0">
            <a href="index.php?link=nova-ocorrencia"><button class="btn btn-sm btn-primary" name="nova-ocorrencia"><i class="fas fa-user-plus"></i> Novo</button></a>
        </div>
        <button class="btn btn-sm btn-outline-secondary dropdown-toggle pt-1">
            <span data-feather="calendar"></span>
            This week
        </button>
    </div>
</div>

<p>
    <?php
    if(isset($_SESSION['cad-ocor-sucess'])){//isset mandar imprimir
        echo $_SESSION['cad-ocor-sucess']; //echo imprimir
        unset($_SESSION['cad-ocor-sucess']); //unset destoi a variavel
    }
    ?>
</p>


<?php while ($linhas = mysqli_fetch_array($result)){
    if($linhas['ocor_situacao'] == '1'){
        $linhas['ocor_situacao'] = 'Testar';
        $corStatus = 'alert-primary';
    }
    if($linhas['ocor_situacao'] == '2'){
        $linhas['ocor_situacao'] = 'Analisar';
        $corStatus = 'alert-warning';
    }
    if($linhas['ocor_situacao'] == '3'){
        $linhas['ocor_situacao'] = 'Programar';
        $corStatus = 'alert-danger';
    }
    ?>
    <div class="mt-4 small">
        <div class="card">
            <div class="card-header <?php echo $corStatus ?>">
                <div class="row">
                    <div class="col-2">
                        Ocôrrencia: <strong><?php echo $linhas['ocor_id']?></strong>
                    </div>
                    <div class="col-6">
                        Cliente: <strong><?php echo $linhas['ocor_cliente']?></strong>
                    </div>
                    <div class="col-2">
                        Situação: <strong><?php echo $linhas['ocor_situacao']?></strong>
                    </div>
                    <div class="col">
                        <input type="button" class="btn btn-sm btn-info float-lg-right" value="Finalizar">
                    </div>
                </div>
            </div>
            <div class="card-body mt-2">
                <div class="row border-bottom">
                    <div class="col-6">
                        <strong>Analista: </strong><?php echo $linhas['usernome']?>
                    </div>
                    <div class="col-6">
                        <strong>Criado: </strong><?php echo $linhas['ocor_datacriacao']?>
                    </div>
                </div>
                <div class="row border-bottom mt-1">
                    <div class="col-6">
                        <strong>Programador: </strong><?php echo $linhas['usernome']?>
                    </div>
                    <div class="col-6">
                        <strong>Finalizado: </strong><?php echo $linhas['ocor_datafinalizacao'] ?>
                    </div>
                </div>
                <h1 class="h5 font-weight-bold mt-2">Solicitação:</h1>
                    <?php echo "<p>".nl2br($linhas['ocor_solicitacao'])."</p>"?>
            </div>
            <div class="card-footer">
                <div class="btn-group">
                    <button class="btn btn-secondary btn-sm" type="button">
                        <i class="far fa-folder-open"></i> Abrir
                    </button>
                    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item small text-primary font-weight-bold" href="index.php?link=editar-ocorrencia&id=<?php echo $linhas['ocor_id']?>">Editar</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item small text-danger font-weight-bold" onclick="deleteOcorrenciaInd(<?php echo $linhas['ocor_id']?>)" style="cursor: pointer">Excluir</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<script>
    function deleteOcorrenciaInd(del_id) {
        var resposta = confirm("Deseja realmente excluir essa Ocôrrencia ?");
        if (resposta == true){
            window.location.href = "index.php?link=deleta-ocorrencia&del_id="+del_id;
        }
    }
</script>
