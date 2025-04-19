<?php
    $title = 'Cadastrar';
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
        <h1>Cadastrar</h1>
        <form method="post">
          
          <div class="form-single w100">
            <label for="nome"><i class="fa-solid fa-user"></i></label>
            <input id="nome" name='nome' type="text" placeholder="Nome" content="required">
          </div>

          <div class="form-single w100">
            <label for="matricula"><i class="fa-regular fa-address-card"></i></label>
            <input id="matricula" name='matricula' type="number" placeholder="Matrícula" content="required">
          </div>

          <div class="form-single w100">
            <label for="email"><i class="fa-solid fa-at"></i></label>
            <input id="email" name='email' type="text" placeholder="Email" content="required">
          </div>

          <div class="form-single w50">
            <label for="senha"><i class="fa-solid fa-lock"></i></label>
            <input id="senha" name='senha' type="password" placeholder="Senha" content="required">  
          </div>

          <div class="form-single w50">
            <label for="confirmar_senha"><i class="fa-solid fa-lock"></i></label>
            <input id="confirmar_senha" name='confirma_senha' type="password" placeholder="Confirmar senha" content="required">  
          </div>

          <div class="btn-login w100">
            <input type="submit" name='cadastrar-agente' value="Cadastrar!">
            <a href="<?php echo INCLUDE_PATH?>">Já tem cadastro?</a>
          </div>
          
        </form>
      </div>
    
  </div>
</div>


<?php
    include("footer.php");
?>