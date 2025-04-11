<?php
  $title = 'Editar gestante';
  $css = ['painel'];
  $js = ['mask','painel','form'];
  include("header.php");
  $menuSelected = 'idosos';
  $paciente = \Classes\Models\UtilsModel::selecionar('paciente', 'id', $_GET['id']);

  $observacao = explode('||', $paciente['observacao'])[6]; //Observação gestante
  $gestante = \Classes\Models\UtilsModel::selecionar('gestante', 'paciente_id', $paciente['id']);
?>
<div id="painel">
  <?php include(BASE_DIR_PAINEL.'pages/sidebar.php');?>
  <main id="painel-content">
    <div class="container">
      <div class="content">
        <div class="mapa-site">
          <a href="<?php echo INCLUDE_PATH;?>">Painel / </a> <a href="<?php echo INCLUDE_PATH;?>gestantes">Gestante / </a> <span>Editar gestante</span>
        </div>
        <h1>Editar paciente</h1>
        <form method="post" enctype="multipart/form-data">
            
            <div class="form-single w100">
                <label for="nome">Nome*: </label>
                <input type="text" id="nome" name="nome" value="<?php echo $paciente['nome'];?>" content="required">
            </div>

            <div class="form-single w50">
                <label for="prontuario">Prontuário: </label>
                <input type="text" id="prontuario" value="<?php echo $paciente['prontuario'];?>" name="prontuario">
            </div>

            <div class="form-single w50">
                <label for="telefone">Telefone: </label>
                <input type="text" id="telefone" value="<?php echo $paciente['telefone'];?>" name="telefone">
            </div>     
            
            <div class="form-single w50">
                <label for="dum">DUM: </label>
                <input type="date" id="dum" name="dum" value="<?php echo $gestante['dum'];?>">
            </div>

            <div class="form-single w50">
                <label for="dpp">DPP: </label>
                <input type="date" id="dpp" name="dpp" value="<?php echo $gestante['dpp'];?>">
            </div>

            <div class="form-single w100">
                <label for="parto">Parto: </label>
                <input type="text" id="parto" value="<?php echo $gestante['parto'];?>" name="parto">
            </div>

            <div class="form-single w50">
                <label for="alto_risco">Alto risco: </label>
                <input type="checkbox" id="alto_risco" name="alto_risco" value="1" <?php echo (!empty($gestante['alto_risco'])) ? 'checked' : ''; ?>>
                <label for="alto_risco" class="checkbox-custom"><i class="fa-solid fa-check"></i></label>
            </div>

            <div class="form-single w100">
                <label for="conduta">Conduta: </label>
                <textarea name="conduta" id="conduta"><?php echo $gestante['conduta'];?></textarea>
            </div>

            <div class="form-single w100">
              <label for="observacao">Observação gestante: </label>
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
              <input type="submit" class="btn-input" name="editar-gestante" value="Atualizar!">
            </div> 
        </form>
      
      </div>
    </div>

  </main>
</div>

<?php
    include("footer.php");
?>