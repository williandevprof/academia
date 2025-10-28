 <div class="tipopessoa" ng-show="mostrar == 'tipopessoa'">
  <div class="section-divider mv40" id="spy1">
    <span>Selecione o tipo de pessoa para cadastrar</span>
  </div>

  <div class="row">
    <div class="col-md-4">
      <div class="section">
        <label class="option">
        <input ng-model="pessoa.aluno"  type="checkbox" name="aluno" value="">
        <span class="checkbox"></span>Aluno</label>
      </div>
    </div>
    <div class="col-md-4 hidden-xs">
      <div class="section">
        <label class="option">
        <input ng-model="pessoa.funcionario" type="checkbox" name="funcionario" value="">
        <span class="checkbox"></span>Funcionário</label>
      </div>
    </div>
    <div class="col-md-4">
      <label class="option">
      <input ng-model="pessoa.fornecedor" type="checkbox" name="fornecedor" value="">
      <span class="checkbox"></span>Fornecedor</label>
    </div>  
  </div>
</div>
