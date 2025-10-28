<div id="usuario" ng-show="mostrar == 'usuario'">
  <div class="section-divider mv40" id="spy3">
    <span>Dados do Usuário</span>
  </div>
  <!-- .section-divider -->
  <div class="row">
    <div class="col-md-4">
    </div>
    <div class="col-md-4">
    </div>
    <div class="col-md-4">
      <label ng-show="mostraConfSenhaDiferente" style="color:red">
        Senha não confirmada
      </label>
    </div>   
  </div>
  <div class="row">
    <div class="col-md-4">
      <label for="">Usuário</label>
      <label for="firstname" class="field prepend-icon">
          <input ng-model="pessoa.user" type="text" name="user" id="user" class="gui-input" placeholder="Digite o nome do Usuário">
          <label for="firstname" class="field-icon">
            <i class="fa fa-user"></i>
          </label>
        </label>
    </div>
    <div class="col-md-4">
      <label for="">Senha</label>
      <label for="password" class="field prepend-icon">
        <input ng-model="pessoa.senha" type="password" name="senha" id="senha" class="gui-input" placeholder="Digite a Senha do Usuário">
        <label for="password" class="field-icon">
          <i class="fa fa-lock"></i>
        </label>
      </label>
    </div> 
    <div class="col-md-4">
      <label for="">Confirmar Senha</label>
      <label for="repeatPassword" class="field prepend-icon">
        <input ng-model="pessoa.confsenha" ng-blur="validaConfSenha()" type="password" name="confsenha" id="confsenha" class="gui-input" placeholder="Repita a Senha do Usuário">
        <label for="repeatPassword" class="field-icon">
          <i class="fa fa-unlock-alt"></i>
        </label>
      </label>
    </div>    
  </div> 
</div>
 