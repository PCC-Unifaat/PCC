<?php
  $title = 'Cadastrar paciente';
  $css = ['painel'];
  $js = ['mask','painel','form'];
  include("header.php");
  //   $agente = \Classes\Models\UtilsModel::selecionar('tb_admin.agente', 'id', $_SESSION['id']);
  
  $menuSelected = 'pacientes';
  
?>
<div id="painel">
  <?php include(BASE_DIR_PAINEL.'pages/sidebar.php');?>
  <main id="painel-content">
    <div class="container">
      <div class="content">
        <div class="mapa-site">
          <a href="<?php echo INCLUDE_PATH;?>">Painel / </a> <a href="<?php echo INCLUDE_PATH;?>pacientes">pacientes / </a> <span>Cadastrar paciente</span>
        </div>
        <h1>Cadastar paciente</h1>
        <!-- <div id="loading">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" width="200" height="200" style="shape-rendering: auto; display: block; background: rgba(255, 255, 255, 0);" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path stroke="none" fill="#e15b64" d="M10 50A40 40 0 0 0 90 50A40 42 0 0 1 10 50">
          <animateTransform values="0 50 51;360 50 51" keyTimes="0;1" repeatCount="indefinite" dur="1s" type="rotate" attributeName="transform"></animateTransform>
        </path><g></g></g></svg>
        </div> -->
        <form method="post" enctype="multipart/form-data">
            
            <div class="form-single w100">
                <label for="nome">Nome*: </label>
                <input type="text" id="nome" name="nome" content="required">
            </div>

            <div class="form-single w30">
                <label for="cpf">CPF*: </label>
                <input type="text" id="cpf" name="cpf" content="required">
            </div>

            <div class="form-single w30">
                <label for="nascimetno">Data de nascimento*: </label>
                <input type="date" id="nascimetno" name="nascimetno" content="required">
            </div>

            <div class="form-single w30">
                <label for="prontuario">Prontuário: </label>
                <input type="text" id="prontuario" name="prontuario">
            </div>

            <div class="form-single w30">
                <label for="telefone">Telefone: </label>
                <input type="text" id="telefone" name="telefone">
            </div>

            <div class="form-single w70">
              <label for="sexo">Sexo (biológico)*: </label>
              <select id="sexo" name="sexo" content="required">
                <option value="" disabled selected>Selecione</option>
                <option value="masculino">Masculino</option>
                <option value="feminino">Feminino</option>
              </select>
            </div>

            <div class="form-single w100">
                <p>Comorbidades: </p>
                
                <?php
                    $comorbidades = \Classes\Models\UtilsModel::selecionarTudo('comorbidade');
                    foreach ($comorbidades as $key => $value) { ?>
                    <div class="form-single">
                        <label for="cat_<?php echo $value['id']?>"><?php echo ucfirst($value['comorbidade'])?> </label>
                        <input type="checkbox" id="cat_<?php echo $value['id']?>" name="comorbidade[]" value="<?php echo $value['id']?>">
                        <label for="cat_<?php echo $value['id']?>" class="checkbox-custom"><i class="fa-solid fa-check"></i></label>
                    </div>
                <?php } ?>

            </div>
            
            <div class="form-single w100">            
              <input type="submit" class="btn-input" name="acao" value="Cadastrar!">
            </div>
            
        </form>
      
      </div>
    </div>

  </main>
</div>

<?php
    include("footer.php");
?>