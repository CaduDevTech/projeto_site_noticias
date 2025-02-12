<?=Sessao::mensagemAlerta('usuarioSucesso'); ?>

<div class="col-xl-4 col-md-6 mx-auto p-4" data-aos="fade-right" >
<div class="border rounded p-5 border-dark-subtle circle">
<h1 class="display-6 text-center">Entrar</h1>

<?=Sessao::mensagemAlerta('usuarioError') ?>

<p class="text-center pb-3" >Preencha os campos abaixo para se fazer login</p>
<form name="formularioLogin"  method="POST" action="<?=URL?>usuarios/login" >
  <div class="mb-3">
  <label for="exampleInputEmail1" class="form-label">Email:</label>
    <input type="text" placeholder="Digite o seu Email..." class="form-control <?= $dados['erro_email'] ? 'is-invalid' : '' ?>" id="exampleInputEmail1" value="<?= $dados['email'] ?>" name="email">
    <div class="invalid-feedback"><?= $dados['erro_email'] ?></div>
  </div>
  <div class="mb-3">
  <label for="exampleInputPassword1" class="form-label text-center">Senha:</label>
    <input type="password" placeholder="Digite uma senha..." class="form-control <?= $dados['erro_senha'] ? 'is-invalid' : '' ?> toggle-password" id="exampleInputPassword1"  name="senha" value="<?= $dados['senha'] ?>" >
    <div class="invalid-feedback"><?= $dados['erro_senha'] ?></div>
  </div>

  <div class="row">
  <div class="col">
  <div class="mb-3 ">
  <button type="submit" name="enviar" class="btn btn-primary">Entrar</button>
  
  </div>
    <div class="col">
  <a href="<?=URL?>usuarios/cadastrar" class="">Você não possui uma conta?<br> Criar</a>
  </div>
  </div>
</div>
    </div>
    </form>
</div>

