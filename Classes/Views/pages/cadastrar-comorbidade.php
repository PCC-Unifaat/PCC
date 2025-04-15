<?php
  $title = 'Cadastrar comorbidade';
  $css = ['painel'];
  $js = ['mask','painel','form'];
  include("header.php");
  $menuSelected = 'comorbidade';
  
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
                <label for="comorbidade">Comorbidade*: </label>
                <input type="text" id="comorbidade" name="comorbidade" content="required">
            </div>
            
            <div class="form-single w100">            
              <input type="submit" class="btn-input" name="cadastrar-comorbidade" value="Cadastrar!">
            </div>
            
        </form>
      
      </div>
    </div>

  </main>
</div>

<?php
    include("footer.php");
?>