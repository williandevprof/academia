<div ng-show="mostraFormNutricao">
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
      <button class="btn btn-warning" ng-click="voltaListaAlunosNutricao()">
        <i class="fa fa-sign-in fs22 text-primary"></i> 
        Voltar para a lista de alunos
      </button>
    </div>  
  </div>

  <div class="section-divider mb40" id="spy2">
    <span>Alimentação</span>
  </div>

       
  <div class="row">
    <div class="col-md-2">
      <div class="section">
        <label for="">Plano de Nutrição</label>
        <input ng-model="nutricao.plano" type="text" class="gui-input" placeholder="Digite o nome do Plano">
      </div>
    </div>  

    <div class="col-md-2">
      <label for="datepicker1" class="field prepend-icon">
        <input ng-model="nutricao.data_inicio"  class="gui-input"
        onkeypress="mascaraData(this, event)"
        placeholder="Data de Início">
        <label class="field-icon">
          <i class="fa fa-calendar-o"></i>
        </label>
      </label>
    </div> 
    <div class="col-md-2">
      <label for="datepicker1" class="field prepend-icon">
        <input ng-model="nutricao.data_termino"  class="gui-input"
        onkeypress="mascaraData(this, event)"
        placeholder="Data de Término">
        <label class="field-icon">
          <i class="fa fa-calendar-o"></i>
        </label>
      </label>
    </div> 
  </div>
  
  <div class="row">  
    
    <input ng-model="nutricao.idplano_nutricao" type="hidden">
    <input ng-model="nutricao.idrefeicao_plano_nutricao" type="hidden">
    <input ng-model="nutricao.idalimento" type="hidden">
    <input ng-model="nutricao.ativo" type="hidden">

    <div class="col-md-2">
      <label for="">Refeição</label>
      <select  ng-model="nutricao.refeicao" class="select2-single form-control">
        <option  value="">Selecione a Refeição</option>
        <option ng-repeat="refeicao in refeicoes" value="{{refeicao.idrefeicao}}">{{refeicao.refeicao}}</option>
      </select>
    </div> 

    <div class="col-md-2">
      <div class="section">
        <label for="">Horário</label>
        <input ng-model="nutricao.horario" type="text" class="gui-input" placeholder="Digite o Horário">
      </div>
    </div>  

    <div class="col-md-2">
      <div class="section">
        <label for="">Alimento</label>
        <input ng-model="nutricao.alimento" type="text" class="gui-input" placeholder="Digite o alimento">
      </div>
    </div>  
    <div class="col-md-2">
      <div class="section">
        <label for="">Medida/Quantidade</label>
        <input ng-model="nutricao.medida" type="text" class="gui-input" placeholder="Digite a medida do alimento">
      </div>
    </div>  
  </div>

  <div class="row">
    <div class="col-md-3">
      <div class="section">
        <button class="btn btn-success" ng-click="addPlano_nutricao()">
        <i class="fa fa-save"></i> 
        Salvar
      </button>
      </div>
    </div>
  </div> 

    
  <br><br>
  <table  class="table table-bordered table-striped table-hover">
    <tr>
      <th>Refeição</th>
      <th>Horário</th>
      <th>Alimento</th>
      <th>Medida/Quantidade</th>
      <th>Alterar</th>
      <th>Excluir</th>
    </tr>
    <tr ng-repeat="plano in plano_nutricao">
      <td>{{plano.refeicao}}</td>
      <td>{{plano.horario}}</td>
      <td>{{plano.alimento}}</td>
      <td>{{plano.medida}}</td>
      <td>
          <button ng-click="alterarAlimento(plano)" class="btn btn-warning btn-xs">Alterar
              <span class="imoon icon-pencil"></span>
          </button> 
      </td>
      <td>
          <button ng-click="excluirAlimento(plano)" class="btn btn-danger btn-xs">Excluir
              <span class="imoon imoon-cancel-circle"></span>
          </button> 
      </td>
    </tr>
  </table>
    
</div>
