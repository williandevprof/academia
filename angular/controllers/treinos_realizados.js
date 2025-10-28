app.controller('treinos_realizados', function($scope, $rootScope, $http, ngDialog, $mdDialog)
{
  // declaração da variavel global da url da api
  url = "http://localhost/Academia/";

  $scope.setClickedRowTreinoRealizado = function(index)
  {
    $scope.selectedRowTreinoRealizado = index;
  }
  
  // seleciona os ciclos e treinos realizados pelo aluno
  function getTreinosRealizados()
  {
    
    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      method: 'GET',
      url :  url+"treinos_realizados/getTreinosRealizados"  
    }
    $http(config).then(function successCallback(response) 
    { 
      $scope.treinosRealizados = response.data;
         
    }, function errorCallback(response)
    {
      console.log(response);
    }); 
   
  }

  getTreinosRealizados();

  // autocomplete do campo de busca
  $scope.autoCiclosRealizados = function(buscarCicloRealizado)
  { 
        
    // chama o metodo de busca no controller
    $http.post('treinos_realizados/autoCiclosRealizados', { "buscarCicloRealizado" : buscarCicloRealizado}).
    success(function(data) 
    { 
        // JSON retornado do banco
        $scope.autoCiclos = data;  
    })
  }

  // pesquisa os treinos de acordo com os filtros 
  $scope.pesquisarTreinosRealizados = function()
  {
    var pesquisarCiclosRealizadosObj = new Object();
    
    pesquisarCiclosRealizadosObj.buscar = $scope.buscarCicloRealizado;

    pesquisarCiclosRealizadosObj.dataInicio = $scope.buscarDataInicio;

    pesquisarCiclosRealizadosObj.dataTermino = $scope.buscarDataTermino;

    pesquisarCiclosRealizadosObj.dataTreinoRealizado = $scope.buscarDataTreinoRealizado;

    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data: pesquisarCiclosRealizadosObj,
      method: 'POST',
      url :  url+"treinos_realizados/pesquisarTreinosRealizados"  
    }
    $http(config).then(function successCallback(response) 
    { 
       $scope.treinosRealizados = response.data;
        
    }, function errorCallback(response)
    {
      console.log(response);
    });
  }

  // mostra detalhes do treino e os exercicios do treino realizado
  // quando o usuário clica em cima do treino na grid
  $scope.mostraTreinoRealizado = function(idtreino_realizado)
  {
    
    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data: idtreino_realizado,
      method: 'POST',
      url :  url+"treinos_realizados/mostraTreinoRealizado"  
    }
    $http(config).then(function successCallback(response) 
    { 
        $scope.cicloSelecionado = response.data[0];
        
        $scope.mostraCicloSelecionado = true;
               
    }, function errorCallback(response)
    {
      console.log(response);
    });

    getTreinos(idtreino_realizado);
    
    getExerciciosTreinos(idtreino_realizado);

  }

  
  function getExerciciosTreinos(idtreino_realizado)
  {
    
    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data: idtreino_realizado,
      method: 'POST',
      url :  url+"treinos_realizados/getExerciciosTreinos"  
    }
    $http(config).then(function successCallback(response) 
    { 

      $scope.exerciciosTreino = response.data;

      
      // pega a ultima posição do array de exercicios
      var ultimaPosicao = response.data.length; 

      var stringRegiao = "";

      var verificaRegiao = "";

      // percorre todos os exercício
      for (var i = 0; i < ultimaPosicao; i++)
      {
        // verifica se a região trabalhada do exercício é diferente da anterior
        // para não repetir região trabalhada
        if (verificaRegiao != response.data[i].regiaoTrabalhada)
        {
            // verifica se a variável que vai guardar a string está vazio ou nao
            // para usar ou não a virgula 
            if (stringRegiao != "")
            {
               stringRegiao = stringRegiao+", "+response.data[i].regiaoTrabalhada;
            }
            else
            {
               stringRegiao = stringRegiao+" "+response.data[i].regiaoTrabalhada;
            }  
            
        }
        
        verificaRegiao = response.data[i].regiaoTrabalhada;
       
      }

      $scope.regiosTrabalhadas = stringRegiao;
        
    }, function errorCallback(response)
    {
      console.log(response);
    }); 
   
  }

 
  
  function getTreinos(idtreino_realizado)
  {

    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data: idtreino_realizado,
      method: 'POST',
      url :  url+"treinos_realizados/getTreinos"  
    }
    $http(config).then(function successCallback(response) 
    { 
        $scope.treinos = response.data;
                             
    }, function errorCallback(response)
    {
        console.log(response);
    }); 
  }


});  