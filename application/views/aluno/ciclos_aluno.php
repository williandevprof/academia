<div ng-show="mostraCiclosAluno">
  <div class="row">
    <div class="col-md-10">
      <div class="row">
        <div class="col-md-5">
          <input ng-model="buscarCicloAluno"  type="text" class="form-control" 
            placeholder="Digite o nome do ciclo de treino para a busca"
            ng-keyup="autoCicloAluno(buscarCicloAluno)" uib-typeahead="autoCicloAluno as autoCicloAluno.ciclo for autoCicloAluno in autoCiclosAluno | filter:$viewValue | limitTo:8">
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
          <button ng-click="pesquisarCicloAluno()"  class="button btn-primary">Buscar&nbsp;<i class="fa fa-search"></i></button>
        </div>
      </div> 
      <br>
      <table  class="table table-bordered table-striped table-hover">
        <tr>
          <th>Id</th>
          <th>Ciclo</th>
          <th>Nível</th>
          <th>Genero</th>
          <th>Meta Principal</th>
          <th>Modelo</th>
          <th>Data de Inicio</th>
          <th>Data de Término</th>
          <th>Ativo</th>
        </tr>
        <tr dir-paginate="ciclo in ciclosTreino| itemsPerPage:6"
        pagination-id="ciclosPaginate" ng-dblclick="mostraTreinos(ciclo.idaluno_ciclo, ciclo)">
          <td><h4>{{ciclo.idaluno_ciclo}}</h4></td>
          <td><h4>{{ciclo.ciclo}}</h4></td>
          <td><h4>{{ciclo.nivel}}</h4></td>
          <td><h4>{{ciclo.genero}}</h4></td>
          <td><h4>{{ciclo.metaPrincipal}}</h4></td>
          <td><h4>{{ciclo.modeloCiclo}}</h4></td>
          <td><h4>{{ciclo.dataInicioBrasileiro}}</h4></td>
          <td><h4>{{ciclo.dataTerminoBrasileiro}}</h4></td>
          <td ng-click="mudarCicloAtivo(ciclo.idaluno_ciclo, ciclo.idaluno)"><h4>
            <button class="btn btn-danger" ng-if="ciclo.ativo == 0">
              Inativo
              <span class="icon-write"></span>
            </button>
            <button class="btn btn-success" ng-if="ciclo.ativo == 1">
              Ativo
              <span class="icon-write"></span>
            </button>
          </h4></td>
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
</div>

<div ng-show="mostraCicloSelecionado">
 
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

  <br><hr>

   <h3>Para adicionar peso, serie e intervalo nos exercicios,
  basta clicar na linha onde o exercicio se encontra!</h3><br>

  <div class="row">
    <div class="col-md-2" ng-repeat="treino in treinos">
      <button  ng-click="mostraTreinoAluno(treino)"
      ng-class="{'css_btn_class': treino.treino != classe, 'css_btn_class_azul': treino.treino == classe}"
      >Treino {{treino.treino}}</button>
    </div> 
  </div>  

  <br><br>  
  <div class="col-md-5">
    <table  class="table table-bordered">  
      <tr>
        <td colspan="8">
         <center><span class="treinoGrid">{{treinoGrid}}&nbsp;&nbsp;{{regiosTrabalhadas}}</span></center>
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
      <tr ng-repeat="exercicio in exerciciosTreino" 
      ng-click="abreModalExercicio(exercicio.idaluno_exercicio, exercicio)">
          <td>{{$index +1}}</td>
       
          <td>
            <!-- percorre todos os exercicios combinados da tabela exercicio_combinado
            correspondente ao treino selecionado -->
            <div ng-repeat="exercicioTreinoCombinado in exerciciosTreinoCombinado">

              <!-- Verifica se o objeto do exercicio combinado possui um idexercicio_treino 
              igual o idexercicio_treino do proprio exercicio que esta sendo listado,
              dessa forma conseguimos garantir que ele irá mostrar o exercicio combinado apenas
              no exercicio ao qual ele foi associado -->
              <span ng-if="exercicioTreinoCombinado.idexercicio_treino == exercicio.idexercicio_treino">
                 {{exercicioTreinoCombinado.exercicio}} +
              </span>
                        
            </div>

            <!-- se não existir exercicio combinado é porque é um exercicio sem outro associativo 
            (combinado) ou o proprio exercicio de um combinado mas sendo o primeiro por isso não esta na tabela exercicio_combinado-->
            <span ng-if="!exercicioTreinoCombinado">
                {{exercicio.exercicio}}
            </span> 
            
          </td>
                   
          <td>{{exercicio.regiaoTrabalhada}}</td>
          <td>{{exercicio.aparelho}}</td>
          <td>{{exercicio.serie}}</td>
          <td>{{exercicio.repeticao}}</td>
          <td>{{exercicio.peso}}</td>
          <td>{{exercicio.intervalo}}</td>
          
          <td ng-show="escondeId">{{exercicio.idaluno_exercicio}}</td>
      </tr>
     
    <table>
      <div class="btn_paginacao">
        <dir-pagination-controls
          pagination-id="treinoPaginate"
          max-size="5"
          direction-links="true"
          boundary-links="true">
        </dir-pagination-controls>
      </div> <!-- fim da div do btn_paginacao -->
    </table>
  </div>     
</div> 

