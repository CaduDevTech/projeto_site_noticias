


<div class="container p-5 mt-5">
    <div class="row">
        <div class="col-md-8">
            <h1 class="my-5"><?= APP_NOME ?></h1>
            <p>Este projeto é uma criação própria de <?= APP_CRIADORES?>, desenvolvido com o objetivo de aprimorar habilidades na área de desenvolvimento web, com foco no estudo do padrão MVC. Neste projeto, é possível fazer comentários em posts de outros usuários, entre outras funcionalidades. Aproveite e obrigado por testar nossa aplicação!</p>
        </div>
        <div class="col-md-4 text-center">
            <div class="img-fluid logo">
                <img class="img-fluid" src="<?= URL ?>public/img/noticias-icon.png" alt="<?= APP_NOME ?>">
            </div>
        </div>
    </div>

    <div class="border-top mt-3 border-dark"></div>

    <h1 class="my-5">Tecnologias utilizadas no projeto</h1>

    <!-- Cards Row -->
    <div class="row gx-4 gy-4 justify-content-center">
    <div class="col-lg-4 col-md-5 col-sm-6 col-12">
        <div class="card" id="cardHome">
            <img src="<?= URL ?>public/img/php-icon.png" class="card-img-top" alt="Imagem do Card 1">
            <div class="card-body">
                <h5 class="card-title">PHP</h5>
                <p class="card-text">Esse projeto foi desenvolvido com PHP para a construção do back-end.</p>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-5 col-sm-6 col-12">
        <div class="card" id="cardHome">
            <img src="<?= URL ?>public/img/mysql-icon.svg" class="card-img-top" alt="Imagem do Card 2">
            <div class="card-body">
                <h5 class="card-title">MySQL</h5>
                <p class="card-text">O projeto utiliza MySQL como banco de dados.</p>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-5 col-sm-6 col-12">
        <div class="card" id="cardHome">
            <img src="<?= URL ?>public/img/mvc-icon.png" class="card-img-top" alt="Imagem do Card 3">
            <div class="card-body">
                <h5 class="card-title">MVC</h5>
                <p class="card-text">O projeto utiliza o padrão MVC para organizar o código.</p>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-5 col-sm-6 col-12">
        <div class="card" id="cardHome">
            <img src="<?= URL ?>public/img/hacker_icon.webp" class="card-img-top" alt="Imagem do Card 4">
            <div class="card-body">
                <h5 class="card-title">Proteções</h5>
                <p class="card-text">O sistema utiliza protecões contra ataques com <strong>CSRF</strong> (<i>Cross-Site Request Forgery</i>), <strong>SQL Injection</strong> e <strong>XSS</strong>(<i> Cross-Site Scripting</i>).</p>
            </div>
        </div>
    </div>
</div>

</div>

 

