<?php
	namespace models;

	class ProdutoModel extends Model
	{
		public function reader() {
			try {
				// Verifica se o parâmetro de busca está presente na URL
				$search = isset($_GET['search']) ? $_GET['search'] : '';
		
				// Prepara a consulta SQL com ou sem filtro de busca
				$sqlStr = "SELECT * FROM produtos";
		
				// Adiciona o filtro de busca, se houver
				if (!empty($search)) {
					$sqlStr .= " WHERE Nome LIKE :search";
				}
		
				// Adiciona a ordenação
				$sqlStr .= " ORDER BY local ASC";
		
				// Prepara a consulta SQL
				$sql = $this->pdo->prepare($sqlStr);
		
				// Se houver um parâmetro de busca, vincula o valor
				if (!empty($search)) {
					$sql->bindValue(':search', '%' . $search . '%');
				}
		
				$sql->execute();
				$resultados = $sql->fetchAll(\PDO::FETCH_ASSOC);
				return $resultados;
			} catch (\PDOException $e) {
				error_log("Erro na consulta: " . $e->getMessage());
				die("Erro na consulta: " . $e->getMessage());
			}
		}
		public function readerComSaldo() {
			try {
				// Verifica se o parâmetro de busca está presente na URL
				$search = isset($_GET['search']) ? $_GET['search'] : '';
				
				// Prepara a consulta SQL com filtro de saldo maior que 0
				$sqlStr = "SELECT * FROM produtos WHERE saldo_final > 0";
		
				// Adiciona o filtro de busca, se houver
				if (!empty($search)) {
					$sqlStr .= " AND Nome LIKE :search";
				}
		
				// Adiciona a ordenação
				$sqlStr .= " ORDER BY local ASC";
		
				// Prepara a consulta SQL
				$sql = $this->pdo->prepare($sqlStr);
		
				// Se houver um parâmetro de busca, vincula o valor
				if (!empty($search)) {
					$sql->bindValue(':search', '%' . $search . '%');
				}
		
				$sql->execute();
				$resultados = $sql->fetchAll(\PDO::FETCH_ASSOC);
				return $resultados;
			} catch (\PDOException $e) {
				error_log("Erro na consulta: " . $e->getMessage());
				die("Erro na consulta: " . $e->getMessage());
			}
		}
		

		
		

		public function cadastrar($data){
			$sql = "INSERT INTO produtos (nome, local, categoria, situacao, saldo_final, custo, fornecedor) 
			VALUES (:nome, :local, :categoria, :situacao, :saldo, :custo, :fornecedor)";

			$stmt = $this->pdo->prepare($sql);
			$stmt->bindParam(':nome', $data['nome']);
			$stmt->bindParam(':local', $data['local']);
			$stmt->bindParam(':categoria', $data['categoria']);
			$stmt->bindParam(':situacao', $data['situacao']);
			$stmt->bindParam(':saldo', $data['saldo']);
			$stmt->bindParam(':custo', $data['custo']);
			$stmt->bindParam(':fornecedor', $data['fornecedor']);

			return $stmt->execute();


		}

		public function atualizar($data) {
			$sql = "UPDATE produtos SET nome = :nome, local = :local, categoria = :categoria, situacao = :situacao, custo = :custo, fornecedor = :fornecedor WHERE id = :id";
		
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindParam(':nome', $data['nome']);
			$stmt->bindParam(':local', $data['local']);
			$stmt->bindParam(':categoria', $data['categoria']);
			$stmt->bindParam(':situacao', $data['situacao']);
			$stmt->bindParam(':custo', $data['custo']);
			$stmt->bindParam(':fornecedor', $data['fornecedor']);
			$stmt->bindParam(':id', $data['id']); // Adicione esta linha para vincular o ID
		
			return $stmt->execute();
		}


		
		
	
	}
?>