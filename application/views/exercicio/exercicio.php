<div ng-controller="exercicio">
 
  <!-- inicio do formulario -->
  <form name="cadastro">

    <!-- Start: Content-Wrapper  controla o conteudo-->
  <section id="content_wrapper">
    <!-- Begin: Content -->
    <section id="content" class="table-layout animated fadeIn">

      <!-- begin: .tray-center -->
        <div class="tray tray-center">

          <div class="mw1000 center-block">

           
            <!-- Begin: Admin Form -->
            <div class="admin-form">

                <div class="panel heading-border">
              
              <div class="panel-body bg-light">
                <form method="post" action="" id="form-ui">
                              
                <div id="exercicio" ng-show="mostrar == 'cadastroExercicio'">
			            <div class="row">
                   <div class="col-md-2"> 
                      <button class="btn btn-danger" id="cancelarExercicio" ng-click="cancelarExercicio()">Cancelar &nbsp;<span class="imoon imoon-cancel-circle"></span></button>
                    </div>  
                    <div class="col-md-2"> 
                      <button class="btn btn-success" id="salvarExercicio" ng-click="salvarExercicio()" ng-disabled="cadastro.$invalid">Salvar&nbsp;<i class="fa fa-save"></i></button>
                    </div>
                  </div> 	
        				  <div class="section-divider mb40" id="spy2">
        				    <span>Cadastro de Exercícios</span>
        				  </div>

        				  <div class="row">
        				    <div class="col-md-8">
        				      <label ng-hide="mostranomeObrigatorio" style="color:red">
        				        Este campo é de preenchimento obrigatório
        				      </label>
        				    </div> 
        				  </div>
        				  <div class="row">
        				    <div class="col-md-6">
        				      <div class="section">
        				        <label for="">Exercício</label>
        				        <input ng-model="exercicio.exercicio"  type="text" class="form-control" placeholder="Digite o nome do exercício">
        				      </div>
        				    </div>
                    <div class="col-md-6">
                      <div class="section">
                          <label for="">Tipo de Exercício</label>
                          <input ng-model="exercicio.tipoExercicio"  type="text" class="form-control"  placeholder="Digite o tipo de exercicío"
                        ng-keyup="autoTipo(tipoExercicio)" uib-typeahead="autoTipo as autoTipo.tipoExercicio for autoTipo in autoTipos | filter:$viewValue | limitTo:8">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="section">
                        <label for="">Região Trabalhada</label>
                        <input ng-model="exercicio.regiaoTrabalhada"  type="text" class="form-control"  placeholder="Digite a região do corpo que o exercício irá trabalhar"
                      ng-keyup="autoRegiao(regiaoTrabalhada)" uib-typeahead="autoRegiao as autoRegiao.regiaoTrabalhada for autoRegiao in autoRegioes | filter:$viewValue | limitTo:8">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="section">
                        <label for="">Aparelho</label>
                        <input ng-model="exercicio.aparelho"  type="text" class="form-control"  placeholder="Digite o nome do aparelho do exercício"
                       ng-keyup="autoAparelho(aparelho)" uib-typeahead="autoAparelho as autoAparelho.aparelho for autoAparelho in autoAparelhos | filter:$viewValue | limitTo:8">
                      </div>
                    </div>
                  </div>  

            			  <!-- Text Areas -->
        				  <div class="row">
        				    <div class="col-md-12">
        				      <div class="section">
        				        <label class="field prepend-icon">
        				          <textarea ng-model="pessoa.observacao" class="gui-textarea" id="observacao" name="observacao" placeholder="Digite uma Observação"></textarea>
        				          <label for="comment" class="field-icon">
        				            <i class="fa fa-comments"></i>
        				          </label>
        				          <span class="input-footer">
        				            Utilize esse campo para digitar observações para o cadastro
        				          </span>
        				        </label>
        				      </div>
        				    </div>
        				  </div>
        				</div> 
		

                                    
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

                 <div ng-show="mostrar == 'mostralistaExercicio'"> 
                  <div class="section-divider mb40">
                    <span>Lista de Exercícios</span>
                  </div>

                  <?php
                    session_start();
                    $conexao = mysqli_connect('127.0.0.1', 'root', '', 'academia');

                    // seleciona a permissao de cadastrar exercicio para esse usuário
                    $sql = mysqli_query($conexao, "SELECT * FROM usuario u 
                    JOIN usuario_permissao up on u.idusuario = up.idusuario
                    JOIN permissao p on up.idpermissao = p.idpermissao
                    WHERE u.idusuario = '{$_SESSION["iduser"]}'
                    AND  p.permissao = 'exercicio'");
           
                    $retornoExercicio = mysqli_fetch_assoc($sql);

                    if ($retornoExercicio['cadastrar'] == 1) 
                    {

                      ?> 
                        <div class="row">
                          <div class="col-md-2">
                            <button ng-click="novoExercicio()" class="button btn-primary">Novo&nbsp;<i class="fa fa-plus"></i></button>
                          </div>
                        </div>
                      <?php
                    }
                  ?>      
                  <br>
                  <div class="row">
                    <div class="col-md-5">
                     <input ng-model="exercicio.buscarExercicio"  type="text" class="form-control"  placeholder="Digite o nome do exercicio para a busca"
                        ng-keyup="autoExercicio(buscarExercicio)" uib-typeahead="autoExercicio as autoExercicio.exercicio for autoExercicio in autoExercicios | filter:$viewValue | limitTo:8">
                    </div>
                    
                    <div class="col-md-2">
                      <button ng-click="pesquisarExercicio()"  class="button btn-primary">Buscar&nbsp;<i class="fa fa-search"></i></button>
                    </div>
                  </div>
                  <br><br>

                  <div ng-hide="mostraListaPessoa">
                    <table  class="table table-bordered table-striped table-hover">
                      <tr>
                        <th>Id</th>
                        <th>Exercício</th>
                        <th>Aparelho</th>
                        <th>Região Trabalhada</th>
                        <th>Tipo de Exercício</th>
                        <?php
                          if ($retornoExercicio['alterar'] == 1) 
                          {

                            ?>
                              <th>Alterar</th>
                            <?php
                          }  
                        ?>

                      </tr>
                      <tr dir-paginate="exercicio in exercicios|itemsPerPage:7">
                        <td>{{exercicio.idexercicio}}</td>
                        <td>{{exercicio.exercicio}}</td>
                        <td>{{exercicio.aparelho}}</td>
                        <td>{{exercicio.regiaoTrabalhada}}</td>
                        <td>{{exercicio.tipoExercicio}}</td>
                        <?php
                          if ($retornoExercicio['alterar'] == 1) 
                          {

                            ?>
                              <td>
                                <button class="btn btn-warning" ng-click="editar(exercicio)">Alterar &nbsp;<span class="icon-write"></span></button>
                              </td>
                            <?php
                          }
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


            </div>

          </div>
        </div>
        <!-- end: .tray-center -->


      </section>
      <!-- End: Content -->

    </section>

    

  </div>
  <!-- End: Main -->

  <!-- BEGIN: PAGE SCRIPTS -->

  <script src="vendor/jquery/jquery-1.11.1.min.js"></script>
  <script src="vendor/jquery/jquery_ui/jquery-ui.min.js"></script>
  
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

    $("#cancelarExercicio").addClass("btn btn-danger");
    $("#salvarExercicio").addClass("btn btn-success");

    
    // Form Switcher
    $('#form-switcher > button').on('click', function() {
      var btnData = $(this).data('form-layout');
      var btnActive = $('#form-elements-pane .admin-form.active');

      // Remove any existing animations and then fade current form out
      btnActive.removeClass('slideInUp').addClass('animated fadeOutRight animated-shorter');
      // When above exit animation ends remove leftover classes and animate the new form in
      btnActive.one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
        btnActive.removeClass('active fadeOutRight animated-shorter');
        $('#' + btnData).addClass('active animated slideInUp animated-shorter')
      });
    });

    // Cache several DOM elements
    var pageHeader = $('.content-header').find('b');
    var adminForm = $('.admin-form');
    var options = adminForm.find('.option');
    var switches = adminForm.find('.switch');
    var buttons = adminForm.find('.button');
    var Panel = adminForm.find('.panel');

    // Form Skin Switcher
    $('#skin-switcher a').on('click', function() {
      var btnData = $(this).data('form-skin');

      $('#skin-switcher a').removeClass('item-active');
      $(this).addClass('item-active')

      adminForm.each(function(i, e) {
        var skins = 'theme-primary theme-info theme-success theme-warning theme-danger theme-alert theme-system theme-dark';
        var panelSkins = 'panel-primary panel-info panel-success panel-warning panel-danger panel-alert panel-system panel-dark';
        $(e).removeClass(skins).addClass('theme-' + btnData);
        Panel.removeClass(panelSkins).addClass('panel-' + btnData);
        pageHeader.removeClass().addClass('text-' + btnData);
      });

      $(options).each(function(i, e) {
        if ($(e).hasClass('block')) {
          $(e).removeClass().addClass('block mt15 option option-' + btnData);
        } else {
          $(e).removeClass().addClass('option option-' + btnData);
        }
      });
      $(switches).each(function(i, ele) {
        if ($(ele).hasClass('switch-round')) {
          if ($(ele).hasClass('block')) {
            $(ele).removeClass().addClass('block mt15 switch switch-round switch-' + btnData);
          } else {
            $(ele).removeClass().addClass('switch switch-round switch-' + btnData);
          }
        } else {
          if ($(ele).hasClass('block')) {
            $(ele).removeClass().addClass('block mt15 switch switch-' + btnData);
          } else {
            $(ele).removeClass().addClass('switch switch-' + btnData);
          }
        }

      });
      buttons.removeClass().addClass('button btn-' + btnData);
    });

    setTimeout(function() {
      adminForm.addClass('theme-primary');
      Panel.addClass('panel-primary');
      pageHeader.addClass('text-primary');

      $(options).each(function(i, e) {
        if ($(e).hasClass('block')) {
          $(e).removeClass().addClass('block mt15 option option-primary');
        } else {
          $(e).removeClass().addClass('option option-primary');
        }
      });
      $(switches).each(function(i, ele) {

        if ($(ele).hasClass('switch-round')) {
          if ($(ele).hasClass('block')) {
            $(ele).removeClass().addClass('block mt15 switch switch-round switch-primary');
          } else {
            $(ele).removeClass().addClass('switch switch-round switch-primary');
          }
        } else {
          if ($(ele).hasClass('block')) {
            $(ele).removeClass().addClass('block mt15 switch switch-primary');
          } else {
            $(ele).removeClass().addClass('switch switch-primary');
          }
        }
      });
      buttons.removeClass().addClass('button btn-primary');
    }, 800);

  });
  </script>
  <!-- END: PAGE SCRIPTS -->  




