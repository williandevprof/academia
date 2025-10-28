<div ng-show="mostrar == 'parq'">
  <div class="section-divider mv40" id="spy4">
    <span>Par Q</span>
  </div>
  <!-- .section-divider -->

  <!-- Form Addons -->
  <div class="row">
    <div class="col-md-12">
      <b><h2>Marque apenas em caso de resposta positiva a pergunta!</h2></b>
    </div>
  </div>
  <br>
  
  <div class="row"  ng-repeat="pessoa in pessoas">
      
  </div>
  
    
  <div ng-repeat="resposta in pessoa.respostasAlunoParq">
    
    <div class="row"  ng-repeat="pergunta in pessoa.perguntas" ng-if="resposta.idperguntaParq == pergunta.idperguntaParq">
                  
      <div class="col-md-12">
        <div class="section">
          <input type="hidden" ng-model="pergunta.idpergunta">
          <label class="option">
            <input type="checkbox" ng-model="pergunta.resposta"
            ng-checked="resposta.resposta == 1">
            <span class="checkbox"></span>{{pergunta.pergunta}}
          </label>
        </div>
      </div>      
    
    </div>
  
  </div> 
  
</div>