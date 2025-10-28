<div ng-show="mostrar == 'endereco'">
  <div class="section-divider mb40" id="spy2">
    <span>Dados de Endereço</span>
  </div>  
  
  <div class="row">
    <div class="col-md-4">
      <div class="section">
        <label for="">CEP</label>
        <label class="field prepend-icon">
          <input ng-model="pessoa.cep" type="text" name="cep" id="cep" class="gui-input"
            ng-blur="buscarEndereco()"  onkeypress="mascaraCEP(this, event)" placeholder="Digite o CEP">
          <label for="email" class="field-icon">
          <i class="fa fa-envelope"></i>
          </label>
        </label>
      </div>
    </div>

    <div class="col-md-4">
      <label for="">Estado</label>
      <select  ng-model="pessoa.estado" class="select2-single form-control">
        <option  value="">Selecione o Estado</option>
        <option ng-selected="pessoa.uf == estado.estado" ng-repeat="estado in estados" value="{{estado.idestado}}">{{estado.estado}}</option>
      </select>
    </div> 
    <div class="col-md-4">
      <div class="section">
        <label for="">Cidade</label>
        <label for="city" class="field prepend-icon">
          <input type="hidden" ng-model="pessoa.idcidade" value="pessoa.idcidade">
          <input ng-model="pessoa.cidade" type="text" name="cidade" id="cidade" class="gui-input" placeholder="Digite a Cidade">
          <label for="city" class="field-icon">
            <i class="fa fa-building-o"></i>
          </label>
        </label>
        </label>
      </div>
    </div>    
  </div>
  <div class="row">
    <div class="col-md-8">
      <div class="section">
        <label for="">Rua</label>
        <input type="hidden" ng-model="pessoa.idendereco" value="pessoa.idendereco">
        <label for="firstaddr" class="field prepend-icon">
          <input ng-model="pessoa.rua" type="text" name="rua" id="rua" class="gui-input" placeholder="Digite o nome da Rua">
          <label for="firstaddr" class="field-icon">
            <i class="fa fa-map-marker"></i>
          </label>
      </div>
    </div>
    <div class="col-md-2">
      <div class="section">
        <label for="">Número</label>
        <input ng-model="pessoa.numero" type="text" name="numero" id="numero" class="gui-input" placeholder="Número">
      </div>
    </div>
    <div class="col-md-2">
      <div class="section">
        <label for="">Complemento</label>
        <input ng-model="pessoa.complemento" type="text" name="complemento" id="complemento" class="gui-input" placeholder="Complemento">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-8">
      <div class="section">
        <label for="">Bairro</label>
        <input type="hidden" ng-model="pessoa.idbairro" value="pessoa.idbairro">
        <input ng-model="pessoa.bairro"  type="text" name="bairro" id="bairro" class="gui-input phone-group" placeholder="Digite o nome do Bairro">
      </div>
    </div>
    <div class="col-md-4">
      <div class="section">
        <label for="">Referência</label>
        <input ng-model="pessoa.referencia"  type="text" name="referencia" id="referencia" class="gui-input phone-group" placeholder="Digite uma referência para o Endereço">
      </div>
    </div>
  </div>

  Endereços: <span ng-click="maisEndereco()" class="fa fa-plus-square-o"></span>
  <div ng-repeat="endereco in pessoa.enderecos">
    <div class="row">
      <div class="col-md-4">
        <div class="section">
          <label for="">CEP</label>
          <label class="field prepend-icon">
            <input ng-model="pessoa.enderecos[$index].cep" type="text" name="cep" id="cep" class="gui-input"
               ng-blur="buscarEnderecoAlternativo($index)" onkeypress="mascaraCEP(this, event)" placeholder="Digite o CEP">
            <label for="email" class="field-icon">
            <i class="fa fa-envelope"></i>
            </label>
          </label>
        </div>
      </div>

      <div class="col-md-4">
        <label for="">Estado</label>
        <select ng-model="pessoa.enderecos[$index].estado" class="select2-single form-control">
          <option value="">Selecione o Estado</option>
          <option ng-selected="pessoa.enderecos[$index].uf == estado.estado" ng-repeat="estado in estados" value="{{estado.idestado}}">{{estado.estado}}</option>
        </select>
      </div> 
      
      <div class="col-md-4">
        <div class="section">
          <label for="">Cidade</label>
          <label for="city" class="field prepend-icon">
            <input ng-model="pessoa.enderecos[$index].cidade" type="text" name="cidade" id="cidade" class="gui-input" placeholder="Digite a Cidade">
            <label for="city" class="field-icon">
              <i class="fa fa-building-o"></i>
            </label>
          </label>
          </label>
        </div>
      </div>    
    </div>
    <div class="row">
      <div class="col-md-8">
        <div class="section">
          <label for="">Rua</label>
          <label for="firstaddr" class="field prepend-icon">
            <input ng-model="pessoa.enderecos[$index].rua" type="text" name="rua" id="rua" class="gui-input" placeholder="Digite o nome da Rua">
            <label for="firstaddr" class="field-icon">
              <i class="fa fa-map-marker"></i>
            </label>
        </div>
      </div>
      <div class="col-md-2">
        <div class="section">
          <label for="">Número</label>
          <input ng-model="pessoa.enderecos[$index].numero" type="text" name="numero" id="numero" class="gui-input" placeholder="Número">
        </div>
      </div>
      <div class="col-md-2">
        <div class="section">
          <label for="">Complemento</label>
          <input ng-model="pessoa.enderecos[$index].complemento" type="text" name="complemento" id="complemento" class="gui-input" placeholder="Complemento">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8">
        <div class="section">
          <label for="">Bairro</label>
          <input ng-model="pessoa.enderecos[$index].bairro"  type="text" name="bairro" id="bairro" class="gui-input phone-group" placeholder="Digite o nome do Bairro">
        </div>
      </div>
      <div class="col-md-3">
        <div class="section">
          <label for="">Referência</label>
          <input ng-model="pessoa.enderecos[$index].referencia"  type="text" name="referencia" id="referencia" class="gui-input phone-group" placeholder="Referência">
        </div>
      </div>
      <div class="col-md-1">
        <button ng-click="btnExluirEndereco($index)" class="btn btn-danger btn-xs">Excluir
           <span class="imoon imoon-cancel-circle"></span>
        </button>   
      </div>
    </div>
  </div>
</div>



