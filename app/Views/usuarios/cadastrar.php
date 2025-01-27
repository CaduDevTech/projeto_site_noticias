<div class="col-xl-4 col-md-6 mx-auto p-4 " >
<div class="border rounded p-5 border-dark-subtle circle">
<h1 class="display-6 text-center">Cadastre-se</h1>
<p class="text-center pb-3" >Preencha os campos abaixo para se cadastrar</p>

<form name="formulario"  method="POST" action="<?=URL?>/usuarios/login" >
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Nome:</label>
    <input type="text" placeholder="Digite o seu nome..." name="nome" id="exampleInputEmail1"  value="<?=$dados['nome'] ?>" class="form-control <?= $dados['erro_nome'] ? 'is-invalid' : '' ?>">
    <div class="invalid-feedback"><?= $dados['erro_nome'] ?></div>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email:</label>
    <input type="text" placeholder="Digite o seu Email..." class="form-control <?= $dados['erro_email'] ? 'is-invalid' : '' ?>" id="exampleInputEmail1" value="<?= $dados['email'] ?>" name="email">
    <div class="invalid-feedback"><?= $dados['erro_email'] ?></div>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Nome publico:</label>
    <input type="text" placeholder="Nome publico a todos" class="form-control <?= $dados['erro_nomePublico'] ? 'is-invalid' : '' ?>" id="exampleInputEmail1" name="nomePublico" value="<?= $dados['nomePublico'] ?>">
    <div class="invalid-feedback"><?= $dados['erro_nomePublico'] ?></div>
    <div id="emailHelp" class="form-text">Coloque um nome de usuário não existente.</div>

  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label text-center">Senha:</label>
    <input type="password" placeholder="Digite uma senha..." class="form-control <?= $dados['erro_senha'] ? 'is-invalid' : '' ?> toggle-password" id="exampleInputPassword1"  name="senha" value="<?= $dados['senhaConfirmar'] ?>" >
    <div class="invalid-feedback"><?= $dados['erro_senha'] ?></div>
  </div>

  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label text-center">Confirme sua Senha:</label>
        <input type="password" placeholder="Repita sua senha digitada..." class="form-control <?= $dados['erro_senhaConfirmar'] ? 'is-invalid' : '' ?>" id="exampleInputPassword1"  name="senhaConfirmar" value="<?= $dados['senhaConfirmar'] ?>">
        <div class="invalid-feedback"><?= $dados['erro_senhaConfirmar'] ?></div>
  </div>
  <div class="row"> 
  <div class="col">
  <div class="mb-3 ">
  <button type="submit" name="enviar" class="btn btn-primary">Adicionar</button>
  </div>
    <div class="col">
  <a href="<?=URL?>usuarios/login" class="">Voces já possui uma conta?<br> Entrar</a>
  </div>
  </div>
</div>
    </div>
</div>
</form>

