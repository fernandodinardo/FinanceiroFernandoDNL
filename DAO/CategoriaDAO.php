<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class CategoriaDAO extends Conexao {

    public function InserirCategoria($nome) {

        if (trim($nome) == '') {
            return 0;
        }

        //1o Passo: Criar uma Variável que receberá um Objeto de CONEXAO
        $conexao = parent::retornaConexao();

        //2o Passo: Criar uma Variável que deverá conter o Comando SQL - INSERT
        $comando = 'insert into tb_categoria (nome_categoria, id_usuario) values (?,?)';

        //3o Passo: Criar o Objeto que será configurado para ser executado no Banco de Dados
        $sql = new PDOStatement();

        //4o Passo: Fazer com que o SQL receba a Conexão que vai estar preparada para o Comando.
        $sql = $conexao->prepare($comando);

        //5o Passo: Ver se existe o "?" no Comando, se tiver fazer o "bindValue".
        $sql->bindValue(1, $nome);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        //6o Passo: Precisamos EXECUTAR.

        try {

            $sql->execute(); //se der tudo certo, "retorna MSG 1"

            return 1;
        } catch (Exception $ex) { // se por acaso der algum ERRO, "retorna MSG -1"
            return -1;
        }
    }

    public function ConsultarCategoria() {

        $conexao = parent::retornaConexao();

        $comando = 'select 
                            id_categoria,
                            nome_categoria
                    from tb_categoria
                        where id_usuario = ? order by nome_categoria';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, UtilDAO::CodigoLogado());

        //Configura o ARRAY para somente trazer a coluna e seu valor (eliminando o indice do ARRAY)

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }

    public function DetalharCategoria($id) {

        $conexao = parent::retornaConexao();

        $comando = 'select 
                            id_categoria,
                            nome_categoria
                    from tb_categoria
                        where id_usuario = ? and id_categoria = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, UtilDAO::CodigoLogado());
        $sql->bindValue(2, $id);

        //Configura o ARRAY para somente trazer a coluna e seu valor (eliminando o indice do ARRAY)

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }

    public function AlterarCategoria($nome, $id) {

        if (trim($nome) == '') {
            return 0;
        }

        $conexao = parent::retornaConexao();
        $comando = 'update tb_categoria
                        set nome_categoria = ?
                        where id_usuario = ? and id_categoria = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, UtilDAO::CodigoLogado());
        $sql->bindValue(3, $id);

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -1;
        }
    }

    public function ExcluirCategoria($codCategoria) {

        $conexao = parent::retornaConexao();
        $comando = 'delete
                        from tb_categoria
                        where id_categoria = ? and id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $codCategoria);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 4;
        } catch (Exception $ex) {
            return -2;
        }
    }

}