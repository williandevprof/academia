<div ng-show="mostraListaCiclo">
  <div class="col-md-4">
    <div class="row">
      <div class="col-md-7">
        <input ng-model="buscarCiclo"  type="text" class="form-control" 
          placeholder="Digite o nome do ciclo de treino"
          ng-keyup="autoCiclo(buscarCiclo)" uib-typeahead="autoCiclo as autoCiclo.ciclo for autoCiclo in autoCiclos | filter:$viewValue | limitTo:8">
      </div> 

      <div class="col-md-3">
        <button ng-click="pesquisarCiclo()"  class="button btn-primary">Buscar&nbsp;<i class="fa fa-search"></i></button>
      </div>
    </div> 
    <br>
    <div class="row">
      <div class="col-md-3">
        <button ng-click="novoCicloAluno()" class="button btn-primary">Novo&nbsp;<i class="fa fa-plus"></i></button>
      </div>
      
      <div class="col-md-3">
        <button class="btn btn-success" ng-click="addCicloTreinoAluno()">
            Salvar&nbsp;<i class="fa fa-save"></i>
        </button>
      </div>  
      
      <div class="col-md-3">
        <button ng-click="alterarCiclo()" class="button btn-warning">Alterar&nbsp;<span class="icon-write"></span></button>
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
        </tr>
        <tr dir-paginate="ciclo in ciclos|itemsPerPage:10" pagination-id="cicloPaginate"
        ng-class="{'selected':$index == selectedRow}" ng-click="setClickedRow($index, ciclo.idciclo); listaTreino(ciclo.idciclo)">
          <td>{{ciclo.idciclo}}</td>
          <td>{{ciclo.ciclo}}</td>
          <td>{{ciclo.nivel}}</td>
          <td>{{ciclo.genero}}</td>
          <td>{{ciclo.modeloCiclo}}</td>
          <td>{{ciclo.metaPrincipal}}</td>
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
</div> 


<div ng-show="mostraListaTreinoCiclo" class="col-md-8">
  <div class="row">
    <table  class="table">
      <tr>
        <td colspan="2">
          <span class="descrTreino">Ciclo:</span>  <span class="treino">{{treinos[0].ciclo}}</span>     
        </td>
        <td colspan="2">
         <span class="descrTreino">Modelo:</span> <span class="treino">{{treinos[0].modeloCiclo}}  </span>   
        </td>
        <td>
          <span class="descrTreino">Meta:</span> <span class="treino">{{treinos[0].metaPrincipal}}</span>     
        </td>
        <td>
          <span class="descrTreino">Nível:</span> <span class="treino">{{treinos[0].nivel}}</span>    
        </td>
        <td>
          <span class="descrTreino">Gênero:</span> <span class="treino">{{treinos[0].genero}}</span>     
        </td>
      </tr>
    </table>
    
    <hr/>

    <div class="row">
      <div class="col-md-3"> 
        <div class="section">
          <label for="datepicker1" class="field prepend-icon">
            <input ng-model="cicloTreinoAluno.dataInicio" id="dataInicio" name="dataInicio" class="gui-input"
            onkeypress="mascaraData(this, event)"
            placeholder="Data de Inicio">
            <label class="field-icon">
              <i class="fa fa-calendar-o"></i>
            </label>
          </label>  
        </div>
      </div>
      <div class="col-md-3"> 
        <div class="section">
          <label for="datepicker1" class="field prepend-icon">
            <input ng-model="cicloTreinoAluno.dataTermino" id="dataTermino" name="dataTermino" class="gui-input"
            onkeypress="mascaraData(this, event)"
            placeholder="Data de Término">
            <label class="field-icon">
              <i class="fa fa-calendar-o"></i>
            </label>
          </label>  
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-2" ng-repeat="treino in treinos">
        <button  ng-click="mostraTreino(treino)"
        ng-class="{'css_btn_class': treino.treino != classe, 'css_btn_class_azul': treino.treino == classe}"
        >Treino {{treino.treino}}</button>
      </div> 
    </div>  

    <br><br> 
    

    <div class="col-md-8">
      <table  class="table table-bordered">  
        <tr >
          <td colspan="4">
           <center><span class="treinoGrid">{{treinoGrid}} &nbsp;   {{regiosTrabalhadas}}</span></center>
           </td>
         </tr>
         <th></th>
         <th>Exercício</th>
         <th>Região Trabalhada</th>
         <th>Aparelho</th>
         
         <th ng-show="escondeId"></th>

         <!-- percorre todos os exercicios relacionado ao treino selecionado -->
         <tr ng-repeat="exercicio in exerciciosTreino" >
            <td>{{$index+1}}</td>
         
            <td>
              <!-- percorre todos os exercicios combinados da tabela exercicio_combinado
              correspondente ao treino selecionado -->
              <div ng-repeat="exercicioTreinoCombinadoAluno in exerciciosTreinoCombinadoAluno">

                <!-- Verifica se o objeto do exercicio combinado possui um idexercicio_treino 
                igual o idexercicio_treino do proprio exercicio que esta sendo listado,
                dessa forma conseguimos garantir que ele irá mostrar o exercicio combinado apenas
                no exercicio ao qual ele foi associado -->
                <span ng-if="exercicioTreinoCombinadoAluno.idexercicio_treino == exercicio.idexercicio_treino">
                   {{exercicioTreinoCombinadoAluno.exercicio}} +
                </span>
                          
              </div>

              <!-- se não existir exercicio combinado é porque é um exercicio sem outro associativo 
              (combinado) ou o proprio exercicio de um combinado mas sendo o primeiro por isso não esta na tabela exercicio_combinado-->
              <span ng-if="!exercicioTreinoCombinadoAluno">
                  {{exercicio.exercicio}}
              </span> 
              
            </td>
                     
            <td>{{exercicio.regiaoTrabalhada}}</td>
            <td>{{exercicio.aparelho}}</td>
            
            <td ng-show="escondeId">{{exercicio.idexercicio_treino}}</td>
         </tr>
         
      <table>
      <br><br>
    </div>   
    
  </div>
</div></div>
