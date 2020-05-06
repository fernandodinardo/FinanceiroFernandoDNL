<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();

require_once '../DAO/CategoriaDAO.php';

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {

    $objDAO = new CategoriaDAO();
    $dados = $objDAO->DetalharCategoria($_GET['cod']);

    if (count($dados) == 0) {
        header('location: consultar_categoria.php');
    }
} else if (isset($_POST['btnSalvar'])) {

    $id = $_POST['cod'];
    $nome = $_POST['nome_cat'];

    $objDAO = new CategoriaDAO();
    $ret = $objDAO->AlterarCategoria($nome, $id);
    header('location: alterar_categoria.php?cod=' . $id . '&ret=' . $ret);
} else if (isset($_POST['btnExcluir'])) {

    $id = $_POST['cod'];
    $objDAO = new CategoriaDAO();
    $ret = $objDAO->ExcluirCategoria($id);
    header('location: consultar_categoria.php?ret=' . $ret);
} else {
    header('location: consultar_categoria.php');
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

                            <h2> Alterar Categoria </h2>   
                            <h5> ( Aqui você irá alterar o cadastro de Categoria ) </h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->

                    <hr />

                    <form method="post" action="alterar_categoria.php">
                        <input type="hidden" name="cod" value="<?= $dados[0]['id_categoria'] ?>" />
                        <div class="form-group">
                            <label> Altere a Categoria: </label>
                            <input class="form-control" placeholder="Digite Aqui..." id="nome_cat" name="nome_cat" value="<?= $dados[0]['nome_categoria'] ?>" />
                            <label id="val_nome_cat" class="validar-campos"> </label>
                        </div>

                        <button onclick="return ValidarTela(2)" class="btn btn-success" name="btnSalvar"> Salvar </button>
                        <button  class="btn btn-danger" name="btnExcluir"> Excluir </button>
                    </form>

                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>

        <!--        
                <script>
                    function ValidarCampos() {
        
                        if ($("#nome_cat").val().trim() === "") {
                            alert('Favor preencher o nome para Categoria!');
                            return-false;
                        }
                    }
                </script>
        -->

    </body>
</html>
