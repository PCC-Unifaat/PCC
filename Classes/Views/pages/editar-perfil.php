<?php
  $title = 'Editar perfil';
  $css = ['painel'];
  $js = ['mask','painel','form','editar-perfil'];
  include("header.php");
  $agente = \Classes\Models\UtilsModel::selecionar('agente', 'id', $_SESSION['id']);
  
  $menuSelected = 'perfil';
?>
<div id="painel">
  <?php include(BASE_DIR_PAINEL.'pages/sidebar.php');?>
  <main id="painel-content">
    <div class="container">
      <div class="content">
        <div class="mapa-site">
          <a href="<?php echo INCLUDE_PATH;?>">Painel / </a> <span>Editar perfil</span>
        </div>
        <h1>Editar perfil</h1>

        <form method="post">
          
          <div class="form-single w100">
            <label for="nome">Nome:</label>
            <input id="nome" name='nome' type="text" placeholder="Nome" value="<?php echo $agente['nome']; ?>" content="required">
          </div>

          <div class="form-single w100">
            <label for="email">Email:</i></label>
            <input id="email" name='email' type="text" placeholder="Email" value="<?php echo $agente['email']; ?>" content="required">
          </div>

          <div class="form-single w100">
            <label for="senha">Senha:</label>
            <input id="senha" name='senha' type="password" placeholder="Senha" content="required">  
          </div>
          <div class="btn-login w50">
            <input class="btn-input" type="submit" name='editar-perfil' value="Atualizar!">
          </div>

          <div class="form-single">
            <span class="w50 btn-troca-senha">Alterar senha</span>
          </div>
          
        </form>
        
        <div class="trocar-senha-container">
          <form method="post" class="trocar-senha">
            <h2>Alterar senha</h2>
            <div class="fechar-confirmar-senha w100">
              <span><i class="fa-solid fa-times"></i></span>
            </div>

            <div class="form-single w100">
              <label for="senha-atual">Senha atual*:</label>
              <input id="senha-atual" name='senha-atual' type="password" placeholder="Senha atual" content="required">  
            </div>

            <div class="form-single w100">
              <label for="senha">Nova senha*:</label>
              <input id="senha" name='senha' type="password" placeholder="Nova senha" content="required">  
            </div>

            <div class="form-single w100">
              <label for="confirmar_senha">Confirmar senha*:</label>
              <input id="confirmar_senha" name='confirmar_senha' type="password" placeholder="Confirmar senha" content="required">  
            </div>

            <div class="form-single">
              <input class="btn-input"type="submit" value="Atualizar senha" name="atualiza-senha">
            </div>
          </form>
        </div>
        
      </div>

    </div>
  </main>
</div>

<?php
    include("footer.php");
?>