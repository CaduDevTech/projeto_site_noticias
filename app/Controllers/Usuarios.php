<?php

class Usuarios extends Controller
{
    private $usuarioModel;

    public function __construct()
    {
        if (Sessao::logado() == true) {
            URL::redireicionar(url: 'posts');
        }

        $this->usuarioModel = $this->model('Usuario');
        
    }

    public function cadastrar()
    {
        $formulario = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
        if (isset($formulario)) {
            $dados = [
                'nome' => trim(htmlspecialchars($formulario['nome'])),
                'email' => trim(htmlspecialchars($formulario['email'])),
                'nomePublico' => trim(htmlspecialchars($formulario['nomePublico'])),
                'senha' => trim(htmlspecialchars($formulario['senha'])),
                'senhaConfirmar' => trim(htmlspecialchars($formulario['senhaConfirmar'])),
                'token' => $formulario['token'],
                'erro_nome' => '',
                'erro_email' => '',
                'erro_nomePublico' => '',
                'erro_senha' => '',
                'erro_senhaConfirmar' => ''
            ];

            // Validador de token Csrf
            Csrf::validarToken($dados['token']);

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
            }elseif(strlen($dados['nomePublico']) > 15){
                $dados['erro_nomePublico'] = 'O nome público deve ter menos de 15 caracteres.';
            }
    
            if (empty($dados['senha'])) {
                $dados['erro_senha'] = 'Preencha o campo de senha.';

            } elseif (strlen($dados['senha']) < 6) {
                $dados['erro_senha'] = 'A senha deve ter pelo menos 6 caracteres.';

            }elseif ($dados['senha'] !== $dados['senhaConfirmar']) {
                $dados['erro_senhaConfirmar'] = 'As senhas devem ser iguais.';
            }

    
            // Verifica se há erros
            if (empty($dados['erro_nome']) && empty($dados['erro_email']) && empty($dados['erro_nomePublico']) &&
                empty($dados['erro_senha']) && empty($dados['erro_senhaConfirmar']))
                {
                // Se nenhum erro, salva o usuário
                $dados['senha'] = Validador::gerarSenha($dados['senha']);

                if ($this->usuarioModel->armazenar($dados)) {
                    
                    Sessao::mensagemAlerta('usuarioSucesso', 'Cadastrado com sucesso.', 'success');
                    URL::redireicionar('usuarios/login');
                    exit;
 
                } else {
                    
                    Sessao::mensagemAlerta('usuarioError', 'Erro ao cadastrar usuário.', 'danger');
                    unset($_SESSION['usuarioError']);
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
                'email' => trim(htmlspecialchars($formulario['email'])),
                'senha' => trim(htmlspecialchars($formulario['senha'])),
                'token' => htmlspecialchars($formulario['token']),
                'erro_email' => '',
                'erro_senha' => '',
            ];

            // Caso base no CSRF, faz as validações necessárias

            switch (Csrf::validarToken($dados['token']) == true) {

                case empty($dados['email']) :
                    $dados['erro_email'] = 'Preencha o campo de email.';
                    break;
                case Validador::validarEmail($dados['email']) :
                    $dados['erro_email'] = 'O email inserido não é válido.';
                    break;
                case empty($dados['senha']) :
                    $dados['erro_senha'] = 'Preencha o campo de senha.';
                    break;
                    
                case strlen($dados['senha']) < 6 :
                    $dados['erro_senha'] = 'A senha deve ter pelo menos 6 caracteres.';
                    break;
            }
                
            // Verifica se há erros
            if (empty($dados['erro_email']) && empty($dados['erro_senha'])) {
                // Busca o usuário no banco pelo email
                $usuario = $this->usuarioModel->buscarPorEmail($dados['email']);
    
                if ($usuario && password_verify($dados['senha'], $usuario->senha)) {
                    $this->criarSessaoUsuario($usuario);
                    URL::redireicionar('posts');
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
    
    private function criarSessaoUsuario($usuario) {
        $_SESSION['usuario_id'] = $usuario->id;
        $_SESSION['usuario_nome'] = $usuario->nome;
        $_SESSION['usuario_email'] = $usuario->email;
        $_SESSION['usuario_nivel'] = $usuario->tipo_perfil;

        URL::redireicionar('posts');
    }

    public function sair($rota = null) {

        unset($_SESSION["usuario_id"]);
        unset($_SESSION["usuario_nome"]);
        unset($_SESSION["usuario_email"]);

        session_destroy();

        URL::redireicionar($rota);
    }
}    