<div ng-controller="salvar_treinos">
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
                
                  <div class="col-md-2">  
                    <span class="descrTreino">Ciclo:</span>  <span class="treino">{{ciclo}}</span>     
                  </div>
                  <div class="col-md-2"> 
                   <span class="descrTreino">Modelo:</span> <span class="treino">{{modelo}}  </span>   
                  </div>
                  <div class="col-md-2"> 
                    <span class="descrTreino">Meta:</span> <span class="treino">{{meta}}</span>     
                  </div>
                  <div class="col-md-2"> 
                    <span class="descrTreino">Nível:</span> <span class="treino">{{nivel}}</span>    
                  </div>
                  <div class="col-md-2"> 
                    <span class="descrTreino">Gênero:</span> <span class="treino">{{genero}}</span>     
                  </div>

                  
                  <br>
                  <div>
                    <h3></h3>
                  </div><br>

                  <br>  

                  <div class="row">
                    <div class="col-md-2">
                      <div class="section admin-widgets-page"> 
                        <label for="datepicker1" class="field prepend-icon">
                          <input ng-model="dataRealizacaoTreino" type="text" id="dataRealizacaoTreino" name="dataRealizacaoTreino" class="gui-input"
                          onkeypress="mascaraData(this, event)"
                          placeholder="Data de Realização do Treino">
                          <label class="field-icon">
                            <i class="fa fa-calendar-o"></i>
                          </label>
                        </label>
                      </div> 
                    </div>  
                  </div>  

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
                      <tr  ng-click="selecionarTreino(treino.idaluno_treino)">
                        <td colspan="8">
                         <center><span class="treinoGrid">{{treinoGrid}}&nbsp;&nbsp; {{regiosTrabalhadas}}</span></center>
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
                        <th>Marque os exercícios Realizados</th>
                                                
                      </tr>  
                       <!-- percorre todos os exercicios relacionado ao treino selecionado -->
                      <tr ng-repeat="exercicio in exerciciosTreinosAtivo">
                        <td>{{$index+1}}</td>
                        <td>{{exercicio.exercicio}}</td>
                        <td>{{exercicio.regiaoTrabalhada}}</td>
                        <td>{{exercicio.aparelho}}</td>
                        <td>{{exercicio.serie}} <span ng-if="exercicio.serie">X</span> {{exercicio.repeticao}}</td>
                        <td>{{exercicio.peso}}</td>
                        <td>{{exercicio.intervalo}}</td>
                        <td>
                          <label class="option">
                            <input type="checkbox" ng-model="exercicio.selected"
                            value={{exercicio.idaluno_exercicio}}>
                            <span class="checkbox"></span>
                          </label>
                        </td>
                      </tr>
                    <table>
                    
                    <br><br>

                    <div class="row">
                      
                      <div class="col-md-4">
                        <button 
                          class="btn btn-success" ng-click="salvarTreinoSelecionado()" >Salvar Treino&nbsp;<i class="fa fa-save"></i>
                        </button>
                      </div>
                    </div>

                     <!--  dialog do valida data -->
                    <script type="text/ng-template" id="dialogValidaData">
                      <div class="ngdialog-message">
                          <h3>{{validaData}}</h3>
                          <p ng-show="theme">Test content for <code>{{theme}}</code></p>
                      </div>
                      <div class="ngdialog-buttons">
                          <button type="button" class="ngdialog-button ngdialog-button-primary" ng-click="okValidaData()">OK</button>
                      </div>
                    </script>

                    <!--  dialog de sucesso de cadastro -->  
                    <script type="text/ng-template" id="dialogCadastrado">
                      <div class="ngdialog-message">
                          <h3>{{cadastrado}}</h3>
                          <p ng-show="theme">Test content for <code>{{theme}}</code></p>
                      </div>
                      <div class="ngdialog-buttons">
                          <button type="button" class="ngdialog-button ngdialog-button-primary" ng-click="okCadastrado()">OK</button>
                      </div>
                    </script>
                 
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