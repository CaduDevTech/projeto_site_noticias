<?php

class Usuarios extends Controller
{
    private $usuarioModel;

    public function __construct()
    {
        
        $this->usuarioModel = $this->model('Usuario');
    }
    public function cadastrar()
    {
        $formulario = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
        if (isset($formulario)) {
            $dados = [
                'nome' => trim($formulario['nome']),
                'email' => trim($formulario['email']),
                'nomePublico' => trim($formulario['nomePublico']),
                'senha' => trim($formulario['senha']),
                'senhaConfirmar' => trim($formulario['senhaConfirmar']),
                'erro_nome' => '',
                'erro_email' => '',
                'erro_nomePublico' => '',
                'erro_senha' => '',
                'erro_senhaConfirmar' => ''
            ];
    
            // Validações
            if (empty($dados['nome'])) {
                $dados['erro_nome'] = 'Preencha o campo de nome.';
            } elseif (Validador::validarNome($dados['nome'])) {
                $dados['erro_nome'] = 'O nome deve conter apenas letras e espaços.';
            }
    
            if (empty($dados['email'])) {
                $dados['erro_email'] = 'Preencha o campo de email.';
            } elseif (Validador::validarEmail($dados['email'])) {
                $dados['erro_email'] = 'O email inserido não é válido.';
            } elseif ($this->usuarioModel->verificarDuplicidadeEmail($dados['email']) === true) {
                $dados['erro_email'] = 'Email em uso, tente outro.';
            }
    
            if (empty($dados['nomePublico'])) {
                $dados['erro_nomePublico'] = 'Preencha o campo de nome público.';
            } elseif ($this->usuarioModel->verificarDuplicidadeNomePublico($dados['nomePublico']) === true) {
                $dados['erro_nomePublico'] = 'Nome público em uso, tente outro.';
            }
    
            if (empty($dados['senha'])) {
                $dados['erro_senha'] = 'Preencha o campo de senha.';
            } elseif (strlen($dados['senha']) < 6) {
                $dados['erro_senha'] = 'A senha deve ter pelo menos 6 caracteres.';
            }

    
            // Verifica se há erros
            if (empty($dados['erro_nome']) && empty($dados['erro_email']) && empty($dados['erro_nomePublico']) &&
                empty($dados['erro_senha']) && empty($dados['erro_senhaConfirmar']))
                {
                // Se nenhum erro, salva o usuário
                $dados['senha'] = Validador::gerarSenha($dados['senha']);
                if ($this->usuarioModel->armazenar($dados)) {
                    echo 'Cadastro efetuado com sucesso<hr>';
                } else {
                    echo 'Erro ao cadastrar o usuário<hr>';
                }
            } else {
                // Mostra os erros no formulário
                $this->view('usuarios/cadastrar', $dados);
            }
        } else {
            // Exibe formulário vazio
            $dados = [
                'nome' => '',
                'email' => '',
                'nomePublico' => '',
                'senha' => '',
                'senhaConfirmar' => '',
                'erro_nome' => '',
                'erro_email' => '',
                'erro_nomePublico' => '',
                'erro_senha' => '',
                'erro_senhaConfirmar' => ''
            ];
    
            $this->view('usuarios/cadastrar', $dados);
        }
    }

    public function login()
    {
        $formulario = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($formulario)) {
            $dados = [
                'email' => trim($formulario['email']),
                'senha' => trim($formulario['senha']),
                'erro_email' => '',
                'erro_senha' => '',
            ];

            // Validações
            if (empty($dados['email'])) {
                $dados['erro_email'] = 'Preencha o campo de email.';
            } elseif (Validador::validarEmail($dados['email'])) { // Correção: valida o formato do email corretamente
                $dados['erro_email'] = 'O email inserido não é válido.';
            }

            if (empty($dados['senha'])) {
                $dados['erro_senha'] = 'Preencha o campo de senha.';
            } elseif (strlen($dados['senha']) < 6) {
                $dados['erro_senha'] = 'Email ou senha inválidos.';
            }

            // Verifica se há erros
            if (empty($dados['erro_email']) && empty($dados['erro_senha'])) {
                // Busca o usuário no banco pelo email
                $usuario = $this->usuarioModel->buscarPorEmail($dados['email']);
    
                if ($usuario && password_verify($dados['senha'], $usuario->senha)) {
                    // Login bem-sucedido
                    echo 'Usuário logado com sucesso<hr>';
                    // Redirecionar ou iniciar a sessão
                    var_dump($usuario);
                } else {
                    // Mensagem de erro genérica por segurança
                    $dados['erro_senha'] = 'Email ou senha inválidos.';
                }
            }

            // Mostra os erros ou redireciona
            $this->view('usuarios/login', $dados);
        } else {
            // Exibe formulário vazio
            $dados = [
                'email' => '',
                'senha' => '',
                'erro_email' => '',
                'erro_senha' => '',
            ];
    
            $this->view('usuarios/login', $dados);
        }
    }
    
}    