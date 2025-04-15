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

          <a href="<?php echo INCLUDE_PATH;?>puericultura">Puericultura</a> <br>
          <a href="<?php echo INCLUDE_PATH;?>criancas">Crianças</a> <br>
          <a href="<?php echo INCLUDE_PATH;?>idosos">Idosos</a> <br>
          <a href="<?php echo INCLUDE_PATH;?>hipertensos">Hipertensos</a> <br>
          <a href="<?php echo INCLUDE_PATH;?>diabeticos">Diabeticos</a> <br>
          <a href="<?php echo INCLUDE_PATH;?>ppn">Mulheres no período fértil</a> <br>
          <a href="<?php echo INCLUDE_PATH;?>gestantes">Gestantes</a> <br><br>
          <a href="<?php echo INCLUDE_PATH;?>pacientes">Pacientes</a>
      </div>
    </div>

  </main>
</div>

<?php
    include("footer.php");
?>