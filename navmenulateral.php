<nav class="col-md-2 d-none d-md-block bg-light sidebar ">
    <div class="accordion" id="accordionExample">
        <div class="sidebar-sticky">
            <ul class="nav flex-column">
                <!-- DASHBOARD -->
                <li class="nav-item border-bottom">
                    <a class="nav-link active" href="index.php?link=dashboard">
                        <span data-feather="home"></span>
                        Dashboard <span class="sr-only">(current)</span>
                    </a>
                </li>
<!--
                <!-- CLIENTES --
                <li class="nav-item collapsed border-bottom" data-toggle="collapse" data-target="#clientes" aria-expanded="false" aria-controls="collapseThree">
                    <a class="nav-link" href="#">
                        <span data-feather="users"></span>
                        Clientes
                    </a>
                    <div id="clientes" class="collapse hover-item" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body border">
                            <ul class="nav flex-column">
                                <li class="nav-item border-bottom">
                                    <a class="nav-link" href="admin.php?link=31"><span><i class="fas fa-users sm" style="padding: 5px"></i></span>Clientes</a>
                                </li>
                                <li class="nav-item border-bottom">
                                    <a class="nav-link" href="#"><span><i class="fas fa-key" style="padding: 5px"></i></span>Chave Acesso</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>

                <!-- ORDENS --
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span data-feather="file"></span>
                        Orders
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span data-feather="shopping-cart"></span>
                        Products
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span data-feather="bar-chart-2"></span>
                        Reports
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span data-feather="layers"></span>
                        Integrations
                    </a>
                </li>
-->
            </ul>

<!--
            <!-- MOVIMENTOS --
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Movimentos</span>
                <a class="d-flex align-items-center text-muted" href="#">
                    <span data-feather="plus-circle"></span>
                </a>
            </h6>
            <!--FINANCEIRO--
            <ul class="nav flex-column ">
                <li class="nav-item collapsed border-bottom hover-item" data-toggle="collapse" data-target="#financeiro" aria-expanded="false" aria-controls="collapseThree">
                    <a class="nav-link" href="#">
                        <span data-feather="users"></span>
                        Financeiro
                    </a>
                    <div id="financeiro" class="collapse hover-item" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body border">
                            <ul class="nav flex-column">
                                <li class="nav-item ">
                                    <a class="nav-link" href="admin.php?link=2"><span><i class="fas fa-users sm" style="padding: 5px"></i></span>Contas Receber</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><span><i class="fas fa-users sm" style="padding: 5px"></i></span>Contas Á Pagar</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
-->

            <!--CONTROLE DE OCORRENCIA-->
            <ul class="nav flex-column">
                <li class="nav-item collapsed border-bottom hover-item" data-toggle="collapse" data-target="#ocorrencia" aria-expanded="false" aria-controls="collapseThree">
                    <a class="nav-link" href="#">
                        <span data-feather="file-text"></span>
                        Controle de Ocôrrencia
                    </a>
                    <div id="ocorrencia" class="collapse hover-item" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body border">
                            <ul class="nav flex-column">
                                <li class="nav-item ">
                                    <a class="nav-link" href="index.php?link=ocorrencias"><span><i class="far fa-file-alt" style="padding: 5px"></i></span>Ocôrrencias</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="">
                <!-- CONFIGURAÇÕES -->
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Configurações</span>
                    <a class="d-flex align-items-center text-muted" href="#">
                        <span data-feather="plus-circle"></span>
                    </a>
                </h6>

                <!--PARAMETROS-->
                <ul class="nav flex-column">
                    <li class="nav-item collapsed border-bottom" data-toggle="collapse" data-target="#usuarios" aria-expanded="false" aria-controls="collapseThree">
                        <a class="nav-link" href="#">
                            <span data-feather="settings"></span>
                            Parâmetros
                        </a>
                        <div id="usuarios" class="collapse hover-item" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="card-body border">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="admin.php?link=20"><span><i class="far fa-building " style="padding: 5px"></i></span>Empresas</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="index.php?link=usuarios"><span><i class="fas fa-users sm" style="padding: 5px"></i></span>Usuários</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<style>
    .flex-column{
        font-size: 0.9em;
    }
    .card-body{
        padding-top: 0;
    }
</style>