<div ng-show="mostraFormContrato">
  <h4 class="micro-header">Contrato</h4>

  <div class="row">
    <div class="col-md-9">
      <div class="section">
        <label for="">Nome</label>
        <input ng-model="contrato.nome" type="text" class="form-control" placeholder="Digite o nome do contrato">
      </div>
    </div>
  </div>
  <br>

  <div class="row">
    <div class="col-md-8">
      <div class="section">
        <label for="">Contrato</label>
        <textarea ng-model="contrato.texto" cols="185" rows="25"></textarea>  
      </div>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-md-2">
      <div class="section">
        <button ng-click="salvar()" class="btn btn-success">Salvar&nbsp;<i class="fa fa-save"></i></button>
      </div>
    </div>
    <div class="col-md-2">
      <div class="section">
        <button class="btncancelar btn btn-danger" ng-click="cancelarContrato()">Cancelar &nbsp;
        <span class=" imoon imoon-cancel-circle"></span></button>
      </div>
    </div>
  </div>
</div>


