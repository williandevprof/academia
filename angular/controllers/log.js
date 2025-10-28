app.controller('log', function($scope, $window, $rootScope, $http, ngDialog, $mdDialog)
{
  // declaração da variavel global da url da api
  url = "http://localhost/Academia/";

  $scope.pesquisarLog = function()
  {
  	var log = $scope.log;
    
    $http({
      method: 'POST',
      data:log,
      url:'log_pdf',
      headers:{'Content-Type':'application/json'}
        
    }).success(function(data){
      
      $window.open(url+'/log_pdf/imprimirLog');

    });
  }

});