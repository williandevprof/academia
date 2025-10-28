<md-dialog aria-label="Mango (Fruit)" ng-controller="pessoa">


  <form ng-cloak>
    <md-toolbar>
      <div class="md-toolbar-tools">
        <h2> {{pessoaDialog.nome}} </h2>
        <span flex></span>
      </div>
    </md-toolbar>

    <md-dialog-content>
      <div class="md-dialog-content">
       
        <div class="row">
          <div class="col-md-5">
            <img style="margin: auto; max-width: 100%;" alt="Lush mango tree" ng-src="../Academia/api_fotos/images/{{image.foto}}" >
          </div> 
          <div class="col-md-7">
            <h2>Genero: {{pessoaDialog.genero}}</h2>
            <h2>Idade: {{pessoaDialog.idade}} Anos</h2>
            <h2>Telefone: {{pessoaDialog.telefone}} {{pessoaDialog.operadora}}</h2>
            <h2>Email: {{pessoaDialog.email}}</h2>
            <h2>Usuário: {{pessoaDialog.usuario}}</h2>
            <h2>Profissão: {{pessoaDialog.profissao}}</h2>
            <h2>Cidade: {{pessoaDialog.cidade}}</h2>

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
 