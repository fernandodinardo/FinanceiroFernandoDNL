<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();

require_once '../DAO/MovimentoDAO.php';

$tipo_mov = '';
$dtaInicial = '';
$dtaFim = '';

if (isset($_POST['btnPesquisar'])) {

    $dao = new MovimentoDAO();

    $tipo_mov = $_POST['tipo_mov'];
    $dtaInicial = $_POST['dtainicial'];
    $dtaFim = $_POST['dtafinal'];

    $movimentos = $dao->FiltrarMovimento($tipo_mov, $dtaInicial, $dtaFim);
} else if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {

    //Valores para manter o filtro da pesquisa;
    $tipo_mov = $_GET['tipo_filtro'];
    $dtaInicial = $_GET['dt_ini'];
    $dtaFim = $_GET['dt_fim'];

    //Dados para fazer a Exclusão;
    $cod = $_GET['cod'];
    $codConta = $_GET['cod_conta'];
    $tipoExc = $_GET['tipo_mov'];
    $valorExc = $_GET['valor'];

    $dao = new MovimentoDAO();

    $ret = $dao->ExcluirMovimento($cod, $codConta, $tipoExc, $valorExc);
    $movimentos = $dao->FiltrarMovimento($tipo_mov, $dtaInicial, $dtaFim);
}
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
                            if (isset($movimentos) && $movimentos == 0) {
                                ExibirMsg(0);
                            } else if (isset($ret)) {
                                ExibirMsg($ret);
                            }
                            ?>

                            <h2> Consultar Movimentos </h2>   
                            <h5> ( Aqui você irá consultar / excluir os seus Movimentos ) </h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />

                    <form action="consultar_movimento.php" method="post">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label> Tipo </label>
                                <select class="form-control" name="tipo_mov">  
                                    <option value="0" <?= $tipo_mov == 0 ? 'selected' : '' ?> > TODOS </option>
                                    <option value="1" <?= $tipo_mov == 1 ? 'selected' : '' ?> > Entrada </option>
                                    <option value="2" <?= $tipo_mov == 2 ? 'selected' : '' ?> > Saída </option>
                                </select>
                            </div>                    
                        </div>

                        <div class="col-lg-6">

                            <div class="form-group">
                                <label> Data Inicial </label>
                                <input type="date" class="form-control" name="dtainicial" value="<?= $dtaInicial ?>">
                            </div>

                        </div>

                        <div class="col-lg-6">

                            <div class="form-group">
                                <label> Data Final </label>
                                <input type="date" class="form-control" name="dtafinal" value="<?= $dtaFim ?>">
                            </div>

                        </div>

                        <div class="form-group">
                            <center>
                                <button class="btn btn-info" name="btnPesquisar"> Pesquisar </button>
                            </center>
                        </div>

                    </form>

                    <?php if (isset($movimentos) && $movimentos != 0) { ?>                    
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Advanced Tables -->
                                <div class="panel panel-default">

                                    <div class="panel-heading">
                                        Movimentos encontrados:
                                    </div>

                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                                <thead>
                                                    <tr>
                                                        <th> Data do movimento </th>
                                                        <th> Empresa </th>
                                                        <th> Categoria </th>
                                                        <th> Conta </th>
                                                        <th> Valor </th>
                                                        <th> Tipo </th>
                                                        <th> Observação </th>
                                                        <th> Ação </th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    <?php for ($i = 0; $i < count($movimentos); $i++) { ?>

                                                        <tr class="odd gradeX">
                                                            <td> <?= $movimentos [$i]['data_movimento'] ?> </td>
                                                            <td> <?= $movimentos [$i]['nome_empresa'] ?> </td>
                                                            <td> <?= $movimentos [$i]['nome_categoria'] ?> </td>
                                                            <td> <?= $movimentos [$i]['nome_conta'] ?> / <?= $movimentos [$i]['numero_conta'] ?> </td>
                                                            <td> <?= $movimentos [$i]['valor_movimento'] ?> </td>
                                                            <td> <?= $movimentos [$i]['tipo_movimento'] == 1 ? 'Entrada' : 'Saída' ?> </td>
                                                            <td> <?= $movimentos [$i]['obs_movimento'] ?> </td>
                                                            <td>  
                                                                <a href="consultar_movimento.php?cod=<?= $movimentos[$i]['id_movimento'] ?>&cod_conta=<?= $movimentos[$i]['id_conta'] ?>&tipo_mov=<?= $movimentos [$i]['tipo_movimento'] ?>&valor=<?= $movimentos [$i]['valor_movimento'] ?>&tipo_filtro=<?= $tipo_mov ?>&dt_ini=<?= $dtaInicial ?>&dt_fim=<?= $dtaFim ?>" class="btn btn-danger btn-xs"> Excluir </a>
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
                    <?php } ?>                    

                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>


    </body>

</html>
