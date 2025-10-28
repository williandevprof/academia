app.controller('aparelho', function($scope, $http, $window,  ngDialog)
{
    url = "http://localhost/Academia/";
    
	  $scope.aparelho = {};

    $scope.mostrar = 'mostralistaAparelho';

	$scope.novoAparelho = function()
	{
		$scope.mostrar = 'cadastroAparelho';
	}

	$scope.cancelarAparelho = function()
	{
	  ngDialog.openConfirm({template: 'dialogcancelarAparelho',
    	scope: $scope //Pass the scope object if you need to access in the template
      }).then(
        
      );
	}	

	$scope.confirmcancelarAparelho = function()
	{
     $scope.aparelho = ""; 
		 ngDialog.close();
		 $scope.mostrar = 'mostralistaAparelho';
	}

	$scope.cancelcancelarAparelho = function()
	{
	    ngDialog.close();
	}

	$scope.salvarAparelho = function()
	{
  		var aparelho = $scope.aparelho;

      var config = 
      {
          headers: {'Content-Type': 'application/x-www-form-urlencoded'},
          data : aparelho, 
          method: 'POST',
          url :  url+"aparelho/addAparelho"  
      }
      $http(config).then(function successCallback(response) 
      { 
          if (response.data != "")
          {
            $scope.validaAparelho = response.data;

            ngDialog.openConfirm({template: 'dialogValidaAparelho',
              scope: $scope //Pass the scope object if you need to access in the template
            }).then(
              
            );
          }
          else
          {
            $scope.cadastrado = "Cadastro Realizado";
            
            ngDialog.openConfirm({template: 'dialogCadastrado',
              scope: $scope //Pass the scope object if you need to access in the template
            }).then(
              
            );

            $scope.aparelho = ""; 
          
            $scope.mostrar = 'mostralistaAparelho';

            listarAparelho();
          }
            
      }, function errorCallback(response)
      {
          console.log(response);
      });
  	
	}


  
  $scope.pesquisarAparelho = function()
  {
    
    var aparelho = $scope.aparelho;

    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data: aparelho,
      method: 'POST',
      url :  url+"aparelho/pesquisarAparelho"  
    }
    $http(config).then(function successCallback(response) 
    { 
      
      $scope.aparelhos = response.data;
    
    }, function errorCallback(response)
    {
      console.log(response);
    }); 

    
  }

	// auto complete do campo buscar 
  $scope.autoAparelho = function(buscarAparelho)
  {
    
    $http.post('aparelho/autoAparelho', { "buscarAparelho" : buscarAparelho}).
    success(function(data) 
    {
        // JSON retornado do banco
        $scope.autoAparelhos = data;  
    })
  }

	$scope.okValidaAparelho = function()
	{
		ngDialog.close();
	}

  $scope.okdialogCadastrado = function()
  {
    ngDialog.close();
  }

	function listarAparelho()
  {
    
    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      method: 'GET',
      url :  url+"aparelho/listaAparelhos"  
    }
    $http(config).then(function successCallback(response) 
    { 
       $scope.aparelhos = response.data;
    
    }, function errorCallback(response)
    {
      console.log(response);
    }); 
   
  }

  listarAparelho();

  $scope.editar = function(aparelho)
  {
  	  var idaparelho = aparelho.idaparelho;

      var config = 
      {
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        data: idaparelho,
        method: 'POST',
        url :  url+"aparelho/getAparelhoEditar"  
      }
      $http(config).then(function successCallback(response) 
      { 

         $scope.mostrar = 'cadastroAparelho';  
         $scope.aparelho = response.data[0]; 
      
      }, function errorCallback(response)
      {
        console.log(response);
      }); 
    	
  }

});	