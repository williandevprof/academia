app.factory("pessoaServico", function($http){
  
  // declaração da variavel global da url da api
  url = "http://localhost/academia/";
    

      

  var _getContratos = function()
  {
      return $http.get(url+"pessoa/getContratos");
  }
  
  var _getCategoriaTreino = function()
  {
      return $http.get(url+"pessoa/getCategoriaTreino");
  }

  var _getTipoPlano = function()
  {
      return $http.get(url+"pessoa/getTipoPlano");
  }

  var _getFormaPgto = function()
  {
      return $http.get(url+"pessoa/getFormaPgto");
  }

  var _getPrazoPlano = function()
  {
      return $http.get(url+"pessoa/getPrazoPlano");
  }   


  // retorna o objeto da api para o controller
  return {
       
        getContratos:        _getContratos,
        getTipoPlano:        _getTipoPlano,
        getFormaPgto:        _getFormaPgto,
        getPrazoPlano:       _getPrazoPlano,
        getCategoriaTreino:  _getCategoriaTreino
    };
   
});