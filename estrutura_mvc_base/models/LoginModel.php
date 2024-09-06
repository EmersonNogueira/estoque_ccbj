<?php
	namespace models;

	class LoginModel extends Model
	{


        public function criaruser($data){
            $sql = "INSERT INTO usuarios (nome_usuario, senha_usuario, tipo_usuario) 
                    VALUES (:nome_usuario, :senha_usuario, :tipo_usuario)";
        
            $stmt = $this->pdo->prepare($sql);
            
            // Bind dos parâmetros usando as chaves corretas do array $data
            $stmt->bindParam(':nome_usuario', $data['nome']);
            $stmt->bindParam(':tipo_usuario', $data['tipo']);
        
            // Gerando o hash da senha antes de bindar o valor
            $hashedPassword = password_hash($data['senha'], PASSWORD_DEFAULT);
            $stmt->bindParam(':senha_usuario', $hashedPassword);
            
            // Depuração para verificar o conteúdo de $data
            var_dump($data);
        
            return $stmt->execute();
        }

        public function verificarLogin($username, $password, $expectedType) {
            // Preparar a consulta para obter o hash da senha e o tipo de usuário do banco de dados
            $sql = "SELECT senha_usuario, tipo_usuario FROM usuarios WHERE nome_usuario = :username";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
        
            // Recuperar o hash da senha e o tipo de usuário armazenado
            $result = $stmt->fetch(\PDO::FETCH_ASSOC); // Obtém a linha do resultado como um array associativo
        
            if ($result) {
                $hashedPassword = $result['senha_usuario']; // Acessa o hash da senha
                $userType = $result['tipo_usuario']; // Acessa o tipo de usuário
        
                // Verificar se a senha fornecida corresponde ao hash
                if (password_verify($password, $hashedPassword)) {
                    // Verifica se o tipo de usuário corresponde ao tipo esperado
                    if ($userType === $expectedType) {
                        
                        return true; // Senha correta e tipo de usuário corresponde

                    } else {
                        return false; // Tipo de usuário não corresponde
                    }
                } else {
                    return false; // Senha incorreta
                }
            } else {
                return false; // Usuário não encontrado
            }
        }
        
        

    }

?>


