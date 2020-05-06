<?php
require_once '../DAO/CadastroDAO.php';

if (isset($_POST['btnFinalizar'])) {

    $nome = $_POST['nome_completo'];
    $email = $_POST['email_cadastro'];
    $senha = $_POST['senha_cadastro'];
    $confirmasenha = $_POST['senha_confirma'];

    $objDAO = new CadastroDAO();
    $ret = $objDAO->CadastrarUsuario($nome, $email, $senha, $confirmasenha);
}
?>

﻿<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <?php
    include_once '_head.php';
    ?>
    <body>
        <div class="container">
            <div class="row text-center  ">
                <div class="col-md-12">
                    <br /><br />

                    <?php
                    if (isset($ret)) {
                        ExibirMsg($ret);
                    }
                    ?>

                    <h2> FinanceiroSys : CADASTRO </h2>
                    <h5>( Faça seu cadastro para Acesso )</h5>

                    <br />
                </div>
            </div>

            <form action="Cadastro.php" method="post">
                <div class="row">

                    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                        <div class="panel panel-default">

                            <div class="panel-heading">
                                <strong>  Preencha os campos abaixo: </strong>  
                            </div>

                            <div class="panel-body">
                                <form role="form">
                                    <br/>

                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"  ></i></span>
                                        <input type="text" class="form-control" placeholder="Insira seu Nome Completo" id="nome_completo" name="nome_completo" onchange="return ValidarTela(1)" />
                                    </div>

                                    <div class="form-group">
                                        <label id="val_nome_completo" class="validar-campos"></label>
                                    </div>

                                    <div class="form-group input-group">
                                        <span class="input-group-addon">@</span>
                                        <input type="text" class="form-control" placeholder="Insira seu Endereço de Email" id="email_cadastro" name="email_cadastro" onchange="return ValidarTela(1)" />
                                    </div>

                                    <div class="form-group">
                                        <label id="val_email_cadastro" class="validar-campos"></label>
                                    </div>

                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                        <input type="password" class="form-control" placeholder="Informe uma Senha" id="senha_cadastro" name="senha_cadastro" onchange="return ValidarTela(1)" />
                                    </div>

                                    <div class="form-group">
                                        <label id="val_senha_cadastro" class="validar-campos"></label>
                                    </div>

                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                        <input type="password" class="form-control" placeholder="Confirme a Senha" id="senha_confirma" name="senha_confirma" />
                                    </div>

                                    <div class="form-group">
                                        <label id="val_senha_confirma" class="validar-campos"></label>
                                    </div>

                                    <button onclick="return ValidarTela(1)" name="btnFinalizar" class="btn btn-success "> Finalizar Cadastro </button>

                                    <hr />

                                    Já possui um Cadastro?  <a href="Login.php" > Clique Aqui! </a>

                                </form>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <!--
                //Abaixo é uma Function em JAVA SCRIPT (e JQuery) para poder abrir um balão para Preencher os campos Obrigatórios desta Tela "Cadastro.PHP".
                //Mas no caso para ficar um negócio mais Profissional, criamos um arquivo CSS.. e um Arquivo em JavaScript para poder fazer essas validações dos campos da tela.
        -->        
        <!--
                <script>
        
                    function ValidarCampos() {
        
                        if ($("#nome_completo").val().trim() === "") {
                            alert('Favor preencher o Nome Completo!');
                            return-false;
                        }
        
                        if ($("#email_cadastro").val().trim() === "") {
                            alert('Favor preencher o Endereço de E-mail!');
                            return-false;
                        }
        
                        if ($("#senha_cadastro").val().trim() === "") {
                            alert('Favor preencher a sua Senha!');
                            return-false;
                        }
        
                        if ($("#senha_confirma").val().trim() === "") {
                            alert('Favor confirmar a sua Senha!');
                            return-false;
                        }
                    }
        
                </script>
        -->

    </body>

</html>
