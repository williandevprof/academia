<div ng-show="mostrar == 'contato'">
	<div class="section-divider mb40" id="spy2">
		<span>Dados de Contato</span>
	</div>  
	<div class="row">
		<div class="col-md-6">
		  <div class="section">
		  	<label for="">Email</label>
		  	<input type="hidden" ng-model="pessoa.idemail" value="{{pessoa.idemail}}">
		    <label class="field prepend-icon">
		      <input ng-model="pessoa.email" type="email" name="email" id="email" class="gui-input" placeholder="Digite o Email">
		      <label for="email" class="field-icon">
		        <i class="fa fa-envelope"></i>
		      </label>
		    </label>
		  </div>
		</div>
		<div class="col-md-6">
		  <div class="section">
		  	<label for="">Email</label>
		  	<input type="hidden" ng-model="pessoa.idemail_dois" value="{{pessoa.idemail_dois}}">
		    <label class="field prepend-icon">
		      <input ng-model="pessoa.email_dois" type="email" name="email_dois" id="email_dois" class="gui-input" placeholder="Digite o Email">
		      <label for="email" class="field-icon">
		        <i class="fa fa-envelope"></i>
		      </label>
		    </label>
		  </div>
		</div>
	</div>

			
  	<!-- primeiro telefone -->
	<div class="row">
	  <div class="col-md-2">
	  	<label for="">Tipo</label>
	    <label class="field select">
	      <input type="hidden" ng-model="pessoa.idtelefone" value="{{pessoa.idtelefone}}">	
	      <select  ng-model="pessoa.tipoTelefone" id="tipoTelefone" name="tipoTelefone" ng-change="changeTipoTelefone()">
	        <option value="">Tipo</option>
	        <option value="Residencial">Residencial</option>
	        <option value="Celular">Celular</option>
	        <option value="Comercial">Comercial</option>
	      </select>
	    </label>  
	  </div> 	
	  <div class="col-md-3" ng-show="mostraOperadora">
	  	<label for="">Operadora</label>
	    <label class="field select">
	      <select ng-model="pessoa.operadora" id="operadora" name="operadora">
	        <option value="">Operadora</option>
	        <option value="Claro">Claro</option>
	        <option value="Oi">Oi</option>
	        <option value="Tim">Tim</option>
	        <option value="Vivo">Vivo</option>
	      </select>
	  </div> 
	  <div class="col-md-3">
	  	<label for="">Telefone</label>
	    <div class="section">
	      <label for="home_phone" class="field prepend-icon">
	        <input ng-model="pessoa.telefone" type="tel" name="home_phone" id="home_phone" class="gui-input phone-group"
	        onkeypress="mascaraTelefone(this, event)"
	        placeholder="Telefone com o DDD">
	        <label for="home_phone" class="field-icon">
	          <i class="fa fa-phone"></i>
	        </label>
	      </label>
	    </div>
	  </div>
	  <div class="col-md-3">
	  	<label for="">Contato</label>
	    <input ng-model="pessoa.contato" type="text" id="contato" name="contato" class="gui-input" placeholder="Contato">
	  </div>
    </div>  
    Telefones: <span ng-click="maisTelefone()" class="fa fa-plus-square-o"></span>
	<div class="row" ng-repeat="contato in pessoa.contatos">
	   <div class="col-md-2">
	   	<label for="">Tipo</label>
	    <label class="field select">
	      <select ng-model="pessoa.contatos[$index].tipoTelefone" id="tipoTelefone" name="tipoTelefone" 
	      ng-change="changeTipoTelefoneArray($index)">
	        <option value="">Tipo</option>
	        <option value="Residencial">Residencial</option>
	        <option value="Celular">Celular</option>
	        <option value="Comercial">Comercial</option>
	      </select>
	    </label>  
	  </div> 	
	  <div class="col-md-3" ng-show="mostraOperadoraArray">
	  	<label for="">Operadora</label>
	    <label class="field select">
	      <select ng-model="pessoa.contatos[$index].operadora"  id="operadora" name="operadora">
	        <option value="">Operadora</option>
	        <option value="Claro">Claro</option>
	        <option value="Oi">Oi</option>
	        <option value="Tim">Tim</option>
	        <option value="Vivo">Vivo</option>
	      </select>
	  </div> 
	  <div class="col-md-3">
	  	<label for="">Telefone</label>
	    <div class="section">
	      <label for="home_phone" class="field prepend-icon">
	        <input ng-model="pessoa.contatos[$index].telefone"  type="tel" name="home_phone" id="home_phone" class="gui-input phone-group"
	        onkeypress="mascaraTelefone(this, event)"
	        placeholder="Telefone com o DDD">
	        <label for="home_phone" class="field-icon">
	          <i class="fa fa-phone"></i>
	        </label>
	      </label>
	    </div>
	  </div>
	  <div class="col-md-3">
	  	<label for="">Contato</label>
	    <input ng-model="pessoa.contatos[$index].contato"  type="text" id="contato" name="contato" class="gui-input" placeholder="Contato">
	  </div>
	  <div class="col-md-1">
	    <button ng-click="btnExluirContato($index)" class="btn btn-danger btn-xs">Excluir
		   <span class="imoon imoon-cancel-circle"></span>
		</button>		
	  </div>	
	</div>  
</div>    