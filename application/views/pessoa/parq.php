<body class="form-editors-page" data-spy="scroll" data-target="#nav-spy" data-offset="300">

  <!-- Start: Theme Preview Pane -->
  <div id="skin-toolbox">
    <div class="panel">
      <div class="panel-heading">
        <span class="panel-icon">
          <i class="fa fa-gear text-primary"></i>
        </span>
        <span class="panel-title"> Theme Options</span>
      </div>
      <div class="panel-body pn">
        <ul class="nav nav-list nav-list-sm pl15 pt10" role="tablist">
          <li class="active">
            <a href="#toolbox-header" role="tab" data-toggle="tab">Navbar</a>
          </li>
          <li>
            <a href="#toolbox-sidebar" role="tab" data-toggle="tab">Sidebar</a>
          </li>
          <li>
            <a href="#toolbox-settings" role="tab" data-toggle="tab">Misc</a>
          </li>
        </ul>
        <div class="tab-content p20 ptn pb15">
          <div role="tabpanel" class="tab-pane active" id="toolbox-header">
            <form id="toolbox-header-skin">
              <h4 class="mv20">Header Skins</h4>
              <div class="skin-toolbox-swatches">
                <div class="checkbox-custom checkbox-disabled fill mb5">
                  <input type="radio" name="headerSkin" id="headerSkin8" checked value="">
                  <label for="headerSkin8">Light</label>
                </div>
                <div class="checkbox-custom fill checkbox-primary mb5">
                  <input type="radio" name="headerSkin" id="headerSkin1" value="bg-primary">
                  <label for="headerSkin1">Primary</label>
                </div>
                <div class="checkbox-custom fill checkbox-info mb5">
                  <input type="radio" name="headerSkin" id="headerSkin3" value="bg-info">
                  <label for="headerSkin3">Info</label>
                </div>
                <div class="checkbox-custom fill checkbox-warning mb5">
                  <input type="radio" name="headerSkin" id="headerSkin4" value="bg-warning">
                  <label for="headerSkin4">Warning</label>
                </div>
                <div class="checkbox-custom fill checkbox-danger mb5">
                  <input type="radio" name="headerSkin" id="headerSkin5" value="bg-danger">
                  <label for="headerSkin5">Danger</label>
                </div>
                <div class="checkbox-custom fill checkbox-alert mb5">
                  <input type="radio" name="headerSkin" id="headerSkin6" value="bg-alert">
                  <label for="headerSkin6">Alert</label>
                </div>
                <div class="checkbox-custom fill checkbox-system mb5">
                  <input type="radio" name="headerSkin" id="headerSkin7" value="bg-system">
                  <label for="headerSkin7">System</label>
                </div>
                <div class="checkbox-custom fill checkbox-success mb5">
                  <input type="radio" name="headerSkin" id="headerSkin2" value="bg-success">
                  <label for="headerSkin2">Success</label>
                </div>
                <div class="checkbox-custom fill mb5">
                  <input type="radio" name="headerSkin" id="headerSkin9" value="bg-dark">
                  <label for="headerSkin9">Dark</label>
                </div>
              </div>
            </form>
          </div>
          <div role="tabpanel" class="tab-pane" id="toolbox-sidebar">
            <form id="toolbox-sidebar-skin">
              <h4 class="mv20">Sidebar Skins</h4>
              <div class="skin-toolbox-swatches">
                <div class="checkbox-custom fill mb5">
                  <input type="radio" name="sidebarSkin" checked id="sidebarSkin3" value="">
                  <label for="sidebarSkin3">Dark</label>
                </div>
                <div class="checkbox-custom fill checkbox-disabled mb5">
                  <input type="radio" name="sidebarSkin" id="sidebarSkin1" value="sidebar-light">
                  <label for="sidebarSkin1">Light</label>
                </div>
                <div class="checkbox-custom fill checkbox-light mb5">
                  <input type="radio" name="sidebarSkin" id="sidebarSkin2" value="sidebar-light light">
                  <label for="sidebarSkin2">Lighter</label>
                </div>
              </div>
            </form>
          </div>
          <div role="tabpanel" class="tab-pane" id="toolbox-settings">
            <form id="toolbox-settings-misc">
              <h4 class="mv20 mtn">Layout Options</h4>
              <div class="form-group">
                <div class="checkbox-custom fill mb5">
                  <input type="checkbox" checked="" id="header-option">
                  <label for="header-option">Fixed Header</label>
                </div>
              </div>
              <div class="form-group">
                <div class="checkbox-custom fill mb5">
                  <input type="checkbox" checked="" id="sidebar-option">
                  <label for="sidebar-option">Fixed Sidebar</label>
                </div>
              </div>
              <div class="form-group">
                <div class="checkbox-custom fill mb5">
                  <input type="checkbox" id="breadcrumb-option">
                  <label for="breadcrumb-option">Fixed Breadcrumbs</label>
                </div>
              </div>
              <div class="form-group">
                <div class="checkbox-custom fill mb5">
                  <input type="checkbox" id="breadcrumb-hidden">
                  <label for="breadcrumb-hidden">Hide Breadcrumbs</label>
                </div>
              </div>
              <h4 class="mv20">Layout Options</h4>
              <div class="form-group">
                <div class="radio-custom mb5">
                  <input type="radio" id="fullwidth-option" checked name="layout-option">
                  <label for="fullwidth-option">Fullwidth Layout</label>
                </div>
              </div>
              <div class="form-group mb20">
                <div class="radio-custom radio-disabled mb5">
                  <input type="radio" id="boxed-option" name="layout-option" disabled>
                  <label for="boxed-option">Boxed Layout
                    <b class="text-muted">(Coming Soon)</b>
                  </label>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="form-group mn br-t p15">
          <a href="#" id="clearLocalStorage" class="btn btn-primary btn-block pb10 pt10">Clear LocalStorage</a>
        </div>
      </div>
    </div>
  </div>
  <!-- End: Theme Preview Pane -->

     

    <!-- Start: Content-Wrapper -->
    <section id="content_wrapper">

      <!-- Start: Topbar-Dropdown -->
      <div id="topbar-dropmenu">
        <div class="topbar-menu row">
          <div class="col-xs-4 col-sm-2">
            <a href="#" class="metro-tile">
              <span class="metro-icon glyphicon glyphicon-inbox"></span>
              <p class="metro-title">Messages</p>
            </a>
          </div>
          <div class="col-xs-4 col-sm-2">
            <a href="#" class="metro-tile">
              <span class="metro-icon glyphicon glyphicon-user"></span>
              <p class="metro-title">Users</p>
            </a>
          </div>
          <div class="col-xs-4 col-sm-2">
            <a href="#" class="metro-tile">
              <span class="metro-icon glyphicon glyphicon-headphones"></span>
              <p class="metro-title">Support</p>
            </a>
          </div>
          <div class="col-xs-4 col-sm-2">
            <a href="#" class="metro-tile">
              <span class="metro-icon fa fa-gears"></span>
              <p class="metro-title">Settings</p>
            </a>
          </div>
          <div class="col-xs-4 col-sm-2">
            <a href="#" class="metro-tile">
              <span class="metro-icon glyphicon glyphicon-facetime-video"></span>
              <p class="metro-title">Videos</p>
            </a>
          </div>
          <div class="col-xs-4 col-sm-2">
            <a href="#" class="metro-tile">
              <span class="metro-icon glyphicon glyphicon-picture"></span>
              <p class="metro-title">Pictures</p>
            </a>
          </div>
        </div>
      </div>
      <!-- End: Topbar-Dropdown -->

      
      <!-- Begin: Content -->
      <section id="content" class="table-layout animated fadeIn">

        <!-- begin: .tray-center -->
        <div class="tray tray-center">

          <!-- CKEditor -->
          <h4 class="micro-header mt50">Cadastro de PAR Q</h4>

          <input type="hidden" ng-model="parq.idparq" value="{{parq.idparq}}">
          
          <textarea ng-model="parq.textoParq" cols="185" rows="30">
            {{parq.textoParq}}
          </textarea><br>
          
        <span ng-click="maisPergunta()" class="fa fa-plus-square-o"></span><br> 
      
        <div class="row" ng-repeat="pergunta in parqperguntas">
          <input type="hidden" ng-model="parqperguntas[$index].idpergunta" value="parqperguntas[$index].idpergunta">
           <div class="col-md-10">
            <input class="form-control" ng-model="parqperguntas[$index].pergunta" type="text" value="{{parqperguntas[$index].pergunta}}"><br>
          </div>
          <?php

            session_start();
            $conexao = mysqli_connect('127.0.0.1', 'root', '', 'academia');

            // seleciona a permissao de cadastrar parq para esse usuário
            $sql = mysqli_query($conexao, "SELECT * FROM usuario u 
            JOIN usuario_permissao up on u.idusuario = up.idusuario
            JOIN permissao p on up.idpermissao = p.idpermissao
            WHERE u.idusuario = '{$_SESSION["iduser"]}'
            AND  p.permissao = 'parq'");
   
            $retornoParq = mysqli_fetch_assoc($sql);
          
            if ($retornoParq['excluir'] == 1) 
            {

              ?>   
                <div class="col-md-2">
                    <button ng-click="btnExluirPergunta(parqperguntas[$index])" class="btn btn-danger btn-xs">Excluir
                      <span class="imoon imoon-cancel-circle"></span>
                    </button>
                </div>
              <?php
              }
          ?>    
        </div>
      
        <?php 
          
          
          if (($retornoParq['cadastrar'] == 1) || ($retornoParq['alterar'] == 1))
          {

            ?> 

              <button ng-click="salvar(parq)" class="btn btn-success">Salvar&nbsp;<i class="fa fa-save"></i></button> 

            <?php
          }
          ?>    
        </div>
        <!-- end: .tray-center -->

        

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

    <!--  dialog de sucesso de cadastro -->  
    <script type="text/ng-template" id="dialogValidaParq">
      <div class="ngdialog-message">
          <h3>{{cadastrado}}</h3>
          <p ng-show="theme">Test content for <code>{{theme}}</code></p>
      </div>
      <div class="ngdialog-buttons">
          <button type="button" class="ngdialog-button ngdialog-button-primary" ng-click="okValidaParq()">OK</button>
      </div>
    </script>

    <!--  dialog do excluir pergunta -->
    <script type="text/ng-template" id="dialogExluirPergunta">
      <div class="ngdialog-message">
          <h3>Tem certeza que deseja excluir essa pergunta?</h3>
          <p ng-show="theme">Test content for <code>{{theme}}</code></p>
      </div>
      <div class="ngdialog-buttons">
          <button type="button" class="ngdialog-button ngdialog-button-danger"  ng-click="cancelExcluirPergunta()">Não</button>
          <button type="button" class="ngdialog-button ngdialog-button-primary" ng-click="confirmExcluirPergunta()">Sim</button>
      </div>
    </script>


  <style>
  /* demo styles -summernote */
  .btn-toolbar > .btn-group.note-fontname {
    display: none;
  }
  /* demo styles - hides several ckeditor toolbar buttons */
  #cke_52,
  #cke_53 {
    display: none !important;
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

  <!-- Ckeditor JS -->
  <script src="vendor/plugins/ckeditor/ckeditor.js"></script>

  <!-- Summernote Plugin -->
  <script src="vendor/plugins/summernote/summernote.min.js"></script>

  <!-- MarkDown JS -->
  <script src="vendor/plugins/markdown/markdown.js"></script>
  <script src="vendor/plugins/markdown/to-markdown.js"></script>
  <script src="vendor/plugins/markdown/bootstrap-markdown.js"></script>

  <!-- X-Edit JS -->
  <script src="vendor/plugins/moment/moment.min.js"></script>
  <!-- X-Edit Dependencies -->
  <script src="vendor/plugins/xeditable/js/bootstrap-editable.min.js"></script>
  <script src="vendor/plugins/xeditable/inputs/address/address.js"></script>
  <script src="vendor/plugins/xeditable/inputs/typeaheadjs/lib/typeahead.js"></script>
  <script src="vendor/plugins/xeditable/inputs/typeaheadjs/typeaheadjs.js"></script>

  <!-- Page Javascript -->
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


    // Init Summernote Plugin
    $('.summernote').summernote({
      height: 255, //set editable area's height
      focus: false, //set focus editable area after Initialize summernote
      oninit: function() {},
      onChange: function(contents, $editable) {},
    });

    // Init Inline Summernote Plugin
    $('.summernote-edit').summernote({
      airMode: true,
      focus: false //set focus editable area after Initialize summernote            
    });

    // Turn off automatic editor initilization.
    // Used to prevent conflictions with multiple text 
    // editors being displayed on the same page.
    CKEDITOR.disableAutoInline = true;

    // Init Ckeditor
    CKEDITOR.replace('ckeditor1', {
      height: 210,
      on: {
        instanceReady: function(evt) {
          $('.cke').addClass('admin-skin cke-hide-bottom');
        }
      },
    });

    // Init Inline Ckeditors
    CKEDITOR.inline('ckeditor-inline1');
    CKEDITOR.inline('ckeditor-inline2');

    // Init MarkDown Editor
    $("#markdown-editor").markdown({
      savable: false,
      onChange: function(e) {
        var content = e.parseContent(),
          content_length = (content.match(/\n/g) || []).length + content.length
        if (content == '') {
          $('#md-footer').hide()
        } else {
          $('#md-footer').show().html(content)
        }
      }
    });

    // Init X-editable Plugin
    function XEdit() {
      //enable / disable xedit
      $('#enable').click(function() {
        $(this).toggleClass('active');
        $('#user .editable').editable('toggleDisabled');
      });

      //editables 
      $('#username').editable({
        type: 'text',
        pk: 1,
        name: 'username',
        title: 'Enter username'
      });

      $('#firstname').editable({
        validate: function(value) {
          if ($.trim(value) == '') return 'This field is required';
        }
      });

      $('#sex').editable({
        prepend: "not selected",
        source: [{
          value: 1,
          text: 'Male'
        }, {
          value: 2,
          text: 'Female'
        }],
        display: function(value, sourceData) {
          var colors = {
              "": "gray",
              1: "green",
              2: "blue"
            },
            elem = $.grep(sourceData, function(o) {
              return o.value == value;
            });

          if (elem.length) {
            $(this).text(elem[0].text).css("color", colors[value]);
          } else {
            $(this).empty();
          }
        }
      });

      $('#status').editable();

      $('#group').editable({
        showbuttons: false
      });

      $('#vacation').editable({
        datepicker: {
          todayBtn: 'linked'
        }
      });

      $('#dob').editable();

      $('#event').editable({
        placement: 'right',
        combodate: {
          firstItem: 'name'
        }
      });

      $('#meeting_start').editable({
        format: 'yyyy-mm-dd hh:ii',
        viewformat: 'dd/mm/yyyy hh:ii',
        validate: function(v) {
          if (v && v.getDate() == 10) return 'Day cant be 10!';
        },
        datetimepicker: {
          todayBtn: 'linked',
          weekStart: 1
        }
      });

      $('#comments').editable({
        showbuttons: 'bottom'
      });

      $('#note').editable();
      $('#pencil').click(function(e) {
        e.stopPropagation();
        e.preventDefault();
        $('#note').editable('toggle');
      });

      $('#state').editable({
        source: ["Alabama", "Alaska", "Arizona", "Arkansas", "California", "Colorado", "Connecticut", "Delaware", "Florida", "Georgia", "Hawaii", "Idaho", "Illinois", "Indiana", "Iowa", "Kansas", "Kentucky", "Louisiana", "Maine", "Maryland", "Massachusetts", "Michigan", "Minnesota", "Mississippi", "Missouri", "Montana", "Nebraska", "Nevada", "New Hampshire", "New Jersey", "New Mexico", "New York", "North Dakota", "North Carolina", "Ohio", "Oklahoma", "Oregon", "Pennsylvania", "Rhode Island", "South Carolina", "South Dakota", "Tennessee", "Texas", "Utah", "Vermont", "Virginia", "Washington", "West Virginia", "Wisconsin", "Wyoming"]
      });

      $('#state2').editable({
        value: 'California',
        typeahead: {
          name: 'state',
          local: ["Alabama", "Alaska", "Arizona", "Arkansas", "California", "Colorado", "Connecticut", "Delaware", "Florida", "Georgia", "Hawaii", "Idaho", "Illinois", "Indiana", "Iowa", "Kansas", "Kentucky", "Louisiana", "Maine", "Maryland", "Massachusetts", "Michigan", "Minnesota", "Mississippi", "Missouri", "Montana", "Nebraska", "Nevada", "New Hampshire", "New Jersey", "New Mexico", "New York", "North Dakota", "North Carolina", "Ohio", "Oklahoma", "Oregon", "Pennsylvania", "Rhode Island", "South Carolina", "South Dakota", "Tennessee", "Texas", "Utah", "Vermont", "Virginia", "Washington", "West Virginia", "Wisconsin", "Wyoming"]
        }
      });

      $('#fruits').editable({
        pk: 1,
        limit: 3,
        source: [{
          value: 1,
          text: 'banana'
        }, {
          value: 2,
          text: 'peach'
        }, {
          value: 3,
          text: 'apple'
        }, {
          value: 4,
          text: 'watermelon'
        }, {
          value: 5,
          text: 'orange'
        }]
      });

      $('#address').editable({
        url: '/post',
        value: {
          city: "Moscow",
          street: "Lenina",
          building: "12"
        },
        validate: function(value) {
          if (value.city == '') return 'city is required!';
        },
        display: function(value) {
          if (!value) {
            $(this).empty();
            return;
          }
          var html = '<b>' + $('<div>').text(value.city).html() + '</b>, ' + $('<div>').text(value.street).html() + ' st., bld. ' + $('<div>').text(value.building).html();
          $(this).html(html);
        }
      });

      $('#user .editable').on('hidden', function(e, reason) {
        if (reason === 'save' || reason === 'nochange') {
          var $next = $(this).closest('tr').next().find('.editable');
          if ($('#autoopen').is(':checked')) {
            setTimeout(function() {
              $next.editable('show');
            }, 300);
          } else {
            $next.focus();
          }
        }
      });

    };
    XEdit();

  });
  </script>
  <!-- END: PAGE SCRIPTS -->

</body>

</html>
