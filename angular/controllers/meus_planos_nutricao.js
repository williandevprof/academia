app.controller('meus_planos_nutricao', function($scope, $http, $window, ngDialog)
{

  url = "http://localhost/Academia/";

  // metodo que pega as avaliações do aluno logado
  function getPlanos_nutricao()
  {
    
    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      method: 'GET',
      url :  url+"meus_planos_nutricao/getPlanos_nutricao"  
    }
    $http(config).then(function successCallback(response) 
    { 

      $scope.planos_nutricao = response.data;
         
    }, function errorCallback(response)
    {
      console.log(response);
    }); 
   
  }

  getPlanos_nutricao();

  $scope.pesquisarNutricao = function()
  {

  	var nutricao = $scope.nutricao;

  	var config = 
    {
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        data : nutricao, 
        method: 'POST',
        url :  url+"meus_planos_nutricao/pesquisarNutricao"  
    }
    $http(config).then(function successCallback(response) 
    {  
    	$scope.planos_nutricao = response.data;
	  	
	}, function errorCallback(response)
    {
        console.log(response);
    });  	
  }

  $scope.detalharNutricao = function(plano)
  {
    
    $http({
      method: 'POST',
      data:plano,
      url:'nutricao_pdf',
      headers:{'Content-Type':'application/json'}
        
    }).success(function(data){
      
      $window.open(url+'/nutricao_pdf/imprimirNutricao');

    });
  }

});  