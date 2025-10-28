<md-dialog aria-label="Mango (Fruit)" ng-controller="pessoa">

  <form ng-cloak>
    <md-toolbar>
      <div class="md-toolbar-tools">
        <h2> {{funcionario}} - Existem Ciclos de Treino com data expirando hoje {{nome}} </h2>
        <span flex></span>
      </div>
    </md-toolbar>

    <md-dialog-content>
      <div class="md-dialog-content">

        <div class="row" ng-repeat="ciclo in ciclos">
          <div class="col-md-3">
            <img style="margin: auto; width: 100px; height: 100px;" 
            ng-src="../Academia/api_fotos/images/{{ciclo.foto}}" >
          </div> 
          <div class="col-md-7">
            <h2>Aluno: {{ciclo.nome}}</h2>
            <h2>Ciclo: {{ciclo.ciclo}}</h2>
          </div>  
        </div>
     
      </div>
    </md-dialog-content>

    <md-dialog-actions layout="row">
      <span flex></span>
      <md-button ng-click="closeDialog()">
       Fechar
      </md-button>
      
    </md-dialog-actions>
  </form>
</md-dialog>
 