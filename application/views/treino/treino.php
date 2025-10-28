<div ng-controller="treino">
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
                   
                     
                    <?php include_once("form_ciclo_treino.php"); ?>
                  
                    <?php include_once("lista_ciclo_treino.php"); ?>

                    <?php include_once("lista_exercicio.php"); ?>

                    <?php include_once("lista_treino.php"); ?>

                   

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
