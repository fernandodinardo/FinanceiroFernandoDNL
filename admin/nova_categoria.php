<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();

require_once '../DAO/CategoriaDAO.php';

if (isset($_POST['btnSalvar'])) {
    
    $nome = $_POST ['nome_cat'];
    $objDAO = new CategoriaDAO();
    $ret = $objDAO->InserirCategoria($nome);
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
                            if(isset($ret)) {
                                ExibirMsg($ret);
                            }
                            ?>
                            <h2> Nova Categoria </h2>   
                            <h5> ( Aqui você irá cadastrar as Categorias ) </h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->

                    <hr />

                    <form method="post" action="nova_categoria.php">

                        <div class="form-group">
                            <label> Digite um nome para Categoria: </label>
                            <input class="form-control" placeholder="Insira o nome para categoria..."  id="nome_cat" name="nome_cat" />
                            <label id="val_nome_cat" class="validar-campos"> </label>
                        </div>

                        <button onclick="return ValidarTela(2)" class="btn btn-success" name="btnSalvar"> Salvar </button>
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
