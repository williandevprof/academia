<div ng-controller="nutricao">
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

                  <?php include_once("form_nutricao.php"); ?>
                  <?php include_once("lista_nutricao.php"); ?>

                  <div ng-hide="mostraListaAluno">  
                    <div class="section row mbn">

                      <div>
                        <div  class="section-divider mb40">
                          <span>Lista de Alunos Para Planos de nutrição</span>
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
                              <?php
                                session_start();
                                $conexao = mysqli_connect('127.0.0.1', 'root', '', 'academia');

                                // seleciona a permissao de cadastrar planos de nutrição para esse usuário
                                $sql = mysqli_query($conexao, "SELECT * FROM usuario u 
                                JOIN usuario_permissao up on u.idusuario = up.idusuario
                                JOIN permissao p on up.idpermissao = p.idpermissao
                                WHERE u.idusuario = '{$_SESSION["iduser"]}'
                                AND  p.permissao = 'plano de nutricao'");
                       
                                $retornoNutricao = mysqli_fetch_assoc($sql);

                                if ($retornoNutricao['cadastrar'] == 1) 
                                {

                                  ?> 
                                    <th>Novo</th>
                                  <?php
                                }
                              ?>      
                              <th>Listar</th>
                              
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
                              <?php
                                if ($retornoNutricao['cadastrar'] == 1) 
                                  {

                                    ?>
                                      <td>
                                          <button class="btn btn-success" ng-click="addPlano(aluno, image)">Novo Plano&nbsp;  <i class="fa fa-plus"></i>
                                          </button>
                                      </td>
                                    <?php
                                  }
                              ?>  
                              <td>
                                  <button class="btn btn-info" ng-click="listaNutricao(aluno, image)">Listar Planos de Nutrição&nbsp;  <i class="fa fa-search"></i>
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
                  </div>    

                  </div>

                    <!--  dialog do validar avaliação -->  
                  <script type="text/ng-template" id="dialogValidaNutricao">
                    <div class="ngdialog-message">
                        <h3>{{validaNutricao}}</h3>
                        <p ng-show="theme">Test content for <code>{{theme}}</code></p>
                    </div>
                    <div class="ngdialog-buttons">
                        <button type="button" class="ngdialog-button ngdialog-button-primary" ng-click="okValidaNutricao()">OK</button>
                    </div>
                  </script> 

                    <!--  dialog de cadastrado -->  
                  <script type="text/ng-template" id="dialogCadastradoAvaliacaoFisica">
                    <div class="ngdialog-message">
                        <h3>{{cadastrado}}</h3>
                        <p ng-show="theme">Test content for <code>{{theme}}</code></p>
                    </div>
                    <div class="ngdialog-buttons">
                        <button type="button" class="ngdialog-button ngdialog-button-primary" ng-click="okCadastrado()">OK</button>
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