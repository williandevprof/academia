<div id="funcionario" ng-show="pessoa.funcionario">
  <div class="section-divider mv40" id="spy5">
    <span>Cadastro de Funcionário</span>
  </div>
  <div class="row">
    <div class="col-md-8">
      <div class="section">
        <label for="">Função</label>
        <input ng-model="pessoa.funcao" type="text" name="nome" id="nome" class="gui-input" placeholder="Digite a função">
      </div>
    </div>
    <div class="col-md-4">
      <div class="section admin-widgets-page"> 
        <label for="">Data de Admissão</label>
        <label for="datepicker1" class="field prepend-icon">
          <input ng-model="pessoa.dataAdmissao" type="text" id="dataAdmissao" name="dataAdmissao" class="gui-input"
          onkeypress="mascaraData(this, event)"
          placeholder="Data de Admissão">
          <label class="field-icon">
            <i class="fa fa-calendar-o"></i>
          </label>
        </label>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4">
      <label class="field select">
        <label for="">Setor</label>
        <select ng-model="pessoa.setor" id="setor" name="setor" class="form-control">
          <option value="">Selecione o Setor</option>
          <option value="Musculação">Musculação</option>
          <option value="Natação">Natação</option>
          <option value="Zumba">Zumba</option>
          <option value="Corrida">Corrida</option>
        </select>
    </div>  
    <div class="col-md-4">
      <div class="section">
        <label for="">Carteira de trabalho</label>
        <label for="mobile_phone" class="field prepend-icon">
          <input ng-model="pessoa.ctps"  type="text" name="ctps" id="ctps" class="gui-input phone-group"
           placeholder="Digite a Carteira de Trabalho">
        </label>
      </div>
    </div>
    <div class="col-md-4">
      <div class="section">
        <label for="">Serie</label>
        <input ng-model="pessoa.serie"  type="text" name="serie" id="serie" class="gui-input phone-group"
           placeholder="Digite a Serie">
      </div>
    </div>
  </div>  
  <div class="row">
    <div class="col-md-4">
      <label for="">Pis</label>
      <input ng-model="pessoa.pis"  type="text" name="pis" id="pis" class="gui-input phone-group"
           placeholder="Digite o PIS">
      </label>
    </div> 
  
    <div class="col-md-4">
      <div class="section">
        <label for="">Salário Base</label>
        <label for="firstname" class="field prepend-icon">
          <input ng-model="pessoa.salarioBase"  type="text" name="salarioBase" id="salarioBase" class="gui-input" placeholder="Digite o Salário Base">
        <label for="firstname" class="field-icon">
          <i class="fa fa-money"></i>
        </label>
      </label>
      </div>
    </div>
  </div>                      
</div>
                    
                    
                    
                    
