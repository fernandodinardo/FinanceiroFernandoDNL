<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();

require_once '../DAO/MovimentoDAO.php';
require_once '../DAO/CategoriaDAO.php';
require_once '../DAO/ContaDAO.php';
require_once '../DAO/EmpresaDAO.php';

$objDAO_Cat = new CategoriaDAO();
$objDAO_Conta = new ContaDAO();
$objDAO_Emp = new EmpresaDAO();

if (isset($_POST['btnSalvar'])) {

    $tipomovimento = $_POST['tipo_movimento'];
    $dtamovimento = $_POST['dtamovimento'];
    $vlrmovimento = $_POST['vlrmovimento'];

    $selempresa = $_POST['sel_empresa'];
    $selcategoria = $_POST['sel_categoria'];
    $selconta = $_POST['sel_conta'];
    $obs = $_POST ['obs_conta'];

    $objDAO = new MovimentoDAO();
    $ret = $objDAO->InserirMovimento($tipomovimento, $dtamovimento, $vlrmovimento, $selempresa, $selcategoria, $selconta, $obs);
}

$categorias = $objDAO_Cat->ConsultarCategoria();
$contas = $objDAO_Conta->ConsultarConta();
$empresas = $objDAO_Emp->ConsultarEmpresa();
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
                            if (isset($ret)) {
                                ExibirMsg($ret);
                            }
                            ?>

                            <h2> Realizar Movimento </h2>   
                            <h5> ( Aqui você irá realizar os Movimentos de Entrada / Saída ) </h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->

                    <hr />

                    <form action="realizar_movimento.php" method="post">

                        <div class="form-group">
                            <label> Selecione o tipo de movimento: </label>
                            <select class="form-control" id="tipo_movimento" name="tipo_movimento" onchange="return ValidarTela(5)">
                                <option value=""> Selecione o movimento.. </option>
                                <option value="1"> 1-Entrada </option>
                                <option value="2"> 2-Saída </option>
                            </select>
                            <label id="val_tipo_movimento" class="validar-campos"> </label>
                        </div>

                        <div class="form-group">
                            <label> Data do Movimento: </label>
                            <input type="date" class="form-control" placeholder="Informe a Data do Movimento..." id="dtamovimento" name="dtamovimento" onchange="return ValidarTela(5)" />
                            <label id="val_dtamovimento" class="validar-campos"> </label>
                        </div>

                        <!--
                        <div class="form-group"> <label> Valor: </label> </div>
                        <div class="form-group input-group">
                        <span class="input-group-addon">R$</span>
                        <input class="form-control" placeholder="Insira o Valor do Movimento..." />
                        </div>
                        -->

                        <div class="form-group"> <label> Valor: </label>
                            <div class="form-group input-group">
                                <span class="input-group-addon">R$</span>
                                <input class="form-control" placeholder="Insira o Valor do Movimento..." id="vlr_movimento" name="vlrmovimento" onchange="return ValidarTela(5)" />
                            </div>
                            <label id="val_vlr_movimento" class="validar-campos"> </label>
                        </div>

                        <div class="form-group">
                            <label> Selecione a Empresa: </label>
                            <select class="form-control" id="selempresa" name="sel_empresa" onchange="return ValidarTela(5)">
                                <option value="">Selecione a Empresa..</option>

                                <?php for ($i = 0; $i < count($empresas); $i++) { ?>
                                    <option value="<?= $empresas[$i]['id_empresa'] ?>"><?= $empresas[$i]['nome_empresa'] ?></option>
                                <?php } ?>
                            </select>
                            <label id="val_selempresa" class="validar-campos"> </label>
                        </div>

                        <div class="form-group">
                            <label> Selecione a Categoria: </label>
                            <select class="form-control" id="selcategoria" name="sel_categoria" onchange="return ValidarTela(5)">
                                <option value="">Selecione a Categoria..</option>

                                <?php for ($i = 0; $i < count($categorias); $i++) { ?>
                                    <option value="<?= $categorias[$i]['id_categoria'] ?>"><?= $categorias[$i]['nome_categoria'] ?></option>
                                <?php } ?>

                            </select>
                            <label id="val_selcategoria" class="validar-campos"> </label>
                        </div>

                        <div class="form-group">
                            <label> Selecione a Conta/Banco: </label>
                            <select class="form-control" id="selconta" name="sel_conta" onchange="return ValidarTela(5)">
                                <option value="">Selecione a Conta/Banco..</option>

                                <?php for ($i = 0; $i < count($contas); $i++) { ?>
                                    <option value="<?= $contas[$i]['id_conta'] ?>"><?= $contas[$i]['nome_conta'] ?></option>
                                <?php } ?>
                            </select>
                            <label id="val_selconta" class="validar-campos"> </label>
                        </div>

                        <div class="form-group">
                            <label> Observação </label>
                            <textarea class="form-control" rows="3" name="obs_conta"></textarea>
                        </div>

                        <button onclick="return ValidarTela(5)" type="submit" class="btn btn-success" name="btnSalvar"> Salvar </button>
                    </form>
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
    </body>
</html>
