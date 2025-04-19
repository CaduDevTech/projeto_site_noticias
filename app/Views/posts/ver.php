<div class="container col-xl-8 py-5 my-5 border shadow-lg p-3 mb-5 bg-body-tertiary rounded" data-aos="fade-left">

    <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
        <ol class="breadcrumb mt-3">
            <li class="breadcrumb-item"><a href="<?=URL?>posts">Posts</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?=$dados['post']->titulo ?></li>
        </ol>
    </nav>
    <div class="card text-center my-3">
        <div class="card-header bg-secondary text-white">
            <?= $dados['post']->titulo ?>
        </div>

        <div class="card-body my-3">
            <?php if (!empty($dados['post']->imagem)): ?>
            <img src="<?= URL . '/' . $dados['post']->imagem ?>" class="card-img-top img-fluid"
                style="max-height: 300px; object-fit: cover;" alt="Em construção">
            <?php endif; ?>

            <p class="card-text py-3"><?= $dados['post']->texto ?></p>
        </div>
        <div class="card-footer text-body-secondary py-3">
            <small>
                Escrito por: <b><?=$dados['usuario']->nome_publico ?></b> em
                <?=Validador::dataBr($dados['post']->criado_em);?>
            </small>
        </div>

        <?php if(
            $dados['post']->id_usuario == $_SESSION['usuario_id'] ||
            $_SESSION['usuario_nivel'] == 'admin' ||
            $_SESSION['usuario_nivel'] == 'tecnico')
            :?>

        <ul class="list-inline">
            <li class="list-inline-item">
                <a href="<?=URL?>posts/editar/<?=$dados['post']->id ?>" class="btn btn-primary">Editar</a>
            </li>
            <li class="list-inline-item">
                <!-- Botão para abrir o modal -->
                <a class="btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#modalDeletar<?=$dados['post']->id?>">Deletar</a>
            </li>
        </ul>

        <?php endif; ?>
    </div>
</div>

<?php if(
    $dados['post'] -> id_usuario == $_SESSION['usuario_id'] ||
    $_SESSION['usuario_nivel'] == 'admin' ||
    $_SESSION['usuario_nivel'] == 'tecnico'
    ):?>

                    <!-- Modal -->
<div class="modal fade" id="modalDeletar<?=$dados['post']->id?>" tabindex="-1"
    aria-labelledby="modalDeletarLabel<?=$dados['post']->id?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-white">
            <!-- Adicionando tema preto e letras brancas -->
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalDeletarLabel<?=$dados['post']->id?>">Certeza que deseja excluir?
                </h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                Após confirmar, esta notícia será apagada permanentemente.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
                <form action="<?= URL . 'posts/deletar/' . $dados['post']->id ?>" method="POST">
                    <input type="submit" class="btn btn-danger" value="Deletar">
                    <?php echo CriaCsrf::getToken(); ?>
                </form>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>