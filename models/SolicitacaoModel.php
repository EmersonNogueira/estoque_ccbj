<?php

    namespace models;

    class SolicitacaoModel extends Model
    {

        public function reader(){
            try {
                // Consulta SQL com JOIN para obter informações de solicitacao e produtos
                $sqlStr = "
                    SELECT s.*, p.nome AS nome_produto, p.situacao AS situacao_produto, p.saldo_final AS saldo_atual
                    FROM solicitacao s
                    LEFT JOIN produtos p ON s.produto_id = p.id
                ";
                $sql = $this->pdo->prepare($sqlStr);
                $sql->execute();
                $solicitacoes = $sql->fetchAll(\PDO::FETCH_ASSOC);
                return $solicitacoes; 
        
            } catch (\PDOException $e) {
                error_log("Erro na consulta: " . $e->getMessage());
                die("Erro na consulta: " . $e->getMessage());
            }
        }
        

        public function add($setor, $solicitante, $produto_id, $quantidade_pedida, $obs) {
            try {
                $sqlStr = "INSERT INTO solicitacao (setor, solicitante, produto_id, quantidade_pedida, obs, data_solicitacao) 
                           VALUES (:setor, :solicitante, :produto_id, :quantidade_pedida, :obs, NOW())";
    
                $sql = $this->pdo->prepare($sqlStr);
    
                // Bind the parameters to prevent SQL injection
                $sql->bindParam(':setor', $setor);
                $sql->bindParam(':solicitante', $solicitante);
                $sql->bindParam(':produto_id', $produto_id);
                $sql->bindParam(':quantidade_pedida', $quantidade_pedida);
                $sql->bindParam(':obs', $obs);
    
                // Execute the query
                $sql->execute();
    
                // Optionally, return the ID of the newly created record
                return $this->pdo->lastInsertId();
    
            } catch (\PDOException $e) {
                error_log("Erro ao adicionar solicitação: " . $e->getMessage());
                throw new \Exception("Erro ao adicionar solicitação: " . $e->getMessage());
            }
        }
        

        public function updateStatus($id) {
            echo $id;
            // Definindo o status a ser atualizado
            $status = 'finalizado';
            
            // Consulta SQL para atualizar o status
            $sql = "UPDATE solicitacao SET status = :status WHERE id = :id";
        
            // Preparando a consulta
            $stmt = $this->pdo->prepare($sql);
        
            // Ligando os parâmetros
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        
            // Executando a consulta
            $stmt->execute();
        }
        

    }
?>