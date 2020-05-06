<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();

require_once '../DAO/EmpresaDAO.php';

if(isset($_POST['btnSalvar'])) {
    
    $nome = $_POST['nome_empresa'];
    $endereco = $_POST['endereco_empresa'];
    $telefone = $_POST['telefone_empresa'];
    
    $objDAO = new EmpresaDAO();
    $ret = $objDAO->InserirEmpresa($nome, $endereco, $telefone);
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

                            <h2> Nova Empresa </h2>   
                            <h5> ( Aqui você irá cadastrar as Empresas ) </h5>

                        </div>

                    </div>
                    <!-- /. ROW  -->

                    <hr />
                    <form method="post" action="nova_empresa.php">
                        <div class="form-group">
                            <label> Digite o nome da Empresa: </label>
                            <input class="form-control" placeholder="Insira o nome da empresa..." id="nome_empresa" name="nome_empresa" onchange="return ValidarTela(4)" />
                            <label id="val_nome_empresa" class="validar-campos"> </label>
                        </div>

                        <div class="form-group">
                            <label> Digite o endereço da Empresa: </label>
                            <input class="form-control" placeholder="Insira o endereço da empresa..." id="endereco_empresa" name="endereco_empresa" onchange="return ValidarTela(4)" />
                            <label id="val_endereco_empresa" class="validar-campos"> </label>
                        </div>

                        <div class="form-group">
                            <label> Digite o telefone da Empresa: </label>
                            <input class="form-control" placeholder="Insira o telefone da empresa..." id="telefone_empresa" name="telefone_empresa" onchange="return ValidarTela(4)" />
                            <label id="val_telefone_empresa" class="validar-campos"> </label>
                        </div>

                        <button onclick="return ValidarTela(4)" class="btn btn-success" name="btnSalvar"> Salvar </button>
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
