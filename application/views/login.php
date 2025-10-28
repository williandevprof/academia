<?php include_once("cabecalho.php"); ?>

<body class="admin-elements-page" data-spy="scroll" data-target="#nav-spy" data-offset="300">
   
  <!-- Start: Main -->
  <div id="main" ng-controller="login">

    <!-- Start: Content-Wrapper -->
    <section id="content_wrapper">

      <!-- Begin: Content -->
      <section id="content" class="table-layout animated fadeIn">

        <!-- begin: .tray-center -->
        <div class="tray tray-center">
          <div class="">
            
            <div class="tab-content mw900 center-block center-children">

                     

              <!-- Login 2 -->
              <div class="admin-form theme-primary tab-pane active" id="login2" role="tabpanel">
                <div class="panel panel-primary heading-border">
                  <div class="panel-heading">
                    <span class="panel-title">
                      <i class="fa fa-sign-in"></i>Acessar o sistema</span>
                  </div>
                  <!-- end .form-header section -->

                    <div class="panel-body p25 pt10">
                      <div class="section row">
                        
                        <div class="col-md-6">
                          <div class="section-divider mv40">
                            <span>Login</span>
                          </div>
                          <!-- .tagline -->

                          <div class="section">
                            <label for="username" class="field prepend-icon">
                              <input ng-model="usuario.usuario" type="text" name="username" id="username" class="gui-input" placeholder="Usuário">
                              <label for="username" class="field-icon">
                                <i class="fa fa-user"></i>
                              </label>
                            </label>
                          </div>
                          <!-- end section -->

                          <div class="section">
                            <label for="password" class="field prepend-icon">
                              <input ng-model="usuario.senha" type="password" name="password" id="password" class="gui-input" placeholder="Senha">
                              <label for="password" class="field-icon">
                                <i class="fa fa-lock"></i>
                              </label>
                            </label>
                          </div>
                          <!-- end section -->

                          <div class="section">
                            <label class="switch block">
                              <input type="checkbox" name="remember2" id="remember2" checked>
                              <label for="remember2" data-on="YES" data-off="NO"></label>
                              <span>Remember me</span>
                            </label>
                          </div>
                          <!-- end section -->

                        </div>
                        <!-- end .colm section -->

                      </div>
                      <!-- end .section row section -->

                    </div>
                    <!-- end .form-body section -->
                    <div class="panel-footer">
                      <button ng-click="loginUsuario()" class="button btn-primary">Acessar</button>
                    </div>
                    <!-- end .form-footer section -->
                  
                </div>
                <!-- end .admin-form section -->
              </div>
              <!-- end: .admin-form -->
                  
            </div>

          </div>
        </div>
        <!-- end: .tray-center -->

      </section>
      <!-- End: Content -->

    </section>

  </div>
  <!-- End: Main -->

    <!--  dialog de login -->  
    <script type="text/ng-template" id="dialogErroLogin">
      <div class="ngdialog-message">
          <h3>{{errologin}}</h3>
          <p ng-show="theme">Test content for <code>{{theme}}</code></p>
      </div>
      <div class="ngdialog-buttons">
          <button type="button" class="ngdialog-button ngdialog-button-primary" ng-click="okValidaLogin()">OK</button>
      </div>
    </script>

  <style>
  /* demo page styles */
  .admin-form .panel.heading-border:before,
  .admin-form .panel .heading-border:before {
    transition: all 0.7s ease;
  }
  </style>

  <!-- BEGIN: PAGE SCRIPTS -->

  <!-- jQuery -->
  <script src="vendor/jquery/jquery-1.11.1.min.js"></script>
  <script src="vendor/jquery/jquery_ui/jquery-ui.min.js"></script>

  <!-- Theme Javascript -->
  <script src="assets/js/utility/utility.js"></script>
  <script src="assets/js/demo/demo.js"></script>
  <script src="assets/js/main.js"></script>
  <script type="text/javascript">
  jQuery(document).ready(function() {

    "use strict";

    // Init Theme Core    
    Core.init();

    // Init Demo JS  
    Demo.init();

    // Demo code - active navigation btns
    $('.animation-nav').click(function() {
      $('.animation-nav').removeClass('btn-primary').addClass('btn-default');
      $(this).addClass('btn-primary');
    });

    // Form switcher nav
    var formSwitches = $('.admin-form-list a');
    formSwitches.on('click', function() {
      formSwitches.removeClass('item-active');
      $(this).addClass('item-active')

      if ($(this).attr('href') === "#contact3") {
        setTimeout(function() {
          initialize();
        }, 100);
      }

    });

  });
  </script>
  <!-- END: PAGE SCRIPTS -->

</body>

</html>
