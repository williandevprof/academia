<div ng-show="mostraFormAvaliacao">
  <div class="section-divider mb40" id="spy2">
    <span>Identificação do Aluno</span>
  </div>

  <div class="row">
    <div class="col-md-2">
      <img  ng-repeat="image in images" ng-if="aluno.idpessoa == image.idpessoa" style="width: 200px; height: 200px;" ng-src="../Academia/api_fotos/images/{{image.foto}}">
    </div> 
    <div class="col-md-4">
      <div class="row">
        <span style="font-size: 16px;">Nome:</span> <span style="font-size: 18px;"><b>{{nome}}</b></span>
      </div>
      <div class="row">
        <span style="font-size: 16px;">Idade:</span> <span style="font-size: 18px;"><b>{{idade}}</b></span> 
      </div>
      <div class="row">
        <span style="font-size: 16px;">Genero:</span> <span style="font-size: 18px;"><b>{{genero}}</b></span>
      </div>
      <br>
      <button class="btn btn-warning" ng-click="voltaListaAlunosAvaliacoes()">
        <i class="fa fa-sign-in fs22 text-primary"></i> 
        Voltar para a lista de alunos
      </button>
    </div>  
  </div>

  <div class="section-divider mb40" id="spy2">
    <span>Cadastro de nova Avaliação Física</span>
  </div>
     
  <div class="row">
    <div class="col-md-3">
      <div class="section admin-widgets-page"> 
        <label for="">Data da Avaliação</label>
        <label for="datepicker1" class="field prepend-icon">
          <input ng-model="avaliacao.data_avaliacao" type="text" class="gui-input"
          onkeypress="mascaraData(this, event)"
          placeholder="Data da Avaliação">
          <label class="field-icon">
            <i class="fa fa-calendar-o"></i>
          </label>
        </label>
      </div>
    </div>
      
    <div class="col-md-3">
      <div class="section">
        <label for="">Peso (Kg)</label>
        <input ng-model="avaliacao.peso" type="text" class="gui-input" placeholder="Digite o Peso">
      </div>
    </div>
    <div class="col-md-3">
      <div class="section">
        <label for="">Altura (m)</label>
         <input ng-model="avaliacao.altura" type="text" class="gui-input" 
         placeholder="Digite a Altura">
      </div>
    </div>
  </div>

  <div class="section-divider mb40" id="spy2">
    <span>Dobras Cutâneas (mm)</span>
  </div>

  <div class="row">
    <div class="col-md-3">
      <div class="section">
        <label for="">Triceps</label>
        <input ng-model="avaliacao.triceps" type="text" class="gui-input" placeholder="Digite o Trceps">
      </div>
    </div>
    <div class="col-md-3">
      <div class="section">
        <label for="">Subescapular</label>
         <input ng-model="avaliacao.subescapular" type="text" class="gui-input" 
         placeholder="Digite o subescapular">
      </div>
    </div>
    <div class="col-md-3">
      <div class="section">
        <label for="">Supra Llíaca</label>
        <input ng-model="avaliacao.supralliaca" type="text" class="gui-input" placeholder="Digite a Supra Llíaca">
      </div>
    </div>
    <div class="col-md-3">
      <div class="section">
        <label for="">Abdômen</label>
         <input ng-model="avaliacao.abdomen" type="text" class="gui-input" 
         placeholder="Digite o abdomen">
      </div>
    </div>  
  </div>


  <div class="section-divider mb40" id="spy2">
    <span>Circuferência (cm)</span>
  </div>

  <div class="row">
    <div class="col-md-3">
      <div class="section">
        <label for="">Braço Esquerdo</label>
         <input ng-model="avaliacao.braco_esquerdo" type="text" class="gui-input" 
         placeholder="Digite o Braço Esquerdo">
      </div>
    </div>
    <div class="col-md-3">
      <div class="section">
        <label for="">Braço Direito</label>
        <input ng-model="avaliacao.braco_direito" type="text" class="gui-input" placeholder="Digite o Braço Direito">
      </div>
    </div>
    <div class="col-md-3">
      <div class="section">
        <label for="">Anti Braço Esquerdo</label>
         <input ng-model="avaliacao.antibraco_esquerdo" type="text" class="gui-input" 
         placeholder="Digite o Anti Braço Esquerdo">
      </div>
    </div>
    <div class="col-md-3">
      <div class="section">
        <label for="">Anti Braço Direito</label>
        <input ng-model="avaliacao.antibraco_direito" type="text" class="gui-input" placeholder="Digite o Anti Braço Direito">
      </div>
    </div>  
  </div>

  <div class="row">
    <div class="col-md-3">
      <div class="section">
        <label for="">Quadril</label>
        <input ng-model="avaliacao.quadril" type="text" class="gui-input" placeholder="Digite o Quadril">
      </div>
    </div>
    <div class="col-md-3">
      <div class="section">
        <label for="">Cintura</label>
         <input ng-model="avaliacao.cintura" type="text" class="gui-input" 
         placeholder="Digite a Cintura">
      </div>
    </div>
    <div class="col-md-3">
      <div class="section">
        <label for="">Percoço</label>
         <input ng-model="avaliacao.pescoco" type="text" class="gui-input" 
         placeholder="Digite o Pescoço">
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-3">
      <div class="section">
        <label for="">Coxa Esquerda</label>
         <input ng-model="avaliacao.coxa_esquerda" type="text" class="gui-input" 
         placeholder="Digite a Coxa Esquerda">
      </div>
    </div>
    <div class="col-md-3">
      <div class="section">
        <label for="">Coxa Direita</label>
        <input ng-model="avaliacao.coxa_direita" type="text" class="gui-input" placeholder="Digite a Coxa Direita">
      </div>
    </div>
    <div class="col-md-3">
      <div class="section">
        <label for="">Perna Esquerda</label>
         <input ng-model="avaliacao.perna_esquerda" type="text" class="gui-input" 
         placeholder="Digite a Perna Esquerda">
      </div>
    </div>
    <div class="col-md-3">
      <div class="section">
        <label for="">Perna Direita</label>
        <input ng-model="avaliacao.perna_direita" type="text" class="gui-input" placeholder="Digite a Perna Direita">
      </div>
    </div>  
  </div>

  <div class="section-divider mb40" id="spy2">
    <span>Diâmetro (cm)</span>
  </div>

  <div class="row">
    <div class="col-md-3">
      <div class="section">
        <label for="">Radio</label>
         <input ng-model="avaliacao.radio" type="text" class="gui-input" 
         placeholder="Digite o Radio">
      </div>
    </div>
    <div class="col-md-3">
      <div class="section">
        <label for="">Fêmur</label>
        <input ng-model="avaliacao.femur" type="text" class="gui-input" placeholder="Digite o Femur">
      </div>
    </div>  
  </div>

  <br>
  <button class="btn btn-info" ng-click="calcular()">Calcular&nbsp;</button>
  <br>

  <div class="section-divider mb40" id="spy2">
    <span>Composição Corporal</span>
  </div>

  <div class="row">
    <div class="col-md-3">
      <div class="section">
        <label for="">Índice de Massa Corporal (IMC)</label>
         <input style="color:black; font-weight: bold; font-size: 16px;" 
         ng-model="avaliacao.imc" type="text" class="gui-input" disabled="true">
      </div>
    </div>

    <div class="col-md-3">
      <div class="section">
        <label for="">Percentual de Gordura</label>
         <input style="color:black; font-weight: bold; font-size: 16px;" ng-model="avaliacao.percentual_gordura" type="text" class="gui-input" 
          disabled="true">
      </div>
    </div>

    <div class="col-md-3">
      <div class="section">
        <label for="">Massa Magra</label>
         <input style="color:black; font-weight: bold; font-size: 16px;" ng-model="avaliacao.massa_magra" type="text" class="gui-input" 
          disabled="true">
      </div>
    </div>

    <div class="col-md-3">
      <div class="section">
        <label for="">Massa Gorda</label>
         <input style="color:black; font-weight: bold; font-size: 16px;" ng-model="avaliacao.massa_gorda" type="text" class="gui-input" 
          disabled="true">
      </div>
    </div>
  </div>

  <div class="row">
     <div class="col-md-3">
        {{classificacaoIMC}}
     </div>
     <div class="col-md-3">
        {{classificacaoPercentualGordura}}
     </div>
  </div>

  <br><br>
  <button ng-show="mostraBtnSalvar" class="btn btn-success" ng-click="salvarAvaliacao()">Salvar Avaliação&nbsp;
  <i class="fa fa-save"></i></button>
  <br>
  
</div>


