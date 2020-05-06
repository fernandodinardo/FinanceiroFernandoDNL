<?php
require_once '../DAO/UtilDAO.php';

if (isset($_GET['closed']) && $_GET['closed'] == 1) {
    UtilDAO::DeslogarSessao();
}
?>


<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">

            <li>
                <a href="#"><i class="fa fa-sitemap fa-2x"></i> CATEGORIA <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="nova_categoria.php"> Cadastar Nova Categoria </a>
                    </li>

                    <li>
                        <a href="consultar_categoria.php"> Consultar Categoria </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-bank fa-2x"></i> EMPRESA <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="nova_empresa.php"> Cadastrar Nova Empresa </a>
                    </li>

                    <li>
                        <a href="consultar_empresa.php"> Consultar Empresa </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-money fa-2x"></i> CONTA <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="nova_conta.php"> Cadastrar Nova Conta/Banco </a>
                    </li>

                    <li>
                        <a href="consultar_conta.php"> Consultar Conta/Banco </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-refresh fa-2x"></i> MOVIMENTO <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="realizar_movimento.php"> Realizar Movimentos </a>
                    </li>

                    <li>
                        <a href="consultar_movimento.php"> Consultar Movimentos </a>
                    </li>
                </ul>
            </li>

            <li>
                <a class="active-menu" href="_menu.php?closed=1"><i class="fa fa-close fa-2x"></i> SAIR </a>
            </li>	
        </ul>
    </div>
</nav>
