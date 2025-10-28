app.controller('exercicio', function($scope, $http, $window,  ngDialog)
{
  url = "http://localhost/Academia/";
	
  $scope.exercicio = {};

  $scope.mostrar = 'mostralistaExercicio';

  

	$scope.novoExercicio = function()
	{
		$scope.mostrar = 'cadastroExercicio';
	}

	$scope.cancelarExercicio = function()
	{
	  ngDialog.openConfirm({template: 'dialogcancelarExercicio',
    	scope: $scope //Pass the scope object if you need to access in the template
      }).then(
        
      );
	}	

	$scope.confirmcancelarExercicio = function()
	{
		 ngDialog.close();
     $scope.exercicio = "";
		 $scope.mostrar = 'mostralistaExercicio';
	}

	$scope.cancelcancelarExercicio = function()
	{
	    ngDialog.close();
	}

	$scope.salvarExercicio = function()
	{
  		var exercicio = $scope.exercicio;

      var config = 
      {
          headers: {'Content-Type': 'application/x-www-form-urlencoded'},
          data : exercicio, 
          method: 'POST',
          url :  url+"exercicio/addExercicio"  
      }
      $http(config).then(function successCallback(response) 
      {   
          
          if (response.data != "")
          {
            $scope.validaExercicio = response.data;

            ngDialog.openConfirm({template: 'dialogValidaExercicio',
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

            $scope.exercicio = "";
            
            $scope.mostrar = 'mostralistaExercicio';
          
            listarExercicios();
          } 
      }, function errorCallback(response)
      {
          console.log(response);
      });
    		
	}

  $scope.okValidaExercicio = function()
  {
    ngDialog.close();
  }

  $scope.okdialogCadastrado = function()
  {
    ngDialog.close();
  }

  
  $scope.pesquisarExercicio = function()
  {
    
    var exercicio = $scope.exercicio;

    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data: exercicio,
      method: 'POST',
      url :  url+"exercicio/pesquisarExercicio"  
    }
    $http(config).then(function successCallback(response) 
    { 

      $scope.exercicios = response.data;
         
    }, function errorCallback(response)
    {
      console.log(response);
    }); 
   
  }

	// auto complete do tipo de exercicio
  $scope.autoExercicio = function(buscarExercicio)
  {
    $http.post('exercicio/autoExercicio', { "buscarExercicio" : buscarExercicio}).
    success(function(data) 
    {
        // JSON retornado do banco
        $scope.autoExercicios = data;  
    })
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

  // auto complete do campo regiaoTrabalhada 
  $scope.autoRegiao = function(buscarRegiaoTrabalhada)
  {
    $http.post('regiao_trabalhada/autoRegiao', { "buscarRegiaoTrabalhada" : buscarRegiaoTrabalhada}).
    success(function(data) 
    {
        // JSON retornado do banco
        $scope.autoRegioes = data;  
    })
  }

  $scope.autoAparelho = function(buscarAparelho)
  {
    
    $http.post('aparelho/autoAparelho', { "buscarAparelho" : buscarAparelho}).
    success(function(data) 
    {
        // JSON retornado do banco
        $scope.autoAparelhos = data;  
    })
  }

	function listarExercicios()
  {
    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      method: 'GET',
      url :  url+"exercicio/listaExercicios"  
    }
    $http(config).then(function successCallback(response) 
    { 

      $scope.exercicios = response.data;
         
    }, function errorCallback(response)
    {
      console.log(response);
    }); 
 
  }

  listarExercicios();

  $scope.editar = function(exercicio)
  {
  	  var idexercicio = exercicio.idexercicio;

    	var config = 
      {
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        data: idexercicio,
        method: 'POST',
        url :  url+"exercicio/getExercicioEditar"  
      }
      $http(config).then(function successCallback(response) 
      { 

         $scope.exercicio = response.data[0];
         $scope.mostrar = 'cadastroExercicio'; 
      
      }, function errorCallback(response)
      {
        console.log(response);
      }); 
  }

});	