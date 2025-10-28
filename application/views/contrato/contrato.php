<div ng-controller="contrato">
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

                  <?php include_once("form_contrato.php"); ?>
                  

                  <div ng-hide="mostraListaContrato">	
	                  <div class="section row mbn">

	                  	<div>
	                      <div  class="section-divider mb40">
	                        <span>Lista de Contratos</span>
	                      </div>
	                      <br>
	                      <div class="row">
	                      	<div class="col-md-2">
	                      		<?php
	                            	session_start();
						            $conexao = mysqli_connect('127.0.0.1', 'root', '', 'academia');

						            // seleciona a permissao de cadastrar contratos para esse usuário
						            $sql = mysqli_query($conexao, "SELECT * FROM usuario u 
						            JOIN usuario_permissao up on u.idusuario = up.idusuario
						            JOIN permissao p on up.idpermissao = p.idpermissao
						            WHERE u.idusuario = '{$_SESSION["iduser"]}'
						            AND  p.permissao = 'contrato'");
						   
						            $retornoContrato = mysqli_fetch_assoc($sql);

						            if ($retornoContrato['cadastrar'] == 1) 
						            {

						              ?> 
	                            		<button class="btn btn-success" ng-click="addContrato()">Novo Contrato&nbsp;  <i class="fa fa-plus"></i>
			                                </button>
	                            	  <?php
	                            	}  
	                            ?> 

	                      	</div>
	                      </div>
	                      
	                      <br>
	                      <div class="row">
	                             
	                        <div class="col-md-5">
	                          <label for="firstname" class="field prepend-icon">
	                            <input ng-model="contrato.buscarContrato"  type="text" class="gui-input" placeholder="Digite o nome do contrato para a busca"
	                            ng-keyup="autoContrato(contrato.buscarContrato)" uib-typeahead="autoContrato as autoContrato.nome for autoContrato in autoContratos | filter:$viewValue | limitTo:8">
	                            <label for="firstname" class="field-icon">
	                              <i class="fa fa-user"></i>
	                            </label>
	                          </label>
	                        </div>
	                        <div class="col-md-2">
	                          <div class="section admin-widgets-page"> 
	                            <label for="datepicker1" class="field prepend-icon">
	                              <input ng-model="contrato.buscarDataContrato1" type="text" class="gui-input"
	                              onkeypress="mascaraData(this, event)"
	                              placeholder="Data do cadastro do contrato 1">
	                              <label class="field-icon">
	                                <i class="fa fa-calendar-o"></i>
	                              </label>
	                            </label>
	                          </div>
	                        </div>
	                        <div class="col-md-2">
	                          <div class="section admin-widgets-page"> 
	                            <label for="datepicker1" class="field prepend-icon">
	                              <input ng-model="contrato.buscarDataContrato2" type="text" class="gui-input"
	                              onkeypress="mascaraData(this, event)"
	                              placeholder="Data do cadastro do contrato 2">
	                              <label class="field-icon">
	                                <i class="fa fa-calendar-o"></i>
	                              </label>
	                            </label>
	                          </div>
	                        </div>
	                        <div class="col-md-2">
	                          <button ng-click="pesquisarContrato()" class="button btn-primary">Buscar&nbsp;<i class="fa fa-search"></i></button>
	                        </div>
	                      </div>
	                      <br><br>

	                      <div>
	                        <table  class="table table-bordered table-striped table-hover">
	                          <tr>
	                          
	                            <th>Nome</th>
	                            <th>Imprimir</th>
	                            
	                            <?php
	                            	if ($retornoContrato['alterar'] == 1) 
						            {

						              ?> 
	                            		<th>Alterar</th>
	                            	  <?php
	                            	}  
	                            ?>  	
	                            
	                          </tr>
	                          <tr dir-paginate="contrato in contratos|itemsPerPage:7">
	                           	                            
	                            <td>{{contrato.nome}}</td>
	                            <td>
	                            	<button class="btn btn-info" ng-click="imprimirContrato(contrato)">
	                            		Imprimir &nbsp;
	                            		<span class="glyphicon glyphicon-print"></span>
	                            	</button>
	                            </td>
	                            <?php
	                            	if ($retornoContrato['alterar'] == 1) 
						            {

						              ?> 
			                            <td>
			                                <button class="btn btn-warning" ng-click="editar(contrato)">Alterar&nbsp; <span class="icon-write"></span>
			                                </button>
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
	                      </div> 
	                    </div> <!-- fim da div do lista alunos-->
	                </div>    

                  </div>

                  <!--  dialog do validar contrato -->  
		            <script type="text/ng-template" id="dialogValidaContrato">
		              <div class="ngdialog-message">
		                  <h3>{{validaContrato}}</h3>
		                  <p ng-show="theme">Test content for <code>{{theme}}</code></p>
		              </div>
		              <div class="ngdialog-buttons">
		                  <button type="button" class="ngdialog-button ngdialog-button-primary" ng-click="okValidaContrato()">OK</button>
		              </div>
		            </script>

		            <!--  dialog de sucesso de cadastro -->  
		            <script type="text/ng-template" id="dialogCadastrado">
		              <div class="ngdialog-message">
		                  <h3>{{cadastrado}}</h3>
		                  <p ng-show="theme">Test content for <code>{{theme}}</code></p>
		              </div>
		              <div class="ngdialog-buttons">
		                  <button type="button" class="ngdialog-button ngdialog-button-primary" ng-click="okValidaContrato()">OK</button>
		              </div>
		            </script>

		            <!--  dialog do cancelar contrato -->
                    <script type="text/ng-template" id="dialogcancelarContrato">
                      <div class="ngdialog-message">
                          <h3>Tem certeza que deseja cancelar essa operação?</h3>
                          <p ng-show="theme">Test content for <code>{{theme}}</code></p>
                      </div>
                      <div class="ngdialog-buttons">
                          <button type="button" class="ngdialog-button ngdialog-button-danger"  ng-click="cancelcancelarContrato()">Não</button>
                          <button type="button" class="ngdialog-button ngdialog-button-primary" ng-click="confirmcancelarContrato()">Sim</button>
                      </div>
                    </script>

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