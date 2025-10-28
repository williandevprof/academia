app.controller('usuario', function($scope, $rootScope, $http, ngDialog, $mdDialog)
{
  // declaração da variavel global da url da api
  url = "http://localhost/Academia/";

  var Usuario = "";

  function getUsuarios()
  {
    
    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      method: 'GET',
      url :  url+"usuario/getUsuarios"  
    }
    $http(config).then(function successCallback(response) 
    { 

      $scope.usuarios = response.data;
         
    }, function errorCallback(response)
    {
      console.log(response);
    }); 
   
  }

  getUsuarios();

   // metodo que faz a seleção da foto
  function selectFoto()
  {
      // chama o arquivo que faz o select das fotos
      $http.get("../Academia/api_fotos/select.php"
      ).success(function(data){
        
        $scope.images = data;
        
      });
  }

  // seleciona a foto assim que carrega a página
  selectFoto();

  // metodo para abrir um modal com a imagem ampliada e informações do usuário 
  $scope.openImg = function(ev, pessoa, image)
  {

    // guarda dados pessoais  
    $scope.pessoaDialog = pessoa;
    // guarda a imagem
    $scope.image = image;
   
    // pega o ano de nascimento
    var anoNascimento = pessoa.dataNascimento.split("-");
   

    // pega a data de hoje
    var todayDate = new Date(),
    // pega o ano atual
    todayYear = todayDate.getFullYear(),
    // pega o mes atual
    todayMonth = todayDate.getMonth(),
    // pega o dia atual
    todayDay = todayDate.getDate()

    // subtrai o ano atual com o ano de nascimento para obter a idade
    $scope.pessoaDialog.idade = todayYear - anoNascimento[0];
    
    if ($scope.pessoaDialog.genero == "M")
    {
         $scope.pessoaDialog.genero = "Masculino";
    }else if ($scope.pessoaDialog.genero == "F")
    {
         $scope.pessoaDialog.genero = "Feminino";
    }
    
    // abre o modal
    $mdDialog.show({
      
      templateUrl: 'pessoa_dialog.php',
      scope: $scope,
      preserveScope: true,
      parent: angular.element(document.body),
      targetEvent: ev,
      clickOutsideToClose:true,
      fullscreen: $scope.customFullscreen // Only for -xs, -sm breakpoints.
    
    })
    .then(function(answer) {
      $scope.status = 'You said the information was "' + answer + '".';
    }, function() {
      $scope.status = 'You cancelled the dialog.';
    });
  } 


  // auto complete do campo buscar 
  $scope.autoPessoa = function(buscarPessoa)
  {
    // Pesquisa no banco via AJAX
    $http.post('pessoa/autoPessoa', { "buscarPessoa" : buscarPessoa}).
      success(function(data) {
          // JSON retornado do banco
      $scope.autoPessoas = data;  
      
    })
  }

  // metodo para pesquisar pessoas
  $scope.pesquisarPessoa = function()
  {
    
    var pessoa = $scope.pessoa;

    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data : pessoa, 
      method: 'POST',
      url :  url+"pessoa/pesquisarPessoa"  
    }
    $http(config).then(function successCallback(response) 
    { 
      
      $scope.usuarios = response.data;
  
    }, function errorCallback(response)
    {
      console.log(response);
    }); 

  }


  $scope.editarPermissao = function(usuario, image)
  {
  	
  	// chama o arquivo que faz o select das fotos
    $http.get("../Academia/api_fotos/select.php"
    ).success(function(data){
    
      $scope.images = data;
    
    });

    $scope.usuario = usuario;

    Usuario = usuario;

    $scope.nome   = usuario.nome;
    $scope.user   = usuario.usuario;

    // chama o metodo que seleciona as permissoes no banco de dados
    getPermissoes();

    
  	$scope.mostraListaUsuarios = true;
  	$scope.mostraPermissao = true;
  }

  $scope.voltaListaUsuarios = function()
  {
    getUsuarios();
  	$scope.mostraListaUsuarios = false;
  	$scope.mostraPermissao = false;
  }


  // metodo que seleciona as permissões no banco de dados
  function getPermissoes()
  {

    var idusuario = Usuario.idusuario;

  	var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data:idusuario,
      method: 'POST',
      url :  url+"usuario/getPermissoes"  
    }
    $http(config).then(function successCallback(response) 
    { 
      
      $scope.permissoes = response.data;
         
    }, function errorCallback(response)
    {
      console.log(response);
    }); 

  }

  
  // auto complete do campo buscar 
  $scope.autoPermissao = function(permissao)
  {
    // Pesquisa no banco via AJAX
    $http.post('usuario/autoPermissao', { "permissao" : permissao}).
      success(function(data) {
          // JSON retornado do banco
      $scope.autoPermissoes = data;  
      
    })
  }

  // metodo para pesquisar permissões
  $scope.pesquisarPermissao = function()
  {
    
    var permissao = $scope.permissao;

    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data : permissao, 
      method: 'POST',
      url :  url+"usuario/pesquisarPermissao"  
    }
    $http(config).then(function successCallback(response) 
    { 
      
      $scope.permissoes = response.data;
      
    }, function errorCallback(response)
    {
      console.log(response);
    }); 

  }

  // metodo que cadastra ou altera as permissões do usuário
  $scope.cadastrar_alterar_permissao = function(idpermissao, nome)
  {
    
    // cria o objeto para guardar o id do usuario, o id da permissao
    // e o objeto que contem se é permissão de cadastro, visualização
    // alteração ou exclusão, possuindo verdadeiro ou falso  
    var permissaoObj = new Object();

    permissaoObj.idusuario = Usuario.idusuario;

    permissaoObj.idpermissao = idpermissao;

    permissaoObj.nome = nome;
    
   
    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data: permissaoObj,
      method: 'POST',
      url :  url+"usuario/cadastrar_alterar_permissao"  
    }
    $http(config).then(function successCallback(response) 
    { 
            
    }, function errorCallback(response)
    {
      console.log(response);
    });  


  }

  // altera o check box clicado para verdadeiro ou falso
  $scope.permiso = {
      nome : true
  };
 


});  