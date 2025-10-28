app.controller('login', function($scope, $rootScope, $http, ngDialog)
{

  $scope.usuario = {};

  // declaração da variavel global da url da api
  url = "http://localhost/Academia/";

  $scope.loginUsuario = function()
  {
      var usuario = $scope.usuario;
      
      var config = 
      {
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        data : usuario, 
        method: 'POST',
        url :  url+"login/logar"  
      }
      $http(config).then(function successCallback(response) 
      { 
        if (response.data == 1)
        {
            window.location.href = "http://localhost/Academia/main";
        }
        else
        {
            $scope.errologin = "Usuário ou senha incorreto";

            ngDialog.openConfirm({template: 'dialogErroLogin',
            scope: $scope //Pass the scope object if you need to access in the template
            }).then(
              
            );
        }
      
      }, function errorCallback(response)
      {
        console.log(response);
      });
  }

  $scope.okValidaLogin = function()
  {
       ngDialog.close();
  }

});
