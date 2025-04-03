<?php
    $title = 'Login';
    $css = ['login'];
    $js = ['mask','form'];
    include("header.php");
?>
<div>
    <div class="box-side">
      <div class="icon"><span><i class="fa-solid fa-stethoscope"></i></span></div>
      <div class="icon"><span><i class="fa-regular fa-hourglass-half"></i></span></div>
      <div class="icon"><span><i class="fa-solid fa-heart-pulse"></i></span></div>
      <div class="icon"><span><i class="fa-regular fa-clock"></i></span></div>
      <div class="icon"><span><i class="fa-solid fa-pills"></i></span></div>
    </div>
    <div class="box-login">
        <div class="container-login">
          <div class="logo">MedClock</div>
          <h1>Login</h1>
          <form method="post">
            <div class="form-single w100">
              <label for="email"><i class="fa-solid fa-at"></i></label>
              <input id="email" name="email" type="text" placeholder="E-mail" content="required">
            </div>
            <div class="form-single w100">
              <label for="senha"><i class="fa-solid fa-lock"></i></label>
              <input id="senha" name="senha" type="password" placeholder="Senha" content="required">  
            </div>
            <div class="btn-login w100">
              <input type="submit" name="acao" value="Entrar!">
              <a href="<?php echo INCLUDE_PATH?>cadastrar">Cadastrar</a>
            </div>
            <a class="esqueceu-senha" href="<?php echo INCLUDE_PATH?>recuperar_senha">Esqueceu a senha?</a>
          </form>
        </div>
    
    </div>
</div>


<?php
    include("footer.php");
?>