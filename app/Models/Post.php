<?php

class Post
{

    private $db;

    public function __construct()
    {
        $this->db = new Conexao();
    }

    public function lerPosts()
    {
        $this->db->query("SELECT *, 
            post.id AS postId,
            post.criado_em AS postDataCadastro, 
            usuarios.id AS usuarioId, 
            usuarios.criado_em AS usuarioDataCadastro
            
            FROM post
            INNER JOIN usuarios ON
             post.id_usuario = usuarios.id
            order by post.criado_em desc;
        ");
        return $this->db->resultados();
    }

    public function postarNoticias($dados)
    {
        try {
            $this->db->query("INSERT INTO post (titulo, texto, id_usuario) VALUES (:titulo, :texto, :id_usuario)");
            $this->db->bind(':titulo', $dados['titulo']);
            $this->db->bind(':texto', $dados['texto']);
            $this->db->bind(':id_usuario', $dados['usuario_id']);

            return $this->db->executa();
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false; // Retorna false em caso de erro
        }
    }

    public function atualizar($dados)
    {
        try {
            $this->db->query("UPDATE post SET titulo = :titulo, texto = :texto WHERE id = :id");

            $this->db->bind(':id', $dados['id']);
            $this->db->bind(':titulo', $dados['titulo']);
            $this->db->bind(':texto', $dados['texto']);

            return $this->db->executa();
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false; // Retorna false em caso de erro
        }
    }


    public function lerPostPorId($id)
    {
        $this->db->query("SELECT * FROM post WHERE id = :id");
        $this->db->bind(':id', $id);

        return $this->db->resultado();
    }

    public function buscarUsuarioPorId($id)
    {
        $this->db->query("SELECT * FROM usuarios WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->resultado(); // Retorna o usuário ou false
    }

    public function deletar($id)
    {
        $this->db->query("DELETE FROM post WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->executa();
    }
}
