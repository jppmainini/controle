<?php
include_once "../../kernel/dbconect.php";



if((!isset($_POST['pesqCliente']))||(!isset($_POST['pesqSituac']))){
    $pesqCliente = '';
    $pesqSituac = '';
}else{
    $pesqCliente = $_POST['pesqCliente'];
    if(!empty($_POST['pesqSituac'])){
        $pesqSituac = 'and ocor_situacao = '.$_POST['pesqSituac'];
    }else{
        $pesqSituac = '';
    }
}


if(!isset($_POST['order_ID'])){
    $order_codigo = '';
}else{
    $order_codigo = $_POST['order_ID'];
}


if(($order_codigo == '') or ($order_codigo == 'crescente')){
    $order_codigo = 'ocor_id';
}
if($order_codigo == 'decrescente'){
    $order_codigo = 'ocor_id desc';
}

if(($pesqCliente != '') or ($pesqCliente == '')){
    $query = "select ocorrencias.ocor_id, ocorrencias.ocor_cliente, ocor_analista, ocor_programador, p1.usernome as analista, p2.usernome as programador,
            ocorrencias.ocor_situacao, situacoes.situac_descricao, ocorrencias.ocor_solicitacao, ocorrencias.ocor_prioridade, ocorrencias.ocor_datacriacao,ocor_datafinalizacao
            from ocorrencias
            inner join usuarios as p1 on ocorrencias.ocor_analista = p1.userid
            inner join usuarios as p2 on ocorrencias.ocor_programador = p2.userid	
            inner join situacoes on ocorrencias.ocor_situacao = situacoes.situac_id
            where ocor_cliente like '$pesqCliente%' $pesqSituac
            order by ocorrencias.$order_codigo";
    $resultPrincipal = mysqli_query($dbConect, $query) or die (mysqli_error($dbConect));
    $linhas = mysqli_num_rows($resultPrincipal);
    if($linhas > 0){
        while ($linhas = mysqli_fetch_array($resultPrincipal)){?>
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
                        <a href='index.php?link=editar-ocorrencia&id=<?php echo $linhas['ocor_id']?>'><button type="button" class="btn btn-warning btn-sm text-white" name="btn-editUsuario" title="Editar" ><i class="far fa-edit"></i></button></a>
                        <button type="button" class="btn btn-danger btn-sm text-white" title="Excluir" onclick="deleteuser(<?php echo $linhas['userid'];?>)" ><i class="far fa-trash-alt"></i></button>
                    </div>
                </td>
            </tr>
            <?php
        }

    }else{
        echo "<h1>Nenhum usuarios encontrado...</h1>";
    }
}


