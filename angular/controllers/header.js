app.controller('header', function($scope, $rootScope, $http, ngDialog, $mdDialog)
{
  // declaração da variavel global da url da api
  url = "http://localhost/Academia/";

  $scope.logout = function()
  {
  	var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      method: 'GET',
      url :  url+"header/sair"  
    }
    $http(config).then(function successCallback(response) 
    { 
    	// redireciona para a tela de login	
        window.location.href = "http://localhost/Academia/login";

    }, function errorCallback(response)
    {
      console.log(response);
    }); 

  	
  }

});  