app.controller('main', function($scope, $rootScope, $http, $mdDialog, ngDialog)
{
  // declaração da variavel global da url da api
  url = "http://localhost/Academia/";

  // metodo que pega os dados do usuário logado
  function getUsuario()
  {
    
    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      method: 'GET',
      url :  url+"main/getUsuario"  
    }
    $http(config).then(function successCallback(response) 
    { 

      $scope.usuario = response.data;
      
      // verifica se o usuário logado é um funcionario
      if ($scope.usuario[0].idfuncionario)
      {
        //chama o metodo que irá verificar se tem ciclo de treino
        // de alunos com data expirada
        data_ciclo_terminado($scope.usuario[0].nome)
        
      }
               
    }, function errorCallback(response)
    {
      console.log(response);
    }); 
   
  }

  getUsuario();

  // metodo que irá verificar se tem aluno com ciclo de treino
  // com data expirando hoje
  function data_ciclo_terminado(funcionario)
  {
    // guarda o nome do funcionario logado no sistema para notificá-lo
    $scope.funcionario = funcionario;
    
    var config = 
    {
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        method: 'GET',
        url :  url+"main/getAlunosCiclos"  
    }
    $http(config).then(function successCallback(response) 
    { 
      $scope.ciclos = response.data;

      // verifica se a consulta retornou algum ciclo com data vencendo hoje
      if ($scope.ciclos[0].ativo == 1) 
      {
        // abre o modal
        $mdDialog.show({
          
          templateUrl: 'aviso_data_ciclo_terminado.php',
          scope: $scope,
          preserveScope: true,
          parent: angular.element(document.body),
          clickOutsideToClose:true,
          fullscreen: $scope.customFullscreen // Only for -xs, -sm breakpoints.
        
        })
        .then(function(answer) {
          $scope.status = 'You said the information was "' + answer + '".';
        }, function() {
          $scope.status = 'You cancelled the dialog.';
        });
        
      }
  
    }, function errorCallback(response)
    {
      console.log(response);
    });  
   
  }


  // metodo que faz a seleção da foto
  function selectFoto()
  {
      // chama o arquivo que faz o select das fotos
      $http.get("../Academia/api_fotos/select.php"
      ).success(function(data){
        
        $scope.images = data;
        
      });
  }

  // seleciona a foto assim que carrega a página
  selectFoto();

});

