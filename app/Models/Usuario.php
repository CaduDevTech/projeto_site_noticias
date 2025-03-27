<?php

class Usuario
{
    private $db;

    public function __construct()
    {
        $this->db = new Conexao();
    }

    // Método para armazenar usuário
    public function armazenar($dados)
    {
        try {
            $this->db->query("INSERT INTO usuarios (nome, email, nome_publico, senha, status_perfil, tipo_perfil) VALUES (:nome, :email, :nomePublico, :senha , :status_perfil, :tipo_perfil)");
            $this->db->bind(':nome', $dados['nome']);
            $this->db->bind(':email', $dados['email']);
            $this->db->bind(':nomePublico', $dados['nomePublico']);
            $this->db->bind(':senha', $dados['senha']);
            $this->db->bind(':tipo_perfil', "comum");
            $this->db->bind(':status_perfil', "ativo");

            return $this->db->executa();
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false; // Retorna false em caso de erro
        }
    }

    // Método para verificar duplicidade de email
    public function verificarDuplicidadeEmail($email)
    {
        $this->db->query("SELECT COUNT(*) as total FROM usuarios WHERE email = :email");
        $this->db->bind(':email', $email);

        $resultado = $this->db->resultado();
        return $resultado->total > 0; // Retorna true se o email já existe
    }

    // Método para verificar duplicidade de nome público
    public function verificarDuplicidadeNomePublico($nomePublico)
    {
        $this->db->query("SELECT COUNT(*) as total FROM usuarios WHERE nome_publico = :nomePublico");
        $this->db->bind(':nomePublico', $nomePublico);
        
        $resultado = $this->db->resultado();
        return $resultado->total > 0; // Retorna true se o nome público já existe
    }

    public function verificarLogin($email, $senha)
    {
        $this->db->query("SELECT COUNT(*) as total FROM usuarios WHERE email = :email AND senha = :senha");
        $this->db->bind(':email', $email);
        $this->db->bind(':senha', $senha);

        $resultado = $this->db->resultado();
        return $resultado->total > 0; // Retorna true se o nome público já existe
    }

    public function buscarPorEmail($email)
    {
        $this->db->query("SELECT * FROM usuarios WHERE email = :email");
        $this->db->bind(':email', $email);
        return $this->db->resultado(); // Retorna o usuário ou false
    }

    public function lerUsuarioPorId($id)
    {
        $this->db->query("SELECT * FROM post WHERE id = :id");
        $this->db->bind(':id', $id);

        return $this->db->resultado();
    }
}
