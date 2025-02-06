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
                <p class="card-text py-3"><?= $dados['post']->texto ?></p>
            </div>
            <div class="card-footer text-body-secondary py-3">
              <small>
                Escrito por: <b><?=$dados['usuario']->nome_publico ?></b> em
                <?=Validador::dataBr($dados['post']->criado_em);?>
                </small>
            </div>

            <?php if($dados['post'] -> id_usuario == $_SESSION['usuario_id']):?>


            <a href="<?=URL?>posts/editar/<?=$dados['post']->id ?>" class="btn btn-primary">Editar</a>
            <?php endif; ?>

        </div>
    </div>
