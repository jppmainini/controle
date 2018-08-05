<?php
    $resultado = mysqli_query($dbConect, "select * from usuarios order by userid");
    $linhas = mysqli_num_rows($resultado);
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-1 ">
    <h1 class="h2">Cadastro de Usuários</h1>
    <div class="btn-toolbar mb-1 mb-md-0">
        <div class="btn mr-0">
            <a href="index.php?link=novo-usuario"><button class="btn btn-sm btn-primary" name="novo-usuario"><i class="fas fa-user-plus"></i> Novo</button></a>
            <button class="btn btn-sm btn-danger" id="delsel"><i class="far fa-trash-alt"></i> Delete</button>
        </div>
        <button class="btn btn-sm btn-outline-secondary dropdown-toggle pt-1">
            <span data-feather="calendar"></span>
            This week
        </button>
    </div>
</div>

<!--<form method="post" action="">-->
    <input class="form-control w-100" type="search" name="pesquisa" id="pesquisa" placeholder="Pesquisar" aria-label="Search" autocomplete="off">
    <p>
        <?php
        if(isset($_SESSION['cad-user-sucess'])){//isset mandar imprimir
            echo $_SESSION['cad-user-sucess']; //echo imprimir
            unset($_SESSION['cad-user-sucess']); //unset destoi a variavel
        }
        ?>
    </p>

    <!--<h2>Section title</h2>-->
    <div class="table-responsive">
        <table class="table table-sm table-bordered table-hover">
            <thead>
            <tr>
                <!--<th><input type="checkbox" class="m-md-1" name="checkboxall" id="checkboxall"></th>-->
                <th class="m-md-1">#</th>
                <th>Codigo</th>
                <th>Nome:</th>
                <th>e-Mail:</th>
                <th>Usuario:</th>
                <th>Nivel:</th>
                <th>Ações:</th>
            </tr>
            </thead>
            <tbody class="resultado">
            <?php while ($linhas = mysqli_fetch_array($resultado)){?>
            <tr  id="resultado">
                <td class="text-center" style="width: 2%"><input type="checkbox" class="checkbox m-md-1 checkboxid" name="userid[]" value="<?php echo $linhas['userid']?>" ></td>
                <td style="width: 5%"><?php echo $linhas['userid']?></td>
                <td style="width: 20%"><?php echo $linhas['usernome']?></td>
                <td style="width: 25%"><?php echo $linhas['useremail']?></td>
                <td style="width: 15%"><?php echo $linhas['userusuario']?></td>
                <td style="width: 10%"><?php
                    if ($linhas['nivel_acesso'] == 1){
                        echo 'Administrador';
                    }
                    if ($linhas['nivel_acesso'] == 2){
                        echo 'Operador';
                    }
                    if ($linhas['nivel_acesso'] == 3){
                        echo 'Usuário';
                    }
                    ?>
                </td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm text-white" data-toggle="modal" data-target="#gridSystemModal<?php echo $linhas['userid']?>" title="Visualizar" ><i class="far fa-eye"></i></button>
                    <a href='index.php?link=editar-usuario&id=<?php echo $linhas['userid'];?>'><button type="button" class="btn btn-warning btn-sm text-white" name="btn-editUsuario" title="Editar" ><i class="far fa-edit"></i></button></a>
                    <button type="button" class="btn btn-danger btn-sm text-white" title="Excluir" onclick="deleteuser(<?php echo $linhas['userid'];?>)" ><i class="far fa-trash-alt"></i></button>
                </td>
            </tr>
                <!-- INICIO DO MODAL -->
                <div id="gridSystemModal<?php echo $linhas['userid']?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
                    <div class="modal-lg modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="gridModalLabel">Visualização do Usuário</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid bd-example-row ">
                                    <div class="row">
                                        <div class="col-md-12"><strong>Código: </strong><?php echo $linhas['userid']?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-9"><strong>Nome: </strong> <?php echo $linhas['usernome']?></div>
                                        <div class="col-md-3"><strong>Usuário: </strong> <?php echo $linhas['userusuario']?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-9"><strong>eMail: </strong> <?php echo $linhas['useremail']?></div>
                                        <div class="col-md-3"><strong>Nível: </strong> <?php echo $linhas['nivel_acesso']?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FIM MODAL -->
                <?php
            }
            ?>
        </tbody>
    </table>
<!--</form>-->

<script language="JavaScript">
    /*function deleteuser(delid) {
        if (confirm("Deseja realmente excluir o usuario ?")){
            window.location.href="processa/pro_excluir_usuario.php?del_id="+delid;
            return true;
        }
    }*/
    // DELETA UNITARIO
    function deleteuser(delid) {
        var resposta = confirm("Deseja realmente excluir o usuario ?");
        if (resposta == true){
            window.location.href = "index.php?link=deleta-usuario&del_id="+delid;
        }
    }
    // CHECKBOX NA GRID
    $(document).ready(function () {
        $('#checkboxall').click(function () {
            if ($(this).is(":checked"))
                $('.checkboxid').prop('checked', true);
            else
                $('.checkboxid').prop('checked', false);
        })
    })

    // DELETA MULTIPLOS
    $(document).ready(function () {
        $('#delsel').click(function () {
            if(confirm("Deseja Realmente excluir esses dados selecionados ?")){
                var id = [];

                $(':checkbox:checked').each(function (i) {
                    id[i] = $(this).val();
                });
                if(id.length === 0){
                    alert("Selecione pelomenos um item.")
                } else {
                    alert(id);
                    $.ajax({
                        url: "processa/cadastros/usuarios/pro_cad_usuarios.php",
                        method: "POST",
                        data: {id: id},
                        success: function() {
                            alert(id);
                            for (var i = 0; i < id.length; i++) {
                                $('tr#' + id[i] + '').css('background-color', '#ccc');
                                $('tr#' + id[i] + '').fadeOut('slow');
                            }
                        }
                    });
                }

            }else{
                return false;
            }
        });
    });

    const inputEle = document.getElementById('pesquisa');
    inputEle.addEventListener('keyup', function(e){
        var key = e.which || e.keyCode;
        if (key == 13) {
            // PESQUISA
            $(function () {
                var pesquisa = $(inputEle).val();
                if((pesquisa != '') || (pesquisa == '')){
                    var dados = {
                        palavra : pesquisa
                    }
                    $.post('processa/cadastros/usuarios/busca_usuario.php', dados, function (retorna) {
                        $(".resultado").html(retorna);
                    });
                }else {
                    $(".resultado").html(retorna);
                }
            });
        }
    });

    /*
    //PESQUISA
    $(function () {
        $("#pesquisa").keyup(function () {
            var pesquisa = $(this).val();
            if((pesquisa != '') || (pesquisa == '')){
                var dados = {
                    palavra : pesquisa
                }
                $.post('processa/cadastros/usuarios/busca_usuario.php', dados, function (retorna) {
                    $(".resultado").html(retorna);
                });
            }else {
                $(".resultado").html(retorna);
            }
        });
    });
*/
</script>
