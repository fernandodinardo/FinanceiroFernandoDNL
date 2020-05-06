<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();

require_once '../DAO/ContaDAO.php';

if (isset($_POST['btnSalvar'])) {

    $nome = $_POST['conta_banco'];
    $agencia = $_POST['num_agencia'];
    $numconta = $_POST['num_conta'];
    $saldoconta = $_POST['saldoconta'];

    $objDAO = new ContaDAO();
    $ret = $objDAO->InserirConta($nome, $agencia, $numconta, $saldoconta);
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
                            if (isset($ret)) {
                                ExibirMsg($ret);
                            }
                            ?>

                            <h2> Nova Conta/Banco </h2>   
                            <h5> ( Aqui você irá cadastrar as Contas/Bancos ) </h5>

                        </div>

                    </div>
                    <!-- /. ROW  -->

                    <hr />

                    <form method="post" action="nova_conta.php">
                        <div class="form-group">
                            <label> Nome da Conta / Banco: </label>
                            <input class="form-control" placeholder="Insira o Nome da Conta/Banco..." id="conta_banco" name="conta_banco" onchange="return ValidarTela(3)" />
                            <label id="val_conta_banco" class="validar-campos"> </label>
                        </div>

                        <div class="form-group">
                            <label> Agência: </label>
                            <input class="form-control" placeholder="Insira o No. da Agência..." id="num_agencia" name="num_agencia" onchange="return ValidarTela(3)" />
                            <label id="val_num_agencia" class="validar-campos"> </label>
                        </div>

                        <div class="form-group">
                            <label> Número da Conta: </label>
                            <input class="form-control" placeholder="Insira o No. da Conta..." id="num_conta" name="num_conta" onchange="return ValidarTela(3)" />
                            <label id="val_num_conta" class="validar-campos"> </label>
                        </div>

                        <div class="form-group">
                            <label> Saldo da Conta: </label>
                            <input class="form-control" placeholder="Informe o Saldo da Conta..." id="saldoconta" name="saldoconta" onchange="return ValidarTela(3)" />
                            <label id="val_saldoconta" class="validar-campos"> </label>
                        </div>

                        <button onclick="return ValidarTela(3)" class="btn btn-success" name="btnSalvar"> Salvar </button>
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
