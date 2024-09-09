<?php

    namespace models;

    class RegistroModel extends Model
    {
        public function reader() {
            try {
                // Verifica se o parâmetro de busca está presente na URL
                $search = isset($_GET['search']) ? $_GET['search'] : '';
        
                // Prepara a consulta SQL com ou sem filtro de busca
                $sqlStr = "
                    SELECT 
                        r.id, 
                        r.produto_id, 
                        p.Nome AS NomeProduto, 
                        r.tipo, 
                        r.quantidade, 
                        r.destino, 
                        r.obs,
                        DATE_FORMAT(r.data, '%d-%m-%Y %H:%i') AS data  -- Formata a data e hora (somente hora e minuto)
                    FROM 
                        registros r
                    JOIN 
                        produtos p ON r.produto_id = p.ID
                ";
        
                // Adiciona o filtro de busca, se houver
                if (!empty($search)) {
                    $sqlStr .= " WHERE p.Nome LIKE :search";
                }
        
                // Prepara a consulta SQL
                $sql = $this->pdo->prepare($sqlStr);
        
                // Se houver um parâmetro de busca, vincula o valor
                if (!empty($search)) {
                    $sql->bindValue(':search', '%' . $search . '%');
                }
        
                // Executa a consulta
                $sql->execute();
                $registros = $sql->fetchAll(\PDO::FETCH_ASSOC);
        
                return $registros;
            } catch (\PDOException $e) {
                error_log("Erro na consulta: " . $e->getMessage());
                die("Erro na consulta: " . $e->getMessage());
            }
        }
        

        
        
        


        public function processa_registro($id, $saldo, $tipo, $destino, $obs, $quantidade) {
            // Atualiza o saldo do produto
            $sql = "UPDATE produtos SET saldo_final = :saldo_final WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':saldo_final', $saldo);
            $stmt->bindParam(':id', $id); 
            $r = $stmt->execute();
        
            // Insere o registro na tabela de registros
            $sql1 = "INSERT INTO registros (tipo, destino, produto_id, obs, quantidade,data) 
                    VALUES (:tipo, :destino, :id_prod, :obs, :quantidade,NOW())";
            $stmt1 = $this->pdo->prepare($sql1);
            $stmt1->bindParam(':tipo', $tipo);
            $stmt1->bindParam(':destino', $destino);
            $stmt1->bindParam(':id_prod', $id);
            $stmt1->bindParam(':obs', $obs); // Adiciona a ligação para o parâmetro :obs
            $stmt1->bindParam(':quantidade', $quantidade);
        
            $s = $stmt1->execute(); 
        
            // Verifica se ambas as execuções foram bem-sucedidas
            if ($r && $s) {
                return true;
            } else {
                return false;
            }
        }
        






        
    }
?>