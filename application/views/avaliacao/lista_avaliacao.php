<div ng-show="mostraListaAvaliacao">	
  <div class="section row mbn">

  	<div class="section-divider mb40" id="spy2">
    <span>Identificação do Aluno</span>
  </div>

  <div class="row">
    <div class="col-md-2">
      <img  ng-repeat="image in images" ng-if="aluno.idpessoa == image.idpessoa" style="width: 200px; height: 200px;" ng-src="../Academia/api_fotos/images/{{image.foto}}">
    </div> 
    <div class="col-md-4">
      <div class="row">
        <span style="font-size: 16px;">Nome:</span> <span style="font-size: 18px;"><b>{{nome}}</b></span>
      </div>
      <div class="row">
        <span style="font-size: 16px;">Idade:</span> <span style="font-size: 18px;"><b>{{idade}}</b></span> 
      </div>
      <div class="row">
        <span style="font-size: 16px;">Genero:</span> <span style="font-size: 18px;"><b>{{genero}}</b></span>
      </div>
      <br>
      <div class="row">
      	<button class="btn btn-warning" ng-click="voltaListaAlunos()">
          <i class="fa fa-sign-in fs22 text-primary"></i> 
          Voltar para a lista de alunos
        </button>
      </div>
    </div>  
  </div>

  	<div>
      <div  class="section-divider mb40">
        <span>Lista de Avaliações Físicas</span>
      </div>

      
      <br>
      <div class="row">
       
        <div class="col-md-2">
          <div class="section admin-widgets-page" ng-hide="mostrainputbuscarDataNascimento"> 
            <label for="datepicker1" class="field prepend-icon">
              <input ng-model="avaliacao.data_avaliacao1" type="text" class="gui-input"
              onkeypress="mascaraData(this, event)"
              placeholder="Data da Avaliação 1">
              <label class="field-icon">
                <i class="fa fa-calendar-o"></i>
              </label>
            </label>
          </div>
        </div>

        <div class="col-md-2">
          <div class="section admin-widgets-page" ng-hide="mostrainputbuscarDataNascimento"> 
            <label for="datepicker1" class="field prepend-icon">
              <input ng-model="avaliacao.data_avaliacao2" type="text" class="gui-input"
              onkeypress="mascaraData(this, event)"
              placeholder="Data da Avaliação 2">
              <label class="field-icon">
                <i class="fa fa-calendar-o"></i>
              </label>
            </label>
          </div>
        </div>

        <div class="col-md-2">
          <button ng-click="pesquisarAvaliacao()" class="button btn-primary">Buscar&nbsp;<i class="fa fa-search"></i></button>
        </div>
      </div>
      <br><br>

      <div>
        <table  class="table table-bordered table-striped table-hover">
          <tr>
            <th>ID</th>        
            <th>Peso</th>
            <th>Altura</th>
            <th>IMC</th>
            <th>Percentual de Gordura</th>
            <th>Massa Magra</th>
            <th>Massa Gorda</th>
            <th>Data da Avaliação</th>
            <th>Detalhar</th>
            <?php
              session_start();
              $conexao = mysqli_connect('127.0.0.1', 'root', '', 'academia');

              // seleciona a permissao de alterar avaliação fisica para esse usuário
              $sql = mysqli_query($conexao, "SELECT * FROM usuario u 
              JOIN usuario_permissao up on u.idusuario = up.idusuario
              JOIN permissao p on up.idpermissao = p.idpermissao
              WHERE u.idusuario = '{$_SESSION["iduser"]}'
              AND  p.permissao = 'avaliacao fisica'");
     
              $retornoAvaliacao = mysqli_fetch_assoc($sql);

              if ($retornoAvaliacao['alterar'] == 1) 
              {
                ?> 
                  <th>Alterar</th>
                <?php
              }  
            ?>      

          </tr>
          <tr dir-paginate="avaliacao in avaliacoes|itemsPerPage:7">
          	<td>{{avaliacao.idavaliacao_fisica}}</td>
            <td>{{avaliacao.peso}}</td>
            <td>{{avaliacao.altura}}</td>
            <td>{{avaliacao.imc}}</td>
            <td>{{avaliacao.percentual_gordura}}</td>
            <td>{{avaliacao.massa_magra}}</td>
            <td>{{avaliacao.massa_gorda}}</td>
            <td>{{avaliacao.data_avaliacao}}</td>
            <td>
                <button class="btn btn-info" ng-click="detalharAvaliacao(avaliacao)">Detalhar Avaliação&nbsp;  <i class="fa fa-search"></i>
                </button>
            </td>
                
            <?php
              if ($retornoAvaliacao['alterar'] == 1) 
              {
                ?>      
                  <td>
                    <button class="btn btn-warning" ng-click="editar(avaliacao)">Alterar &nbsp;<span class="icon-write"></span></button>
                  </td>
                <?php
              }  
            ?>  
          </tr>
        </table>
        <div class="btn_paginacao">
          <dir-pagination-controls
            max-size="5"
            direction-links="true"
            boundary-links="true" >
          </dir-pagination-controls>
        </div> <!-- fim da paginação-->
      </div> 
    </div> <!-- fim da div do lista alunos-->
  </div>    

</div>