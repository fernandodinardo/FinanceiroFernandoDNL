<?php

function ExibirMsg($ret) {

    switch ($ret) {
        
        case -3:
            echo '<div class="alert alert-warning">
                      Não foi encontrado nenhum usuário!! Usuário é inválido!!
                  </div>';
            break;

        case -2:
            echo '<div class="alert alert-warning">
                      Não foi possível excluir o registro, pois o mesmo está em uso!!
                  </div>';
            break;
        
        case -1:
            echo '<div class="alert alert-danger">
                      Ocorreu um erro na Operação. Tente mais tarde!!
                  </div>';
            break;

        case 0:
            echo '<div class="alert alert-warning">
                      Preencher o(s) campo(s) obrigatório(s)!
                  </div>';
            break;

        case 1:
            echo '<div class="alert alert-success">
                      Operação realizada com sucesso! Dados foram salvos!
                  </div>';
            break;

        case 2:
            echo '<div class="alert alert-info">
                      A sua senha deve ter no mínimo 6 dígitos!!! Favor verificar!!!
                  </div>';
            break;

        case 3:
            echo '<div class="alert alert-danger">
                      As senhas digitadas não conferem. Favor digitá-las novamente!!!
                  </div>';
            break;
        
        case 4:
            echo '<div class="alert alert-success">
                      O registro foi excluído com êxito!!
                  </div>';
            break;
    }
}
