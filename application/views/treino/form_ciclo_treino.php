<div ng-show="mostrar == 'mostraCadastroCiclo'">

  <div class="row">
    <div class="col-md-2">
         <button class="btn btn-danger" id="cancelarExercicio" ng-click="cancelarExercicio()">Cancelar &nbsp;<span class="imoon imoon-cancel-circle"></span></button>
    </div>
    <div class="col-md-2">
      <button class="btn btn-success" id="salvarCicloTreino" ng-click="salvarCicloTreino()" ng-disabled="cadastro.$invalid">Salvar&nbsp;<i class="fa fa-save"></i></button>
    </div>
  </div>
  
  <div class="section-divider mb40" id="spy2">
    <span>Cadastro de Ciclo de treino</span>
  </div>


  <div class="row">
    <div class="col-md-6">
      <div class="section">
        <label>Nome do ciclo de Treino</label>
        <input type="text" ng-model="ciclo.ciclo" class="form-control" ng-required="true">
      </div>
    </div>
    <div class="col-md-3">
      <div class="section">
        <label>Nivel</label>
        <select ng-model="ciclo.nivel" class="select2-single form-control">
          <option value="">Selecione o nível</option>
          <option value="Iniciante">Iniciante</option>
          <option value="Intermediario">Intermediario</option>
          <option value="Avançado">Avançado</option>
        </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="section">
        <label>Gênero</label>
        <select ng-model="ciclo.genero" class="select2-single form-control">
          <option value="">Selecione o Genero</option>
          <option value="Masculino">Masculino</option>
          <option value="Feminino">Feminino</option>
        </select>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="section">
        <label>Meta Principal</label>
        <input type="text" ng-model="ciclo.metaPrincipal" class="form-control">
      </div>
    </div>
    <!-- Irá esconder o modelo de ciclo quando o usuário tentar alterar o ciclo -->
    <div class="col-md-6" ng-hide="escondeModeloCiclo">
      <div class="section">
        <label>Modelo de ciclo de treinos</label>
        <select ng-model="ciclo.modeloCiclo" class="select2-single form-control">
          <option value="">Selecione o modelo de ciclo</option>
          <option value="AB">AB</option>
          <option value="ABC">ABC</option>
          <option value="ABCD">ABCD</option>
          <option value="ABCDE">ABCDE</option>
          
        </select>
      </div>
    </div>
  </div>  
</div> 






