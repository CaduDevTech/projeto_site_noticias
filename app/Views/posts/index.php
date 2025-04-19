    <div class="col-xl-8 col-md-6 container py-5">

        <?php 
        Sessao::mensagemAlerta('post'); 
        Sessao::mensagemAlerta('postError');
        Sessao::mensagemAlerta('error_imagem');
        Sessao::mensagemAlerta('tokenError');
        print_r($_SESSION);
        ?>

        <div class="card" data-aos="fade-left">
            <div class="card-header bg-info text-white">POSTAGENS
                <div class="float-end mt-2">
                    <a href="<?= URL ?>posts/cadastrar" class="btn btn-light">Escrever</a>
                </div>
            </div>
            <div class="card-body">

                <?php if (empty($dados['posts'])): ?>
                    <div class="alert alert-info text-center" role="alert">
                        Nenhuma postagem encontrada!
                    </div>
                <?php endif; ?>

                <?php
                 foreach ($dados['posts'] as $post): ?>

                    <div class="card mb-3">
                    <?php if (!empty($post->imagem)): ?>
                    <img src="<?= URL . $post->imagem?>" class="card-img-top img-fluid" style="max-height: 300px; object-fit: cover;" alt="Em construção">

                    <?php endif;?>

                        <div class="card-body">
                            <h5 class="card-title"> <?= $post->titulo ?></h5>
                            
                            <p class="card-text"><?= $post->texto ?></p>
                            <a href="<?= URL ?>posts/ver/<?= $post->postId ?>" class="btn btn-white border border-info text-info float-end">Ler mais</a>
                            <p class="card-text"><small class="text-body-secondary">Escrito por: <?= $post->nome_publico ?> em <?=Validador::dataBr($post->postDataCadastro) ?></small></p>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>
    </div>