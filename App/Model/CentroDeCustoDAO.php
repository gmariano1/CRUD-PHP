<?php
namespace App\Model;

class CentroDeCustoDAO
{
    public function create(CentroDeCusto $c)
    {
        $sql = "INSERT INTO centro_de_custo (nome) VALUES (?)";
        $stmt = Conexao::getConnection()->prepare($sql);
        $stmt->bindValue(1, $c->getNome());
        $return = $stmt->execute();
        if($return){
            return "Inserido com sucesso";
        }else{
            return "Erro de execução";
        }
    }

    public function read()
    {
        $sql = "SELECT * FROM centro_de_custo";
        $stmt = Conexao::getConnection()->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            $return = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $return;
        }else{
            return "Não existem registros";
        }

    }

    public function update(CentroDeCusto $c)
    {

        if(!is_null($c->getNome()))
        {
            $sql = "UPDATE centro_de_custo SET nome = ? WHERE id = ?";
            $stmt = Conexao::getConnection()->prepare($sql);
            $stmt->bindValue(1, $c->getNome());
            $stmt->bindValue(2, $c->getId());
            $return = $stmt->execute();
            if(!$return){
                return "Erro ao atualizar";
            }
        }
        return "Atualizado com sucesso";
        
    }

    public function delete($id)
    {
        $sql = "DELETE FROM centro_de_custo WHERE id = ?";
        $stmt = Conexao::getConnection()->prepare($sql);
        $stmt->bindValue(1, $id);
        $return = $stmt->execute();
        if($return){
            return "Deletado com sucesso";
        }else{
            return "Erro ao deletar";
        }
    }
}