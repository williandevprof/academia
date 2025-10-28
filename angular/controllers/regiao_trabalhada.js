app.controller('regiao_trabalhada', function($scope, $http, $window, ngDialog)
{
  url = "http://localhost/Academia/";

	$scope.tipo_exercicio = {};

  $scope.mostrar = 'mostralistaRegiaoTrabalhada';

	$scope.novoRegiaoTrabalhada = function()
	{
		$scope.mostrar = 'cadastroRegiaoTrabalhada';
	}

	$scope.cancelarRegiaoTrabalhada = function()
	{
	  ngDialog.openConfirm({template: 'dialogcancelarRegiaoTrabalhada',
    	scope: $scope //Pass the scope object if you need to access in the template
      }).then(
        
      );
	}	

	$scope.confirmcancelarRegiaoTrabalhada = function()
	{
		 ngDialog.close();
     $scope.regiao = "";
		 $scope.mostrar = 'mostralistaRegiaoTrabalhada';
	}

	$scope.cancelcancelarRegiaoTrabalhada = function()
	{
	    ngDialog.close();
	}

	$scope.salvarRegiaoTrabalhada = function()
	{
  		var regiao = $scope.regiao;

      var config = 
      {
          headers: {'Content-Type': 'application/x-www-form-urlencoded'},
          data : regiao, 
          method: 'POST',
          url :  url+"regiao_trabalhada/addRegiao_trabalhada"  
      }
      $http(config).then(function successCallback(response) 
      { 
        if (response.data != "")
        {
          $scope.validaRegiao = response.data;

          ngDialog.openConfirm({template: 'dialogValidaRegiao',
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

          $scope.regiao = "";
          
          $scope.mostrar = 'mostralistaRegiaoTrabalhada';
        
          listarRegioesTrabalhadas();
                 
        } 
      }, function errorCallback(response)
      {
          console.log(response);
      });
  	
	}

  $scope.okValidaRegiao = function()
  {
    ngDialog.close();
  }

  $scope.okdialogCadastrado = function()
  {
    ngDialog.close();
  }

  
  $scope.pesquisarRegiaoTrabalhada = function()
  {
    
    var regiaoTrabalhada = $scope.regiao;

    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data: regiaoTrabalhada,
      method: 'POST',
      url :  url+"regiao_trabalhada/pesquisarRegiaoTrabalhada"  
    }
    $http(config).then(function successCallback(response) 
    { 

      $scope.regioes_trabalhadas = response.data;
    
    }, function errorCallback(response)
    {
      console.log(response);
    }); 
   
  }

	// auto complete do campo buscar 
  $scope.autoRegiao = function(buscarRegiaoTrabalhada)
  {
    $http.post('regiao_trabalhada/autoRegiao', { "buscarRegiaoTrabalhada" : buscarRegiaoTrabalhada}).
    success(function(data) 
    {
        // JSON retornado do banco
        $scope.autoRegioes = data;  
    })
  }

	function listarRegioesTrabalhadas()
  {
    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      method: 'GET',
      url :  url+"regiao_trabalhada/listaRegioesTrabalhadas"  
    }
    $http(config).then(function successCallback(response) 
    { 
      $scope.regioes_trabalhadas = response.data;
    
    }, function errorCallback(response)
    {
      console.log(response);
    }); 
  
  }

  listarRegioesTrabalhadas();

  $scope.editar = function(regiao)
  {
  	  var idregiaoTrabalhada = regiao.idregiaoTrabalhada;

      var config = 
      {
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        data: idregiaoTrabalhada,
        method: 'POST',
        url :  url+"regiao_trabalhada/getRegiaoEditar"  
      }
      $http(config).then(function successCallback(response) 
      { 

         $scope.regiao = response.data[0];
         $scope.mostrar = 'cadastroRegiaoTrabalhada';  
      
      }, function errorCallback(response)
      {
        console.log(response);
      }); 
  }

});	