<div ng-show="mostraListaExercicios">
  <br>
  <div class="col-md-5"> 
        
    <div class="row textoAddExercicio">
      Para adicionar Exercícios ao {{treinoGrid}} {{idTreinoGrid}}, basta dar um clique duplo na linha da tabela que corresponde ao exercício desejado!
    </div> 
    <br>
    <div class="row textoAddExercicioCombinado">
      Para adicionar um treino combinado, basta selecionar o exercicio na tabela ao lado e depois clicar no exercicio desta tabela que fará combinação com o exercicio selecionado! 
    </div> 
    <br>
    <div class="row">
      <div class="col-md-5">
        <input ng-model="exercicio.buscarExercicio"  type="text" class="form-control" 
          placeholder="Nome do exercicio"
          ng-keyup="autoExercicio(buscarExercicio)" uib-typeahead="autoExercicio as autoExercicio.exercicio for autoExercicio in autoExercicios | filter:$viewValue | limitTo:8">
      </div>  

      <div class="col-md-5">
        <input ng-model="exercicio.buscarExercicioRegiao"  type="text" class="form-control" 
          placeholder="Nome da região do corpo"
          ng-keyup="autoExercicioRegiao(buscarExercicioRegiao)" uib-typeahead="autoRegiao as autoRegiao.regiaoTrabalhada for autoRegiao in autoRegioes | filter:$viewValue | limitTo:8">
      </div> 
      
      <div class="col-md-2">
        <button ng-click="pesquisarExercicio()"  class="button btn-primary">Buscar&nbsp;<i class="fa fa-search"></i></button>
      </div>
    </div>
   
    <br>
  
    
      <table  class="table table-bordered table-striped table-hover">
        <tr>
          <th>Exercício</th>
          <th>Aparelho</th>
          <th>Região Trabalhada</th>
        </tr>
        <tr ng-dblclick="addExercicioTreinoAluno(exercicio)" dir-paginate="exercicio in exercicios|itemsPerPage:10" pagination-id="exercicioPaginate">
          <td>{{exercicio.exercicio}}</td>
          <td>{{exercicio.aparelho}}</td>
          <td>{{exercicio.regiaoTrabalhada}}</td>
        </tr>
      </table>
      <div class="btn_paginacao">
        <dir-pagination-controls
          pagination-id="exercicioPaginate"
          max-size="5"
          direction-links="true"
          boundary-links="true" >
        </dir-pagination-controls>
      </div>
      
  </div>  
</div>


<div ng-show="mostraNovaListaTreino" class="col-md-7">
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
    
    
    
    <div class="row">
      <div class="col-md-2" ng-repeat="treino in treinos">
        <button  ng-click="mostraNovoTreinoAluno(treino)"
        ng-class="{'css_btn_class': treino.treino != classe, 'css_btn_class_azul': treino.treino == classe}"
        >Treino {{treino.treino}}</button>
      </div> 
    </div>  

    <br><br>  

    <!-- -->
    <table  class="table table-bordered">  
      <tr >
        <td colspan="7">
         <center><span class="treinoGrid">{{alunoTreinoGrid}}   {{idAlunoTreinoGrid}}</span></center>
         </td>
       </tr>
       <th></th>
       <th>Exercício</th>
       <th>Região Trabalhada</th>
       <th>Aparelho</th>
       <th></th>
       <tr dir-paginate="exercicio in exerciciosNovoTreinoAluno| itemsPerPage:10"
        pagination-id="treinoNovoAlunoPaginate"
        ng-class="{'selected':clicked}" 
        ng-click="clicked = !clicked; getIdExercicioTreinoAluno(exercicio, clicked)">
          <td>{{$index+1}}</td>
          <td>{{exercicio.exercicio}}</td>         
          <td>{{exercicio.regiaoTrabalhada}}</td>
          <td>{{exercicio.aparelho}}</td>
          <td>
            <button ng-click="exluirExercicioTreinoAluno(exercicio.idaluno_exercicio)" class="btn btn-danger btn-xs">Excluir
               <span class="imoon imoon-cancel-circle"></span>
            </button>  
          </td>
        </tr>
    </table>
    <div class="btn_paginacao">
      <dir-pagination-controls
        pagination-id="treinoNovoAlunoPaginate"
        max-size="5"
        direction-links="true"
        boundary-links="true">
      </dir-pagination-controls>
    </div> 

   
  </div>
</div>
