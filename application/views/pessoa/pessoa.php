<div ng-controller="pessoa">
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
                  
                  <div ng-show="linha_cadastro">
                    <div class="row">
                      <div class="col-md-2" 
                        ng-click="mudaFormulario('pessoa')"
                        ng-class="{linha_ativa :mostrar == 'pessoa'}">
                        <div><div class="circle">1</div>Pessoa
                        <span class="glyphicon glyphicon-user"></span></div>
                        
                      </div>
                      <div class="col-md-2" 
                         ng-click="mudaFormulario('contato')" 
                         ng-class="{linha_ativa :mostrar == 'contato'}">
                        <div><div class="circle">2</div>Contato
                        <i class="fa fa-phone"></i></span></div>
                        
                      </div>
                      <div class="col-md-2" 
                        ng-click="mudaFormulario('endereco')"
                        ng-class="{linha_ativa :mostrar == 'endereco'}">
                        <div><div class="circle">3</div>Endereço
                         <i class="fa fa-map-marker"></i></div>
                     
                      </div>
                      <div class="col-md-2" 
                        ng-click="mudaFormulario('tipopessoa')"
                        ng-class="{linha_ativa :mostrar == 'tipopessoa'}">
                        <div><div class="circle">4</div>Tipo
                        <i class="fa fa-user"></i></div>
                       
                      </div>
                      <div class="col-md-2" 
                        ng-click="mudaFormulario('usuario')"
                        ng-class="{linha_ativa :mostrar == 'usuario'}">
                        <div><div class="circle">5</div>Usuário
                        <i class="fa fa-user"></i></div>
                       
                      </div> 
                      <div class="col-md-2" 
                        ng-click="mudaFormulario('parq')"
                        ng-class="{linha_ativa :mostrar == 'parq'}">
                        <div><div class="circle">6</div>Parq
                         <span class="glyphicon glyphicon-book"></span></div>
                       
                      </div> 
                       
                    </div>
                  </div>

                  <div class="section row mbn">
                  
                    <div ng-show="mostraBotoesPessoa">
                      <br> 
                      <div class="row">
                       
                          <button  ng-show="btnAnterior" ng-click="anterior()" class="btnAnterior button btn-primary"> <<  Anterior</button>
                        
                        
                          <button ng-show="mostrabntCancelarPessoa" class="btncancelar btn btn-danger" id="cancelarPessoa" ng-click="cancelarPessoa()">Cancelar &nbsp;<span class=" imoon imoon-cancel-circle"></span></button>
                       
                          &nbsp;&nbsp;&nbsp;&nbsp;
                           
                          <button ng-show="mostrabntSalvar" class="btnsalvar btn btn-success" id="salvarPessoa" ng-click="salvarPessoa()" ng-disabled="cadastro.$invalid">Salvar&nbsp;<i class="fa fa-save"></i></button>
                        
                        
                          <button ng-show="btnProximo" ng-click="proximo()" class="btnProximo button btn-primary">Próximo >></button>
                        
                        
                      </div> 
                    </div>
                    
                    
                    <!-- faz a inclusão do formulario tipo de pessoa-->
                    <?php include_once("tipopessoa.php"); ?>
                    
                    <!-- faz a inclusão do formulário de pessoa -->
                    <?php include_once("pessoa_dados.php"); ?>
                
                    <!-- faz a inclusão do formulario de usuário-->
                    <?php include_once("usuario.php"); ?>

                    <!-- essa div é para mostrar ou não esses dados
                     de acordo com a aba que estiver sendo mostrada -->
                    <div id="pessoas" ng-show="mostrarPessoas">
                      <!-- Inclusão do formulario de aluno --> 
                      <?php include_once("aluno.php"); ?>
                      
                       <!-- Inclusão do formulario de funcionario --> 
                      <?php include_once("funcionario.php"); ?>
                     
                      <!-- Inclusão do formulario de fornecedor --> 
                      <?php include_once("fornecedor.php"); ?>
                    </div>

                     <!-- faz a inclusão dos campos de contato -->
                    <?php include_once("contato.php"); ?> 

                    <!-- faz a inclusão dos campos de endereço -->
                    <?php include_once("endereco.php"); ?> 
                    
                    <!-- Inclusão do formulario de parq --> 
                    <?php include_once("parq_perguntas.php"); ?>

                     <!-- Inclusão do contrato --> 
                    <?php include_once("aluno_contrato.php"); ?>

                                       
                    

                    <!--  dialog do cancelar cadastro -->
                    <script type="text/ng-template" id="dialogcancelarPessoa">
                      <div class="ngdialog-message">
                          <h3>Tem certeza que deseja cancelar essa operação?</h3>
                          <p ng-show="theme">Test content for <code>{{theme}}</code></p>
                      </div>
                      <div class="ngdialog-buttons">
                          <button type="button" class="ngdialog-button ngdialog-button-danger"  ng-click="cancelcancelarPessoa()">Não</button>
                          <button type="button" class="ngdialog-button ngdialog-button-primary" ng-click="confirmcancelarPessoa()">Sim</button>
                      </div>
                    </script>

                    <!--  dialog do cancelar cadastro do contrato -->
                    <script type="text/ng-template" id="dialogcancelarCadastroContrato">
                      <div class="ngdialog-message">
                          <h3>Tem certeza que deseja cancelar essa operação?</h3>
                          <p ng-show="theme">Test content for <code>{{theme}}</code></p>
                      </div>
                      <div class="ngdialog-buttons">
                          <button type="button" class="ngdialog-button ngdialog-button-danger"  ng-click="cancelcancelarCadastroContrato()">Não</button>
                          <button type="button" class="ngdialog-button ngdialog-button-primary" ng-click="confirmcancelarCadastroContrato()">Sim</button>
                      </div>
                    </script>

                      <!--  dialog do validar cadastro pessoa -->  
                    <script type="text/ng-template" id="dialogValidaUsuario">
                      <div class="ngdialog-message">
                          <h3>{{validaUsuario}}</h3>
                          <p ng-show="theme">Test content for <code>{{theme}}</code></p>
                      </div>
                      <div class="ngdialog-buttons">
                          <button type="button" class="ngdialog-button ngdialog-button-primary" ng-click="okValidaUsuario()">OK</button>
                      </div>
                    </script>

                      <!--  dialog de sucesso de cadastro -->  
                    <script type="text/ng-template" id="dialogCadastrado">
                      <div class="ngdialog-message">
                          <h3>{{cadastrado}}</h3>
                          <p ng-show="theme">Test content for <code>{{theme}}</code></p>
                      </div>
                      <div class="ngdialog-buttons">
                          <button type="button" class="ngdialog-button ngdialog-button-primary" ng-click="okValidaUsuario()">OK</button>
                      </div>
                    </script>

                    <!--  dialog do validar aluno contrato -->  
                    <script type="text/ng-template" id="dialogValidaAlunoContrato">
                      <div class="ngdialog-message">
                          <h3>{{ValidaAlunoContrato}}</h3>
                          <p ng-show="theme">Test content for <code>{{theme}}</code></p>
                      </div>
                      <div class="ngdialog-buttons">
                          <button type="button" class="ngdialog-button ngdialog-button-primary" ng-click="okValidaAlunoContrato()">OK</button>
                      </div>
                    </script>

                    <!--  dialog do cadastrado aluno contrato -->  
                    <script type="text/ng-template" id="dialogCadastradoAlunoContrato">
                      <div class="ngdialog-message">
                          <h3>{{CadastradoAlunoContrato}}</h3>
                          <p ng-show="theme">Test content for <code>{{theme}}</code></p>
                      </div>
                      <div class="ngdialog-buttons">
                          <button type="button" class="ngdialog-button ngdialog-button-primary" ng-click="okCadastradoAlunoContrato()">OK</button>
                      </div>
                    </script>

                    


                    <div ng-hide="mostratituloPessoaLista" class="section-divider mb40">
                      <span>Lista de Pessoas</span>
                    </div>

                    <?php 
                    $conexao = mysqli_connect('127.0.0.1', 'root', '', 'academia');

                    // seleciona a permissao de cadastrar pessoa para esse usuário
                    $sql = mysqli_query($conexao, "SELECT * FROM usuario u 
                    JOIN usuario_permissao up on u.idusuario = up.idusuario
                    JOIN permissao p on up.idpermissao = p.idpermissao
                    WHERE u.idusuario = '{$_SESSION["iduser"]}'
                    AND  p.permissao = 'pessoa'");
           
                    $retornoPessoa = mysqli_fetch_assoc($sql);

                    if ($retornoPessoa['cadastrar'] == 1)
                    {

                      ?>

                        <div class="row">
                          <div class="col-md-2">
                            <button ng-hide="mostrabtnovaPessoa" ng-click="novaPessoa()" class="button btn-primary">Novo&nbsp;<i class="fa fa-plus"></i></button>
                          </div>
                        </div>

                      <?php
                      
                    }

                    ?>  
                    <br>
                    <div class="row">
                      <div class="col-md-2">
                        <div class="section">
                          <label class="field select" ng-hide="mostraInputTipoPessoa">
                            <select ng-model="pessoa.buscarTipoPessoa" id="tipoPessoa" name="tipoPessoa">
                              <option value="">Tipo de Pessoa</option>
                              <option value="Aluno">Aluno</option>
                              <option value="Funcionario">Funcionário</option>
                              <option value="Fornecedor">Fornecedor</option>
                            </select>
                            <i class="arrow"></i>
                          </label>
                        </div>
                      </div> 
                      <div class="col-md-5">
                        <label for="firstname" ng-hide="mostrainputbuscarPessoa" class="field prepend-icon">
                          <input ng-model="pessoa.buscarPessoa"  type="text" name="buscarPessoa" id="buscarPessoa" class="gui-input" placeholder="Digite o nome da pessoa para a busca"
                          ng-keyup="autoPessoa(buscarPessoa)" uib-typeahead="autoPessoa as autoPessoa.nome for autoPessoa in autoPessoas | filter:$viewValue | limitTo:8">
                          <label for="firstname" class="field-icon">
                            <i class="fa fa-user"></i>
                          </label>
                        </label>
                      </div>
                      <div class="col-md-3">
                        <div class="section admin-widgets-page" ng-hide="mostrainputbuscarDataNascimento"> 
                          <label for="datepicker1" class="field prepend-icon">
                            <input ng-model="pessoa.buscarDataNascimento" type="text" id="buscarDataNascimento" name="buscarDataNascimento" class="gui-input"
                            onkeypress="mascaraData(this, event)"
                            placeholder="Data de Nascimento">
                            <label class="field-icon">
                              <i class="fa fa-calendar-o"></i>
                            </label>
                          </label>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <button ng-click="pesquisarPessoa()"  ng-hide="mostrabtnpesquisarPessoa" class="button btn-primary">Buscar&nbsp;<i class="fa fa-search"></i></button>
                      </div>
                    </div>
                    <br><br>

                    <div ng-hide="mostraListaPessoa">
                      <table  class="table table-bordered table-striped table-hover">
                        <tr>
                          <th><center>Foto</center></th>
                          <th>Id</th>
                          <th>Nome</th>
                          <th>Telefone</th>
                          <th>Email</th>
                          <th>Tipo de Pessoa</th>
                          <?php
                          if ($retornoPessoa['alterar'] == 1)
                          {

                            ?>  
                              <th>Alterar</th>
                            <?php
                            }
                          ?>    

                          <th>Par Q</th>
                          <?php

                            // seleciona a permissao de visualizar contrato aluno para esse usuário
                            $sql = mysqli_query($conexao, "SELECT * FROM usuario u 
                            JOIN usuario_permissao up on u.idusuario = up.idusuario
                            JOIN permissao p on up.idpermissao = p.idpermissao
                            WHERE u.idusuario = '{$_SESSION["iduser"]}'
                            AND  p.permissao = 'contrato aluno'");
                   
                            $retornoContrato_aluno = mysqli_fetch_assoc($sql);

                            if ($retornoContrato_aluno['visualizar'] == 1)
                            {

                            ?> 

                              <th>Contrato</th>
                             <?php
                            }
                          ?>    
                        </tr>
                        <tr dir-paginate="pessoa in pessoas|itemsPerPage:7">
                          <td>
                            <center>
                              <div ng-repeat="image in images">
                                <!-- Lista a foto se o idpessoa de pessoa for igual o idpessoa-->
                                <img  ng-if="pessoa.idpessoa == image.idpessoa" style="width: 125px; height: 75px;" ng-src="../Academia/api_fotos/images/{{image.foto}}" ng-click="openImg($event, pessoa, image)">
                              </div> 
                            </center>  
                          </td>
                          <td>{{pessoa.idpessoa}}</td>
                          <td>{{pessoa.nome}}</td>
                          <td>{{pessoa.telefone}}</td>
                          <td>{{pessoa.email}}</td>
                          <td>
                            <span ng-if="pessoa.idaluno">Aluno</span>
                            <span ng-if="pessoa.idfuncionario">Funcionário</span>
                            <span ng-if="pessoa.idfornecedor">Fornecedor</span>
                          </td>
                          <?php
                          if ($retornoPessoa['alterar'] == 1)
                          {

                            ?>

                              <td>
                                <button class="btn btn-warning" ng-click="editar(pessoa)">Alterar &nbsp;<span class="icon-write"></span></button>
                              </td>
                          
                          <?php

                            }
                          ?>  
                          <td><button ng-if="pessoa.idaluno" class="btn btn-info" ng-click="imprimirParq(pessoa)">Par Q &nbsp;<span class="glyphicon glyphicon-print"></span></button></td>
                          
                          <?php
                            if ($retornoContrato_aluno['visualizar'] == 1)
                            {

                            ?> 

                              <td>
                                <button ng-if="pessoa.idaluno" class="btn btn-info" ng-click="gerarContrato(pessoa)">Contrato &nbsp;</button>
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
                      </div> <!-- fim da paginação-->
                      
                        
                    </div> <!-- fim da div que mostra a lista pessoa--> 
                  
                  </div>
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
           

  <style>
  /* demo page styles */
  body { min-height: 2300px; }
  
  .content-header b,
  .admin-form .panel.heading-border:before,
  .admin-form .panel .heading-border:before {
    transition: all 0.7s ease;
  }
  /* responsive demo styles */
  @media (max-width: 800px) {
    .admin-form .panel-body { padding: 18px 12px; }
    .option-group .option {	display: block; }
    .option-group .option + .option {	margin-top: 8px; }
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

    // codigo de encolher o menu  
    //$("#toggle_sidemenu_t").on('click', sidebarTopToggle);
    //$("#toggle_sidemenu_l").on('click', sidebarLeftToggle);
    //$("#toggle_sidemenu_r").on('click', sidebarRightToggle);


    $("#dataNascimento").datepicker(
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

    $("#buscarDataNascimento").datepicker(
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


    $("#dataAdmissao").datepicker(
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

    $("#dataPagamento").datepicker(
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

    $("#dataContratacao").datepicker(
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

    $("#dataRenovacao").datepicker(
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

</body>

</html>
