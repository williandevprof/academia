<div ng-controller="aluno">
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
                 
                    <div ng-hide="mostraListaAluno">
                      <div  class="section-divider mb40">
                        <span>Lista de Alunos</span>
                      </div>

                      
                      <br>
                      <div class="row">
                             
                        <div class="col-md-5">
                          <label for="firstname" class="field prepend-icon">
                            <input ng-model="aluno.buscarAluno"  type="text" name="buscarPessoa" id="buscarPessoa" class="gui-input" placeholder="Digite o nome da pessoa para a busca"
                            ng-keyup="autoAluno(aluno.buscarAluno)" uib-typeahead="autoAluno as autoAluno.nome for autoAluno in autoAlunos | filter:$viewValue | limitTo:8">
                            <label for="firstname" class="field-icon">
                              <i class="fa fa-user"></i>
                            </label>
                          </label>
                        </div>
                        <div class="col-md-3">
                          <div class="section admin-widgets-page" ng-hide="mostrainputbuscarDataNascimento"> 
                            <label for="datepicker1" class="field prepend-icon">
                              <input ng-model="aluno.buscarDataNascimento" type="text" id="buscarDataNascimento" name="buscarDataNascimento" class="gui-input"
                              onkeypress="mascaraData(this, event)"
                              placeholder="Data de Nascimento">
                              <label class="field-icon">
                                <i class="fa fa-calendar-o"></i>
                              </label>
                            </label>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <button ng-click="pesquisarAluno()"  ng-hide="mostrabtnpesquisarPessoa" class="button btn-primary">Buscar&nbsp;<i class="fa fa-search"></i></button>
                        </div>
                      </div>
                      <br><br>

                      <div>
                        <table  class="table table-bordered table-striped table-hover">
                          <tr>
                            <th><center>Foto</center></th>
                            <th>Nome</th>
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>Data de Nascimento</th>
                            <th>Treinos</th>
                            
                          </tr>
                          <tr dir-paginate="aluno in alunos|itemsPerPage:7">
                            <td>
                              <center>
                                <div >
                                  <!-- Lista a foto se o idpessoa de pessoa for igual o idpessoa-->
                                  <img ng-repeat="image in images"  ng-if="aluno.idpessoa == image.idpessoa" style="width: 125px; height: 75px;" ng-src="../Academia/api_fotos/images/{{image.foto}}" ng-click="openImg($event, aluno, image)">
                                </div> 
                              </center>  
                            </td>
                            
                            <td>{{aluno.nome}}</td>
                            <td>{{aluno.telefone}}</td>
                            <td>{{aluno.email}}</td>
                            <td>{{aluno.dataNascimentoBrasileiro}}</td>
                            
                            <td>
                                <button class="btn btn-info" ng-click="treino(aluno, image)">Treinos&nbsp;  <span class="icon-write"></span>
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
                    </div> <!-- fim da div do lista alunos-->

                    <!--  dialog do validar ciclo -->  
                  <script type="text/ng-template" id="dialogValidaCiclo">
                    <div class="ngdialog-message">
                        <h3>{{validaCiclo}}</h3>
                        <p ng-show="theme">Test content for <code>{{theme}}</code></p>
                    </div>
                    <div class="ngdialog-buttons">
                        <button type="button" class="ngdialog-button ngdialog-button-primary" ng-click="okValidaCiclo()">OK</button>
                    </div>
                  </script> 

                  <!--  dialog do validar cadastro de novo ciclo-->  
                  <script type="text/ng-template" id="dialogValidaCicloAluno">
                    <div class="ngdialog-message">
                        <h3>{{validaCicloAluno}}</h3>
                        <p ng-show="theme">Test content for <code>{{theme}}</code></p>
                    </div>
                    <div class="ngdialog-buttons">
                        <button type="button" class="ngdialog-button ngdialog-button-primary" ng-click="okValidaCadastroCiclo()">OK</button>
                    </div>
                  </script>

                   <!--  dialog de sucesso de cadastro -->  
                  <script type="text/ng-template" id="dialogCadastradoCicloAluno">
                    <div class="ngdialog-message">
                        <h3>{{cadastrado}}</h3>
                        <p ng-show="theme">Test content for <code>{{theme}}</code></p>
                    </div>
                    <div class="ngdialog-buttons">
                        <button type="button" class="ngdialog-button ngdialog-button-primary" ng-click="okdialogCadastrado()">OK</button>
                    </div>
                  </script> 

                  <!--  dialog do ciclo treino cadastrado -->  
                  <script type="text/ng-template" id="dialogCicloTreinoAdicionado">
                    <div class="ngdialog-message">
                        <h3>{{cicloTreinoCadastrado}}</h3>
                        <p ng-show="theme">Test content for <code>{{theme}}</code></p>
                    </div>
                    <div class="ngdialog-buttons">
                        <button type="button" class="ngdialog-button ngdialog-button-primary" ng-click="okCadCicloTreino()">OK</button>
                    </div>
                  </script> 

                  <!--  dialog do valida ciclo treino -->  
                  <script type="text/ng-template" id="dialogValidaCicloTreino">
                    <div class="ngdialog-message">
                        <h3>{{validaCicloTreino}}</h3>
                        <p ng-show="theme">Test content for <code>{{theme}}</code></p>
                    </div>
                    <div class="ngdialog-buttons">
                        <button type="button" class="ngdialog-button ngdialog-button-primary" ng-click="okValidaCadCicloTreino()">OK</button>
                    </div>
                  </script> 
                   
                    <?php include_once("aluno_perfil.php") ?>
                    <?php include_once("aluno_novo_ciclo.php") ?>
                    <?php include_once("aluno_novos_exercicios.php") ?>
                    <?php include_once("aluno_treinos_realizados.php") ?>
                    
                    <?php include_once("ciclos_aluno.php") ?>
                    <?php include_once("aluno_treino.php") ?>
                    
                   
                  <!--  dialog de cadastro de peso, serie e intervalo -->
                  <script type="text/ng-template" id="dialogCadastroSeriePesoIntervalo">
                    <h3>{{Exercicio}}</h3>
                    <div class="row"> 
                      <div class="col-md-5">
                        <label>Serie</label>
                        <input type="text" ng-model="exercicioModal.serie" class="form-control">
                      </div>
                      <div class="col-md-5">
                        <label>Repetições</label>
                        <input type="text" ng-model="exercicioModal.repeticao" class="form-control">
                      </div>
                    </div> 
                    <div class="row"> 
                      <div class="col-md-5">
                        <label>Peso</label>
                        <input type="text" ng-model="exercicioModal.peso" class="form-control">
                      </div>
                      <div class="col-md-5">
                        <label>Intervalo</label>
                        <input type="text" ng-model="exercicioModal.intervalo" class="form-control">
                      </div>
                    </div>    
                    
                    <br> 
                    <div class="ngdialog-buttons">
                        
                        <button type="button" class="ngdialog-button ngdialog-button-danger"  ng-click="cancelarExercicio()">Cancelar</button>
                        
                        <button type="button" class="ngdialog-button ngdialog-button-primary" ng-click="salvarExercicio(exercicioModal)">Salvar</button>
                    </div>
                  </script> 


                  
     

                    <!--  dialog do cancelar cadastro -->
                    <script type="text/ng-template" id="dialogcancelarExercicio">
                      <div class="ngdialog-message">
                          <h3>Tem certeza que deseja cancelar essa operação?</h3>
                          <p ng-show="theme">Test content for <code>{{theme}}</code></p>
                      </div>
                      <div class="ngdialog-buttons">
                          <button type="button" class="ngdialog-button ngdialog-button-danger"  ng-click="cancelcancelarExercicio()">Não</button>
                          <button type="button" class="ngdialog-button ngdialog-button-primary" ng-click="confirmcancelarExercicio()">Sim</button>
                      </div>
                    </script>

                     <!--  dialog do validar cadastro -->  
                    <script type="text/ng-template" id="dialogValidaTreino">
                      <div class="ngdialog-message">
                          <h3>{{validaTreino}}</h3>
                          <p ng-show="theme">Test content for <code>{{theme}}</code></p>
                      </div>
                      <div class="ngdialog-buttons">
                          <button type="button" class="ngdialog-button ngdialog-button-primary" ng-click="okValidaTreino()">OK</button>
                      </div>
                    </script>

                      <!--  dialog do validar cadastro -->  
                    <script type="text/ng-template" id="dialogValidaExercicio">
                      <div class="ngdialog-message">
                          <h3>{{validaExercicio}}</h3>
                          <p ng-show="theme">Test content for <code>{{theme}}</code></p>
                      </div>
                      <div class="ngdialog-buttons">
                          <button type="button" class="ngdialog-button ngdialog-button-primary" ng-click="okValidaExercicio()">OK</button>
                      </div>
                    </script>

                    <!--  dialog de sucesso de cadastro -->  
                    <script type="text/ng-template" id="dialogCadastrado">
                      <div class="ngdialog-message">
                          <h3>{{cadastrado}}</h3>
                          <p ng-show="theme">Test content for <code>{{theme}}</code></p>
                      </div>
                      <div class="ngdialog-buttons">
                          <button type="button" class="ngdialog-button ngdialog-button-primary" ng-click="okdialogCadastrado()">OK</button>
                      </div>
                    </script>
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

    <!-- Start: Right Sidebar -->
    <aside id="sidebar_right" class="nano affix">

      <!-- Start: Sidebar Right Content -->
      <div class="sidebar-right-content nano-content p15">
          <h5 class="title-divider text-muted mb20"> Server Statistics
            <span class="pull-right"> 2013
              <i class="fa fa-caret-down ml5"></i>
            </span>
          </h5>
          <div class="progress mh5">
            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 44%">
              <span class="fs11">DB Request</span>
            </div>
          </div>
          <div class="progress mh5">
            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 84%">
              <span class="fs11 text-left">Server Load</span>
            </div>
          </div>
          <div class="progress mh5">
            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 61%">
              <span class="fs11 text-left">Server Connections</span>
            </div>
          </div>
          <h5 class="title-divider text-muted mt30 mb10">Traffic Margins</h5>
          <div class="row">
            <div class="col-xs-5">
              <h3 class="text-primary mn pl5">132</h3>
            </div>
            <div class="col-xs-7 text-right">
              <h3 class="text-success-dark mn">
                <i class="fa fa-caret-up"></i> 13.2% </h3>
            </div>
          </div>
          <h5 class="title-divider text-muted mt25 mb10">Database Request</h5>
          <div class="row">
            <div class="col-xs-5">
              <h3 class="text-primary mn pl5">212</h3>
            </div>
            <div class="col-xs-7 text-right">
              <h3 class="text-success-dark mn">
                <i class="fa fa-caret-up"></i> 25.6% </h3>
            </div>
          </div>
          <h5 class="title-divider text-muted mt25 mb10">Server Response</h5>
          <div class="row">
            <div class="col-xs-5">
              <h3 class="text-primary mn pl5">82.5</h3>
            </div>
            <div class="col-xs-7 text-right">
              <h3 class="text-danger mn">
                <i class="fa fa-caret-down"></i> 17.9% </h3>
            </div>
          </div>
          <h5 class="title-divider text-muted mt40 mb20"> Server Statistics
            <span class="pull-right text-primary fw600">USA</span>
          </h5>
        </div>
        
    </aside>
    <!-- End: Right Sidebar -->

  </div>
  <!-- End: Main -->
