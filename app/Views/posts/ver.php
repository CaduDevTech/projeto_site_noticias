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

                <ul class="list-inline">
                    <li class="list-inline-item">
                    <a href="<?=URL?>posts/editar/<?=$dados['post']->id ?>" class="btn btn-primary">Editar</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="btn btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Deletar</a >


                             <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content bg-dark text-white"> 
                                <!-- Adicionando tema preto e letras brancas -->
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Certeza que deseja sair?</h1>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Após confirmar, essa noticia será apagada permanentemente.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
                                    <form action="<?=URL?>posts/deletar/<?=$dados['post']->id ?>" method="POST">
                                    <imput type="submit" value="Deletar" class="btn btn-danger">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                       
                    </li>
                </ul>

            
            <?php endif; ?>

        </div>
    </div>
