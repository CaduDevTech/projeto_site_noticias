<?php

class Posts extends Controller
{

    private $postModel;


    public function __construct()
    {
        if (!Sessao::logado()) {
            URL::redireicionar('usuarios/login');
        }

        $this->postModel = $this->model('Post');
    }

    public function index()
    {
        $dados = [
            'posts' => $this->postModel->lerPosts()
        ];

        $this->view('posts/index', $dados);
    }

    public function cadastrar()
    {


        $formulario = filter_input_array(INPUT_POST, FILTER_DEFAULT);


        if (isset($formulario)) {
            // Pega os dados do formulário
            $dados = [
                'titulo' => trim(htmlspecialchars($formulario['titulo'])),
                'texto' => trim(htmlspecialchars($formulario['texto'])),
                'usuario_id' => $_SESSION['usuario_id'],
                'token' => $formulario['token'],
                'erro_titulo' => '',
                'erro_texto' => '',
                'imagem' => '',
                'erro_imagem' => '' // Adicionando campo para imagem
            ];

            // Validações básicas de texto

            switch (Csrf::validarToken($dados['token']) == true) {
                case empty($dados['titulo']):
                    $dados['erro_titulo'] = 'Preencha o campo de Título.';
                    $this->view('posts/cadastrar', $dados);
                    return;
                    break;

                case empty($dados['texto']):
                    $dados['erro_texto'] = 'Preencha o campo de Texto.';
                    $this->view('posts/cadastrar', $dados);
                    return;
                    break;
            }


            // Tratando o upload de imagem
            if (!empty($_FILES['imagem']['name'])) {

                $arquivo = $_FILES['imagem'];
                $pastaDestino = 'Uploads/posts/';
                $extensao = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
                $nomeArquivo = uniqid('post_') . '.' . $extensao;
                $caminhoFinal = $pastaDestino . $nomeArquivo;
                $extensoesPermitidas = ['jpg', 'jpeg', 'png'];

                switch (empty($dados['erro_titulo']) && empty($dados['erro_texto'])) {
                    // Caso 1: Verifica formato da imagem
                    case !in_array($extensao, $extensoesPermitidas):
                        $dados['erro_imagem'] = 'Formato de imagem inválido. Use JPG, JPEG, PNG.';
                        break;

                    case $_FILES['imagem']['size'] > 5 * 1024 * 1024:
                        $dados['erro_imagem'] = 'O arquivo não pode exceder 5MB.';
                        $this->view('posts/cadastrar', $dados);
                        return;
                        break;

                    // Caso 3: Tenta mover o arquivo
                    case !move_uploaded_file($arquivo['tmp_name'], $caminhoFinal):
                        $dados['erro_imagem'] = 'Erro ao fazer upload da imagem.';
                        break;

                    // Caso padrão: Upload bem-sucedido
                    default:
                        $dados['imagem'] = $caminhoFinal;
                        break;
                }
            }

            // Se houver erros, retorna à view com mensagens
            if (!empty($dados['erro_titulo']) || !empty($dados['erro_texto']) || !empty($dados['erro_imagem'])) {
                $this->view('posts/cadastrar', $dados);
                return;
            }

            // Salvar no banco
            try {
                $this->postModel->postarNoticias($dados);
                Sessao::mensagemAlerta('post', 'Post cadastrado com sucesso.');
            } catch (Exception $e) {
                Sessao::mensagemAlerta('post', 'Post cadastrado com erro', 'danger');

                //echo $e->getMessage();
                exit;
            }
            URL::redireicionar('posts');
        } else {
            // Exibe formulário vazio
            $dados = [
                'titulo' => '',
                'texto' => '',
                'erro_titulo' => '',
                'erro_texto' => '',
                'erro_imagem' => '',
                'imagem' => ''
            ];

            $this->view('posts/cadastrar', $dados);
        }
    }


