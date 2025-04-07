<?php
  $title = 'Diabéticos';
  $css = ['painel'];
  $js = ['painel'];
  include("header.php");
  $menuSelected = 'diabeticos';
  
?>
<div id="painel">
  <?php include(BASE_DIR_PAINEL.'pages/sidebar.php');?>
  <main id="painel-content">
    <div class="container">
      <div class="content">
        <div class="mapa-site">
          <a href="<?php echo INCLUDE_PATH;?>">Painel / </a> <span>Diabéticos</span>
        </div>
      <h1>Lista de pacientes diabéticos!</h1>
      <div class="head">
        <div class="busca w100">
          <?php
            $tabela = 'paciente';
            $ordem = 'nome';
            if (isset($_POST['acao'])) {
                $busca = $_POST['busca'];
                $paciente = Classes\Models\UtilsModel::busca($tabela, 'nome', $busca, $ordem);
            } else {
                $paciente = Classes\Models\UtilsModel::selecionarTudo($tabela);
            }

            // Filter patients with comorbidade 1
            $diabeticos = array_filter($paciente, function($paciente) {
                $comorbidade = explode(',', $paciente['comorbidade']);
                return in_array('1', $comorbidade);
            });
          ?>
          <form class="w100" method="post">
            <input class="w50" type="text" id="busca" name="busca" placeholder="Buscar paciente" value="<?php echo (isset($_POST['busca'])) ? $_POST['busca'] : ''; ?>">
            <select class="w50" name="ordem" placeholder="Ordenar">
              <option <?php if($ordem == 'paciente') echo "selected";?> value="nome">Pacientes (A - Z)</option>
              <option <?php if($ordem == 'paciente DESC') echo "selected";?> value="nome DESC">Pacientes (Z - A)</option>
            </select>
            <div class="btn-busca">
              <a class="limpar-filtro" href="<?php echo INCLUDE_PATH;?>puericultura">Limpar filtro</a>
              <button class="btn-input" name="acao"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
            
          </form>
        </div>
      </div>
      <?php 
        if (empty($diabeticos)) {
            echo '<h3>Nenhum paciente diabético cadastrado</h3>';
        }else{
      ?>
      <div class="overflow"> 
         
          <table> 
          
              <tr> 
                  <th>Nome</th>
                  <th>Prontuário</th>
                  <th>Data de nascimento</th>
                  <th>Insulina</th>
                  <th>Hipertenso</th>
                  <th>Última consulta</th>
                  <th>Próxima consulta</th>
                  <th>Observação</th>
                  <th>Editar</th>
                  
                  
              </tr>
          <?php 
                
              foreach ($diabeticos as $key => $value) {
                $comorbidade = explode(',', $value['comorbidade']);
                $hipertenso = (in_array('2', $comorbidade)) ? true : false;
                $legenda = \Classes\Models\UtilsModel::selecionar('paciente', 'id', $value['id'])['legenda_id'];
                $consultas = \Classes\Models\UtilsModel::selecionar('consulta', 'paciente_id', $value['id']);
                if(!empty($consultas)){
                    $ult_consulta = date('d/m/Y', strtotime($consultas['ult_consulta']));
                    $prox_consulta = date('d/m/Y', strtotime($consultas['prox_consulta']));
                }else{
                    $ult_consulta = '';
                    $prox_consulta = '';
                }
                $obs = explode('||', $value['observacao'])[4];
            ?>
                <tr class="linha-<?php echo $legenda?>">
                  <td><?php echo ucfirst($value['nome']);?></td>
                  <td><?php echo $value['prontuario'];?></td>
                  <td><?php echo date('d/m/Y', strtotime($value['nascimento']));?></td>
                  <td><?php echo (!empty($value['insulina']) ? '<span class="ativo"><i class="fa-solid fa-square-check"></i></span>' : '')?></td>
                  <td><?php echo (!empty($hipertenso) ? '<span class="ativo"><i class="fa-solid fa-square-check"></i></span>' : '')?></td>
                  <td><?php echo $ult_consulta;?></td>
                  <td><?php echo $prox_consulta;?></td>
                  <td><?php echo $obs;?></td>
                  <td><a class="btn editar" href="<?php echo INCLUDE_PATH;?>editar_diabete?id=<?php echo $value['id'];?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
                </tr>
              <?php }?>
          </table>

      </div><!--table-overflow-->
      <?php }?>
      <div class="legenda">
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
      </div>
    </div>

  </main>
</div>

<?php
    include("footer.php");
?>