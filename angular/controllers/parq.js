app.controller('parq', function($scope, $http, $window,  ngDialog)
{
	$scope.parqperguntas  = [];

  // declaração da variavel global da url da api
  url = "http://localhost/Academia/";
  
	// mostra mais campos de perguntas para o parq 
	$scope.maisPergunta = function()
	{
	   $scope.parqperguntas.push(
	   { 
	        
	   });
	}

	// excluir os campos de pergunta da linha clicada
  $scope.btnExluirPergunta = function(parqperguntas)
  {
    $scope.idperguntaParq = parqperguntas.idperguntaParq;

    ngDialog.openConfirm({template: 'dialogExluirPergunta',
      scope: $scope //Pass the scope object if you need to access in the template
    }).then(
      
    );
  }

  $scope.confirmExcluirPergunta = function()
  {
    //$scope.parqperguntas.splice($scope.indice, 1);

    var idperguntaParq = $scope.idperguntaParq;

    var config = 
    {
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        data : idperguntaParq, 
        method: 'POST',
        url :  url+"parq/excluirPergunta"  
    }
    $http(config).then(function successCallback(response) 
    { 
        $scope.cadastrado = "Exclusão Realizada";

        ngDialog.openConfirm({template: 'dialogValidaParq',
            scope: $scope //Pass the scope object if you need to access in the template
        }).then(
            
        );

        listaPerguntas();
         
      }, function errorCallback(response)
      {
          console.log(response);
      });

      ngDialog.close();
  }

  $scope.cancelExcluirPergunta = function()
  {
    ngDialog.close();
  }

  // metodo para trazer o texto do parq
	function getParq()
	{
	    var config = 
      {
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        method: 'GET',
        url :  url+"parq/getParq" 
      }
      $http(config).then(function successCallback(response) 
      { 

         $scope.parq = response.data[0];
      
      }, function errorCallback(response)
      {
        console.log(response);
      }); 
	}

	getParq();

  // metodo para listar as perguntas do parq
	function listaPerguntas()
  {

    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      method: 'GET',
      url :  url+"pessoa/listaPerguntas"  
    }
    $http(config).then(function successCallback(response) 
    { 
      $scope.parqperguntas = response.data;
            
    }, function errorCallback(response)
    {
      console.log(response);
    }); 
  }

  listaPerguntas();

  // metodo para adicionar uma nova pergunta ao parq
  $scope.salvar = function()
  {
  	var perguntas = $scope.parqperguntas;

    var parq = $scope.parq;

    // cria o objeto para guardar o texto do parq e as perguntas
    var parq_perguntas = new Object();

    parq_perguntas.parq  = parq;
    
    parq_perguntas.perguntas =  perguntas; 
  	
    var config = 
    {
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        data : parq_perguntas, 
        method: 'POST',
        url :  url+"parq/addPergunta"
    }
    $http(config).then(function successCallback(response) 
    {
        
        $scope.cadastrado = "Cadastro Realizado";

        ngDialog.openConfirm({template: 'dialogValidaParq',
            scope: $scope //Pass the scope object if you need to access in the template
        }).then(
            
        );

        listaPerguntas();
    }, function errorCallback(response)
    {
        console.log(response);
    });  
  }

  $scope.okValidaParq = function()
  {
  	 ngDialog.close();
  }
});	