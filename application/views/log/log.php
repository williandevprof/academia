<div ng-controller="log">
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

                  <div class="row">
       
                    <div class="col-md-2">
                      <div class="section admin-widgets-page" n> 
                        <label for="datepicker1" class="field prepend-icon">
                          <input ng-model="log.data1" type="text" class="gui-input"
                          onkeypress="mascaraData(this, event)"
                          placeholder="Data 1">
                          <label class="field-icon">
                            <i class="fa fa-calendar-o"></i>
                          </label>
                        </label>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="section admin-widgets-page"> 
                        <label for="datepicker1" class="field prepend-icon">
                          <input ng-model="log.data2" type="text" class="gui-input"
                          onkeypress="mascaraData(this, event)"
                          placeholder="Data 2">
                          <label class="field-icon">
                            <i class="fa fa-calendar-o"></i>
                          </label>
                        </label>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <button ng-click="pesquisarLog()" class="button btn-primary">Buscar&nbsp;<i class="fa fa-search"></i></button>
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