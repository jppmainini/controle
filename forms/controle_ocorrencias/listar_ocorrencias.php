<?php

?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-1 border-bottom ">
    <h1 class="h2">Ocôrrencias</h1>
    <div class="btn-toolbar mb-1 mb-md-0">
        <div class="btn mr-0">
            <a href="index.php?link=nova-ocorrencia"><button class="btn btn-sm btn-primary" name="nova-ocorrencia"><i class="fas fa-user-plus"></i> Novo</button></a>
            <button class="btn btn-sm btn-danger" id="delsel"><i class="far fa-trash-alt"></i> Delete</button>
        </div>
        <button class="btn btn-sm btn-outline-secondary dropdown-toggle pt-1">
            <span data-feather="calendar"></span>
            This week
        </button>
    </div>
</div>



    <div class="mt-4">
        <div class="card">
            <div class="card-header alert-info">
                <div class="row">
                    <div class="col-3">
                        Ocôrrencia: <strong>00000</strong>
                    </div>
                    <div class="col-6">
                        Cliente: <strong>Nome do Cliente</strong>
                    </div>
                    <div class="col-2">
                        Situação: <strong>Pendente</strong>
                    </div>
                    <div class="col">
                        <input type="button" class="btn btn-sm btn-info float-lg-right" value="Finalizar">
                    </div>
                </div>
            </div>
            <div class="card-body mt-2">
                <div class="row border-bottom">
                    <div class="col-6">
                        <strong>Analista: </strong>Fulano
                    </div>
                    <div class="col-6">
                        <strong>Criado: </strong>01/01/2018 15:00:00
                    </div>
                </div>
                <div class="row border-bottom mt-1">
                    <div class="col-6">
                        <strong>Programador: </strong>Fulano
                    </div>
                    <div class="col-6">
                        <strong>Finalizado: </strong>
                    </div>
                </div>
                <h1 class="h5 font-weight-bold mt-2">Solicitação:</h1>
                <p>
                    1-> Lorem ipsum dolor sit amet,sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,  At vero eos et accusam et justo duo dolores et ea rebum.  Lorem ipsum dolor sit amet,  no sea takimata sanctus est Lorem ipsum dolor sit amet.  Stet clita kasd gubergren,  no sea takimata sanctus est Lorem ipsum dolor sit amet.  no sea takimata sanctus est Lorem ipsum dolor sit amet.  no sea takimata sanctus est Lorem ipsum dolor sit amet.  sed diam voluptua.
                </p>

                <!--
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
                -->
            </div>
            <div class="card-footer">
                <div class="d-flex">
                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary btn-sm"><i class="far fa-folder-open"></i> Abrir</button>
                        <button type="button" class="btn btn-secondary btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                            <a class="dropdown-item text-primary font-weight-bold" href="#">Editar</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger font-weight-bold" href="#">Excluir</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <div class="card">
            <div class="card-header alert-warning">
                <div class="row">
                    <div class="col-3">
                        Ocôrrencia: <strong>00000</strong>
                    </div>
                    <div class="col-6">
                        Cliente: <strong>Nome do Cliente</strong>
                    </div>
                    <div class="col-2">
                        Situação: <strong>Pendente</strong>
                    </div>
                    <div class="col">
                        <input type="button" class="btn btn-sm btn-info float-lg-right" value="Finalizar">
                    </div>
                </div>
            </div>
            <div class="card-body mt-2">
                <div class="row border-bottom">
                    <div class="col-6">
                        <strong>Analista: </strong>Fulano
                    </div>
                    <div class="col-6">
                        <strong>Criado: </strong>01/01/2018 15:00:00
                    </div>
                </div>
                <div class="row border-bottom mt-1">
                    <div class="col-6">
                        <strong>Programador: </strong>Fulano
                    </div>
                    <div class="col-6">
                        <strong>Finalizado: </strong>
                    </div>
                </div>
                <h1 class="h5 font-weight-bold mt-2">Solicitação:</h1>
                <p>
                    1-> Lorem ipsum dolor sit amet,sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,  At vero eos et accusam et justo duo dolores et ea rebum.  Lorem ipsum dolor sit amet,  no sea takimata sanctus est Lorem ipsum dolor sit amet.  Stet clita kasd gubergren,  no sea takimata sanctus est Lorem ipsum dolor sit amet.  no sea takimata sanctus est Lorem ipsum dolor sit amet.  no sea takimata sanctus est Lorem ipsum dolor sit amet.  sed diam voluptua.
                </p>

                <!--
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
                -->
            </div>
            <div class="card-footer">
                <input type="button" class="btn btn-sm btn-danger float-right mr-1" value="Excluir">
                <input type="button" class="btn btn-sm btn-warning float-right mr-1" value="Editar">
            </div>
        </div>
    </div>
    <div class="mt-4">
        <div class="card">
            <div class="card-header alert-danger">
                <div class="row">
                    <div class="col-3">
                        Ocôrrencia: <strong>00000</strong>
                    </div>
                    <div class="col-6">
                        Cliente: <strong>Nome do Cliente</strong>
                    </div>
                    <div class="col-2">
                        Situação: <strong>Pendente</strong>
                    </div>
                    <div class="col">
                        <input type="button" class="btn btn-sm btn-info float-lg-right" value="Finalizar">
                    </div>
                </div>
            </div>
            <div class="card-body mt-2">
                <div class="row border-bottom">
                    <div class="col-6">
                        <strong>Analista: </strong>Fulano
                    </div>
                    <div class="col-6">
                        <strong>Criado: </strong>01/01/2018 15:00:00
                    </div>
                </div>
                <div class="row border-bottom mt-1">
                    <div class="col-6">
                        <strong>Programador: </strong>Fulano
                    </div>
                    <div class="col-6">
                        <strong>Finalizado: </strong>
                    </div>
                </div>
                <h1 class="h5 font-weight-bold mt-2">Solicitação:</h1>
                <p>
                    1-> Lorem ipsum dolor sit amet,sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,  At vero eos et accusam et justo duo dolores et ea rebum.  Lorem ipsum dolor sit amet,  no sea takimata sanctus est Lorem ipsum dolor sit amet.  Stet clita kasd gubergren,  no sea takimata sanctus est Lorem ipsum dolor sit amet.  no sea takimata sanctus est Lorem ipsum dolor sit amet.  no sea takimata sanctus est Lorem ipsum dolor sit amet.  sed diam voluptua.
                </p>

                <!--
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
                -->
            </div>
            <div class="card-footer">
                <input type="button" class="btn btn-sm btn-danger float-right mr-1" value="Excluir">
                <input type="button" class="btn btn-sm btn-warning float-right mr-1" value="Editar">
            </div>
        </div>
    </div>