<?php
namespace App\Model;

class CargoDAO
{
    public function create(Cargo $c)
    {
        $sql = "INSERT INTO cargo (nome, descricao) VALUES (?, ?)";
        $stmt = Conexao::getConnection()->prepare($sql);
        $stmt->bindValue(1, $c->getNome());
        $stmt->bindValue(2, $c->getDescricao());
        $return = $stmt->execute();
        if($return){
            return "Inserido com sucesso";
        }else{
            return "Erro de execução";
        }
    }

    public function read()
    {
        $sql = "SELECT * FROM cargo";
        $stmt = Conexao::getConnection()->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            $return = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $return;
        }else{
            return "Não existem registros";
        }

    }

    public function update(Cargo $c)
    {

        if(!is_null($c->getNome()))
        {
            $sql = "UPDATE cargo SET nome = ? WHERE id = ?";
            $stmt = Conexao::getConnection()->prepare($sql);
            $stmt->bindValue(1, $c->getNome());
            $stmt->bindValue(2, $c->getId());
            $return = $stmt->execute();
            if(!$return){
                return "Erro ao atualizar";
            }
        }

        if(!is_null($c->getDescricao()))
        {
            $sql = "UPDATE cargo SET descricao = ? WHERE id = ?";
            $stmt = Conexao::getConnection()->prepare($sql);
            $stmt->bindValue(1, $c->getDescricao());
            $stmt->bindValue(2, $c->getId());
            $stmt->execute();
            if(!$return){
                return "Erro ao atualizar";
            }
            
        }
        return "Atualizado com sucesso";
        
    }

    public function delete($id)
    {
        $sql = "DELETE FROM cargo WHERE id = ?";
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