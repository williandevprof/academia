app.controller('contrato', function($scope, $http, $window, ngDialog)
{
	// declaração da variavel global da url da api
  	url = "http://localhost/Academia/";

  	// esconde a lista de contratos e mostra o formulário
  	$scope.addContrato = function()
  	{
  		$scope.mostraFormContrato  = true;
  		$scope.mostraListaContrato = true;
  	}

  	// lista todos os contratos
    function listarContratos()
    {
	    var config = 
	    {
	      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
	      method: 'GET',
	      url :  url+"contrato/listarContratos"  
	    }
	    $http(config).then(function successCallback(response) 
	    { 

	      $scope.contratos = response.data;
	         
	    }, function errorCallback(response)
	    {
	      console.log(response);
	    }); 
	}    

	listarContratos();

  	// salva um contrato no banco de dados
	$scope.salvar = function()
	{
  	  var contrato = $scope.contrato;

      var config = 
      {
          headers: {'Content-Type': 'application/x-www-form-urlencoded'},
          data : contrato, 
          method: 'POST',
          url :  url+"contrato/addContrato"  
      }
      $http(config).then(function successCallback(response) 
      {   
          
          if (response.data != 0)
          {
            $scope.validaContrato = response.data;

            ngDialog.openConfirm({template: 'dialogValidaContrato',
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

            $scope.contrato = "";

            $scope.mostraFormContrato  = false;
  			$scope.mostraListaContrato = false;	

            listarContratos();
            
          } 
      }, function errorCallback(response)
      {
          console.log(response);
      });
    }
      
    $scope.okValidaContrato = function()
    {
      ngDialog.close();
    }

    // carrega o form preenchido para alterar um contrato
    $scope.editar = function(contrato)
    {	
    	$scope.contrato = contrato;

    	$scope.mostraFormContrato  = true;
  		$scope.mostraListaContrato = true;	
    	
    }

   
    $scope.cancelarContrato = function()
    {
    	ngDialog.openConfirm({template: 'dialogcancelarContrato',
	        scope: $scope //Pass the scope object if you need to access in the template
	    }).then(
	        
	    );
    }

     // volta para a lista quando o usuário clica em cancelar no form do contrato
    $scope.confirmcancelarContrato = function()
    {
    	$scope.contrato = "";

    	$scope.mostraFormContrato  = false;
  		$scope.mostraListaContrato = false;
  		
  		ngDialog.close();	
    }

    $scope.cancelcancelarContrato = function()
    {
    	ngDialog.close();	
    }

    // auto complete do campo buscar 
    $scope.autoContrato = function(buscarContrato)
    {
	    // Pesquisa no banco via AJAX
	    $http.post('contrato/autoContrato', { "buscarContrato" : buscarContrato}).
	      success(function(data) {

	      // JSON retornado do banco
	      $scope.autoContratos = data;  
	      
	    })
    }

    $scope.pesquisarContrato = function()
    {
    
	    var contrato = $scope.contrato;

	    var config = 
	    {
	      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
	      data: contrato,
	      method: 'POST',
	      url :  url+"contrato/pesquisarContrato"  
	    }
	    $http(config).then(function successCallback(response) 
	    { 

	      $scope.contratos = response.data;
	         
	    }, function errorCallback(response)
	    {
	      console.log(response);
	    }); 
	}
	    
    // abre o pdf para imprimir o contrato
    $scope.imprimirContrato = function(contrato)
    {
	    	
	    $http({
	      method: 'POST',
	      data:contrato,
	      url:'contrato_pdf',
	      headers:{'Content-Type':'application/json'}
	        
	    }).success(function(data){
	      
	      $window.open(url+'/contrato_pdf/imprimirContrato');

	    });
    }

});	