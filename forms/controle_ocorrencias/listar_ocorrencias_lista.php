<?php
//RECEBE A QTD DE PAGINA
$pagina_atual = filter_input(INPUT_GET, $pagina, FILTER_SANITIZE_NUMBER_INT);
echo $pagina_atual;
$pagina = (!empty($pagina_atual))? $pagina_atual: 1;

//SETA QTD DE PAGINA
$qtd_result_pg = 3;
// CALCULA QTD PAGINAS
$iniciopg = ($qtd_result_pg * $pagina) - $qtd_result_pg;

$query = "select ocorrencias.ocor_id, ocorrencias.ocor_cliente, ocor_analista, ocor_programador, p1.usernome as analista, p2.usernome as programador,
            ocorrencias.ocor_situacao, situacoes.situac_descricao, ocorrencias.ocor_solicitacao, ocorrencias.ocor_prioridade, ocorrencias.ocor_datacriacao,ocor_datafinalizacao
            from ocorrencias 
            inner join usuarios as p1 on ocorrencias.ocor_analista = p1.userid
            inner join usuarios as p2 on ocorrencias.ocor_programador = p2.userid	
            inner join situacoes on ocorrencias.ocor_situacao = situacoes.situac_id
            order by ocorrencias.ocor_id LIMIT $iniciopg, $qtd_result_pg";
$result = mysqli_query($dbConect, $query);
$totalOcorrencias = mysqli_num_rows($result);