</div>  
  

  <!-- BEGIN: PAGE SCRIPTS -->

  <!-- jQuery -->
  <script src="vendor/jquery/jquery-1.11.1.min.js"></script>
  <script src="vendor/jquery/jquery_ui/jquery-ui.min.js"></script>

  <!-- FileUpload JS -->
  <script src="vendor/plugins/fileupload/fileupload.js"></script>
  <script src="vendor/plugins/holder/holder.min.js"></script>

  <!-- Tagmanager JS -->
  <script src="vendor/plugins/tagsinput/tagsinput.min.js"></script>

  <!-- Theme Javascript -->
  <script src="assets/js/utility/utility.js"></script>
  <script src="assets/js/demo/demo.js"></script>
  <script src="assets/js/main.js"></script>
  <script type="text/javascript">
  jQuery(document).ready(function() {

     // codigo de encolher o menu  
    $("#toggle_sidemenu_t").on('click', sidebarTopToggle);
    $("#toggle_sidemenu_l").on('click', sidebarLeftToggle);
    $("#toggle_sidemenu_r").on('click', sidebarRightToggle);

    "use strict";

    // Init Theme Core    
    Core.init();

    // Init Demo JS  
    Demo.init();

    $("#dataInicio").datepicker(
    {
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior'
      
    });

    $("#dataTermino").datepicker(
    {
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior'
      
    });

    // select list dropdowns - placeholder like creation
    var selectList = $('.admin-form select');
    selectList.each(function(i, e) {
      $(e).on('change', function() {
        if ($(e).val() == "0") $(e).addClass("empty");
        else $(e).removeClass("empty")
      });
    });
    selectList.each(function(i, e) {
      $(e).change();
    });

    // Init TagsInput plugin
    $("input#tagsinput").tagsinput({
      tagClass: function(item) {
        return 'label bg-primary light';
      }
    });

  });
  </script>
  <!-- END: PAGE SCRIPTS -->

</body>

</html>
