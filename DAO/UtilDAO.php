<?php

class UtilDAO {

    private static function IniciarSessao() {

        //Verifica se NAO existe sessão (se ela está desligada).
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public static function CriarSessao($id_user) {
        self::IniciarSessao();
        $_SESSION['cod'] = $id_user;
    }

    public static function CodigoLogado() {
        self::IniciarSessao();
        return $_SESSION['cod'];
    }
    
    public static function DeslogarSessao() {
        self::IniciarSessao();
        
        //Matar a SESSAO LOGADA;
        unset($_SESSION['cod']);
        
        header('location: Login.php');
    }
    
    public static function VerificarLogado() {
        self::IniciarSessao();
        if(!isset($_SESSION['cod'])){
            header('location: Login.php');
        }
    }

}