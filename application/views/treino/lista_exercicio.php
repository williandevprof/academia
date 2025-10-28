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
      <tr ng-dblclick="addExercicioTreino(exercicio.idexercicio)" dir-paginate="exercicio in exercicios|itemsPerPage:10" pagination-id="exercicioPaginate">
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
 