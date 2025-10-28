<div ng-controller="valores_planos">
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

                  <?php
                    session_start();
                    $conexao = mysqli_connect('127.0.0.1', 'root', '', 'academia');

                    // seleciona a permissao de cadastrar exercicio para esse usuário
                    $sql = mysqli_query($conexao, "SELECT * FROM usuario u 
                    JOIN usuario_permissao up on u.idusuario = up.idusuario
                    JOIN permissao p on up.idpermissao = p.idpermissao
                    WHERE u.idusuario = '{$_SESSION["iduser"]}'
                    AND  p.permissao = 'valores plano'");
           
                    $retornoValoresPlanos = mysqli_fetch_assoc($sql);

                    if ($retornoValoresPlanos['cadastrar'] == 1) 
                    {

                      ?> 

                        <div class="section-divider mb40" id="spy2">
                          <span>Cadastro de Valores de Planos</span>
                        </div>
                        <br>
                        <div class="row">
                          <div class="col-md-3">
                            <select ng-model="valor_plano.tipoPlano" class="select2-single form-control">
                              <option value="">Selecione o Tipo de Plano</option>
                              <option ng-repeat="tipo_plano in tipos_plano" value="{{tipo_plano.idtipoPlano}}">{{tipo_plano.tipoPlano}}</option>
                            </select>
                          </div>
                          <div class="col-md-3">
                            <select ng-model="valor_plano.modalidade" class="select2-single form-control">
                              <option value="">Selecione a Modalidade</option>
                              <option ng-repeat="modalidade in modalidades" value="{{modalidade.idmodalidade}}">{{modalidade.modalidade}}</option>
                            </select>
                          </div>
                          <div class="col-md-3">
                            <select ng-model="valor_plano.prazoPlano"class="select2-single form-control">
                              <option value="">Selecione o Prazo</option>
                              <option ng-repeat="prazo_plano in prazos_plano" value="{{prazo_plano.idprazoPlano}}">{{prazo_plano.prazoPlano}}</option>
                            </select>
                          </div>
                        </div>
                        <br>
                        <div class="row">
                          <div class="col-md-3">
                            <div class="section">
                              <input ng-model="valor_plano.valor"  type="text" class="form-control" placeholder="Digite o Valor">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-2"> 
                            <button class="btn btn-success" ng-click="salvarValor_plano()">Salvar&nbsp;<i class="fa fa-save"></i></button>
                          </div>
                        </div>
                      <?php
                    }
                  ?> 
                  
                  <br><br>
                   <div class="section-divider mb40" id="spy2">
                    <span>Lista de Valores de Planos</span>
                  </div>
                  <br> 
                  <table  class="table table-bordered table-striped table-hover">
                    <tr>
                      <th>Id</th>
                      <th>Tipo</th>
                      <th>Modalidade</th>
                      <th>Prazo</th>
                      <th>Valor</th>
                      <?php
                        //if ($retornoExercicio['alterar'] == 1) 
                        //{

                          ?>
                            <th>Alterar</th>
                          <?php
                        //}  
                      ?>

                    </tr>
                    <tr dir-paginate="valor_plano in valores_plano|itemsPerPage:7">
                      <td>{{valor_plano.idvalores_plano}}</td>
                      <td>{{valor_plano.tipoPlano}}</td>
                      <td>{{valor_plano.modalidade}}</td>
                      <td>{{valor_plano.prazoPlano}}</td>
                      <td>{{valor_plano.valor}}</td>
                      
                      <?php
                        //if ($retornoExercicio['alterar'] == 1) 
                        //{

                          ?>
                            <td>
                              <button class="btn btn-warning" ng-click="editar(exercicio)">Alterar &nbsp;<span class="icon-write"></span></button>
                            </td>
                          <?php
                        //}
                      ?>      
                    </tr>
                  </table>
                  <div class="btn_paginacao">
                    <dir-pagination-controls
                      max-size="5"
                      direction-links="true"
                      boundary-links="true" >
                    </dir-pagination-controls>
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
