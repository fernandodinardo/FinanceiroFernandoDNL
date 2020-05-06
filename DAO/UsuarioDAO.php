<?php

require_once '../DAO/Conexao.php';
require_once '../DAO/UtilDAO.php';

class UsuarioDAO extends Conexao {
    
    public function ValidarLogin($email, $senha) {
        
        if(trim($email) == '' || trim($senha) == ''){
            return 0;
        }
        
        $conexao = parent::retornaConexao();
        
        $comando = 'select id_usuario from tb_usuario where email_usuario = ? and senha_usuario = ?';
        
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);
        
        $sql->bindValue(1, $email);
        $sql->bindValue(2, $senha);
        
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        
        $sql->execute();
        
        $user = $sql->fetchAll();
        
        
        //Verificação se houve registro no BD;
        if(count($user) == 0) {
            return ;
        } else {
            $id_user = $user[0]['id_usuario'];
            UtilDAO::CriarSessao($id_user);
            header('location: realizar_movimento.php');
        }
               
    }
    
}
