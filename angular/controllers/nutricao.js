app.controller('nutricao', function($scope, $http, $window, $mdDialog, ngDialog, $filter)
{
  url = "http://localhost/Academia/";

  Aluno = "";

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

  // metodo que pega os alunos para listar
  function getAlunos()
  {
    
    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      method: 'GET',
      url :  url+"aluno/getAlunos"  
    }
    $http(config).then(function successCallback(response) 
    { 

      $scope.alunos = response.data;
         
    }, function errorCallback(response)
    {
      console.log(response);
    }); 
   
  }

  getAlunos();

  // seleciona as refeições para preencher o campo de refeição
  function getRefeicoes()
  {
    
    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      method: 'GET',
      url :  url+"nutricao/getRefeicoes"  
    }
    $http(config).then(function successCallback(response) 
    { 

      $scope.refeicoes = response.data;
         
    }, function errorCallback(response)
    {
      console.log(response);
    }); 
   
  }

  getRefeicoes();

  // metodo que é disparado quando clica no novo plano de nutrição
  $scope.addPlano = function(aluno)
  {
  	
  	// chama o arquivo que faz o select das fotos
    $http.get("../Academia/api_fotos/select.php"
    ).success(function(data){
    
      $scope.images = data;
    
    });

    $scope.aluno = aluno;

    // passa o aluno para a variavel global
  	Aluno = aluno;

  	$scope.nome   = aluno.nome;

  	if (aluno.genero == "F") 
  	{
  		$scope.genero = "Feminino";
  	}else if (aluno.genero == "M") 
  	{
  		$scope.genero = "Masculino";
  	}
  	

  	// pega a data de hoje
    var todayDate = new Date(),
    // pega o ano atual
    todayYear = todayDate.getFullYear(),
    // pega o mes atual
    todayMonth = todayDate.getMonth(),
    // pega o dia atual
    todayDay = todayDate.getDate()

  	
  	// pega o ano de nascimento
    var anoNascimento = aluno.dataNascimento.split("-");
    
    // subtrai o ano atual com o ano de nascimento para obter a idade
    $scope.idade = todayYear - anoNascimento[0];

    $scope.mostraListaAluno = true;
  	$scope.mostraFormNutricao = true;
  }

  // adiciona o plano de nutrição, as refeições e os alimentos
	// no banco de dados 
  $scope.addPlano_nutricao = function()
  {
  	var nutricao  = $scope.nutricao;

  	// cria o objeto para guardar o plano de nutricao e o aluno
  	var nutricao_aluno = new Object();

    nutricao_aluno.idaluno =  Aluno.idaluno; 

    nutricao_aluno.nutricao  = nutricao;

    // guardo no escopo para poder utilizar em outras funções
    $scope.nutricao_aluno = nutricao_aluno;

     	    
    var config = 
    {
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        data : nutricao_aluno, 
        method: 'POST',
        url :  url+"nutricao/addPlano_nutricao"  
    }
    $http(config).then(function successCallback(response) 
    { 	
        if (response.data != 0)
        {
        	$scope.validaNutricao = response.data;

	        ngDialog.openConfirm({template: 'dialogValidaNutricao',
	          scope: $scope //Pass the scope object if you need to access in the template
	        }).then(
	          
	        );
        }
        else
        {
        	// chama o metodo que atualiza a grid de plano de nutricao
        	atualizaGridNovoPlanoNutricao();
        }
       
                    
    }, function errorCallback(response)
    {
        console.log(response);
    });
  	
  }


  // atualiza a grid que mostra o plano de nutrição
  function atualizaGridNovoPlanoNutricao()
  {
  		var nutricao_aluno = $scope.nutricao_aluno;


        var config = 
	    {
	        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
	        data : nutricao_aluno, 
	        method: 'POST',
	        url :  url+"nutricao/getPlano_nutricao"  
	    }
	    $http(config).then(function successCallback(response) 
	    { 	
	    	// verifica se é um objeto, o que significa
	    	// que ainda tem alimentos desse plano de nutrição
	    	// se tiver lista, caso contrario não lista nada
	    	if (typeof response.data === 'object') 
	    	{
	    		$scope.plano_nutricao = response.data;
	    	}
	    	else
	    	{
	    		$scope.plano_nutricao = "";
	    	}	
	    	
	   	    	        
	    }, function errorCallback(response)
	    {
	        console.log(response);
	    });

  }

  $scope.okValidaNutricao = function()
  {
  	ngDialog.close();
  }

  // deleta um alimento da grid, quando o usuário está adicionando
  // um novo plano de nutrição
  $scope.excluirAlimento = function(plano)
  {
  		var config = 
	    {
	        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
	        data : plano, 
	        method: 'POST',
	        url :  url+"nutricao/deleteAlimento"  
	    }
	    $http(config).then(function successCallback(response) 
	    { 	
	        // chama o metodo que atualiza a grid de plano de nutricao
        	atualizaGridNovoPlanoNutricao();
	        
	    }, function errorCallback(response)
	    {
	        console.log(response);
	    });
  }

  // executa o metodo quando clica no alterar na grid
  $scope.alterarAlimento = function(plano)
  {
    $scope.nutricao = angular.copy(plano);
    $scope.nutricao.data_inicio  =  $filter('date')(plano.data_inicio,  'dd/MM/yyyy');
    $scope.nutricao.data_termino =  $filter('date')(plano.data_termino, 'dd/MM/yyyy');
  }

  $scope.voltaListaAlunosNutricao = function()
  {
  	 var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      method: 'GET',
      url :  url+"nutricao/destroi_sessao_plano_nutricao"  
    }
    $http(config).then(function successCallback(response) 
    { 
    	// limpa o formulário e a lista
    	$scope.nutricao = "";
    	$scope.plano_nutricao = "";
         
    }, function errorCallback(response)
    {
      console.log(response);
    }); 

  	$scope.mostraListaAluno = false;
  	$scope.mostraFormNutricao = false;
  }

  // auto complete do campo buscar 
  $scope.autoAluno = function(buscarAluno)
  {
    // Pesquisa no banco via AJAX
    $http.post('aluno/autoAluno', { "buscarAluno" : buscarAluno}).
      success(function(data) {

      // JSON retornado do banco
      $scope.autoAlunos = data;  
      
    })
  }

   //lista os planos de nutrição dos alunos
   $scope.listaNutricao = function(aluno)
   {
   		$scope.mostraListaAluno = true;
	  	$scope.mostraListaNutricao = true;

	  	// chama o arquivo que faz o select das fotos
	    $http.get("../Academia/api_fotos/select.php"
	    ).success(function(data){
	    
	      $scope.images = data;
	    
	    });

	    $scope.aluno = aluno;

	  	// passa o aluno para a variavel global
	  	Aluno = aluno;

	  	$scope.nome   = aluno.nome;

	  	if (aluno.genero == "F") 
	  	{
	  		$scope.genero = "Feminino";
	  	}else if (aluno.genero == "M") 
	  	{
	  		$scope.genero = "Masculino";
	  	}
	  	

	  	// pega a data de hoje
	    var todayDate = new Date(),
	    // pega o ano atual
	    todayYear = todayDate.getFullYear(),
	    // pega o mes atual
	    todayMonth = todayDate.getMonth(),
	    // pega o dia atual
	    todayDay = todayDate.getDate()

	  	
	  	// pega o ano de nascimento
	    var anoNascimento = aluno.dataNascimento.split("-");
	    
	    // subtrai o ano atual com o ano de nascimento para obter a idade
	    $scope.idade = todayYear - anoNascimento[0];

		var config = 
	    {
	      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
	      data : aluno, 
	      method: 'POST',
	      url :  url+"nutricao/getPlanosAluno"  
	    }
	    $http(config).then(function successCallback(response) 
	    { 
	      $scope.planos_nutricao = response.data;
	      
	    }, function errorCallback(response)
	    {
	      console.log(response);
	    }); 
	}

	$scope.voltaListaAlunos = function()
	{
		$scope.mostraListaAluno = false;
	  	$scope.mostraListaNutricao = false;
	}
  
  // metodo para pesquisar alunos
  $scope.pesquisarAluno = function()
  {
    
    var aluno = $scope.aluno;

    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data : aluno, 
      method: 'POST',
      url :  url+"aluno/pesquisarAluno"  
    }
    $http(config).then(function successCallback(response) 
    { 
      $scope.alunos = response.data;
      
    }, function errorCallback(response)
    {
      console.log(response);
    }); 

  }

  $scope.pesquisarNutricao = function()
  {
    
    var nutricao = $scope.nutricao;

    // cria o objeto para guardar o aluno e a nutricao
  	var aluno_nutricao = new Object();

    aluno_nutricao.aluno  = Aluno;
    
    aluno_nutricao.nutricao =  nutricao; 

    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data : aluno_nutricao, 
      method: 'POST',
      url :  url+"nutricao/pesquisarNutricao"  
    }
    $http(config).then(function successCallback(response) 
    { 
      $scope.planos_nutricao = response.data;
      
    }, function errorCallback(response)
    {
      console.log(response);
    }); 

  }

  
  $scope.detalharNutricao = function(plano)
  {
    
    $http({
      method: 'POST',
      data:plano,
      url:'nutricao_pdf',
      headers:{'Content-Type':'application/json'}
        
    }).success(function(data){
      
      $window.open(url+'/nutricao_pdf/imprimirNutricao');

    });
  }
});  