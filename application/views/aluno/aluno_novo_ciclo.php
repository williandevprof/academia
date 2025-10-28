<div ng-show="mostraCadastroCicloAluno">
  <div class="col-md-10">
    <div class="row">
      <div class="col-md-2">
           <button class="btn btn-danger" id="cancelarExercicio" ng-click="cancelarCadastroCicloAluno()">Cancelar &nbsp;<span class="imoon imoon-cancel-circle"></span></button>
      </div>
      <div class="col-md-2">
        <button class="btn btn-success" id="salvarCicloTreino" ng-click="salvarNovoCicloTreinoAluno()" ng-disabled="cadastro.$invalid">Salvar&nbsp;<i class="fa fa-save"></i></button>
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
    <div class="row">
      <div class="col-md-3"> 
        <div class="section">
          <label>Data de Inicio</label>
          <input type="text" ng-model="ciclo.dataInicio" class="form-control" id="dataInicio" onkeypress="mascaraData(this, event)">
        </div>
      </div>
      <div class="col-md-3"> 
        <div class="section">
          <label>Data de Término</label>
          <input type="text" ng-model="ciclo.dataTermino" class="form-control" id="dataTermino" onkeypress="mascaraData(this, event)">
        </div>
      </div>
    </div>   
  </div>
</div> 


<!-- jQuery -->
  <script src="vendor/jquery/jquery-1.11.1.min.js"></script>
  <script src="vendor/jquery/jquery_ui/jquery-ui.min.js"></script>

  <!-- FileUpload JS -->
  <script src="vendor/plugins/fileupload/fileupload.js"></script>
  <script src="vendor/plugins/holder/holder.min.js"></script>

  <!-- Tagmanager JS -->
  <script src="vendor/plugins/tagsinput/tagsinput.min.js"></script>

  <!-- Theme Javascript -->
  <script src="assets/js/utility/utility.js"></script>
  <script src="assets/js/demo/demo.js"></script>
  <script src="assets/js/main.js"></script>
  <script type="text/javascript">
  jQuery(document).ready(function() {

    
    "use strict";

    // Init Theme Core    
    Core.init();

    // Init Demo JS  
    Demo.init();

    $("#dataInicio").datepicker(
    {
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior'
      
    });

    $("#dataTermino").datepicker(
    {
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior'
      
    });
  });  
</script>    
