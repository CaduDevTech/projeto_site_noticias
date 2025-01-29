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

                    <?php if(isset($_SESSION['usuario_id'])):?>
                        
                        <span class="navbar-text ms-auto">
                        <div class="text-center">
                        <?php  echo "Olá, ".$_SESSION['usuario_nome'].". Seja bem vindo(a)";?>
                        <a class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Sair</a>
                        </div>
                        </span>
                       
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
                                    Após a saída você terá que colocar novamente as suas credenciais.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
                                    <a href="<?=URL?>usuarios/sair" type="button" class="btn btn-danger">Sair</a>
                                </div>
                            </div>
                        </div>
                    </div>



                    <?php else :?>

                    <span class="navbar-text ms-auto">
                    
                        <a href="<?=URL?>usuarios/cadastrar" title="Não tem uma conta? Cadastre-se" data-tooltip="tooltip" class="btn btn-info">Cadastre-se</a>
                        <a href="<?=URL?>usuarios/login" title="Tem uma conta? Entre" data-tooltip="tooltip" class="btn btn-info">Entrar</a>
                        
                    </span>

                    <?php endif; ?>
                    

                </div>
            </div>
        </nav>
    </div>
</header>