<?php
  $title = 'Comorbidades';
  $description = 'Comorbidades cadastradas no sistema.';
  $css = ['painel'];
  $js = ['painel'];
  include("header.php");
  $menuSelected = 'comorbidades';
  
?>
<div id="painel">
  <?php include(BASE_DIR_PAINEL.'pages/sidebar.php');?>
  <main id="painel-content">
    <div class="container">
      <div class="content">
        <div class="mapa-site">
          <a href="<?php echo INCLUDE_PATH;?>">Painel / </a> <span>Comorbidades</span>
        </div>
      <h1>Lista de comorbidades!</h1>
      <div class="head">
        <div class="add-item w30">
          <a class="btn-2" href="<?php echo INCLUDE_PATH;?>cadastrar_comorbidade"><i class="fa-solid fa-plus"></i> Adicionar Comorbidade</a>
        </div>
        <div class="busca w70">
          <?php
              $tabela = 'comorbidade';
              $ordem = 'comorbidade';
              if (isset($_POST['acao'])) {
                $ordem = $_POST['ordem'];
                  $busca = $_POST['busca'];
                  $comorbidade = Classes\Models\UtilsModel::busca($tabela, 'comorbidade', $busca, $ordem);
              } else {
                  $comorbidade = Classes\Models\UtilsModel::selecionarTudo($tabela, '1', '1', $ordem);
              }
          ?>
          <form class="w100" method="post">
            <input class="w50" type="text" id="busca" name="busca" placeholder="Buscar comorbidade" value="<?php echo (isset($_POST['busca'])) ? $_POST['busca'] : ''; ?>">
            <select class="w50" name="ordem" placeholder="Ordenar">
              <option <?php if($ordem == 'comorbidade') echo "selected";?> value="comorbidade">Comorbidades (A - Z)</option>
              <option <?php if($ordem == 'comorbidade DESC') echo "selected";?> value="comorbidade DESC">Comorbidades (Z - A)</option>
            </select>
            <div class="btn-busca">
              <a class="limpar-filtro" href="<?php echo INCLUDE_PATH;?>comorbidades">Limpar filtro</a>
              <button class="btn-input" name="acao"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
            
          </form>
        </div>
      </div>
      <?php 
        if (empty($comorbidade)) {
            echo '<h3>Nenhuma comorbidade cadastrada</h3>';
        }else{
      ?>
      <div class="overflow"> 
         
          <table> 
          
              <tr> 
                  <th>Comorbidades</th>
                  
                  <th>Excluir</th>
              </tr>
          <?php 
              foreach ($comorbidade as $key => $value) {
          ?>
              <tr>
                  <td><?php echo ucfirst($value['comorbidade']);?></td>
                  <?php if($value['id'] != 1 && $value['id'] != 2){?>
                  <td><span url="<?php echo INCLUDE_PATH;?>comorbidades?deletar=<?php echo $value['id'];?>" btn="Excluir" msg="Ao confirmar, essa ação não poderá ser desfeita!" class="btn excluir btn-deletar-item confirmar-acao"><i class="fa-regular fa-trash-can"></i></span></td>
                  <?php }else{?>
                    <td></td>
                    <?php }?>
                </tr>
              <?php }?>
          </table>

      </div><!--table-overflow-->
      <?php }?>
      </div>
    </div>

  </main>
</div>

<?php
    include("footer.php");
?>