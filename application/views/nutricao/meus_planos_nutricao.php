<div ng-controller="meus_planos_nutricao">
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
  
				  	<div>
				      <div  class="section-divider mb40">
				        <span>Lista de Planos de Nutrição</span>
				      </div>
				      
				      <br>
				      <div class="row">
				       
				        <div class="col-md-2">
				          <div class="section admin-widgets-page"> 
				            <label for="datepicker1" class="field prepend-icon">
				              <input ng-model="nutricao.data_inicio" type="text" class="gui-input"
				              onkeypress="mascaraData(this, event)"
				              placeholder="Data de Inicio">
				              <label class="field-icon">
				                <i class="fa fa-calendar-o"></i>
				              </label>
				            </label>
				          </div>
				        </div>

				        <div class="col-md-2">
				          <div class="section admin-widgets-page"> 
				            <label for="datepicker1" class="field prepend-icon">
				              <input ng-model="nutricao.data_termino" type="text" class="gui-input"
				              onkeypress="mascaraData(this, event)"
				              placeholder="Data de Término">
				              <label class="field-icon">
				                <i class="fa fa-calendar-o"></i>
				              </label>
				            </label>
				          </div>
				        </div>

				        <div class="col-md-2">
				          <button ng-click="pesquisarNutricao()" class="button btn-primary">Buscar&nbsp;<i class="fa fa-search"></i></button>
				        </div>
				      </div>
				      <br><br>

				      <div>
				        <table  class="table table-bordered table-striped table-hover">
				          <tr>
				            <th>ID</th>        
				            <th>Plano</th>
				            <th>Data de Inicio</th>
				            <th>Data de Término</th>
				            <th>Detalhar</th>
				            
				          </tr>
				          <tr dir-paginate="plano in planos_nutricao|itemsPerPage:7">
				          	<td>{{plano.idplano_nutricao}}</td>
				            <td>{{plano.plano}}</td>
				            <td>{{plano.data_inicio}}</td>
				            <td>{{plano.data_termino}}</td>
				            <td>
				                <button class="btn btn-info" ng-click="detalharNutricao(plano)">Detalhar Nutrição&nbsp;  <i class="fa fa-search"></i>
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