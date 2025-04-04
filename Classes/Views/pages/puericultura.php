<?php
  $title = 'Puericultura';
  $css = ['painel'];
  $js = ['painel'];
  include("header.php");
  // $menuSelected = 'comorbidades';
  
?>
<div id="painel">
  <?php include(BASE_DIR_PAINEL.'pages/sidebar.php');?>
  <main id="painel-content">
    <div class="container">
      <div class="content">
        <div class="mapa-site">
          <a href="<?php echo INCLUDE_PATH;?>">Painel / </a> <span>Puericultura</span>
        </div>
      <h1>Lista de puericultura!</h1>
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

            // Filter patients with less than 1 year of age
            $puericultura = array_filter($paciente, function($paciente) {
                $dataNascimento = new DateTime($paciente['nascimento']);
                $hoje = new DateTime();
                $idade = $hoje->diff($dataNascimento)->y;
                return $idade < 1;
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
        if (empty($puericultura)) {
            echo '<h3>Nenhum paciente puericultura cadastrado</h3>';
        }else{
      ?>
      <div class="overflow"> 
         
          <table> 
          
              <tr> 
                  <th>Nome</th>
                  <th>Prontuário</th>
                  <th>Data de nascimento</th>
                  <th>Última consulta</th>
                  <th>Próxima consulta</th>
                  <th>Observação</th>
                  <th>Editar</th>
                  
                  
              </tr>
          <?php 
              foreach ($puericultura as $key => $value) {
          ?>
                <tr>
                  <td><?php echo ucfirst($value['nome']);?></td>
                  <td><?php echo $value['prontuario'];?></td>
                  <td><?php echo date('d/m/Y', strtotime($value['nascimento']));?></td>
                  <td></td>
                  <td></td>
                  <td></td>
                <td><a class="btn editar" href="<?php echo INCLUDE_PATH;?>editar-puericultura?id=<?php echo $value['id'];?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
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