?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 border-bottom ">
    <h1 class="h3">Ocôrrencias - <?php echo $totalOcorrencias ?></h1>
    <div class="btn-toolbar mb-1 mb-md-0">
        <div class="btn mr-0">
            <a href="nova-ocorrencia"><button class="btn btn-sm btn-primary" name="nova-ocorrencia"><i class="fas fa-user-plus"></i> Novo</button></a>
        </div>
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
            <!--
            <div class="col-2">
                <label class="mb-0" for="pesquisa_situac">Por Analista</label>
                <select class="form-control form-control-sm" name="pesquisa_analista" id="pesquisa_situac">
                    <option value="" selected>...</option>
                    <?php/*
                    $queryUsuarios = mysqli_query($dbConect, "select * from usuarios");
                    while ($usuarios = mysqli_fetch_array($queryUsuarios)){
                        echo "<option value=".$usuarios['userid'].">".$usuarios['usernome']."</option>";
                    } */?>
                </select>
            </div>
            -->
            <div class="col-6">
                <label class="mb-0" for="pesquisa_texto">Por Cliente</label>
                <input type="text" class="form-control form-control-sm" id="pesquisa_texto" placeholder="Pesquisar...">
            </div>
            <div class="col-2">
                <label class="mb-0" for="pesquisa_situacao">Por Situação</label>
                <select class="form-control form-control-sm" id="pesquisa_situacao">
                    <option value="">Todos</option>
                    <?php
                        $querySituacao = mysqli_query($dbConect, "select * from situacoes");
                        while ($situacoes = mysqli_fetch_array($querySituacao)){
                            echo "<option value=".$situacoes['situac_id'].">".$situacoes['situac_descricao']."</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="col">
                <button class="btn btn-success btn-sm float-right" onclick="pesquisarOcorrencias()"><i class="fas fa-filter"></i> Filtrar</button>
            </div>

        </div>
    </fieldset>
</div>

<div class="table-responsive">
    <table class="table table-sm table-hover ">
        <thead class="table-primary small">
            <tr>
                <!--<th><input type="checkbox" class="m-md-1" name="checkboxall" id="checkboxall"></th>-->
                <th class="m-md-1">#</th>
                <th>
                    Ocôrrencia
                    <i class="fas fa-sort-amount-down float-right table-hover" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                    <div class="dropdown">
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <h6 class="dropdown-header">Ordernar</h6>
                            <div class="dropdown-item form-check">
                                <input class="form-check-input" type="radio" name="order_id" id="crescente_id" value="crescente" checked>
                                <label class="form-check-label" for="crescente_id">
                                    Crescente
                                </label>
                            </div>
                            <div class="dropdown-item form-check">
                                <input class="form-check-input" type="radio" name="order_id" id="decrescente_id" value="decrescente">
                                <label class="form-check-label" for="decrescente_id">
                                    Decrescente
                                </label>
                            </div>
                        </div>
                    </div>
                </th>
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

        <?php while ($linhas = mysqli_fetch_array($result)){?>
            <tr class="<?php echo (($linhas['ocor_prioridade'] == 1)? ' table-info':''); echo (($linhas['ocor_prioridade'] == 2)? ' table-warning':''); echo(($linhas['ocor_prioridade'] == 3)? 'table-danger':'') ?>"  id="resultado">
                <td class="text-center" style="width: 2%"><input type="checkbox" class="checkbox m-md-1 checkboxid" name="userid[]" value="<?php echo $linhas['ocor_id']?>" ></td>
                <th style="width: 8%"><?php echo $linhas['ocor_id']?></th>
                <td style="width: 20%"><?php echo $linhas['ocor_cliente']?></td>
                <td style="width: 5%"><?php echo $linhas['situac_descricao']?></td>
                <td style="width: 15%"><?php echo $linhas['analista']?></td>
                <td style="width: 15%"><?php echo $linhas['programador']?></td>
                <td style="width: 15%"><?php echo $linhas['ocor_datacriacao']?></td>
                <td style="width: 15%"><?php echo $linhas['ocor_datafinalizacao']?></td>
                <td class="text-center">
                    <div class="btn-group btn-group-sm" role="group" aria-label="...">
                    <button type="button" class="btn btn-primary btn-sm text-white" data-toggle="modal" data-target="#gridSystemModal<?php echo $linhas['userid']?>" title="Visualizar" ><i class="far fa-eye"></i></button>
                    <a href='editar-ocorrencia&id=<?php echo $linhas['ocor_id']?>'><button type="button" class="btn btn-warning btn-sm text-white" name="btn-editUsuario" title="Editar" ><i class="far fa-edit"></i></button></a>
                    <button type="button" class="btn btn-danger btn-sm text-white" title="Excluir" onclick="deleteOcorrenciaInd(<?php echo $linhas['ocor_id'];?>)" ><i class="far fa-trash-alt"></i></button>
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
            window.location.href = "deleta-ocorrencia&del_id="+del_id;
        }
    }

    //PESQUISA
    function pesquisarOcorrencias() {
        const inputCliente = document.getElementById('pesquisa_texto');
        const inputSituac = document.getElementById('pesquisa_situacao');
        // PESQUISA
        $(function () {
            var pesqCliente = $(inputCliente).val();
            var pesqSituac = $(inputSituac).val();
            //alert(pesqCliente);
            //alert(pesqSituac);
            //breakpoint;
            if((pesqCliente != '') || (pesqCliente == '')){
                //alert(pesqCliente);
                //alert(pesqSituac);
                var dados = {
                    pesqCliente : pesqCliente,
                    pesqSituac : pesqSituac
                }
                $.post('processa/controle_ocorrencias/pro_pesquisa_ocorrencia.php', dados, function (retorna) {
                    $(".resultado").html(retorna);
                });
            }else {
                $(".resultado").html(retorna);
            }
        });
    }

    //ordernar
    $('#crescente_id').click(function () {
        if ($('#crescente_id').is(":checked")){
            alert("crescente marcado");
            const orderID = document.getElementById('crescente_id');
            $(function () {
                var order_ID = $(orderID).val();
                if(order_ID != ''){
                    alert(order_ID);
                    var dados = {
                        order_ID : order_ID,
                    }
                    $.post('processa/controle_ocorrencias/pro_pesquisa_ocorrencia.php', dados, function (retorna) {
                        $(".resultado").html(retorna)
                    })
                }else {
                    $(".resultado").html(retorna)
                }
            });
        }
    })
    $('#decrescente_id').click(function () {
            if ($('#decrescente_id').is(":checked")){
                alert("decrescente marcado");
                const orderID = document.getElementById('decrescente_id');
                $(function () {
                    var order_ID = $(orderID).val();
                    if(order_ID != ''){
                        alert(order_ID);
                        var dados = {
                            order_ID : order_ID,
                        }
                        $.post('processa/controle_ocorrencias/pro_pesquisa_ocorrencia.php', dados, function (retorna) {
                            $(".resultado").html(retorna)
                        })
                    }else {
                        $(".resultado").html(retorna)
                    }
                });
            }
        })


</script>
