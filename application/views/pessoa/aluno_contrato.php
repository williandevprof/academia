<div ng-show="mostraPerfilAlunoContrato">
  <div class="section-divider mb40" id="spy2">
    <span>Identificação do Aluno</span>
  </div>

  <div class="row">
    <div class="col-md-2">
      <img  ng-repeat="image in images" ng-if="pessoa.idpessoa == image.idpessoa" style="width: 200px; height: 200px;" ng-src="../Academia/api_fotos/images/{{image.foto}}">
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
      <button class="btn btn-warning" ng-click="voltaListaPessoas()">
        <i class="fa fa-sign-in fs22 text-primary"></i> 
        Voltar para a lista de pessoas
      </button>
    </div>  
  </div>

</div>


<div ng-show="mostrarContrato">

  <div class="section-divider mb40" id="spy2">
    <span>Dados do Contrato</span>
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="section">
        <label>Contrato</label>
        <label class="field select">
          <select ng-model="aluno_contrato.contrato" class="select2-single form-control">
            <option value="">Selecione o Contrato</option>
            <option ng-repeat="contrato in contratos" value="{{contrato.idcontrato}}">{{contrato.nome}}</option>
          </select>
          <i class="arrow"></i>
        </label>
      </div>
    </div>
    <div class="col-md-4">
      <label>Tipo de Plano</label>
      <select ng-model="aluno_contrato.tipo_plano" class="select2-single form-control" ng-change="getValores()">
        <option value="">Selecione o Tipo de Plano</option>
        <option ng-repeat="tipo_plano in tipos_plano" value="{{tipo_plano.idtipoPlano}}">{{tipo_plano.tipoPlano}}</option>
      </select>
    </div>
    <div class="col-md-4">
      <label>Modalidade</label>
      <select ng-model="aluno_contrato.modalidade" class="select2-single form-control" ng-change="getValores()">
        <option value="">Selecione a Modalidade</option>
        <option ng-repeat="modalidade in modalidades" value="{{modalidade.idmodalidade}}">{{modalidade.modalidade}}</option>
      </select>
    </div>
  </div>
  
  <div class="row">  
    <div class="col-md-4">
      <label>Prazo do Plano</label>
      <select ng-model="aluno_contrato.prazo_plano" class="select2-single form-control" ng-change="getValores()">
        <option value="">Selecione o Prazo</option>
        <option ng-repeat="prazo_plano in prazos_plano" value="{{prazo_plano.idprazoPlano}}">{{prazo_plano.prazoPlano}}</option>
      </select>
    </div>
  
    <div class="col-md-4">
      <label>Forma de Pagamento</label>
      <select ng-model="aluno_contrato.formaPgto" class="select2-single form-control">
        <option value="">Selecione a Forma de Pagamento</option>
        <option ng-repeat="forma_pgto in formas_pgto" value="{{forma_pgto.idformaPagamento}}">{{forma_pgto.formaPagamento}}</option>
      </select>
    </div>
    
    <div class="col-md-4">
      <label>Data de Pagamento</label>
      <div class="section admin-widgets-page"> 
        <label for="datepicker1" class="field prepend-icon">
          <input ng-model="aluno_contrato.dataPagamento"  type="text" id="dataPagamento" name="dataPagamento" class="gui-input"
          onkeypress="mascaraData(this, event)"
          placeholder="Data de Pagamento">
          <label class="field-icon">
            <i class="fa fa-calendar-o"></i>
          </label>
        </label>
      </div>
    </div>  
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="section admin-widgets-page">
        <label>Data do Contrato</label> 
        <label for="datepicker1" class="field prepend-icon">
          <input ng-model="aluno_contrato.dataContratacao"  type="text" id="dataContratacao" name="dataContratacao" class="gui-input"
          onkeypress="mascaraData(this, event)"
          placeholder="Data da Contratação">
          <label class="field-icon">
            <i class="fa fa-calendar-o"></i>
          </label>
        </label>
      </div>
    </div>
    <div class="col-md-4">
      <div class="section admin-widgets-page"> 
        <label>Data de Término</label>
        <label for="datepicker1" class="field prepend-icon">
          <input ng-model="aluno_contrato.dataTermino"  type="text" id="dataTermino" name="dataTermino" class="gui-input"
          onkeypress="mascaraData(this, event)"
          placeholder="Data de Termino">
          <label class="field-icon">
            <i class="fa fa-calendar-o"></i>
          </label>
        </label>
      </div>
    </div>  
    <div class="col-md-4">
      <label>Data de Renovação</label>
      <div class="section admin-widgets-page"> 
        <label for="datepicker1" class="field prepend-icon">
          <input ng-model="aluno_contrato.dataRenovacao"  type="text" id="dataRenovacao" name="dataRenovacao" class="gui-input"
          onkeypress="mascaraData(this, event)"
          placeholder="Data da Renovação">
          <label class="field-icon">
            <i class="fa fa-calendar-o"></i>
          </label>
        </label>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="section">
        <label>Número de Parcelas</label>
        <label for="firstname" class="field prepend-icon">
          <input ng-model="aluno_contrato.numeroParcelas"  type="text" disabled="true" class="gui-input" placeholder="Número de Parcelas" 
          style="color:black; font-weight: bold; font-size: 16px;">
          <label for="firstname" class="field-icon">
            <i class="fa fa-money"></i>
          </label>
        </label>
      </div>
    </div>
    <div class="col-md-4">
      <div class="section">
        <label>Valor das Parcelas</label>
        <label for="firstname" class="field prepend-icon">
          <input ng-model="aluno_contrato.valorParcela" ng-blur="calcTotal()"  type="text" disabled="true" class="gui-input" placeholder="Valor da Parcela"
          style="color:black; font-weight: bold; font-size: 16px;">
          <label for="firstname" class="field-icon">
            <i class="fa fa-money"></i>
          </label>
        </label>
      </div>
    </div>  
    <div class="col-md-4">
      <div class="section">
        <label>Valor Total</label>
        <label for="firstname" class="field prepend-icon">
          <input ng-model="aluno_contrato.valorTotal"  type="text" disabled="true" class="gui-input" placeholder="Valor Total"
          style="color:black; font-weight: bold; font-size: 16px;">
          <label for="firstname" class="field-icon">
            <i class="fa fa-money"></i>
          </label>
        </label>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-2"> 
      <button class="btn btn-success" ng-click="salvarAlunoContrato()">Salvar&nbsp;<i class="fa fa-save"></i></button>
    </div>
    <div class="col-md-2">
       <button class="btncancelar btn btn-danger" ng-click="cancelarCadastroContrato()">Cancelar &nbsp;
        <span class=" imoon imoon-cancel-circle"></span>
      </button>
    </div>
  </div>
  	
