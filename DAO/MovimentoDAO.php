<?php

require_once 'Conexao.php';
require_once '../DAO/UtilDAO.php';

class MovimentoDAO extends Conexao {

    public function InserirMovimento($tipomovimento, $dtamovimento, $vlrmovimento, $selempresa, $selcategoria, $selconta, $obs) {
        
        if (trim($tipomovimento) == '' || trim($dtamovimento) == '' || trim($vlrmovimento) == '' || trim($selempresa) == '' || trim($selcategoria) == '' || trim($selconta) == '') {
            return 0;
        }

        $conexao = parent::retornaConexao();

        $comando = 'insert into tb_movimento (tipo_movimento,
                                              data_movimento,
                                              valor_movimento,
                                              id_empresa,
                                              id_conta,
                                              id_categoria,
                                              id_usuario,
                                              obs_movimento)
                                              values (?, ?, ?, ?, ?, ?, ?, ?)';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $tipomovimento);
        $sql->bindValue(2, $dtamovimento);
        $sql->bindValue(3, $vlrmovimento);
        $sql->bindValue(4, $selempresa);
        $sql->bindValue(5, $selconta);
        $sql->bindValue(6, $selcategoria);
        $sql->bindValue(7, UtilDAO::CodigoLogado());
        $sql->bindValue(8, $obs);

        $conexao->beginTransaction();

        try {

            $sql->execute();

            if ($tipomovimento == 1) {
                $comando = 'update tb_conta set saldo_conta = saldo_conta + ? where id_conta = ?';
            } else {
                $comando = 'update tb_conta set saldo_conta = saldo_conta - ? where id_conta = ?';
            }

            $sql = $conexao->prepare($comando);

            $sql->bindValue(1, $vlrmovimento);
            $sql->bindValue(2, $selconta);

            $sql->execute();

            //CONFIRMA A TRANSAÇÃO;
            $conexao->commit();

            return 1;
        } catch (Exception $ex) {

            //CANCELA TODA OPERAÇÃO;
            $conexao->rollBack();

            return -1;
        }
    }

    public function FiltrarMovimento($tipo_mov, $dataIni, $dataFim) {
        
        if ($dataIni == '' || $dataFim == '') {
            return 0;
        }

        $conexao = parent::retornaConexao();

        $comando = 'select
                            id_movimento,
                            date_format(data_movimento, "%d/%m/%Y") as data_movimento, 
                            nome_empresa,
                            nome_categoria,
                            nome_conta,
                            numero_conta,
                            valor_movimento,
                            tipo_movimento,
                            obs_movimento,                            
                            tb_movimento.id_conta
                        from 
                            tb_movimento
                    INNER JOIN  tb_empresa
                        ON  tb_empresa.id_empresa = tb_movimento.id_empresa
                    INNER JOIN  tb_categoria
                        ON  tb_categoria.id_categoria = tb_movimento.id_categoria
                    INNER JOIN  tb_conta
                        ON  tb_conta.id_conta = tb_movimento.id_conta
                    where 
                        tb_movimento.id_usuario = ?
                    and
                        data_movimento between ? and ?';
        
        if ($tipo_mov != 0) {
            $comando = $comando . ' and tipo_movimento = ?';
        }

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, UtilDAO::CodigoLogado());
        $sql->bindValue(2, $dataIni);
        $sql->bindValue(3, $dataFim);
        
        if ($tipo_mov != 0) {
            $sql->bindValue(4, $tipo_mov);
        }

        //Configura o ARRAY para somente trazer a coluna e seu valor (eliminando o indice do ARRAY)
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }

    public function ExcluirMovimento($codMov, $codConta, $tipo_mov, $valor) {

        $conexao = parent::retornaConexao();

        $comando = 'delete
                        from tb_movimento
                        where id_movimento = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $codMov);
        
        $conexao->beginTransaction();

        try {
            
            //Delete o movimento
            $sql->execute();
            
            //Se é uma ENTRADA, devemos então SUBTRAIR o saldo da conta.
            if ($tipo_mov == 1) {
                $comando = 'update tb_conta
                                   set saldo_conta = saldo_conta - ?
                                   where id_conta = ?';
            } else { //Senão, se for uma SAíDA, devemos então SOMAR ao saldo da conta.
                $comando = 'update tb_conta
                                   set saldo_conta = saldo_conta + ?
                                   where id_conta = ?';
            }
            
            $sql = $conexao->prepare($comando);
            
            $sql->bindValue(1, $valor);
            $sql->bindValue(2, $codConta);
            
            $sql->execute();
            
            $conexao->commit();
            
            return 4;
            
        } catch (Exception $ex) {
            $conexao->rollBack();
            
            return -1;
        }
    }

}
