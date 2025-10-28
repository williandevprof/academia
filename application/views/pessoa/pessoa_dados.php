<div id="pessoa" ng-show="mostrar == 'pessoa'">
  <div class="section-divider mb40" id="spy2">
    <span>Dados Pessoais</span>
  </div>
  <div class="row">
    <div class="col-md-4">
      <label for="pf" class="block mt15 option option-primary">
        <input type="radio" ng-model="pessoa.natureza" ng-checked="pf" ng-click="mostrarPf()" name="naturezaPessoa" id="pf" value="pf">
        <span class="radio"></span>Pessoa Física
      </label>
    </div>
    <div class="col-md-4">
      <label for="pj" class="block mt15 option option-primary">
        <input type="radio" ng-model="pessoa.natureza" ng-click="mostrarPj()" name="naturezaPessoa" id="pj" value="pj">
        <span class="radio"></span>Pessoa Juridica
      </label>
    </div>           
  </div> 
  <br>   
  <div class="row">
    <div class="col-md-8">
      <label ng-hide="mostranomeObrigatorio" style="color:red">
        Este campo é de preenchimento obrigatório
      </label>
    </div> 
  </div>
  <div class="row">
    <div class="col-md-8">
      <div class="section">
        <label for="">Nome Completo</label>
        <label for="firstname" class="field prepend-icon">
          <input ng-model="pessoa.nome" ng-required="true" ng-keyup="validaNome()" ng-blur="validaBlurNome()" type="text" name="nome" id="nome" class="gui-input" placeholder="Digite o nome completo">
          <label for="firstname" class="field-icon">
            <i class="fa fa-user"></i>
          </label>
        </label>
      </div>
    </div>
    <div class="col-md-4">
      <div class="section">
        <label for="">Foto</label>
        <label class="field prepend-icon append-button file">
          <span class="button">Escolha a Foto</span>
          <input type="file" file-input="files" class="gui-file" name="file1" id="file1" onChange="document.getElementById('uploader1').value = this.value;">
          <input ng-model="pessoa.foto" type="text" class="gui-input" id="uploader1" placeholder="">
          <label class="field-icon">
            <i class="fa fa-upload"></i>
          </label>
        </label>  
      </div>
    </div>
  </div> 
    
  <div ng-show="pessoaFisica">
    <div class="row">
      <div class="col-md-4">
        <label ng-hide="mostraDataNascimentoObrigatorio" style="color:red">
          Este campo é de preenchimento obrigatório
        </label>
      </div> 
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="section admin-widgets-page"> 
          <label for="">Data de Nascimento</label>
          <label for="datepicker1" class="field prepend-icon">
            <input ng-model="pessoa.dataNascimento"  ng-keyup="validaDataNascimento()" ng-blur="validaBlurDataNascimento()" type="text" id="dataNascimento" name="dataNascimento" class="gui-input"
            onkeypress="mascaraData(this, event)"
            placeholder="Data de Nascimento">
            <label class="field-icon">
              <i class="fa fa-calendar-o"></i>
            </label>
          </label>
        </div>
      </div>
      <div class="col-md-4">
        <div class="section">
          <label for="">Gênero</label>
          <label class="field select">
            <select ng-model="pessoa.genero" id="genero" name="genero">
              <option value="">Gênero</option>
              <option value="M">Masculino</option>
              <option value="F">Feminino</option>
            </select>
            <i class="arrow"></i>
          </label>
        </div>
      </div>
      <div class="col-md-4">
        <div class="section">
          <label for="">Estado Civil</label>
          <label class="field select">
            <select ng-model="pessoa.estadoCivil" id="estadoCivil" name="estadoCivil">
              <option value="">Estado Civil</option>
              <option value="Solteiro">Solteiro</option>
              <option value="Casado">Casado</option>
              <option value="Divorciado">Divorciado</option>
              <option value="Viuvo">Viúvo</option>
            </select>
            <i class="arrow"></i>
          </label>
        </div>
      </div> 
    </div> 
    <div class="row">
      <div class="col-md-4">
        <div class="section">
          <label for="">Profissão</label>
          <input ng-model="pessoa.profissao" type="text" name="profissao" id="profissao" class="gui-input" placeholder="Digite a Profissão">
        </div>
      </div>
      <div class="col-md-4">
        <div class="section">
          <label for="">CPF</label>
           <input ng-model="pessoa.cpf" type="text" name="cpf" id="cpf" class="gui-input" 
           onkeypress="mascaraCPF(this, event)"
           placeholder="Digite o CPF">
        </div>
      </div>
      <div class="col-md-4">
        <div class="section">
          <label for="">RG</label>
         <input ng-model="pessoa.rg" type="text" name="rg" id="rg" class="gui-input" 
         onkeypress="mascaraRG(this, event)"placeholder="Digite o RG">
        </div>
      </div>
    </div>
  </div>  
  <!-- ___________ -->
  
  <div ng-show="pessoaJuridica">
    <div class="row">
      <div class="col-md-8">
        <div class="section">
          <label for="">Razão Social</label>
          <input ng-model="pessoa.razaoSozial" type="text" name="razaoSozial" id="razaoSozial" class="gui-input" placeholder="Digite a Razão Social">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="section">
          <label for="">CNPJ</label>
          <input ng-model="pessoa.cnpj"  type="text" name="cnpj" id="cnpj" class="gui-input phone-group"
             placeholder="Digite o CNPJ" onkeypress="mascaraCNPJ(this, event)">
        </div>
      </div>
      <div class="col-md-4">
        <div class="section">
          <label for="">Inscrição Estadual</label>
          <input ng-model="pessoa.inscricaoEstadual"  type="text" name="inscricaoEstadual" id="inscricaoEstadual" class="gui-input phone-group"
             placeholder="Digite a Inscrição Estadual">
        </div>
      </div>
    </div>  
  </div>

      
  <!-- Text Areas -->
  <div class="row">
    <div class="col-md-12">
      <div class="section">
        <label class="field prepend-icon">
          <textarea ng-model="pessoa.observacao" class="gui-textarea" id="observacao" name="observacao" placeholder="Digite uma Observação"></textarea>
          <label for="comment" class="field-icon">
            <i class="fa fa-comments"></i>
          </label>
          <span class="input-footer">
            Utilize esse campo para digitar observações para o cadastro
          </span>
        </label>
      </div>
    </div>
  </div>
</div>


