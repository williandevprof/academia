<div ng-controller="meus_treinos">
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

                  <div class="section row mbn">
                    <div ng-show="mostraCiclosAluno">
                      <div class="row">
                        <div class="col-md-5">
                          <input ng-model="buscarMeusCiclos"  type="text" class="form-control" 
                            placeholder="Digite o nome do ciclo de treino para a busca"
                            ng-keyup="autoMeusCiclos(buscarMeusCiclos)" uib-typeahead="autoCiclo as autoCiclo.ciclo for autoCiclo in autoCiclos | filter:$viewValue | limitTo:8">
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
                          <button ng-click="pesquisarMeusCiclos()"  class="button btn-primary">Buscar&nbsp;<i class="fa fa-search"></i></button>
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
                          <tr dir-paginate="ciclo in ciclosTreino| itemsPerPage:5"
                          pagination-id="ciclosPaginate" ng-click="setClickedRow($index, ciclo.idaluno_ciclo); mostraTreinos(ciclo.idaluno_ciclo, ciclo)"
                          ng-class="{'selected':$index == selectedRow}">
                            <td><h4>{{ciclo.idaluno_ciclo}}</h4></td>
                            <td><h4>{{ciclo.ciclo}}</h4></td>
                            <td><h4>{{ciclo.nivel}}</h4></td>
                            <td><h4>{{ciclo.genero}}</h4></td>
                            <td><h4>{{ciclo.metaPrincipal}}</h4></td>
                            <td><h4>{{ciclo.modeloCiclo}}</h4></td>
                            <td><h4>{{ciclo.dataInicioTreino}}</h4></td>
                            <td><h4>{{ciclo.dataTerminoTreino}}</h4></td>
                            <td><h4>
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
                      </div> <br>
                    </div>
                  
                    <div ng-show="mostraCicloSelecionado">
                      <br>
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
                      <br>  

                      <div class="row">
                        <div class="col-md-2" ng-repeat="treino in treinos">
                          <button  ng-click="mostraTreino(treino)"
                          ng-class="{'css_btn_class': treino.treino != classe, 'css_btn_class_azul': treino.treino == classe}"
                          >Treino {{treino.treino}}</button>
                        </div> 
                      </div>  

                      <br><br>
                      <div class="col-md-6">
                        <table  class="table table-bordered">  
                          <tr>
                            <td colspan="7">
                             <center><span class="treinoGrid">{{treinoGrid}}&nbsp;&nbsp;{{regiosTrabalhadas}}</span></center>
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
                           
                            <th ng-show="escondeId"></th>
                          </tr>  
                           <!-- percorre todos os exercicios relacionado ao treino selecionado -->
                          <tr ng-repeat="exercicio in exerciciosTreino">
                              
                              <td>{{$index+1}}</td>
                              <td>{{exercicio.exercicio}}</td> 
                              <td>{{exercicio.regiaoTrabalhada}}</td>
                              <td>{{exercicio.aparelho}}</td>
                              <td>{{exercicio.serie}} <span ng-if="exercicio.serie">X</span> {{exercicio.repeticao}}</td>
                              <td>{{exercicio.peso}}</td>
                              <td>{{exercicio.intervalo}}</td>
                              
                              <td ng-show="escondeId">{{exercicio.idexercicio_treino}}</td>
                          </tr>
                         
                        <table>
                        
                      </div> <!-- fim da div coluna do dir-paginate -->
                     
                    </div> <!-- fim da div do ng-show-->

                  </div> <!-- fim da div do section row mbn-->  
                                
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
                 