</div>  


<div ng-show="mostrarListaContrato">
  <br>
  <?php

    $conexao = mysqli_connect('127.0.0.1', 'root', '', 'academia');
    
    // seleciona a permissao de cadastrar contrato aluno para esse usuário
    $sql = mysqli_query($conexao, "SELECT * FROM usuario u 
    JOIN usuario_permissao up on u.idusuario = up.idusuario
    JOIN permissao p on up.idpermissao = p.idpermissao
    WHERE u.idusuario = '{$_SESSION["iduser"]}'
    AND  p.permissao = 'contrato aluno'");

    $retornoContrato_aluno = mysqli_fetch_assoc($sql);

    if ($retornoContrato_aluno['cadastrar'] == 1)
    {

      ?> 
        <div class="row">
          <div class="col-md-2">
            <button  ng-click="novoAlunoContrato()" class="button btn-primary">Novo&nbsp;<i class="fa fa-plus"></i></button>
          </div>
        </div>
      <?php
    }
  ?>    
        
  <br>
  <div class="section-divider mb40" id="spy2">
    <span>Lista de Contratos do Aluno</span>
  </div>
  <br> 
  <table  class="table table-bordered table-striped table-hover">
    <tr>
      <th>Id</th>
      <th>Contrato</th>
      <th>Plano</th>
      <th>Modalidade</th>
      <th>Prazo</th>
      <th>Forma de Pagamento</th>
      <th>Parcelas</th>
      <th>Valor</th>
      <th>Total</th>
      <th>Imprimir</th>
      <?php
        //if ($retornoExercicio['alterar'] == 1) 
        //{

          ?>
            <th>Alterar</th>
          <?php
        //}  
      ?>

    </tr>
    <tr dir-paginate="contratoAluno in contratosAluno|itemsPerPage:7">
      <td>{{contratoAluno.idaluno_contrato}}</td>
      <td>{{contratoAluno.nome}}</td>
      <td>{{contratoAluno.tipoPlano}}</td>
      <td>{{contratoAluno.modalidade}}</td>
      <td>{{contratoAluno.prazoPlano}}</td>
      <td>{{contratoAluno.formaPagamento}}</td>
      <td>{{contratoAluno.numeroParcelas}}</td>
      <td>{{contratoAluno.valorParcela}}</td>
      <td>{{contratoAluno.valorTotal}}</td>

      <td>
        <button class="btn btn-info" ng-click="imprimirContrato(contratoAluno)">  Contrato&nbsp;
          <span class="glyphicon glyphicon-print"></span>
        </button>
      </td>
      
      <?php
        //if ($retornoExercicio['alterar'] == 1) 
        //{

          ?>
            <td>
              <button class="btn btn-warning" ng-click="editar(exercicio)">Alterar &nbsp;<span class="icon-write"></span></button>
            </td>
          <?php
        //}
      ?>      
    </tr>
  </table>
  <div class="btn_paginacao">
    <dir-pagination-controls
      max-size="5"
      direction-links="true"
      boundary-links="true" >
    </dir-pagination-controls>
  </div>
</div>  