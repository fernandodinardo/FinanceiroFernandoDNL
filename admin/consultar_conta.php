<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();

require_once '../DAO/ContaDAO.php';

$objDAO = new ContaDAO();
$contas = $objDAO->ConsultarConta();

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

                            <h2> Consultar Conta/Banco </h2>   
                            <h5> ( Aqui você irá consultar e alterar as Contas/Bancos ) </h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />

                    <div class="row">
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">

                                <div class="panel-heading">
                                    Lista das contas cadastradas:
                                </div>

                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                            <thead>
                                                <tr>
                                                    <th> Nome da Conta / Banco </th>
                                                    <th> Agência </th>
                                                    <th> Número da Conta </th>
                                                    <th> Saldo da Conta </th>
                                                    <th> Status </th>
                                                    <th> Ação </th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php for ($i = 0; $i < count($contas); $i++) { ?>

                                                    <tr class="odd gradeX">
                                                        <td> <?= $contas [$i]['nome_conta'] ?> </td>
                                                        <td> <?= $contas [$i]['agencia_conta'] ?> </td>
                                                        <td> <?= $contas [$i]['numero_conta'] ?> </td>
                                                        <td> R$ <?= $contas [$i]['saldo_conta'] ?> </td>
                                                        <td> <?= $contas [$i]['status_conta'] == 0 ? 'Inativo' : 'Ativo' ?> </td>

                                                        <td>  
                                                            <a href="alterar_conta.php?cod=<?= $contas[$i]['id_conta'] ?>" class="btn btn-warning btn-xs"> Alterar </a>
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
