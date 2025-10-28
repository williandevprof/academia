<div ng-show="mostraAlunoPerfil">
  <div class="row">
   
    <div class="col-md-2">
      <div class="row">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-info" ng-click="getCiclosTreinosAluno($event, aluno.idaluno)">
          Visualizar Ciclos de Treino
          <i class="fa fa-search"></i>
        </button>
      </div>
      <br><br>
      <?php
        session_start();
        $conexao = mysqli_connect('127.0.0.1', 'root', '', 'academia');

          $sql = mysqli_query($conexao, "SELECT * FROM usuario u 
          JOIN usuario_permissao up on u.idusuario = up.idusuario
          JOIN permissao p on up.idpermissao = p.idpermissao
          WHERE u.idusuario = '{$_SESSION["iduser"]}'
          AND  p.permissao = 'alunos treinos'");
     
          $retornoAlunos_Treinos = mysqli_fetch_assoc($sql);

          if ($retornoAlunos_Treinos['cadastrar'] == 1)
          {
            ?>  
              <div class="row">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-primary" ng-click="addAlunoTreino($event)">
                  Adicionar Ciclos de Treino
                  <i class="fa fa-plus"></i>
                </button>
              </div>
            <?php
          }
        ?>      
      <br><br> 
      <div class="row">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-info" ng-click="getTreinosRealizadosAluno(aluno.idaluno)">
          Treinos Realizados
          <i class="fa fa-search"></i>
        </button>
      </div>
      <br><br>
      <div class="row">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-warning" ng-click="voltaListaAlunos()">
          <i class="fa fa-sign-in fs22 text-primary"></i> 
          Voltar para a lista de alunos
        </button>
      </div> 
    </div>
    <div class="col-md-2">
      <img  ng-repeat="image in images" ng-if="aluno.idpessoa == image.idpessoa" style="width: 200px; height: 200px;" ng-src="../Academia/api_fotos/images/{{image.foto}}">
    </div>  
    <div class="col-md-4">
      <div class="row">
        <span style="font-size: 16px;">Nome:</span> <span style="font-size: 18px;"><b>{{aluno.nome}}</b></span>
      </div>
      <div class="row">
        <span style="font-size: 16px;">Idade:</span> <span style="font-size: 18px;"><b>{{aluno.idade}}</b></span> 
      </div>
      <div class="row">
        <span style="font-size: 16px;">Genero:</span> <span style="font-size: 18px;"><b>{{aluno.genero}}</b></span>
      </div>
    </div>
  </div>
  <br><br> 
</div>