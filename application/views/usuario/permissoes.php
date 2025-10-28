<div ng-show="mostraPermissao">
  <div class="section-divider mb40" id="spy2">
    <span>Identificação do Usuário</span>
  </div>

  <div class="row">
    <div class="col-md-2">
      <img  ng-repeat="image in images" ng-if="usuario.idpessoa == image.idpessoa" style="width: 200px; height: 200px;" ng-src="../Academia/api_fotos/images/{{image.foto}}">
    </div> 
    <div class="col-md-4">
      <div class="row">
        <span style="font-size: 16px;">Nome:</span> <span style="font-size: 18px;"><b>{{nome}}</b></span>
      </div>
      <div class="row">
        <span style="font-size: 16px;">Usuário:</span> <span style="font-size: 18px;"><b>{{user}}</b></span> 
      </div>
     
      <br>
      <button class="btn btn-warning" ng-click="voltaListaUsuarios()">
        <i class="fa fa-sign-in fs22 text-primary"></i> 
        Voltar para a lista de usuários
      </button>
    </div>  
  </div>


  <div>
    <div  class="section-divider mb40">
      <span>Permissões</span>
    </div>

    
    <br>
    <div class="row">
     
      <div class="col-md-5">
        <label for="firstname" class="field prepend-icon">
          <input ng-model="permissao.permissao"  type="text" class="gui-input" placeholder="Digite o nome da permissao para a busca"
          ng-keyup="autoPermissao(permissao.permissao)" uib-typeahead="autoPermissao as autoPermissao.permissao for autoPermissao in autoPermissoes | filter:$viewValue | limitTo:8">
          
        </label>
      </div>

      
      <div class="col-md-2">
        <button ng-click="pesquisarPermissao()" class="button btn-primary">Buscar&nbsp;<i class="fa fa-search"></i></button>
      </div>
    </div>
    <br><br>

    <div>
      <table  class="table table-bordered table-striped table-hover">
        <tr>
          <th>ID</th>        
          <th>Permissão</th>
          <th>Visualizar</th>
          <th>Cadastrar</th>
          <th>Alterar</th>
          <th>Excluir</th>
                    
        </tr>

        
        <tr dir-paginate="permissao in permissoes|itemsPerPage:8">
          <td>{{permissao.idpermissao}}</td>
          <td>{{permissao.permissao}}</td>
          
          <td>
               
            <div class="section">
              <label class="option">
              <input ng-model="permiso[$index].nome_visualizar.visualizar" type="checkbox" ng-click="cadastrar_alterar_permissao(permissao.idpermissao, permiso[$index].nome_visualizar)"
              ng-checked="permissao.visualizar == 1">
              <span class="checkbox"></span></label>
            </div>
          </td>

          <td>
            <div class="section">
              <label class="option">
              <input ng-model="permiso[$index].nome_cadastrar.cadastrar" type="checkbox" ng-click="cadastrar_alterar_permissao(permissao.idpermissao, permiso[$index].nome_cadastrar)"
               ng-checked="permissao.cadastrar == 1">
              <span class="checkbox"></span></label>
            </div>
          </td>

          <td>
            <div class="section">
              <label class="option">
              <input ng-model="permiso[$index].nome_alterar.alterar" type="checkbox" ng-click="cadastrar_alterar_permissao(permissao.idpermissao, permiso[$index].nome_alterar)"
               ng-checked="permissao.alterar == 1">
              <span class="checkbox"></span></label>
            </div>
          </td>

          <td>
            <div class="section">
              <label class="option">
              <input ng-model="permiso[$index].nome_excluir.excluir" type="checkbox" ng-click="cadastrar_alterar_permissao(permissao.idpermissao, permiso[$index].nome_excluir)"
              ng-checked="permissao.excluir == 1">
              <span class="checkbox"></span></label>
            </div>
          </td>
          
        </tr>
      </table>
      <div class="btn_paginacao">
        <dir-pagination-controls
          max-size="5"
          direction-links="true"
          boundary-links="true" >
        </dir-pagination-controls>
      </div> <!-- fim da paginação-->
    </div> 
  </div> <!-- fim da div do lista permissoes-->


</div>  
