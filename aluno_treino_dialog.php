<md-dialog aria-label="Mango (Fruit)" ng-controller="aluno">
  <form ng-cloak>
    
    <md-dialog-content>
      <div class="md-dialog-content">
       <h3>Deseja utilizar um modelo de treino já existente ou criar um novo?</h3>
      </div>
    </md-dialog-content>

    <md-dialog-actions layout="row">
      <span flex></span>
      <md-button ng-click="criarCiclo()">
       Criar um novo modelo de treino
      </md-button>
      <md-button ng-click="utilizarCiclo()">
       Utilizar modelo de treino cadastrado
      </md-button>
    </md-dialog-actions>
  </form>
</md-dialog>
 