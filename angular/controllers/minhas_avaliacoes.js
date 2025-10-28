app.controller('minhas_avaliacoes', function($scope, $http, $window, ngDialog)
{
  url = "http://localhost/Academia/";

  // metodo que pega as avaliações do aluno logado
  function getAvaliacoes()
  {
    
    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      method: 'GET',
      url :  url+"minhas_avaliacoes/getAvaliacoes"  
    }
    $http(config).then(function successCallback(response) 
    { 

      $scope.avaliacoes = response.data;
         
    }, function errorCallback(response)
    {
      console.log(response);
    }); 
   
  }

  getAvaliacoes();

  $scope.pesquisarAvaliacao = function()
  {

  	var avaliacao = $scope.avaliacao;

  	var config = 
    {
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        data : avaliacao, 
        method: 'POST',
        url :  url+"minhas_avaliacoes/pesquisarAvaliacao"  
    }
    $http(config).then(function successCallback(response) 
    {  
    	$scope.avaliacoes = response.data;
	  	
	}, function errorCallback(response)
    {
        console.log(response);
    });  	
  }

  $scope.detalharAvaliacao = function(avaliacao)
  {
    
    $http({
      method: 'POST',
      data:avaliacao,
      url:'avaliacao_fisica_pdf',
      headers:{'Content-Type':'application/json'}
        
    }).success(function(data){
      
      $window.open(url+'/avaliacao_fisica_pdf/imprimirAvaliacao');

    });
  }

});  