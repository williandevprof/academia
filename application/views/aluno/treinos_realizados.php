<div ng-controller="treinos_realizados">
    <!-- Start: Content-Wrapper -->
    <section id="content_wrapper">

      <!-- Begin: Content -->
      <section id="content" class="table-layout animated fadeIn">

        <!-- begin: .tray-center -->
        <div class="tray tray-center">

          <!-- create new order panel -->
          <div class="panel mb25 mt5">
            <div class="panel-heading">
              <ul class="nav panel-tabs-border panel-tabs">
                               
              </ul>
            </div>
            <div class="panel-body p20 pb10">
              <div class="tab-content pn br-n admin-form">
                <div id="tab1_1" class="tab-pane active">

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
                      <th>Data de Inicio Ciclo</th>
                      <th>Data de Término Ciclo</th>
                      
                    </tr>
                    <tr dir-paginate="treino in treinosRealizados| itemsPerPage:5"
                    pagination-id="ciclosPaginate" 
                    ng-class="{'selected':$index == selectedRowTreinoRealizado}"
                    ng-click="mostraTreinoRealizado(treino.idtreino_realizado); setClickedRowTreinoRealizado($index)">
                      <td><h4>{{treino.idtreino_realizado}}</h4></td>
                      <td><h4>{{treino.treino}}</h4></td>
                      <td><h4>{{treino.dataTreino}}</h4></td>
                      <td><h4>{{treino.ciclo}}</h4></td>
                      <td><h4>{{treino.nivel}}</h4></td>
                      <td><h4>{{treino.genero}}</h4></td>
                      <td><h4>{{treino.metaPrincipal}}</h4></td>
                      <td><h4>{{treino.modeloCiclo}}</h4></td>
                      <td><h4>{{treino.dataInicioTreino}}</h4></td>
                      <td><h4>{{treino.dataTerminoTreino}}</h4></td>
                     
                        <span style="color: red;" ng-if="ciclo.ativo == 0">
                          Inativo
                        </span>
                        <span style="color: green;" ng-if="ciclo.ativo == 1">
                          Ativo
                        </span>
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
                    <br>
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

                    <div class="col-md-2"> 
                      <span class="descrTreino">Data:</span> <span class="treino">{{cicloSelecionado.dataTreino}}</span>     
                    </div>

                    <br><hr>

                    <div class="col-md-6"  dir-paginate="treino in treinos| itemsPerPage:10"
                    pagination-id="treinoPaginate">
                      <table  class="table table-bordered">  
                        <tr>
                          <td colspan="7">
                           <center><span class="treinoGrid">Treino {{treino.treino}}&nbsp;&nbsp; {{regiosTrabalhadas}}</span></center>
                          </td>
                        </tr>
                        <tr>
                          <th></th>
                          <th>Exercício</th>
                          <th>Região Trabalhada</th>
                          <th>Aparelho</th>
                          <th>Serie</th>
                          <th>Peso</th>
                          <th>Intervalo</th>
                         
                          
                        </tr>  
                         <!-- percorre todos os exercicios relacionado ao treino selecionado -->
                        <tr ng-repeat="exercicio in exerciciosTreino" ng-if="exercicio.idaluno_treino == treino.idaluno_treino">
                            
                            <td>{{$index+1}}</td>
                            <td>{{exercicio.exercicio}}</td> 
                            <td>{{exercicio.regiaoTrabalhada}}</td>
                            <td>{{exercicio.aparelho}}</td>
                            <td>{{exercicio.serie}} <span ng-if="exercicio.serie">X</span> {{exercicio.repeticao}}</td>
                            <td>{{exercicio.peso}}</td>
                            <td>{{exercicio.intervalo}}</td>
                                                 
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
                    </div> <!-- fim da div coluna do dir-paginate -->
                  </div>  
                </div> <!-- fim da div do tab1-->
                <div id="tab1_2" class="tab-pane">

                  
                </div>
                <div id="tab1_3" class="tab-pane">

                  
                </div>
              </div>
            </div>
          </div>
         
        </div>
        <!-- end: .tray-center -->

      </section>
      <!-- End: Content -->

    </section>
</div>    