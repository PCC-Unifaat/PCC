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

          <p>Esse é o painel de controle do sistema. Aqui você pode gerenciar os dados dos pacientes.</p>
          <p>Para começar, escolha qual tabela você deseja gerenciar:</p>

          <div class="painel-container">
            <a class="btn-inicio" href="<?php echo INCLUDE_PATH;?>puericultura">Puericultura</a>
            <a class="btn-inicio" href="<?php echo INCLUDE_PATH;?>criancas">Crianças</a>
            <a class="btn-inicio" href="<?php echo INCLUDE_PATH;?>idosos">Idosos</a>
            <a class="btn-inicio" href="<?php echo INCLUDE_PATH;?>hipertensos">Hipertensos</a>
            <a class="btn-inicio" href="<?php echo INCLUDE_PATH;?>diabeticos">Diabeticos</a>
            <a class="btn-inicio" href="<?php echo INCLUDE_PATH;?>ppn">Mulheres no período fértil</a>
            <a class="btn-inicio" href="<?php echo INCLUDE_PATH;?>gestantes">Gestantes</a>
            <a class="btn-inicio" href="<?php echo INCLUDE_PATH;?>pacientes">Pacientes</a>
          </div>
          
      </div>
    </div>

  </main>
</div>

<?php
    include("footer.php");
?>