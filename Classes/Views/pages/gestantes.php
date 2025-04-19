<?php
  $title = 'Gestantes';
  $css = ['painel'];
  $js = ['painel'];
  include("header.php");
  $menuSelected = 'idosos';
  
?>
<div id="painel">
  <?php include(BASE_DIR_PAINEL.'pages/sidebar.php');?>
  <main id="painel-content">
    <div class="container">
      <div class="content">
        <div class="mapa-site">
          <a href="<?php echo INCLUDE_PATH;?>">Painel / </a> <span>Gestante</span>
        </div>
      <h1>Lista de gestantes!</h1>
      <div class="head">
        <div class="busca w100">
          <?php
            $tabela = 'paciente';
            $ordem = 'nome';
            if (isset($_POST['acao'])) {
                $ordem = $_POST['ordem'];
                $busca = $_POST['busca'];
                $paciente = Classes\Models\UtilsModel::busca($tabela, 'nome', $busca, $ordem);
            } else {
                $paciente = Classes\Models\UtilsModel::selecionarTudo($tabela, 'agente_id', $_SESSION['id'], $ordem);
            }

            // Filter patients with less than 1 year of age
            $gestante = array_filter($paciente, function($p) {
                return $p['gestante'] != 0;
            });
            
          ?>
          <form class="w100" method="post">
            <input class="w50" type="text" id="busca" name="busca" placeholder="Buscar paciente" value="<?php echo (isset($_POST['busca'])) ? $_POST['busca'] : ''; ?>">
            <select class="w50" name="ordem" placeholder="Ordenar">
              <option <?php if($ordem == 'nome') echo "selected";?> value="nome">Pacientes (A - Z)</option>
              <option <?php if($ordem == 'nome DESC') echo "selected";?> value="nome DESC">Pacientes (Z - A)</option>
            </select>
            <div class="btn-busca">
              <a class="limpar-filtro" href="<?php echo INCLUDE_PATH;?>gestantes">Limpar filtro</a>
              <button class="btn-input" name="acao"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
            
          </form>
        </div>
      </div>
      <?php 
        if (empty($gestante)) {
            echo '<h3>Nenhuma gestante cadastrada!</h3>';
        }else{
      ?>
      <div class="overflow"> 
         
      <table> 
          
          <tr> 
              <th>Nome</th>
              <th>Prontuário</th>
              <th>Data de nascimento</th>
              <th>Idade</th>
              <th>Observação</th>
              <th>Editar</th>
              
              
          </tr>
      <?php 
            
          foreach ($gestante as $key => $value) {
          $legenda = \Classes\Models\UtilsModel::selecionar('paciente', 'id', $value['id'])['legenda_id'];

          $obs = explode('||', $value['observacao'])[6];
      ?>
            <tr class="linha-<?php echo $legenda?>">
              <td><?php echo ucfirst($value['nome']);?></td>
              <td><?php echo $value['prontuario'];?></td>
              <td><?php echo date('d/m/Y', strtotime($value['nascimento']));?></td>
              <td>
                <?php 
                  $dataNascimento = new DateTime($value['nascimento']);
                  $hoje = new DateTime();
                  $idade = $hoje->diff($dataNascimento)->y;
                  echo $idade;
                ?>
              </td>
              <td><?php echo $obs;?></td>
            <td><a class="btn editar" href="<?php echo INCLUDE_PATH;?>editar_gestante?id=<?php echo $value['id'];?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
            </tr>
          <?php }?>
      </table>

      </div><!--table-overflow-->
      <?php }?>
      <div class="legenda-container">
          <div class="legenda w50">
            <h2>Legenda</h2>
            <?php 
              $legenda = \Classes\Models\UtilsModel::selecionarTudo('legenda');
              foreach ($legenda as $key => $value) {
            ?>
              <div class="legenda-item linha-<?php echo $value['id']?>">
                <span class="descricao"><?php echo $value['descricao'];?></span>
              </div>
            <?php }?>
          
          </div>
          <div class="exportar w50">
            <a href="<?php echo INCLUDE_PATH?>gestantes?exportar" class="btn-input" target="_blank">Exportar tabela</a>
          </div>
        </div>
      </div>
    </div>

  </main>
</div>

<?php
    include("footer.php");
?>