    public function editar($id)
    {
        $formulario = filter_input_array(INPUT_POST, FILTER_DEFAULT);


        if (isset($formulario)) {
            $dados = [
                'id' => $id,
                'titulo' => trim(htmlspecialchars($formulario['titulo'])),
                'texto' => trim(htmlspecialchars($formulario['texto'])),
                'usuario_id' => $_SESSION['usuario_id'],
                'token' => htmlspecialchars($formulario['token']),
                'erro_titulo' => '',
                'erro_texto' => ''
            ];
            $post = $this->postModel->lerPostPorId($id);
            // Validações


            switch (Csrf::validarToken($dados['token']) == true) {

                case empty($dados['titulo']):
                    $dados['erro_titulo'] = 'Preencha o campo de Título.';
                    $this->view('posts/editar', $dados);
                    return;
                    break;

                case empty($dados['texto']):
                    $dados['erro_texto'] = 'Preencha o campo de Texto.';
                    $this->view('posts/editar', $dados);
                    return;
                    break;

                case !$this->checarAutorizacao($id, "editar") :
                    Sessao::mensagemAlerta('postError', 'Voce nao pode editar esse post2', 'danger');
                    URL::redireicionar('posts');
                    return;
                    break;

                case $this->postModel->atualizar($dados):
                    Sessao::mensagemAlerta('post', 'Noticia atualizada com sucesso.', 'success');
                    URL::redireicionar('posts');
                    return;
                    break;

                default:
                    Sessao::mensagemAlerta('postError', 'Erro ao atualizar noticia.', 'danger');
                    $this->view('posts/editar', $dados);
                    return;
                    break;
            }
        } else {
            // Exibe formulário vazio

            $post = $this->postModel->lerPostPorId($id);

            if ($this->checarAutorizacao($id, "editar") || !$post->id_usuario != $_SESSION['usuario_id'] ) {

                Sessao::mensagemAlerta('postError', 'Voce nao pode editar esse post3', 'danger');
                URL::redireicionar('posts');
            }
        }
        $dados = [
            'id' => $post->id,
            'titulo' => $post->titulo,
            'texto' => $post->texto,
            'erro_titulo' => '',
            'erro_texto' => ''
        ];


        $this->view('posts/editar', $dados);
    }


    public function ver($id)
    {
        $post = $this->postModel->lerPostPorId($id);
        $usuario = $this->postModel->buscarUsuarioPorId($post->id_usuario);

        if (!$post) {
            Sessao::mensagemAlerta('postError', 'Post nao encontrado.', 'danger');
            URL::redireicionar('posts');
        }

        $dados = [
            'post' => $post,
            'usuario' => $usuario
        ];

        $this->view('posts/ver', $dados);
    }

    public function deletar($id)
    {
        $post = $this->postModel->lerPostPorId($id);
        $metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_SPECIAL_CHARS);

        //validação CSRF
        Csrf::validarToken($_POST['token']);


        if (!$this->checarAutorizacao($id, "deletar") || !$post || $metodo != 'POST') {
            Sessao::mensagemAlerta('postError', 'Voce não tem permissão para deletar esse post', 'danger');
            URL::redireicionar('posts');
        } else {

            $caminhoImagem = '../public/' . $post->imagem;

            if ($this->postModel->deletar($id)) {

                // Verifica se o arquivo de imagem existe e apaga
                if (!empty($post->imagem) || file_exists($caminhoImagem)) {
                    unlink($caminhoImagem);
                }

                Sessao::mensagemAlerta('post', 'Notícia deletada com sucesso.', 'success');
                URL::redireicionar('posts');
            } else {
                Sessao::mensagemAlerta('postError', 'Erro ao deletar o post.', 'danger');
                URL::redireicionar('posts');
            }
        }
    }

    private function checarAutorizacao($id, $acao)
    {
        $post = $this->postModel->lerPostPorId($id);

        $dados = [
            'admin' => ['deletar', 'editar'],
            'tecnico' => ['editar']
        ];

        if ($post->id_usuario == $_SESSION['usuario_id']) {

            return true;
        } else {
            switch ($permissao = $_SESSION['usuario_nivel']) {
                case 'comum':
                    return false;
                    break;

                case 'tecnico':
                    if (in_array($acao, $dados['tecnico'])) {
                        return true;
                    }
                    break;

                case 'admin':
                    if (in_array($acao, $dados['admin'])) {
                        return true;
                    }
                    break;
            }
        }
    }
}
