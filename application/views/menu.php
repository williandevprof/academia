<aside id="sidebar_left" class="nano nano-primary affix">

  <!-- Start: Sidebar Left Content -->
  <div class="sidebar-left-content nano-content">

    <!-- Start: Sidebar Header -->
    <header class="sidebar-header">

      <!-- Sidebar Widget - Menu (Slidedown) -->
      <div class="sidebar-widget menu-widget">
        <div class="row text-center mbn">
          <div class="col-xs-4">
            <a href="dashboard.html" class="text-primary" data-toggle="tooltip" data-placement="top" title="Dashboard">
              <span class="glyphicon glyphicon-home"></span>
            </a>
          </div>
          <div class="col-xs-4">
            <a href="pages_messages.html" class="text-info" data-toggle="tooltip" data-placement="top" title="Messages">
              <span class="glyphicon glyphicon-inbox"></span>
            </a>
          </div>
          <div class="col-xs-4">
            <a href="pages_profile.html" class="text-alert" data-toggle="tooltip" data-placement="top" title="Tasks">
              <span class="glyphicon glyphicon-bell"></span>
            </a>
          </div>
          <div class="col-xs-4">
            <a href="pages_timeline.html" class="text-system" data-toggle="tooltip" data-placement="top" title="Activity">
              <span class="fa fa-desktop"></span>
            </a>
          </div>
          <div class="col-xs-4">
            <a href="pages_profile.html" class="text-danger" data-toggle="tooltip" data-placement="top" title="Settings">
              <span class="fa fa-gears"></span>
            </a>
          </div>
          <div class="col-xs-4">
            <a href="pages_gallery.html" class="text-warning" data-toggle="tooltip" data-placement="top" title="Cron Jobs">
              <span class="fa fa-flask"></span>
            </a>
          </div>
        </div>
      </div>

      <!-- Sidebar Widget - Author (hidden)  -->
      <div class="sidebar-widget author-widget hidden">
        <div class="media">
          <a class="media-left" href="#">
            <img src="assets/img/avatars/3.jpg" class="img-responsive">
          </a>
          <div class="media-body">
            <div class="media-links">
               <a href="#" class="sidebar-menu-toggle">User Menu -</a> <a href="pages_login(alt).html">Logout</a>
            </div>
            <div class="media-author">Michael Richards</div>
          </div>
        </div>
      </div>

      <!-- Sidebar Widget - Search (hidden) -->
      <div class="sidebar-widget search-widget hidden">
        <div class="input-group">
          <span class="input-group-addon">
            <i class="fa fa-search"></i>
          </span>
          <input type="text" id="sidebar-search" class="form-control" placeholder="Search...">
        </div>
      </div>

    </header>
    <!-- End: Sidebar Header -->

    <?php
      $conexao = mysqli_connect('127.0.0.1', 'root', '', 'academia');

      // seleciona o usuario logado para ver se é aluno ou professor para personalizar o menu e verificar as permissões
      $sql = mysqli_query($conexao, "SELECT * FROM usuario u 
              LEFT JOIN pessoa p on u.idpessoa = p.idpessoa
              LEFT JOIN funcionario f on p.idpessoa = f.idpessoa
              LEFT JOIN aluno a on p.idpessoa = a.idpessoa
              WHERE u.idusuario = '{$_SESSION["iduser"]}'");
     
     $res = mysqli_fetch_assoc($sql);

     
     ?>
      
    <!-- Start: Sidebar Menu -->
    <ul class="nav sidebar-menu">
      <li class="sidebar-label pt20">Menu</li>
      <li>
        <a href="pages_calendar.html">
          <span class="fa fa-calendar"></span>
          <span class="sidebar-title">Calendar</span>
          <span class="sidebar-title-tray">
            <span class="label label-xs bg-primary">New</span>
          </span>
        </a>
      </li>
      <li>
        <a href="../README/index.html">
          <span class="glyphicon glyphicon-book"></span>
          <span class="sidebar-title">Documentation</span>
        </a>
      </li>
      <?php
        // verifica se é o usuario administrador para mostrar a 
       //opção de permissões de usuarios e relatórios de log
       if ($res['idusuario_grupo'] == 1)
       {
          ?>
            <li class="active">
              <a href="#/usuario">
                <span class="fa fa-user"></span>
                <span class="sidebar-title">Usuário</span>
              </a>
            </li>
            <li class="active">
              <a href="#/log">
                <span class="fa fa-user"></span>
                <span class="sidebar-title">Alterações no Sistema</span>
              </a>
            </li>
          <?php
       }
         // verifica se o usuário é um funcionário para verificar as permissões dentro do sistema
         if ($res['idfuncionario'])
         {
            // seleciona a permissao de pessoa para esse usuário
            $sql = mysqli_query($conexao, "SELECT * FROM usuario u 
              JOIN usuario_permissao up on u.idusuario = up.idusuario
              JOIN permissao p on up.idpermissao = p.idpermissao
              WHERE u.idusuario = '{$_SESSION["iduser"]}'
              AND  p.permissao = 'pessoa'");
     
              $retornoPessoa = mysqli_fetch_assoc($sql);

                                
            ?><li class="sidebar-label pt15">Exclusive Tools</li>

            <?php
            // verifica se tem a permissao para visualizar pessoa
              if ($retornoPessoa['visualizar'] == 1)
              {
                ?>
                  <li>
                    <a href="#/pessoa">
                      <span class="fa fa-user"></span>
                      <span class="sidebar-title">Pessoa</span>
                    </a>
                    
                  </li>
                
                <?php
              }
              
                     
              // seleciona a permissao de cadastrar contratos para esse usuário
              $sql = mysqli_query($conexao, "SELECT * FROM usuario u 
              JOIN usuario_permissao up on u.idusuario = up.idusuario
              JOIN permissao p on up.idpermissao = p.idpermissao
              WHERE u.idusuario = '{$_SESSION["iduser"]}'
              AND  p.permissao = 'contrato'");
     
              $retornoContrato = mysqli_fetch_assoc($sql);

              if ($retornoContrato['visualizar'] == 1) 
              {

                ?> 
          
                  <li>
                    <a  href="#/contrato">
                      <span class="glyphicon glyphicon-fire"></span>
                      <span class="sidebar-title">Contrato</span>
                    </a>
                    
                  </li>
                <?php
              } 

              // seleciona a permissao de cadastrar contratos para esse usuário
              $sql = mysqli_query($conexao, "SELECT * FROM usuario u 
              JOIN usuario_permissao up on u.idusuario = up.idusuario
              JOIN permissao p on up.idpermissao = p.idpermissao
              WHERE u.idusuario = '{$_SESSION["iduser"]}'
              AND  p.permissao = 'valores plano'");
     
              $retornoValoresPlano = mysqli_fetch_assoc($sql);

              if ($retornoValoresPlano['visualizar'] == 1) 
              {

                ?>   
            
                  <li>
                    <a  href="#/valores_planos">
                      <span class="glyphicon glyphicon-fire"></span>
                      <span class="sidebar-title">Valores Planos</span>
                    </a>
                  </li>
                <?php
              }
                
               // seleciona a permissao de parq para esse usuário
              $sql = mysqli_query($conexao, "SELECT * FROM usuario u 
              JOIN usuario_permissao up on u.idusuario = up.idusuario
              JOIN permissao p on up.idpermissao = p.idpermissao
              WHERE u.idusuario = '{$_SESSION["iduser"]}'
              AND  p.permissao = 'parq'");
     
              $retornoParq = mysqli_fetch_assoc($sql);

              if ($retornoParq['visualizar'] == 1)
              {
                ?>
                  <li>
                    <a href="#/parq">
                      <span class="glyphicon glyphicon-check"></span>
                      <span class="sidebar-title">Par Q</span>
                      <span class="caret"></span>
                    </a>
                    
                  </li>
                
                <?php
              }
              ?>

            

            <li class="sidebar-label pt20">Systems</li>

            <?php

               // seleciona a permissao de avaliação física para esse usuário
              $sql = mysqli_query($conexao, "SELECT * FROM usuario u 
              JOIN usuario_permissao up on u.idusuario = up.idusuario
              JOIN permissao p on up.idpermissao = p.idpermissao
              WHERE u.idusuario = '{$_SESSION["iduser"]}'
              AND  p.permissao = 'avaliacao fisica'");
     
              $retornoAvaliacao_Fisica = mysqli_fetch_assoc($sql);

              if ($retornoAvaliacao_Fisica['visualizar'] == 1)
              {
                ?>
                  <li>
                    <a  href="#/avaliacao_fisica">
                      <span class="fa fa-diamond"></span>
                      <span class="sidebar-title">Avaliações Físicas</span>
                    </a>
                  </li>
                
                <?php
              }
              
               // seleciona a permissao de plano de nutrição para esse usuário
              $sql = mysqli_query($conexao, "SELECT * FROM usuario u 
              JOIN usuario_permissao up on u.idusuario = up.idusuario
              JOIN permissao p on up.idpermissao = p.idpermissao
              WHERE u.idusuario = '{$_SESSION["iduser"]}'
              AND  p.permissao = 'plano de nutricao'");
     
              $retornoNutricao = mysqli_fetch_assoc($sql);

              if ($retornoNutricao['visualizar'] == 1)
              {
                ?>
                  <li>
                    <a  href="#/nutricao">
                      <span class="fa fa-diamond"></span>
                      <span class="sidebar-title">Planos de Nutrição</span>
                    </a>
                  </li>
                
                <?php
              }


              // seleciona a permissao de plano de treino para esse usuário
              $sql = mysqli_query($conexao, "SELECT * FROM usuario u 
              JOIN usuario_permissao up on u.idusuario = up.idusuario
              JOIN permissao p on up.idpermissao = p.idpermissao
              WHERE u.idusuario = '{$_SESSION["iduser"]}'
              AND  p.permissao = 'plano de treino'");
     
              $retornoTreino = mysqli_fetch_assoc($sql);

              if ($retornoTreino['visualizar'] == 1)
              {
                ?>
                  <li>
                    <a  href="#/treino">
                      <span class="fa fa-diamond"></span>
                      <span class="sidebar-title">Planos de Treinos</span>
                    </a>
                  </li>
                
                <?php
              }


              // seleciona a permissao de exercicio para esse usuário
              $sql = mysqli_query($conexao, "SELECT * FROM usuario u 
              JOIN usuario_permissao up on u.idusuario = up.idusuario
              JOIN permissao p on up.idpermissao = p.idpermissao
              WHERE u.idusuario = '{$_SESSION["iduser"]}'
              AND  p.permissao = 'exercicio'");
     
              $retornoExercicio = mysqli_fetch_assoc($sql);

              if ($retornoExercicio['visualizar'] == 1)
              {
                ?>
                  <li>
                    <a  href="#/exercicio">
                      <span class="fa fa-diamond"></span>
                      <span class="sidebar-title">Exercícios</span>
                    </a>
                  </li>
                
                <?php
              }

              // seleciona a permissao de região trabalhada para esse usuário
              $sql = mysqli_query($conexao, "SELECT * FROM usuario u 
              JOIN usuario_permissao up on u.idusuario = up.idusuario
              JOIN permissao p on up.idpermissao = p.idpermissao
              WHERE u.idusuario = '{$_SESSION["iduser"]}'
              AND  p.permissao = 'regiao trabalhada'");
     
              $retornoRegiao = mysqli_fetch_assoc($sql);

              if ($retornoRegiao['visualizar'] == 1)
              {
                ?>
                  <li>
                    <a  href="#/regiao_trabalhada">
                      <span class="fa fa-diamond"></span>
                      <span class="sidebar-title">Região Trabalhada</span>
                    </a>
                  </li>
                
                <?php
              }

               // seleciona a permissao de tipo de exercicio para esse usuário
              $sql = mysqli_query($conexao, "SELECT * FROM usuario u 
              JOIN usuario_permissao up on u.idusuario = up.idusuario
              JOIN permissao p on up.idpermissao = p.idpermissao
              WHERE u.idusuario = '{$_SESSION["iduser"]}'
              AND  p.permissao = 'tipo de exercicio'");
     
              $retornoTipo_Exercicio = mysqli_fetch_assoc($sql);

              if ($retornoTipo_Exercicio['visualizar'] == 1)
              {
                ?>
                   <li>
                    <a href="#/tipo_exercicio">
                      <span class="glyphicon glyphicon-shopping-cart"></span>
                      <span class="sidebar-title">Tipo de Exercicio</span>
                    </a>
                  </li>
                
                <?php
              }

              // seleciona a permissao de aparelho para esse usuário
              $sql = mysqli_query($conexao, "SELECT * FROM usuario u 
              JOIN usuario_permissao up on u.idusuario = up.idusuario
              JOIN permissao p on up.idpermissao = p.idpermissao
              WHERE u.idusuario = '{$_SESSION["iduser"]}'
              AND  p.permissao = 'aparelho'");
     
              $retornoAparelho = mysqli_fetch_assoc($sql);

              if ($retornoAparelho['visualizar'] == 1)
              {
                ?>
                  <li>
                    <a href="#/aparelho">
                      <span class="fa fa-envelope-o"></span>
                      <span class="sidebar-title">Aparelho</span>
                    </a>
                  </li>
                
                <?php
              }
            
              ?>
              

            <!-- sidebar resources -->
            <li class="sidebar-label pt20">Elements</li>

            <?php

            // seleciona a permissao de planos de treinos dos alunos
            // para esse usuário
              $sql = mysqli_query($conexao, "SELECT * FROM usuario u 
              JOIN usuario_permissao up on u.idusuario = up.idusuario
              JOIN permissao p on up.idpermissao = p.idpermissao
              WHERE u.idusuario = '{$_SESSION["iduser"]}'
              AND  p.permissao = 'alunos treinos'");
     
              $retornoAlunos_Treinos = mysqli_fetch_assoc($sql);

              if ($retornoAlunos_Treinos['visualizar'] == 1)
              {
                ?>
                  <li>
                    <a href="#/aluno">
                      <span class="glyphicon glyphicon-bell"></span>
                      <span class="sidebar-title">Alunos Planos de Treinos</span>
                    </a>
                  </li>
                
                <?php
              }
                      
         }
         // se o usuário for um aluno irá visualizar apenas
         // seus proprios treinos, planos de nutrição, avaliações físicas etc
         else if ($res['idaluno'])
         {
            ?>
            <li>
              <a href="#/meus_planos_nutricao">
                <span class="glyphicon glyphicon-bell"></span>
                <span class="sidebar-title">Meus Planos Nutricionais</span>
              </a>
            </li>
            <li>
              <a href="#/minhas_avaliacoes">
                <span class="glyphicon glyphicon-bell"></span>
                <span class="sidebar-title">Minhas Avaliações</span>
              </a>
            </li>
            <li>
              <a href="#/meus_treinos">
                <span class="glyphicon glyphicon-bell"></span>
                <span class="sidebar-title">Meus Treinos</span>
              </a>
            </li>
            <li>
              <a href="#/salvar_treinos">
                <span class="glyphicon glyphicon-bell"></span>
                <span class="sidebar-title">Salvar Treinos</span>
              </a>
            </li>
            <li>
              <a href="#/treinos_realizados">
                <span class="glyphicon glyphicon-bell"></span>
                <span class="sidebar-title">Treinos Realizados</span>
              </a>
            </li>
            <?php
          } // fim fo if
         
      ?>
      
      <li>
        <a class="accordion-toggle" href="#">
          <span class="glyphicon glyphicon-hdd"></span>
          <span class="sidebar-title">Form Elements</span>
          <span class="caret"></span>
        </a>
        <ul class="nav sub-nav">
          <li>
            <a href="form_inputs.html">
              <span class="fa fa-magic"></span> Basic Inputs </a>
          </li>
          <li>
            <a href="form_plugins.html">
              <span class="fa fa-bell-o"></span> Plugin Inputs
              <span class="label label-xs bg-primary">New</span>
            </a>
          </li>
          <li>
            <a href="form_editors.html">
              <span class="fa fa-clipboard"></span> Editors </a>
          </li>
          <li>
            <a href="form_treeview.html">
              <span class="fa fa-tree"></span> Treeview </a>
          </li>
          <li>
            <a href="form_nestable.html">
              <span class="fa fa-tasks"></span> Nestable </a>
          </li>
          <li>
            <a href="form_image-tools.html">
              <span class="fa fa-cloud-upload"></span> Image Tools
              <span class="label label-xs bg-primary">New</span>
            </a>
          </li>
          <li>
            <a href="form_uploaders.html">
              <span class="fa fa-cloud-upload"></span> Uploaders </a>
          </li>
          <li>
            <a href="form_notifications.html">
              <span class="fa fa-bell-o"></span> Notifications </a>
          </li>
          <li>
            <a href="form_content-sliders.html">
              <span class="fa fa-exchange"></span> Content Sliders </a>
          </li>
        </ul>
      </li>
      <li>
        <a class="accordion-toggle" href="#">
          <span class="glyphicon glyphicon-tower"></span>
          <span class="sidebar-title">Plugins</span>
          <span class="caret"></span>
        </a>
        <ul class="nav sub-nav">
          <li>
            <a class="accordion-toggle" href="#">
              <span class="glyphicon glyphicon-globe"></span> Maps
              <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
              <li>
                <a href="maps_advanced.html">Admin Maps</a>
              </li>
              <li>
                <a href="maps_basic.html">Basic Maps</a>
              </li>
              <li>
                <a href="maps_vector.html">Vector Maps</a>
              </li>
              <li>
                <a href="maps_full.html">Full Map</a>
              </li>
            </ul>
          </li>
          <li>
            <a class="accordion-toggle" href="#">
              <span class="fa fa-area-chart"></span> Charts
              <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
              <li>
                <a href="charts_highcharts.html">Highcharts</a>
              </li>
              <li>
                <a href="charts_d3.html">D3 Charts</a>
              </li>
              <li>
                <a href="charts_flot.html">Flot Charts</a>
              </li>
            </ul>
          </li>
          <li>
            <a class="accordion-toggle" href="#">
              <span class="fa fa-table"></span> Tables
              <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
              <li>
                <a href="tables_basic.html"> Basic Tables</a>
              </li>
              <li>
                <a href="tables_datatables.html"> DataTables </a>
              </li>
              <li>
                <a href="tables_datatables-editor.html"> Editable Tables </a>
              </li>
              <li>
                <a href="tables_footable.html"> FooTables </a>
              </li>
              <li>
                <a href="tables_pricing.html"> Pricing Tables </a>
              </li>
            </ul>
          </li>
          <li>
            <a class="accordion-toggle" href="#">
              <span class="fa fa-flask"></span> Misc
              <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
              <li>
                <a href="misc_tour.html"> Site Tour</a>
              </li>
              <li>
                <a href="misc_timeout.html"> Session Timeout</a>
              </li>
              <li>
                <a href="misc_nprogress.html"> Page Progress Loader </a>
              </li>
            </ul>
          </li>
        </ul>
      </li>
      <li>
        <a class="accordion-toggle" href="#">
          <span class="glyphicon glyphicon-duplicate"></span>
          <span class="sidebar-title">Pages</span>
          <span class="caret"></span>
        </a>
        <ul class="nav sub-nav">
          <li>
            <a class="accordion-toggle" href="#">
              <span class="fa fa-gears"></span> Utility
              <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
              <li>
                <a href="landing-page/landing1/index.html" target="_blank"> Landing Page </a>
              </li>
              <li>
                <a href="pages_confirmation.html" target="_blank"> Confirmation
                  <span class="label label-xs bg-primary">New</span>
                </a>
              </li>
              <li>
                <a href="pages_login.html" target="_blank"> Login </a>
              </li>
              <li>
                <a href="pages_login(alt).html" target="_blank"> Login Alt
                  <span class="label label-xs bg-primary">New</span>
                </a>
              </li>
              <li>
                <a href="pages_register.html" target="_blank"> Register </a>
              </li>
              <li>
                <a href="pages_register(alt).html" target="_blank"> Register Alt
                  <span class="label label-xs bg-primary">New</span>
                </a>
              </li>
              <li>
                <a href="pages_screenlock.html" target="_blank"> Screenlock </a>
              </li>
              <li>
                <a href="pages_screenlock(alt).html" target="_blank"> Screenlock Alt
                  <span class="label label-xs bg-primary">New</span>
                </a>
              </li>
              <li>
                <a href="pages_forgotpw.html" target="_blank"> Forgot Password </a>
              </li>
              <li>
                <a href="pages_forgotpw(alt).html" target="_blank"> Forgot Password Alt
                  <span class="label label-xs bg-primary">New</span>
                </a>
              </li>
              <li>
                <a href="pages_coming-soon.html" target="_blank"> Coming Soon
                </a>
              </li>
              <li>
                <a href="pages_404.html"> 404 Error </a>
              </li>
              <li>
                <a href="pages_500.html"> 500 Error </a>
              </li>
              <li>
                <a href="pages_404(alt).html"> 404 Error Alt </a>
              </li>
              <li>
                <a href="pages_500(alt).html"> 500 Error Alt </a>
              </li>
            </ul>
          </li>
          <li>
            <a class="accordion-toggle" href="#">
              <span class="fa fa-desktop"></span> Basic
              <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
              <li>
                <a href="pages_search-results.html">Search Results
                  <span class="label label-xs bg-primary">New</span>
                </a>
              </li>
              <li>
                <a href="pages_profile.html"> Profile </a>
              </li>
              <li>
                <a href="pages_timeline.html"> Timeline Split </a>
              </li>
              <li>
                <a href="pages_timeline-single.html"> Timeline Single </a>
              </li>
              <li>
                <a href="pages_faq.html"> FAQ Page </a>
              </li>
              <li>
                <a href="pages_calendar.html"> Calendar </a>
              </li>
              <li>
                <a href="pages_messages.html"> Messages </a>
              </li>
              <li>
                <a href="pages_messages(alt).html"> Messages Alt </a>
              </li>
              <li>
                <a href="pages_gallery.html"> Gallery </a>
              </li>
            </ul>
          </li>
          <li>
            <a class="accordion-toggle" href="#">
              <span class="fa fa-usd"></span> Misc
              <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
              <li>
                <a href="pages_invoice.html"> Printable Invoice </a>
              </li>
              <li>
                <a href="pages_blank.html"> Blank </a>
              </li>
            </ul>
          </li>
        </ul>
      </li>

      <!-- sidebar bullets -->
      <li class="sidebar-label pt20">Projects</li>
      <li class="sidebar-proj">
        <a href="#projectOne">
          <span class="fa fa-dot-circle-o text-primary"></span>
          <span class="sidebar-title">Website Redesign</span>
        </a>
      </li>
      <li class="sidebar-proj">
        <a href="#projectTwo">
          <span class="fa fa-dot-circle-o text-info"></span>
          <span class="sidebar-title">Ecommerce Panel</span>
        </a>
      </li>
      <li class="sidebar-proj">
        <a href="#projectTwo">
          <span class="fa fa-dot-circle-o text-danger"></span>
          <span class="sidebar-title">Adobe Mockup</span>
        </a>
      </li>
      <li class="sidebar-proj">
        <a href="#projectThree">
          <span class="fa fa-dot-circle-o text-warning"></span>
          <span class="sidebar-title">SSD Upgrades</span>
        </a>
      </li>

      <!-- sidebar progress bars -->
      <li class="sidebar-label pt25 pb10">User Stats</li>
      <li class="sidebar-stat">
        <a href="#projectOne" class="fs11">
          <span class="fa fa-inbox text-info"></span>
          <span class="sidebar-title text-muted">Email Storage</span>
          <span class="pull-right mr20 text-muted">35%</span>
          <div class="progress progress-bar-xs mh20 mb10">
            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 35%">
              <span class="sr-only">35% Complete</span>
            </div>
          </div>
        </a>
      </li>
      <li class="sidebar-stat">
        <a href="#projectOne" class="fs11">
          <span class="fa fa-dropbox text-warning"></span>
          <span class="sidebar-title text-muted">Bandwidth</span>
          <span class="pull-right mr20 text-muted">58%</span>
          <div class="progress progress-bar-xs mh20">
            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 58%">
              <span class="sr-only">58% Complete</span>
            </div>
          </div>
        </a>
      </li>
    </ul>
    <!-- End: Sidebar Menu -->

    <!-- Start: Sidebar Collapse Button -->
    <div class="sidebar-toggle-mini">
      <a href="#">
        <span class="fa fa-sign-out"></span>
      </a>
    </div>
    <!-- End: Sidebar Collapse Button -->

  </div>
  <!-- End: Sidebar Left Content -->
</aside>