app.controller('valores_planos', function($scope, $http, $window, pessoaServico, myResource,  $mdDialog, ngDialog)
{

	// declaração da variavel global da url da api
  url = "http://localhost/Academia/";


  $scope.salvarValor_plano = function()
  {
  	var valor_plano = $scope.valor_plano;
  	
  	var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data : valor_plano, 
      method: 'POST',
      url :  url+"valores_planos/salvarValor_plano"  
    }
    $http(config).then(function successCallback(response) 
    {  
       $scope.valor_plano = "";
       listarValores_plano();

    }, function errorCallback(response)
    {
      console.log(response);
    });  
  }  

  function listarValores_plano()
  {
    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      method: 'GET',
      url :  url+"valores_planos/listarValores_plano"  
    }
    $http(config).then(function successCallback(response) 
    { 
      $scope.valores_plano = response.data;
      
    }, function errorCallback(response)
    {
      console.log(response);
    });  
  }

  listarValores_plano();

  function listarPrazos_plano()
  {
    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      method: 'GET',
      url :  url+"contrato/listarPrazos_plano"  
    }
    $http(config).then(function successCallback(response) 
    { 
      $scope.prazos_plano = response.data;
      
    }, function errorCallback(response)
    {
      console.log(response);
    });  
  }

  listarPrazos_plano();

  function listarTipos_plano()
  {
      var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      method: 'GET',
      url :  url+"contrato/listarTipos_plano"  
    }
    $http(config).then(function successCallback(response) 
    { 
      $scope.tipos_plano = response.data;
      
    }, function errorCallback(response)
    {
      console.log(response);
    });  
  }

  listarTipos_plano();


  function listarModalidades()
  {
      var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      method: 'GET',
      url :  url+"contrato/listarModalidades"  
    }
    $http(config).then(function successCallback(response) 
    { 
      $scope.modalidades = response.data;
      
    }, function errorCallback(response)
    {
      console.log(response);
    });  
  }

  listarModalidades();
});	