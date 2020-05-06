<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();

require_once '../DAO/CategoriaDAO.php';

$objDAO = new CategoriaDAO();
$categorias = $objDAO->ConsultarCategoria();

//echo '<pre>';
//print_r($categorias);
//echo '</pre>';
//
//echo count($categorias);
?>

﻿<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

    <?php
    include_once '_head.php';
    ?>
    <body>
        <div id="wrapper">
            <?php
            include_once '_topo.php';
            include_once '_menu.php';
            ?>

            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">

                            <?php
                            if (isset($_GET['ret'])) {
                                ExibirMsg($_GET['ret']);
                            }
                            ?>

                            <h2> Consultar Categoria </h2>   
                            <h5> ( Aqui você irá consultar e alterar as Categorias ) </h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />

                    <div class="row">
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">

                                <div class="panel-heading">
                                    Lista das categorias cadastradas:
                                </div>

                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                            <thead>
                                                <tr>
                                                    <th> Nome da Categoria </th>
                                                    <th> Ação </th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php for ($i = 0; $i < count($categorias); $i++) { ?>

                                                    <tr class="odd gradeX">
                                                        <td> <?= $categorias[$i]['nome_categoria'] ?> </td>
                                                        <td>  
                                                            <a href="alterar_categoria.php?cod=<?= $categorias[$i]['id_categoria'] ?>" class="btn btn-warning btn-xs"> Alterar </a>
                                                        </td>
                                                    </tr>

                                                <?php } ?>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--End Advanced Tables -->
                        </div>
                    </div>
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
    </body>
</html>
