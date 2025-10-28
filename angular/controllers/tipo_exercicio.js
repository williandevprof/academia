app.controller('tipo_exercicio', function($scope, $http, $window, ngDialog)
{
  url = "http://localhost/Academia/";
	
  $scope.tipo_exercicio = {};

  $scope.mostrar = 'mostralistaTipoExercicio';

	$scope.novoTipoExercicio = function()
	{
		$scope.mostrar = 'cadastroTipoExercicio';
	}

	$scope.cancelartipoExercicio = function()
	{
	  ngDialog.openConfirm({template: 'dialogcancelartipoExercicio',
    	scope: $scope //Pass the scope object if you need to access in the template
      }).then(
        
      );
	}	

	$scope.confirmcancelartipoExercicio = function()
	{
		 ngDialog.close();
     $scope.tipo = "";
		 $scope.mostrar = 'mostralistaTipoExercicio';
	}

	$scope.cancelcancelartipoExercicio = function()
	{
	    ngDialog.close();
	}

	$scope.salvarTipoExercicio = function()
	{
  		var tipo_exercicio = $scope.tipo;

      var config = 
      {
          headers: {'Content-Type': 'application/x-www-form-urlencoded'},
          data : tipo_exercicio, 
          method: 'POST',
          url :  url+"tipo_exercicio/addTipo_exercicio"  
      }
      $http(config).then(function successCallback(response) 
      { 
          if (response.data != "")
        {
          $scope.validaTipo = response.data;

          ngDialog.openConfirm({template: 'dialogValidaTipo',
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

          $scope.tipo = "";
          
          $scope.mostrar = 'mostralistaTipoExercicio';
        
          listarTipos_exercicios();
                 
        } 
      }, function errorCallback(response)
      {
          console.log(response);
      });
  		
	}

  $scope.okValidaTipo = function()
  {
    ngDialog.close();
  }

  $scope.okdialogCadastrado = function()
  {
    ngDialog.close();
  }

  
  $scope.pesquisarTipoExercicio = function()
  {
    
    var tipoExercicio = $scope.tipo;

    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data: tipoExercicio,
      method: 'POST',
      url :  url+"tipo_exercicio/pesquisarTipoExercicio"  
    }
    $http(config).then(function successCallback(response) 
    { 
       $scope.tipos_exercicios = response.data;
    
    }, function errorCallback(response)
    {
      console.log(response);
    }); 
  }

	// auto complete do campo buscar 
  $scope.autoTipo = function(buscarTipoExercicio)
  {
    $http.post('tipo_exercicio/autoTipo', { "buscarTipoExercicio" : buscarTipoExercicio}).
    success(function(data) 
    {
        // JSON retornado do banco
        $scope.autoTipos = data;  
    })
  }

	

	function listarTipos_exercicios()
  {
    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      method: 'GET',
      url :  url+"tipo_exercicio/listaTipo_exercicios"  
    }
    $http(config).then(function successCallback(response) 
    { 

      $scope.tipos_exercicios = response.data;
    
    }, function errorCallback(response)
    {
      console.log(response);
    }); 
    
  }

  listarTipos_exercicios();

  $scope.editar = function(tipo)
  {
  	  var idtipoExercicio = tipo.idtipoExercicio;

      var config = 
      {
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        data: idtipoExercicio,
        method: 'POST',
        url :  url+"tipo_exercicio/getTipoEditar"  
      }
      $http(config).then(function successCallback(response) 
      { 

         $scope.tipo = response.data[0];
         $scope.mostrar = 'cadastroTipoExercicio';   
      
      }, function errorCallback(response)
      {
        console.log(response);
      }); 

    	
  }

});	