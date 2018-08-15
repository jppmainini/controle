<?php
$query = "select ocorrencias.ocor_id, ocorrencias.ocor_cliente, ocor_analista, ocor_programador, p1.usernome as analista, p2.usernome as programador,
            ocorrencias.ocor_situacao, ocorrencias.ocor_solicitacao, ocorrencias.ocor_datacriacao,ocor_datafinalizacao
            from ocorrencias
            inner join usuarios as p1 on ocorrencias.ocor_analista = p1.userid
            inner join usuarios as p2 on ocorrencias.ocor_programador = p2.userid	
            order by ocorrencias.ocor_id";
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
<div>
    <fieldset class="border mb-2 p-2">
        <legend class="h6">Filtros</legend>
        <div class="row">
            <div class="col-2">
                <label class="mb-0" for="pesquisa_situac">Por Analista</label>
                <select class="form-control form-control-sm" name="pesquisa_analista" id="pesquisa_situac">
                    <option value="" selected>...</option>
                    <?php
                    $queryUsuarios = mysqli_query($dbConect, "select * from usuarios");
                    while ($usuarios = mysqli_fetch_array($queryUsuarios)){
                        echo "<option value=".$usuarios['userid'].">".$usuarios['usernome']."</option>";
                    } ?>
                </select>
            </div>
            <div class="col-3">
                <label class="mb-0" for="pesquisa_texto">Por Cliente</label>
                <input type="text" class="form-control form-control-sm" id="pesquisa_texto" placeholder="Pesquisar...">
            </div>
            <div class="col">
                <button class="btn btn-success btn-sm float-right" onclick="pesquisarOcorrencias()"><i class="fas fa-filter"></i> Filtrar</button>
            </div>

        </div>
    </fieldset>
</div>

<div class="table-responsive">
    <table class="table table-sm table-bordered table-hover table small">
        <thead class="table-dark">
            <tr>
                <!--<th><input type="checkbox" class="m-md-1" name="checkboxall" id="checkboxall"></th>-->
                <th class="m-md-1">#</th>
                <th>Ocôrrencia</th>
                <th>Cliente</th>
                <th>Situação</th>
                <th>Analista</th>
                <th>Programador</th>
                <th>Data Criação</th>
                <th>Data Finalização</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody class="resultado">

        <?php while ($linhas = mysqli_fetch_array($result)){
            if($linhas['ocor_situacao'] == '1'){
                $linhas['ocor_situacao'] = 'Testar';
                $corStatus = 'table-primary';
            }
            if($linhas['ocor_situacao'] == '2'){
                $linhas['ocor_situacao'] = 'Analisar';
                $corStatus = 'table-warning';
            }
            if($linhas['ocor_situacao'] == '3'){
                $linhas['ocor_situacao'] = 'Programar';
                $corStatus = 'table-success';
            }
            foreach ($linhas as $indice => $valor)
            ?>
            <tr class="font-weight-bold <?php echo $corStatus ?>"  id="resultado">
                <td class="text-center" style="width: 2%"><input type="checkbox" class="checkbox m-md-1 checkboxid" name="userid[]" value="<?php echo $linhas['ocor_id']?>" ></td>
                <td style="width: 5%"><?php echo $linhas['ocor_id']?></td>
                <td style="width: 20%"><?php echo $linhas['ocor_cliente']?></td>
                <td style="width: 5%"><?php echo $linhas['ocor_situacao']?></td>
                <td style="width: 15%"><?php echo $linhas['analista']?></td>
                <td style="width: 15%"><?php echo $linhas['programador']?></td>
                <td style="width: 15%"><?php echo $linhas['ocor_datacriacao']?></td>
                <td style="width: 15%"><?php echo $linhas['ocor_datafinalizacao']?></td>
                <td class="text-center">
                    <div class="btn-group btn-group-sm" role="group" aria-label="...">
                    <button type="button" class="btn btn-primary btn-sm text-white" data-toggle="modal" data-target="#gridSystemModal<?php echo $linhas['userid']?>" title="Visualizar" ><i class="far fa-eye"></i></button>
                    <a href='index.php?link=editar-ocorrencia&id=<?php echo $linhas['ocor_id']?>'><button type="button" class="btn btn-warning btn-sm text-white" name="btn-editUsuario" title="Editar" ><i class="far fa-edit"></i></button></a>
                    <button type="button" class="btn btn-danger btn-sm text-white" title="Excluir" onclick="deleteuser(<?php echo $linhas['userid'];?>)" ><i class="far fa-trash-alt"></i></button>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<script>
    function deleteOcorrenciaInd(del_id) {
        var resposta = confirm("Deseja realmente excluir essa Ocôrrencia ?");
        if (resposta == true){
            window.location.href = "index.php?link=deleta-ocorrencia&del_id="+del_id;
        }
    }

    //PESQUISA
    function pesquisarOcorrencias() {
        const inputText = document.getElementById('pesquisa_texto');
        const inputSituac = document.getElementById('pesquisa_situac');
        var pesquisa1 = $(inputText).val();
        var pesquisa2 = $(inputSituac).val();
        alert(pesquisa1);
        alert(pesquisa2);
        breakpoint;

        // PESQUISA
        $(function () {
            var pesquisa = $(inputText).val();
            if((pesquisa != '') || (pesquisa == '')){
                var dados = {
                    palavra : pesquisa
                }
                $.post('processa/controle_ocorrencias/pro_pesquisa_ocorrencia.php', dados, function (retorna) {
                    $(".resultado").html(retorna);
                });
            }else {
                $(".resultado").html(retorna);
            }
        });
    }


</script>
