function ValidarTela(numero_tela) {

    var ret = true;

    switch (numero_tela) {

        case 1:  //Tela "Cadastro.PHP"
            if ($("#nome_completo").val().trim() === "") {
                $("#val_nome_completo").show().html("**Preencher o campo Nome!!");
                ret = false;
            } else {
                $("#val_nome_completo").hide();
            }

            if ($("#email_cadastro").val().trim() === "") {
                $("#val_email_cadastro").show().html("**Preencher o campo E-mail!!");
                ret = false;
            } else {
                $("#val_email_cadastro").hide();
            }

            if ($("#senha_cadastro").val().trim() === "") {
                $("#val_senha_cadastro").show().html("**Preencher o campo Senha!!");
                ret = false;

            } else if ($("#senha_cadastro").val().trim().length < 6) {
                $("#val_senha_cadastro").show().html("**Favor inserir uma Senha com no mínimo 6 dígitos!!");

                ret = false;

            } else if ($("#senha_cadastro").val().trim() !== $("#senha_confirma").val().trim()) {
                $("#val_senha_cadastro").hide();
                $("#val_senha_confirma").show().html("**As Senhas informadas não conferem!");
                ret = false;
            }
            break;


        case 2:  //Tela "nova_categoria.PHP" .e. Tela "alterar_categoria.PHP"
            if ($("#nome_cat").val().trim() === "") {
                $("#val_nome_cat").show().html("**Preencher o nome para Categoria!!");
                ret = false;
            } else {
                $("#val_nome_cat").hide();
            }
            break;


        case 3:  //Tela "nova_conta.PHP" .e. Tela "alterar_conta.PHP"
            if ($("#conta_banco").val().trim() === "") {
                $("#val_conta_banco").show().html("**Preencher o campo Nome da Conta/Banco!!");
                ret = false;
            } else {
                $("#val_conta_banco").hide();
            }

            if ($("#num_agencia").val().trim() === "") {
                $("#val_num_agencia").show().html("**Preencher o campo Agência!!");
                ret = false;
            } else {
                $("#val_num_agencia").hide();
            }

            if ($("#num_conta").val().trim() === "") {
                $("#val_num_conta").show().html("**Preencher o campo Número da Conta!!");
                ret = false;
            } else {
                $("#val_num_conta").hide();
            }

            if ($("#saldoconta").val().trim() === "") {
                $("#val_saldoconta").show().html("**Favor informar o saldo dessa conta!!");
                ret = false;
            } else {
                $("#val_saldoconta").hide();
            }
            break;

        case 4: //Tela "nova_empresa.PHP" .e. Tela "alterar_empresa.PHP
            if ($("#nome_empresa").val().trim() === "") {
                $("#val_nome_empresa").show().html("**Preencher o campo Nome da Empresa!!");
                ret = false;
            } else {
                $("#val_nome_empresa").hide();
            }

            if ($("#endereco_empresa").val().trim() === "") {
                $("#val_endereco_empresa").show().html("**Preencher o campo Endereço da Empresa!!");
                ret = false;
            } else {
                $("#val_endereco_empresa").hide();
            }

            if ($("#telefone_empresa").val().trim() === "") {
                $("#val_telefone_empresa").show().html("**Preencher o campo Telefone da Empresa!!");
                ret = false;
            } else {
                $("#val_telefone_empresa").hide();
            }
            break;

        case 5: //Tela "Realizar_Movimento.PHP

            if ($("#tipo_movimento").val() === "") {
                $("#val_tipo_movimento").show().html("**Favor selecionar qual é o tipo do movimento!!");
                ret = false;
            } else {
                $("#val_tipo_movimento").hide();
            }
            
            if ($("#dtamovimento").val() === "") {
                $("#val_dtamovimento").show().html("**Favor selecionar a data que foi realizado o movimento!!");
                ret = false;
            } else {
                $("#val_dtamovimento").hide();
            }

            if ($("#vlr_movimento").val().trim() === "") {
                $("#val_vlr_movimento").show().html("**Favor informar o Valor deste Movimento!!");
                ret = false;
            } else {
                $("#val_vlr_movimento").hide();
            }
            
            if ($("#selempresa").val() === "") {
                $("#val_selempresa").show().html("**Favor selecionar a empresa para realizar este movimento!!");
                ret = false;
            } else {
                $("#val_selempresa").hide();
            }
            
            if ($("#selcategoria").val() === "") {
                $("#val_selcategoria").show().html("**Favor selecionar a categoria para realizar este movimento!!");
                ret = false;
            } else {
                $("#val_selcategoria").hide();
            }
            
            if ($("#selconta").val() === "") {
                $("#val_selconta").show().html("**Favor selecionar a conta para realizar este movimento!!");
                ret = false;
            } else {
                $("#val_selconta").hide();
            }
            
            break;

    }
    return ret;
}



