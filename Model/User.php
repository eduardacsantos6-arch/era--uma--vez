<?php 
namespace Model; 

use Model\Connection; 
use PDO; 
use PDOException; 

class User { 
    private $db; 

    public function __construct() { 
        $this->db = Connection::getInstance(); 
    } 

    /** 
     * Criar o Usuário 
     * @param string $name Nome do usuário 
     * @param string $email E-mail 
     * @param string $password Senha 
     * @return bool Cadastro concluído com sucesso ou falha 
     */ 
    
    public function registerUser(string $name, string $email, string $password): bool { 
        try { 
            $sql = "INSERT INTO users(name, email, password) VALUES(:name, :email, :password)"; 
            
            $stmt = $this->db->prepare($sql); 

            $stmt->bindParam(":name", $name, PDO::PARAM_STR); 
            $stmt->bindParam(":email", $email, PDO::PARAM_STR); 
            $stmt->bindParam(":password", $password, PDO::PARAM_STR); 
            
            return $stmt->execute(); 
        } catch (PDOException $error) { 
            error_log("Erro ao registrar usuário: " . $error->getMessage()); 
        } 

        return false;
    }

    /**
     * Buscar usuário pelo e-mail
     * @param string $email e-mail cadastrado
     * @return array|bool dados do usuário ou falha
     */

    public function getUserByEmail(string $email): array|bool {
        try {
            $sql = "SELECT * FROM users WHERE email = :email";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $error) {
            error_log("Erro ao buscar usuário: " . $error->getMessage());
        }

        return false;
    }
}