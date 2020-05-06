<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class EmpresaDAO extends Conexao {

    public function InserirEmpresa($nome, $endereco, $telefone) {

        if (trim($nome) == '' || trim($endereco) == '' || trim($telefone) == '') {
            return 0;
        }

        $conexao = parent::retornaConexao();

        $comando = 'insert into tb_empresa (nome_empresa, endereco_empresa, telefone_empresa, id_usuario) values (?,?,?,?)';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $endereco);
        $sql->bindValue(3, $telefone);
        $sql->bindValue(4, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -1;
        }
    }

    public function ConsultarEmpresa() {

        $conexao = parent::retornaConexao();

        $comando = 'select 
                            id_empresa,
                            nome_empresa,
                            endereco_empresa,
                            telefone_empresa
                    from tb_empresa
                        where id_usuario = ? order by nome_empresa';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, UtilDAO::CodigoLogado());

        //Configura o ARRAY para somente trazer a coluna e seu valor (eliminando o indice do ARRAY)
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }

    public function DetalharEmpresa($id) {

        $conexao = parent::retornaConexao();

        $comando = 'select
                           id_empresa,
                           nome_empresa,
                           endereco_empresa,
                           telefone_empresa
                    from tb_empresa
                        where id_usuario = ? and id_empresa = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, UtilDAO::CodigoLogado());
        $sql->bindValue(2, $id);

        //Configura o ARRAY para somente trazer a coluna e seu valor (eliminando o indice do ARRAY)
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }

    public function AlterarEmpresa($nome, $endereco, $telefone, $id) {
        if (trim($nome) == '' || trim($endereco) == '' || trim($telefone) == '') {
            return 0;
        }

        $conexão = parent::retornaConexao();
        $comando = 'update tb_empresa
                            set nome_empresa = ?, endereco_empresa = ?, telefone_empresa = ?
                            where id_usuario = ? and id_empresa = ?';

        $sql = new PDOStatement();
        $sql = $conexão->prepare($comando);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $endereco);
        $sql->bindValue(3, $telefone);
        $sql->bindValue(4, UtilDAO::CodigoLogado());
        $sql->bindValue(5, $id);

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -1;
        }
    }

    public function ExcluirEmpresa($codEmpresa) {

        $conexao = parent::retornaConexao();
        $comando = 'delete
                        from tb_empresa
                        where id_empresa = ? and id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $codEmpresa);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 4;
        } catch (Exception $ex) {
            return -2;
        }
    }

}
