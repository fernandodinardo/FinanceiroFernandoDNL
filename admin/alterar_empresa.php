<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();

require_once '../DAO/EmpresaDAO.php';

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {

    $objDAO = new EmpresaDAO();
    $dados = $objDAO->DetalharEmpresa($_GET['cod']);

    if (count($dados) == 0) {
        header('location: consultar_empresa.php');
    }
} else if (isset($_POST['btnSalvar'])) {

    $id = $_POST['cod'];
    $nome = $_POST['nome_empresa'];
    $endereco = $_POST['endereco_empresa'];
    $telefone = $_POST['telefone_empresa'];

    $objDAO = new EmpresaDAO();
    $ret = $objDAO->AlterarEmpresa($nome, $endereco, $telefone, $id);
    header('location: alterar_empresa.php?cod=' . $id . '&ret=' . $ret);
} else if (isset($_POST['btnExcluir'])) {

    $id = $_POST['cod'];
    $objDAO = new EmpresaDAO();
    $ret = $objDAO->ExcluirEmpresa($id);
    header('location: consultar_empresa.php?ret=' . $ret);
    
} else {
    header('location: consultar_empresa.php');
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

                            <h2> Alterar Empresa </h2>   
                            <h5> ( Aqui você irá alterar o cadastro da Empresa ) </h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->

                    <hr />

                    <form method="post" action="alterar_empresa.php">
                        <input type="hidden" name="cod" value="<?= $dados[0]['id_empresa'] ?>" />
                        <div class="form-group">
                            <label> Nome da Empresa: </label>
                            <input class="form-control" placeholder="Digite Aqui..." id="nome_empresa" name="nome_empresa" value="<?= $dados[0]['nome_empresa'] ?>" onchange="return ValidarTela(4)" />
                            <label id="val_nome_empresa" class="validar-campos"> </label>
                        </div>

                        <div class="form-group">
                            <label> Endereço da Empresa: </label>
                            <input class="form-control" placeholder="Digite Aqui..." id="endereco_empresa" name="endereco_empresa" value="<?= $dados[0]['endereco_empresa'] ?>" onchange="return ValidarTela(4)" />
                            <label id="val_endereco_empresa" class="validar-campos"> </label>
                        </div>

                        <div class="form-group">
                            <label> Telefone da Empresa: </label>
                            <input class="form-control" placeholder="Digite Aqui..." id="telefone_empresa" name="telefone_empresa" value="<?= $dados[0]['telefone_empresa'] ?>" onchange="return ValidarTela(4)" />
                            <label id="val_telefone_empresa" class="validar-campos"> </label>
                        </div>

                        <button onclick="return ValidarTela(4)" type="submit" class="btn btn-success" name="btnSalvar"> Salvar </button>
                        <button type="submit" class="btn btn-danger" name="btnExcluir"> Excluir </button>
                    </form>                                        
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>

        <!--
                <script>
        
                    function ValidarCampos() {
        
                        if ($("#nome_empresa").val().trim() === "") {
                            alert('Favor preencher o Nome da Empresa!');
                            return-false;
                        }
        
                        if ($("#endereco_empresa").val().trim() === "") {
                            alert('Favor preencher o endereço da empresa!');
                            return-false;
                        }
        
                        if ($("#telefone_empresa").val().trim() === "") {
                            alert('Favor preencher o Telefone da Empresa!');
                            return-false;
                        }
                    }
        
                </script>
        -->

    </body>
</html>
