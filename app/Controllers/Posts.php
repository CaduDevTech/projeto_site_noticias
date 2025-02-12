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
            'titulo' => trim($formulario['titulo']),
            'texto' => trim($formulario['texto']),
            'usuario_id' => $_SESSION['usuario_id'],
            'erro_titulo' => '',
            'erro_texto' => '',
            'imagem' => '' // Adicionando campo para imagem
        ];

        // Validações básicas
        if (empty($dados['titulo'])) {
            $dados['erro_titulo'] = 'Preencha o campo de Título.';
        }
        if (empty($dados['texto'])) {
            $dados['erro_texto'] = 'Preencha o campo de Texto.';
        }

        // Tratando o upload de imagem
        if (!empty($_FILES['imagem']['name'])) {
            $arquivo = $_FILES['imagem'];
            $pastaDestino = 'Uploads/posts/';

            // Garante que a pasta existe
            if (!is_dir($pastaDestino)) {
                mkdir($pastaDestino, 0777, true);
            }

            // Gera um nome único para a imagem
            $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
            $nomeArquivo = uniqid('post_') . '.' . $extensao;
            $caminhoFinal = $pastaDestino . $nomeArquivo;

            // Verifica se é uma imagem válida
            $extensoesPermitidas = ['jpg', 'jpeg', 'png'];
            if (!in_array(strtolower($extensao), $extensoesPermitidas)) {
                $dados['erro_imagem'] = 'Formato de imagem inválido. Use JPG, JPEG, PNG, GIF ou WEBP.';
            } elseif ($arquivo['size'] > 5 * 1024 * 1024) { // Limite de 5MB
                $dados['erro_imagem'] = 'O arquivo não pode exceder 5MB.';
            } else {
                // Move o arquivo para a pasta de uploads
                if (move_uploaded_file($arquivo['tmp_name'], $caminhoFinal)) {
                    $dados['imagem'] = $caminhoFinal;
                } else {
                    $dados['erro_imagem'] = 'Erro ao fazer upload da imagem.';
                }
            }
        }

        // Se houver erros, retorna à view com mensagens
        if (!empty($dados['erro_titulo']) || !empty($dados['erro_texto']) || !empty($dados['erro_imagem'])) {
            $this->view('posts/cadastrar', $dados);
            return;
        }

        // Salvar no banco
        if ($this->postModel->postarNoticias($dados)) {
            Sessao::mensagemAlerta('post', 'Cadastrado com sucesso.', 'success');
            URL::redireicionar('posts');
        } else {
            die('Erro ao cadastrar.');
        }
    } else {
        // Exibe formulário vazio
        $dados = [
            'titulo' => '',
            'texto' => '',
            'erro_titulo' => '',
            'erro_texto' => '',
            'erro_imagem' => ''
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
                'titulo' => trim($formulario['titulo']),  // Trim para evitar espaços desnecessários
                'texto' => trim($formulario['texto']),
                'usuario_id' => $_SESSION['usuario_id'],
                'erro_titulo' => '',
                'erro_texto' => ''
            ];

            // Validações
            if (empty($dados['titulo'])) {
                $dados['erro_titulo'] = 'Preencha o campo de Título.';
            }
            if (empty($dados['texto'])) {
                $dados['erro_texto'] = 'Preencha o campo de Texto.';
            }

            // Se houver erros, volta para a view com os valores preenchidos
            if (!empty($dados['erro_titulo']) || !empty($dados['erro_texto'])) {
                $this->view('posts/editar',$dados);
                return; // Impede a execução do código abaixo
            }

            // Se nenhum erro, salva o post
            if ($this->postModel->atualizar($dados)) {
                Sessao::mensagemAlerta('post', 'Noticia atualizada com sucesso.', 'success');
                URL::redireicionar('posts');
            } else {
                die('Erro ao cadastrar');
            }
        } else {
            // Exibe formulário vazio

            $post = $this->postModel->lerPostPorId($id);

            if ($post->id_usuario != $_SESSION['usuario_id'] ) {

                Sessao::mensagemAlerta('postError', 'Voce nao pode editar esse post', 'danger');
                URL::redireicionar('posts');

            }else{

            $dados = [
                'id' => $post->id,
                'titulo' => $post->titulo,
                'texto' => $post->texto,
                'erro_titulo' => '',
                'erro_texto' => ''
            ];}

            $this->view('posts/editar', $dados);
        }
    }

    public function ver($id){

        $post = $this->postModel->lerPostPorId($id);
        $usuario = $this->postModel->buscarUsuarioPorId($post->id_usuario);

        $dados = [
            'post' => $post,
            'usuario' => $usuario
        ];

        $this->view('posts/ver', $dados);
    }


    public function deletar($id){

        $id = (int) $id;

        if (is_int($id)) {
            if ($this->postModel->deletar($id)) {
                Sessao::mensagemAlerta('post', 'Noticia deletada com sucesso.', 'success');
                URL::redireicionar('posts');
            } else {
                Sessao::mensagemAlerta('postError', 'Voce nao pode deletar esse post', 'danger');
                URL::redireicionar('posts');
                die('Erro ao deletar');
            }
        } else {

           var_dump($id);
        }

    }
}
