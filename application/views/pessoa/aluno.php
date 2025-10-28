<div id="aluno" ng-show="pessoa.aluno">
  <div class="row">
    <div class="col-md-4">
      <div class="section">
      <label>Código da Catraca</label>
       <input ng-model="pessoa.codigoCatraca" type="password" name="codigoCatraca" id="codigoCatraca" class="gui-input" 
       placeholder="Digite o número para acesso da catraca">
      </div>
    </div>
    <div class="col-md-4">
      <label for="">Consultor</label>
      <select ng-model="pessoa.consultor" class="select2-single form-control">
        <option value="">Selecione o Consultor</option>
        <option ng-repeat="consultor in consultores" value="{{consultor.idpessoa}}">{{consultor.nome}}</option>
      </select>
    </div> 
  </div>
</div>

