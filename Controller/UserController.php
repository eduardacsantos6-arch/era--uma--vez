<?php

namespace Controller;

use Model\User;

class UserController
{
    private $userModel;

    public function __construct() {

        $this->userModel = new User();
    }

    /**
     * Validação de campos vazios
     * @param string $name Nome do usuário
     * @param string $email E-mail
     * @param string $password Senha
     * @return bool Verdadeiro se estiver preenchido
     */

    private function validateEmptyFields(string $name, string $email, string $password): bool {
        if (empty($name) || empty($email) || empty($password)) {

            return false;
        }

        return true;
    }

    /**
     * Validação do e-mail
     * @param string $email E-mail
     * @return bool Verdadeiro se o e-mail for válido
     */

    private function validateUserEmail(string $email): bool {

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }

    /**
     * Validação de senha
     * @param string $password Senha
     * @return bool Verdadeiro se a senha seguir o padrão
     */

    public function passwordValidation(string $password): bool {

        $pattern = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,33}$/';
        return (bool) preg_match($pattern, $password);
    }

    /**
     * Confirmar senha
     * @param string $password Senha
     * @param string $confirmPassword Confirmação da senha
     * @return bool Verdadeiro caso sejam iguais
     */

    public function checkPasswordMatch(string $password, string $confirmPassword): bool {
        return $password === $confirmPassword;
    }

    /**
     * Criptografia da senha
     * @param string $password Senha
     * @return string Senha criptografada
     */

    private function hashPassword(string $password): string {
       
    return password_hash($password, PASSWORD_DEFAULT);

    }

    /**
     * Registro de usuário
     * @param string $name Nome do usuário
     * @param string $email E-mail
     * @param string $password Senha
     * @return bool Cadastro realizado com sucesso ou falha
     */

    public function createUser(string $name, string $email, string $password): bool {

        if (!$this->validateEmptyFields($name, $email, $password)) {
            return false;
        }

        if (!$this->validateUserEmail($email)) {
            return false;
        }

        if (!$this->passwordValidation($password)) {
            return false;
        }

        if ($this->checkUserByEmail($email)) {
            return false;
        }

        $hashedPassword = $this->hashPassword($password);

        return $this->userModel->registerUser($name, $email, $hashedPassword);
    }

    /**
     * Verifica se o e-mail já está cadastrado
     * @param string $email E-mail
     * @return bool Verdadeiro caso o e-mail exista
     */

    public function checkUserByEmail(string $email): bool {

        return (bool) $this->userModel->getUserByEmail($email);
    }

    /**
     * Login do usuário
     * @param string $email E-mail
     * @param string $password Senha
     * @return bool Usuário autenticado ou falha
     */

    public function login(string $email, string $password): bool {

        $user = $this->userModel->getUserByEmail($email);

        if (!$user || !password_verify($password, $user["password"])) {

            return false;
        }

        $_SESSION["id"] = $user["id"];
        $_SESSION["name"] = $user["name"];
        $_SESSION["email"] = $user["email"];

        return true;
    }

    /**
     * Verifica se existe usuário logado
     * @return bool Verdadeiro caso tenha uma sessão ativa
     */

    public function isLoggedIn(): bool
    {
        return isset($_SESSION["id"]);
    }

}