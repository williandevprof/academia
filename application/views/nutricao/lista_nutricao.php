<div ng-show="mostraListaNutricao">	
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
        <span>Lista de Planos de Nutrição</span>
      </div>

      
      <br>
      <div class="row">
       
        <div class="col-md-2">
          <div class="section admin-widgets-page"> 
            <label for="datepicker1" class="field prepend-icon">
              <input ng-model="nutricao.data_inicio" type="text" class="gui-input"
              onkeypress="mascaraData(this, event)"
              placeholder="Data de Inicio">
              <label class="field-icon">
                <i class="fa fa-calendar-o"></i>
              </label>
            </label>
          </div>
        </div>

        <div class="col-md-2">
          <div class="section admin-widgets-page"> 
            <label for="datepicker1" class="field prepend-icon">
              <input ng-model="nutricao.data_termino" type="text" class="gui-input"
              onkeypress="mascaraData(this, event)"
              placeholder="Data de Término">
              <label class="field-icon">
                <i class="fa fa-calendar-o"></i>
              </label>
            </label>
          </div>
        </div>

        <div class="col-md-2">
          <button ng-click="pesquisarNutricao()" class="button btn-primary">Buscar&nbsp;<i class="fa fa-search"></i></button>
        </div>
      </div>
      <br><br>

      <div>
        <table  class="table table-bordered table-striped table-hover">
          <tr>
            <th>ID</th>        
            <th>Plano</th>
            <th>Data de Inicio</th>
            <th>Data de Término</th>
            <th>Detalhar</th>
            
          </tr>
          <tr dir-paginate="plano in planos_nutricao|itemsPerPage:7">
          	<td>{{plano.idplano_nutricao}}</td>
            <td>{{plano.plano}}</td>
            <td>{{plano.data_inicio}}</td>
            <td>{{plano.data_termino}}</td>
            <td>
                <button class="btn btn-info" ng-click="detalharNutricao(plano)">Detalhar Nutrição&nbsp;  <i class="fa fa-search"></i>
                </button>
            </td>
            
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