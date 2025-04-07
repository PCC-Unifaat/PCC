<?php
  $title = 'Cadastrar paciente';
  $css = ['painel'];
  $js = ['mask','painel','form'];
  include("header.php");
  $menuSelected = 'pacientes';
  
?>
<div id="painel">
  <?php include(BASE_DIR_PAINEL.'pages/sidebar.php');?>
  <main id="painel-content">
    <div class="container">
      <div class="content">
        <div class="mapa-site">
          <a href="<?php echo INCLUDE_PATH;?>">Painel </a> / <span>Cadastrar paciente</span>
        </div>
        <h1>Cadastar paciente</h1>
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
                <input type="date" id="nascimetno" name="nascimetno" max="<?php echo date('Y-m-d'); ?>" content="required">
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
              <input type="submit" class="btn-input" name="cadastrar-paciente" value="Cadastrar!">
            </div>
            
        </form>
      
      </div>
    </div>

  </main>
</div>

<?php
    include("footer.php");
?>