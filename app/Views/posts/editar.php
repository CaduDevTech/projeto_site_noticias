<div class="col-xl-8 col-md-6 mx-auto p-4">
    <div class="border rounded p-5 border-dark-subtle circle" data-aos="fade-left">
        <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
            <ol class="breadcrumb"> 
                <li class="breadcrumb-item"><a href="<?=URL?>posts">Posts</a></li>
                <li class="breadcrumb-item"><a href="<?=URL?>posts/ver/<?=$dados['id']?>">Editar</a></li>
                <li class="breadcrumb-item active" aria-current="page">Atualizar</li>
            </ol>
        </nav> 
 
        <h1 class="display-6 text-center">Atualize uma noticia</h1>

        <?php
    
        Sessao::mensagemAlerta('post');?>


        <p class="text-center pb-3">Mude as informações abaixo, caso necessario</p>
        <form name="formulario" method="POST" action="<?=URL?>posts/editar/<?=$dados['id']?>">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Titulo:</label>
                <input type="text" placeholder="Digite o texto da sua noticia..."
                    class="form-control <?= $dados['erro_titulo'] ? 'is-invalid' : '' ?> " id="exampleInputEmail1"
                    value="<?= $dados['titulo'] ?>" name="titulo">
                <div class="invalid-feedback"><?= $dados['erro_titulo'] ?></div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label text-center">Texto:</label>
                <textarea type="text" placeholder="Digite sua noticia..."
                    class="form-control <?= $dados['erro_texto'] ? 'is-invalid' : '' ?>" id="exampleInputPassword1"
                    name="texto" rows="6"><?= $dados['texto']?></textarea>
                <div class="invalid-feedback"><?= $dados['erro_texto'] ?></div>
            </div>

            
            <div class="row">
                <div class="col">
                    <div class="mb-3 text-center">
                        <button type="submit" name="enviar" class="btn btn-info">Atualizar</button>

                    </div>
                </div>
            </div>
    </div>
    </form>
</div>