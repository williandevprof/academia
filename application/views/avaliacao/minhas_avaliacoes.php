<div ng-controller="minhas_avaliacoes">
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

                  <div>
                    <div  class="section-divider mb40">
                      <span>Lista de Avaliações Físicas</span>
                    </div>

                    
                    <br>
                    <div class="row">
                     
                      <div class="col-md-2">
                        <div class="section admin-widgets-page" ng-hide="mostrainputbuscarDataNascimento"> 
                          <label for="datepicker1" class="field prepend-icon">
                            <input ng-model="avaliacao.data_avaliacao1" type="text" class="gui-input"
                            onkeypress="mascaraData(this, event)"
                            placeholder="Data da Avaliação 1">
                            <label class="field-icon">
                              <i class="fa fa-calendar-o"></i>
                            </label>
                          </label>
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div class="section admin-widgets-page" ng-hide="mostrainputbuscarDataNascimento"> 
                          <label for="datepicker1" class="field prepend-icon">
                            <input ng-model="avaliacao.data_avaliacao2" type="text" class="gui-input"
                            onkeypress="mascaraData(this, event)"
                            placeholder="Data da Avaliação 2">
                            <label class="field-icon">
                              <i class="fa fa-calendar-o"></i>
                            </label>
                          </label>
                        </div>
                      </div>

                      <div class="col-md-2">
                        <button ng-click="pesquisarAvaliacao()" class="button btn-primary">Buscar&nbsp;<i class="fa fa-search"></i></button>
                      </div>
                    </div>
                    <br><br>

                    <div>
                      <table  class="table table-bordered table-striped table-hover">
                        <tr>
                          <th>ID</th>        
                          <th>Peso</th>
                          <th>Altura</th>
                          <th>IMC</th>
                          <th>Percentual de Gordura</th>
                          <th>Massa Magra</th>
                          <th>Massa Gorda</th>
                          <th>Data da Avaliação</th>
                          <th>Detalhar</th>
                          
                        </tr>
                        <tr dir-paginate="avaliacao in avaliacoes|itemsPerPage:7">
                          <td>{{avaliacao.idavaliacao_fisica}}</td>
                          <td>{{avaliacao.peso}}</td>
                          <td>{{avaliacao.altura}}</td>
                          <td>{{avaliacao.imc}}</td>
                          <td>{{avaliacao.percentual_gordura}}</td>
                          <td>{{avaliacao.massa_magra}}</td>
                          <td>{{avaliacao.massa_gorda}}</td>
                          <td>{{avaliacao.data_avaliacao}}</td>
                          <td>
                              <button class="btn btn-info" ng-click="detalharAvaliacao(avaliacao)">Detalhar Avaliação&nbsp;  <i class="fa fa-search"></i>
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
                  </div>

                </div>
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