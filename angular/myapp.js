var myapp = angular.module('myApp', ['angularUtils.directives.dirPagination', 'ngDialog', 'mdDialog']);


myapp.controller('clienteCtrl', function($scope, $http, ngDialog)
{
  // metodo que manda salvar ou alterar  
  $scope.salvar = function(cliente)
  {
      var config = 
      {
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        data : cliente, 
        method: 'POST',
        url :  "http://localhost/Api_RestFull_Codeigniter/cliente_api/addCliente"  
      }
      $http(config).then(function successCallback(response) 
      { 
        console.log(response);
        $scope.clientes = response.data;
        listar();

      }, function errorCallback(response)
      {
        console.log(response);
      }); 
  }

  function listar()
  {

      var config =
      {
          method: 'GET',
          /* data : null, */
           url :  "http://localhost/Api_RestFull_Codeigniter/cliente_api/listaCliente" 
      }
      $http(config).then(function successCallback(response)
      { 
        //sucesso
        $scope.clientes = response.data;
        $scope.cliente = "";
      }, function errorCallback(response) {
        //erro
      });
  }

  // lista quando carrega a aplicação
  var config =
  {
      method: 'GET',
      /* data : null, */
       url :  "http://localhost/Api_RestFull_Codeigniter/cliente_api/listaCliente" 
  }
  $http(config).then(function successCallback(response)
  { 
    //sucesso
    $scope.clientes = response.data;
  }, function errorCallback(response) {
    //erro
  });
  
  // quando clica em editar carrega os dados no formulario
  $scope.editar = function(cliente)
  {
    $scope.cliente = angular.copy(cliente);
  }

  var idCliente = "";

  // abre modal para delatar cliente
  $scope.deleteCliente = function(cliente){
    idCliente = cliente.idCliente;
    
    ngDialog.openConfirm({template: 'dialogExcCliente',
      scope: $scope //Pass the scope object if you need to access in the template
    }).then(
      
    );
  }
  
  // confirma a exclusão
  $scope.confirmExcCliente = function()
  {
    $http({
      method: 'POST',
      url:'cliente/deleteCliente',
      headers:{'Content-Type':'application/json'},
      data: idCliente
    }).success(function(data){
      // lista depois de cadastrar ou alterar ou deletar
      console.log(data);
      $http({
        method: 'GET',
        url:'cliente/listaCliente',
        headers:{'Content-Type':'application/json'}
      
      }).success(function(data){
        $scope.lista = data;
      });

      delete $scope.cli;
      $scope.formCliente.$setPristine();
      ngDialog.close();
    });
  }

});
