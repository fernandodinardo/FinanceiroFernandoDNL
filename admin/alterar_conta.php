<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();

require_once '../DAO/ContaDAO.php';

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {

    $objDAO = new ContaDAO();
    $dados = $objDAO->DetalharConta($_GET['cod']);

    if (count($dados) == 0) {
        header('location: consultar_conta.php');
    }
} else if (isset($_POST['btnSalvar'])) {

    $id = $_POST['cod'];
    $nome = $_POST['contabanco'];
    $agencia = $_POST['numagencia'];
    $numconta = $_POST['numconta'];
    $saldoconta = $_POST['saldoconta'];
    $status = $_POST['status_conta'];

    $objDAO = new ContaDAO();
    $ret = $objDAO->AlterarConta($nome, $agencia, $numconta, $saldoconta, $status, $id);
    header('location: alterar_conta.php?cod=' . $id . '&ret=' . $ret);
} else if (isset($_POST['btnExcluir'])) {

    $id = $_POST['cod'];
    $objDAO = new ContaDAO();
    $ret = $objDAO->ExcluirConta($id);
    header('location: consultar_conta.php?ret=' . $ret);
} else {
    header('location: consultar_conta.php');
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
if (isset($_GET['ret'])) {
    ExibirMsg($_GET['ret']);
}
?>

                            <h2> Alterar Conta/Banco </h2>   
                            <h5> ( Aqui você irá alterar o cadastro da Conta/Banco ) </h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->

                    <hr />

                    <form action="alterar_conta.php" method="post">
                        <input type="hidden" name="cod" value="<?= $dados[0]['id_conta'] ?>" />
                        <div class="form-group">
                            <label> Nome da Conta/Banco: </label>
                            <input class="form-control" placeholder="Digite Aqui..." id="conta_banco" name="contabanco" value="<?= $dados[0]['nome_conta'] ?>" onchange="return ValidarTela(3)" />
                            <label id="val_conta_banco" class="validar-campos"> </label>
                        </div>

                        <div class="form-group">
                            <label> Alterar Agência: </label>
                            <input class="form-control" placeholder="Digite Aqui..." id="num_agencia" name="numagencia" value="<?= $dados[0]['agencia_conta'] ?>" onchange="return ValidarTela(3)" />
                            <label id="val_num_agencia" class="validar-campos"> </label>
                        </div>

                        <div class="form-group">
                            <label> Alterar o Número da Conta: </label>
                            <input class="form-control" placeholder="Digite Aqui..." id="num_conta" name="numconta" value="<?= $dados[0]['numero_conta'] ?>" onchange="return ValidarTela(3)" />
                            <label id="val_num_conta" class="validar-campos"> </label>
                        </div>

                        <div class="form-group">
                            <label> Alterar o Saldo da Conta: </label>
                            <input class="form-control" placeholder="Digite Aqui..." id="saldoconta" name="saldoconta" value="<?= $dados[0]['saldo_conta'] ?>" onchange="return ValidarTela(3)" />
                            <label id="val_saldoconta" class="validar-campos"> </label>
                        </div>

                        <div class="form-group">
                            <label> Status </label>
                            <select class="form-control" name="status_conta">
                                <option value="1" <?= $dados[0]['status_conta'] == 1 ? 'selected' : '' ?>  > Ativa </option>
                                <option value="0" <?= $dados[0]['status_conta'] == 0 ? 'selected' : '' ?>  > Inativa </option>
                            </select>
                        </div>

                        <button onclick="return ValidarTela(3)" type="submit" class="btn btn-success" name="btnSalvar"> Salvar </button>
                        <button class="btn btn-danger" name="btnExcluir"> Excluir </button>
                    </form>

                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>

        <!--        
                <script>
        
                    function ValidarCampos() {
        
                        if ($("#conta_banco").val().trim() === "") {
                            alert('Favor preencher o Nome da Conta/Banco!');
                            return-false;
                        }
        
                        if ($("#num_agencia").val().trim() === "") {
                            alert('Favor preencher o No. da Agência!');
                            return-false;
                        }
        
                        if ($("#num_conta").val().trim() === "") {
                            alert('Favor preencher o No. da Conta!');
                            return-false;
                        }
        
                        if ($("#saldoconta").val().trim() === "") {
                            alert('Favor informar o Saldo desta Conta!');
                            return-false;
                        }
                    }
        
                </script>
        -->

    </body>
</html>
