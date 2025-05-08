<?php
  $title = 'Editar idoso';
  $css = ['painel'];
  $js = ['mask','painel','form'];
  include("header.php");
  $menuSelected = 'idosos';
  $paciente = \Classes\Models\UtilsModel::selecionar('paciente', 'id', $_GET['id']);

  $observacao = explode('||', $paciente['observacao'])[2]; //Observação idoso
?>
<div id="painel">
  <?php include(BASE_DIR_PAINEL.'pages/sidebar.php');?>
  <main id="painel-content">
    <div class="container">
      <div class="content">
        <div class="mapa-site">
          <a href="<?php echo INCLUDE_PATH;?>">Painel / </a> <a href="<?php echo INCLUDE_PATH;?>idosos">Idoso / </a> <span>Editar idoso</span>
        </div>
        <h1>Editar paciente</h1>
        <form method="post" enctype="multipart/form-data">
            
            <div class="form-single w100">
                <label for="nome">Nome*: </label>
                <input type="text" id="nome" name="nome" value="<?php echo $paciente['nome'];?>" content="required">
            </div>

            <div class="form-single w30">
                <label for="cpf">CPF*: </label>
                <input type="text" id="cpf" name="cpf" value="<?php echo $paciente['cpf'];?>" content="required">
            </div>

            <div class="form-single w30">
                <label for="nascimetno">Data de nascimento*: </label>
                <input type="date" id="nascimetno" name="nascimetno" value="<?php echo $paciente['nascimento'];?>" max="<?php echo date('Y-m-d'); ?>" content="required">
            </div>

            <div class="form-single w30">
                <label for="prontuario">Prontuário: </label>
                <input type="text" id="prontuario" value="<?php echo $paciente['prontuario'];?>" name="prontuario">
            </div>

            <div class="form-single w30">
                <label for="telefone">Telefone: </label>
                <input type="text" id="telefone" value="<?php echo $paciente['telefone'];?>" name="telefone">
            </div>

            <div class="form-single w70">
              <label for="sexo">Sexo (biológico)*: </label>
              <select id="sexo" name="sexo" content="required">
                <option value="" disabled selected>Selecione</option>
                <option value="masculino" <?php echo ($paciente['sexo'] == 'masculino') ? 'selected' : ''; ?>>Masculino</option>
                <option value="feminino" <?php echo ($paciente['sexo'] == 'feminino') ? 'selected' : ''; ?>>Feminino</option>
              </select>
            </div>

            <div class="form-single w100">
                <p>Comorbidades: </p>
                
                <?php
                    $comorbidades = \Classes\Models\UtilsModel::selecionarTudo('comorbidade');
                    $comorbidadesPaciente = explode(',', $paciente['comorbidade']);
                    foreach ($comorbidades as $key => $value) { ?>
                    <div class="form-single">
                        <label for="cat_<?php echo $value['id']?>"><?php echo ucfirst($value['comorbidade'])?> </label>
                        <input type="checkbox" id="cat_<?php echo $value['id']?>" name="comorbidade[]" value="<?php echo $value['id']?>" <?php echo in_array($value['id'], $comorbidadesPaciente) ? 'checked' : ''; ?>>
                        <label for="cat_<?php echo $value['id']?>" class="checkbox-custom"><i class="fa-solid fa-check"></i></label>
                    </div>
                <?php } ?>
            </div>


            <div class="form-single w100">
              <label for="observacao">Observação idoso: </label>
              <input type="text" id="observacao" name="observacao" value="<?php echo $observacao;?>" maxCaracter="60">
            </div>

            <div class="form-single w30">
              <label for="status">Status do paciente:</label>
              <select name="status" id="status">
                <option value="" selected>Consulta em dia</option>
              <?php
                $legenda = \Classes\Models\UtilsModel::selecionarTudo('legenda');
                foreach ($legenda as $key => $value) {
              ?>
                <option value="<?php echo $value['id']?>" <?php echo ($paciente['legenda_id'] == $value['id']) ? 'selected' : '' ?>><?php echo $value['descricao']?></option>
              <?php } ?>
              </select>
            </div>

            <div class="form-single w100">            
              <input type="submit" class="btn-input" name="editar-idoso" value="Atualizar!">
            </div> 
        </form>
      
      </div>
    </div>

  </main>
</div>

<?php
    include("footer.php");
?>