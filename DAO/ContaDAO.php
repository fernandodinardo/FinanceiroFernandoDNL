<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class ContaDAO extends Conexao {

    public function InserirConta($nome, $agencia, $numconta, $saldoconta) {

        if (trim($nome) == '' || trim($agencia) == '' || trim($numconta) == '' || trim($saldoconta) == '') {
            return 0;
        }

        $conexao = parent::retornaConexao();

        $comando = 'insert into tb_conta (nome_conta, agencia_conta, numero_conta, saldo_conta, status_conta, tb_usuario_id_usuario) values (?,?,?,?,?,?)';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $agencia);
        $sql->bindValue(3, $numconta);
        $sql->bindValue(4, $saldoconta);
        $sql->bindValue(5, 1);
        $sql->bindValue(6, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -1;
        }
    }

    public function ConsultarConta() {

        $conexao = parent::retornaConexao();

        $comando = 'select 
                          id_conta,
                          nome_conta,
                          agencia_conta,
                          numero_conta,
                          saldo_conta,
                          status_conta
                     from tb_conta
                           where tb_usuario_id_usuario = ? order by nome_conta';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, UtilDAO::CodigoLogado());

        //Configura o ARRAY para somente trazer a coluna e seu valor (eliminando o indice do ARRAY)
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }

    public function DetalharConta($id) {

        $conexao = parent::retornaConexao();

        $comando = 'select
                          id_conta,
                          nome_conta,
                          agencia_conta,
                          numero_conta,
                          saldo_conta,
                          status_conta
                    from tb_conta
                        where tb_usuario_id_usuario = ? and id_conta = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, UtilDAO::CodigoLogado());
        $sql->bindValue(2, $id);

        //Configura o ARRAY para somente trazer a coluna e seu valor (eliminando o indice do ARRAY)
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }

    public function AlterarConta($nome, $agencia, $numconta, $saldoconta, $status, $id) {
        if (trim($nome) == '' || trim($agencia) == '' || trim($numconta) == '' || trim($saldoconta) == '') {
            return 0;
        }

        $conexão = parent::retornaConexao();
        $comando = 'update tb_conta
                        set nome_conta = ?, 
                            agencia_conta = ?, 
                            numero_conta = ?, 
                            saldo_conta = ?, 
                            status_conta = ? 
                        where tb_usuario_id_usuario = ? and id_conta = ?';

        $sql = new PDOStatement();
        $sql = $conexão->prepare($comando);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $agencia);
        $sql->bindValue(3, $numconta);
        $sql->bindValue(4, $saldoconta);
        $sql->bindValue(5, $status);
        $sql->bindValue(6, UtilDAO::CodigoLogado());
        $sql->bindValue(7, $id);

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -1;
        }
    }

    public function ExcluirConta($codConta) {
        
        $conexao = parent::retornaConexao();
        
        $comando = 'delete
                        from tb_conta
                        where id_conta = ? and tb_usuario_id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $codConta);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -1;
        }
        
    }

}
