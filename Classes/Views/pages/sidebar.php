<div class="sidebar">
    <div class="menu-icon"><span><i class="fa-solid fa-forward"></i></span></div>
    <div class="side-content">
      <a title="Inicio" class="<?php echo ($menuSelected == 'inicio') ? 'selected' : ''; ?>" href="<?php echo INCLUDE_PATH?>"><i class="fa-solid fa-house"></i> <span>Inicio</span></a>
      <a title="Pacientes" class="<?php echo ($menuSelected == 'pacientes') ? 'selected' : ''; ?>" href="<?php echo INCLUDE_PATH?>pacientes"><i class="fa-regular fa-address-card"></i> <span>Pacientes</span></a>
      <a title="Cadastrar paciente" class="<?php echo ($menuSelected == 'cadastrar_paciente') ? 'selected' : ''; ?>" href="<?php echo INCLUDE_PATH?>cadastrar_paciente"><i class="fa-solid fa-user-plus"></i> <span>Cadastrar pacientes</span></a>
      <a title="Comorbidades" class="<?php echo ($menuSelected == 'comorbidades') ? 'selected' : ''; ?>" href="<?php echo INCLUDE_PATH?>comorbidades"><i class="fa-solid fa-heart-circle-exclamation"></i></i><span>Comorbidades</span></a>
      <a title="Editar perfil" class="<?php echo ($menuSelected == 'perfil') ? 'selected' : ''; ?>" href="<?php echo INCLUDE_PATH?>editar_perfil"><i class="fa-solid fa-user"></i><span>Editar perfil</span></a>
      <?php if(!empty($_SESSION['master'])){ ?>
      <a title="Master" class="<?php echo ($menuSelected == 'master') ? 'selected' : ''; ?>" href="<?php echo INCLUDE_PATH?>master"><i class="fa-solid fa-gears"></i><span>Master</span></a>
      <?php } ?>
      <p title="Sair" url="<?php echo INCLUDE_PATH?>?sair" btn="Sair" class="btn-logout confirmar-acao"><i class="fa-solid fa-arrow-right-from-bracket"></i><span>Sair</span></p>
    </div>
</div>