<?php
  $title = 'Painel';
  $css = ['painel'];
  $js = ['painel'];
  include("header.php");
  $menuSelected = 'inicio';
?>
<div id="painel">
  <?php include(BASE_DIR_PAINEL.'pages/sidebar.php');?>
  <main id="painel-content">
    <div class="container">
      <div class="content">
        <div class="mapa-site">
          <span>Painel</span>
        </div>
          <h1>Bem vindo, <?php echo explode(' ',$_SESSION['nome'])[0]?>!</h1>

    
      </div>
    </div>

  </main>
</div>

<?php
    include("footer.php");
?>