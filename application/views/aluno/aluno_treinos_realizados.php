<div ng-show="mostraTreinosRealizados">
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-3">
        <input ng-model="buscarCicloRealizado"  type="text" class="form-control" 
          placeholder="Digite o nome do ciclo de treino para a busca"
          ng-keyup="autoCiclosRealizados(buscarCicloRealizado)" uib-typeahead="autoCiclo as autoCiclo.ciclo for autoCiclo in autoCiclos | filter:$viewValue | limitTo:8">
      </div> 

      <div class="col-md-2">
        <label for="datepicker1" class="field prepend-icon">
          <input ng-model="buscarDataTreinoRealizado" id="buscarDataTreinoRealizado" name="buscarDataTreinoRealizado" class="gui-input"
          onkeypress="mascaraData(this, event)"
          placeholder="Data do Treino">
          <label class="field-icon">
            <i class="fa fa-calendar-o"></i>
          </label>
        </label>
      </div> 

      <div class="col-md-2">
        <label for="datepicker1" class="field prepend-icon">
          <input ng-model="buscarDataInicio" id="buscarDataInicio" name="buscarDataInicio" class="gui-input"
          onkeypress="mascaraData(this, event)"
          placeholder="Data de Início">
          <label class="field-icon">
            <i class="fa fa-calendar-o"></i>
          </label>
        </label>
      </div> 
      <div class="col-md-2">
        <label for="datepicker1" class="field prepend-icon">
          <input ng-model="buscarDataTermino" id="buscarDataTermino" name="buscarDataTermino" class="gui-input"
          onkeypress="mascaraData(this, event)"
          placeholder="Data de Término">
          <label class="field-icon">
            <i class="fa fa-calendar-o"></i>
          </label>
        </label>
      </div> 
      
      <div class="col-md-3">
        <button ng-click="pesquisarTreinosRealizados()"  class="button btn-primary">Buscar&nbsp;<i class="fa fa-search"></i></button>
      </div>
    </div> <br>
    <table  class="table table-bordered table-striped table-hover">
      <tr>
        <th>Id</th>
        <th>Treino</th>
        <th>Data do Treino</th>
        <th>Ciclo</th>
        <th>Nível</th>
        <th>Genero</th>
        <th>Meta Principal</th>
        <th>Modelo</th>
        <th>Data de Inicio</th>
        <th>Data de Término</th>
        
      </tr>
      <tr dir-paginate="ciclo in treinosRealizados| itemsPerPage:5"
      pagination-id="ciclosPaginate" 
      ng-class="{'selected':$index == selectedRowTreinoRealizado}"
      ng-click="mostraTreinosRealizadosAluno(ciclo);
      setClickedRowTreinoRealizado($index)">
        <td><h4>{{ciclo.idtreino_realizado}}</h4></td>
        <td><h4>{{ciclo.treino}}</h4></td>
        <td><h4>{{ciclo.dataTreino}}</h4></td>
        <td><h4>{{ciclo.ciclo}}</h4></td>
        <td><h4>{{ciclo.nivel}}</h4></td>
        <td><h4>{{ciclo.genero}}</h4></td>
        <td><h4>{{ciclo.metaPrincipal}}</h4></td>
        <td><h4>{{ciclo.modeloCiclo}}</h4></td>
        <td><h4>{{ciclo.dataInicioTreino}}</h4></td>
        <td><h4>{{ciclo.dataTerminoTreino}}</h4></td>
        
      </tr>
    </table>
    <div class="btn_paginacao">
      <dir-pagination-controls
        pagination-id="ciclosPaginate"
        max-size="5"
        direction-links="true"
        boundary-links="true">
      </dir-pagination-controls>
    </div> <br>
  </div>  
</div>

<div ng-show="mostraCicloSelecionadoAluno">
 
  <div class="row">
    <div class="col-md-2">  
      <span class="descrTreino">Ciclo:</span>  <span class="treino">{{cicloSelecionado.ciclo}}</span>     
    </div>
    <div class="col-md-2"> 
     <span class="descrTreino">Modelo:</span> <span class="treino">{{cicloSelecionado.modeloCiclo}}  </span>   
    </div>
    <div class="col-md-2"> 
      <span class="descrTreino">Meta:</span> <span class="treino">{{cicloSelecionado.metaPrincipal}}</span>     
    </div>
    <div class="col-md-2"> 
      <span class="descrTreino">Nível:</span> <span class="treino">{{cicloSelecionado.nivel}}</span>    
    </div>
    <div class="col-md-2"> 
      <span class="descrTreino">Gênero:</span> <span class="treino">{{cicloSelecionado.genero}}</span>     
    </div>

     <div class="col-md-2"> 
      <span class="descrTreino">Data:</span> <span class="treino">{{cicloSelecionado.dataTreino}}</span>     
    </div>
  </div>
  <hr>

  
  <div class="col-md-5"  
  dir-paginate="treino in treinos| itemsPerPage:10"
  pagination-id="treinoPaginate">
    <table  class="table table-bordered">  
      <tr>
        <td colspan="8">
         <center><span class="treinoGrid">Treino {{treino.treino}}    {{regioesTrabalhadas}}</span></center>
        </td>
      </tr>
      <tr>
        <th></th>
        <th>Exercício</th>
        <th>Região Trabalhada</th>
        <th>Aparelho</th>
        <th>Serie</th>
        <th>Repetições</th>
        <th>Peso</th>
        <th>Intervalo</th>
       
        <th ng-show="escondeId"></th>
      </tr>  
       <!-- percorre todos os exercicios relacionado ao treino selecionado -->
      <tr ng-repeat="exercicio in exerciciosTreino" ng-if="exercicio.idaluno_treino == treino.idaluno_treino">
        <td>{{$index +1}}</td>
        <td>{{exercicio.exercicio}}</td>
        <td>{{exercicio.regiaoTrabalhada}}</td>
        <td>{{exercicio.aparelho}}</td>
        <td>{{exercicio.serie}}</td>
        <td>{{exercicio.repeticao}}</td>
        <td>{{exercicio.peso}}</td>
        <td>{{exercicio.intervalo}}</td>
      </tr>
    </table>
    <div class="btn_paginacao">
      <dir-pagination-controls
        pagination-id="treinoPaginate"
        max-size="5"
        direction-links="true"
        boundary-links="true">
      </dir-pagination-controls>
    </div> <!-- fim da div do btn_paginacao -->
  </div>     
</div> 

