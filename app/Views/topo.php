<header class="bg-dark">
    <div class="conteiner">
        <nav class="navbar bg-body-tertiary navbar-expand-sm navbar-dark " data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?=URL?>">Minhas notícias</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?=URL?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?=URL?>paginas/sobre">Sobre nós</a>
                        </li>
                    </ul>
                    <span class="navbar-text ms-auto">
                        <a href="<?=URL?>usuarios/cadastrar" title="Não tem uma conta? Cadastre-se" data-tooltip="tooltip" class="btn btn-info">Cadastre-se</a>
                        <a href="<?=URL?>usuarios/login" title="Tem uma conta? Entre" data-tooltip="tooltip" class="btn btn-info">Entrar</a>
                    </span>
                </div>
            </div>
        </nav>
    </div>
</header>
