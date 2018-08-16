<?php
$query = "select * from situacoes";
$resultPrincipal = mysqli_query($dbConect, $query) or die (mysqli_error($dbConect));

?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-1 border-bottom ">
    <h1 class="h3">Situações</h1>
    <div class="btn-toolbar mb-1 mb-md-0">
        <div class="btn mr-0">
            <a href="index.php?link=nova-situacao"><button class="btn btn-sm btn-primary" name="nova-situacao"><i class="fas fa-user-plus"></i> Novo</button></a>
        </div>
        <button class="btn btn-sm btn-outline-secondary dropdown-toggle pt-1">
            <span data-feather="calendar"></span>
            This week
        </button>
    </div>
</div>

<p>
    <?php
    if(isset($_SESSION['cad-situac-sucess'])){//isset mandar imprimir
        echo $_SESSION['cad-situac-sucess']; //echo imprimir
        unset($_SESSION['cad-situac-sucess']); //unset destoi a variavel
    }
    ?>
</p>

<div class="table-responsive">
    <table class="table table-sm table-hover">
        <thead class="table-primary small">
        <tr>
            <!--<th><input type="checkbox" class="m-md-1" name="checkboxall" id="checkboxall"></th>-->
            <th class="m-md-1">#</th>
            <th>Código</th>
            <th>Descrição</th>
            <th>Data Inclusão</th>
            <th>Data Alteração</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody class="resultado">

        <?php while ($linhas = mysqli_fetch_array($resultPrincipal)){?>
            <tr id="resultado">
            <td class="text-center" style="width: 2%"><input type="checkbox" class="checkbox m-md-1 checkboxid" name="userid[]" value="<?php echo $linhas['situac_id']?>" ></td>
            <th style="width: 5%"><?php echo $linhas['situac_id']?></th>
            <td style="width: 20%"><?php echo $linhas['situac_descricao']?></td>
            <td style="width: 15%"><?php echo $linhas['situac_datainclusao']?></td>
            <td style="width: 15%"><?php echo $linhas['situac_dataalteracao']?></td>
            <td class="text-center">
                <div class="btn-group btn-group-sm" role="group" aria-label="...">
                    <a href='index.php?link=editar-situacao&id=<?php echo $linhas['situac_id']?>'><button type="button" class="btn btn-warning btn-sm text-white" name="btn-editUsuario" title="Editar" ><i class="far fa-edit"></i></button></a>
                    <button type="button" class="btn btn-danger btn-sm text-white" title="Excluir" onclick="deletaSituacoesInd(<?php echo $linhas['situac_id'];?>)" ><i class="far fa-trash-alt"></i></button>
                </div>
            </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<script>
    //deleta
    function deletaSituacoesInd(del_id) {
        var resposta = confirm("Deseja realmente excluir essa Situação ?");
        if (resposta == true){
            window.location.href = "index.php?link=deleta-situacao&del_id="+del_id;
        }
    }
</script>