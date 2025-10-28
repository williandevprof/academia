<div ng-show="mostrar == 'mostraListaCiclo'">
  <div class="col-md-7">
   
    
    <div class="row">

      <?php
        session_start();
        $conexao = mysqli_connect('127.0.0.1', 'root', '', 'academia');

          $sql = mysqli_query($conexao, "SELECT * FROM usuario u 
          JOIN usuario_permissao up on u.idusuario = up.idusuario
          JOIN permissao p on up.idpermissao = p.idpermissao
          WHERE u.idusuario = '{$_SESSION["iduser"]}'
          AND  p.permissao = 'plano de treino'");
     
          $retornoPlanos_Treinos = mysqli_fetch_assoc($sql);

          if ($retornoPlanos_Treinos['cadastrar'] == 1)
          {
            ?>  

              <div class="col-md-2">
                <button ng-click="novoCiclo()" class="button btn-primary">Novo&nbsp;<i class="fa fa-plus"></i></button>
              </div>
            <?php
          }
        ?>      
      <div class="col-md-7">
        <input ng-model="buscarCiclo"  type="text" class="form-control" 
          placeholder="Digite o nome do ciclo de treino para a busca"
          ng-keyup="autoCiclo(buscarCiclo)" uib-typeahead="autoCiclo as autoCiclo.ciclo for autoCiclo in autoCiclos | filter:$viewValue | limitTo:8">
      </div> 

      <div class="col-md-2">
        <button ng-click="pesquisarCiclo()"  class="button btn-primary">Buscar&nbsp;<i class="fa fa-search"></i></button>
      </div>
    </div>  
    <br>
    <div class="row">
      <table  class="table table-bordered">
        <tr>
          <th>Id</th>
          <th>Ciclo</th>
          <th>Nível</th>
          <th>Gênero</th>
          <th>Modelo</th>
          <th>Meta</th>
          <?php
            if ($retornoPlanos_Treinos['alterar'] == 1)
            {
              ?> 
                <th>Alterar</th>
              <?php
            }
          ?>      
        </tr>
        <tr dir-paginate="ciclo in ciclos|itemsPerPage:3" pagination-id="cicloPaginate"
        ng-class="{'selected':$index == selectedRow}" ng-click="setClickedRow($index, ciclo.idciclo); listaTreino(ciclo.idciclo)">
          <td>{{ciclo.idciclo}}</td>
          <td>{{ciclo.ciclo}}</td>
          <td>{{ciclo.nivel}}</td>
          <td>{{ciclo.genero}}</td>
          <td>{{ciclo.modeloCiclo}}</td>
          <td>{{ciclo.metaPrincipal}}</td>
          <?php
            if ($retornoPlanos_Treinos['alterar'] == 1)
            {
              ?> 
                <td>
                  <button ng-click="alterarCiclo(ciclo.idciclo)" class="button btn-warning">Alterar&nbsp;<span class="icon-write"></span></button>
                </td>
              <?php
            }
          ?>      
        </tr>
      </table> 
      <div class="btn_paginacao">
        <dir-pagination-controls
          pagination-id="cicloPaginate"
          max-size="5"
          direction-links="true"
          boundary-links="true" >
        </dir-pagination-controls>
      </div> 
    </div>
  </div> 

  <div class="col-md-2">

  </div>  
</div> </div> 
<br><hr/>  
  