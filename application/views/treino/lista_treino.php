<div ng-show="mostraListaTreino" class="col-md-7">
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
        <button  ng-click="mostraTreino(treino)"
        ng-class="{'css_btn_class': treino.treino != classe, 'css_btn_class_azul': treino.treino == classe}"
        >Treino {{treino.treino}}</button>
      </div> 
    </div>  

    <br><br>  

    <table  class="table table-bordered">  
      <tr >
        <td colspan="7">
          <center>
            <span class="treinoGrid">{{treinoGrid}}
              &nbsp;&nbsp;{{regiosTrabalhadas}}
            </span>
          </center>
         </td>
       </tr>
       <th></th>
       <th>Exercício</th>
       <th>Região Trabalhada</th>
       <th>Aparelho</th>
       <th></th>
       <th ng-show="escondeId"></th>

       <!-- percorre todos os exercicios relacionado ao treino selecionado -->
       <tr dir-paginate="exercicio in exerciciosTreino| itemsPerPage:10"
        pagination-id="treinoPaginate"  ng-class="{'selected':clicked}" 
        ng-click="clicked = !clicked; getIdExercicioTreino(exercicio.idexercicio_treino, clicked)">
          <td>{{$index+1}}</td>
       
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
          <td>
            <button ng-click="exluirExercicioTreino(exercicio.idexercicio_treino)" class="btn btn-danger btn-xs">Excluir
               <span class="imoon imoon-cancel-circle"></span>
            </button>   
          </td>
          <td ng-show="escondeId">{{exercicio.idexercicio_treino}}</td>
       </tr>
       
    <table>
    <div class="btn_paginacao">
      <dir-pagination-controls
        pagination-id="treinoPaginate"
        max-size="5"
        direction-links="true"
        boundary-links="true">
      </dir-pagination-controls>
    </div> 
   
  </div>
</div>