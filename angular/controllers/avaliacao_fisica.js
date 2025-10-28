app.controller('avaliacao_fisica', function($scope, $http, $window, $mdDialog, ngDialog)
{
  url = "http://localhost/Academia/";

  // variável global idAluno
  idAluno = "";

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

   // esconde a lista de alunos e mostra o formulario para 
  // cadastrar uma nova avaliação física
  $scope.addAvaliacao = function(aluno, idaluno)
  {
  	$scope.mostraListaAluno = true;
  	$scope.mostraFormAvaliacao = true;

  	// chama o arquivo que faz o select das fotos
    $http.get("../Academia/api_fotos/select.php"
    ).success(function(data){
    
      $scope.images = data;
    
    });

    // guarda no escopo para poder mostrar a imagem no form 
    $scope.aluno = aluno;

  	// passa o idaluno para a variavel global
  	idAluno = idaluno;

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
  	
  }

  $scope.voltaListaAlunosAvaliacoes = function()
  {
  	$scope.mostraListaAluno    = false;
  	$scope.mostraFormAvaliacao = false;
    $scope.avaliacao = "";
  }

  $scope.calcular = function()
  {
  	var avaliacao = $scope.avaliacao;
  	
  	if (avaliacao)
  	{
  		if (!avaliacao.altura)
	  	{
	  		$scope.validaAvaliacaoFisica = "O campo altura deve ser preenchido";
	        
		    ngDialog.openConfirm({template: 'dialogValidaAvaliacaoFisica',
		        scope: $scope //Pass the scope object if you need to access in the template
		    }).then(
		        
		    );

			return false;
	  	
	  	}else if (!avaliacao.peso)
	  	{
	  		$scope.validaAvaliacaoFisica = "O campo peso deve ser preenchido";
	        
		    ngDialog.openConfirm({template: 'dialogValidaAvaliacaoFisica',
		        scope: $scope //Pass the scope object if you need to access in the template
		    }).then(
		        
		    );

			return false;
	  	}

  	}
  	else
  	{
  		$scope.validaAvaliacaoFisica = "O campo altura e peso devem serem preenchidos";
	        
	    ngDialog.openConfirm({template: 'dialogValidaAvaliacaoFisica',
	        scope: $scope //Pass the scope object if you need to access in the template
	    }).then(
	        
	    );

		  return false;
  	}	

    //var altura  = avaliacao.altura.replace("," , ".");
    //var peso = avaliacao.peso.replace("," , ".");

    var altura  = parseFloat(avaliacao.altura ,10);
  	var peso    = parseInt(avaliacao.peso ,10);
  	
  	var imc = (peso / (altura * altura)).toFixed(2);

  	var fator1 = 1.2  * imc;
  	var fator2 = 0.23 * $scope.idade;
  	
  	// verificar se é homem ou mulher para colocar 1 ou 0
  	if ($scope.aluno.genero == "M")
  	{
  		var fator3 = 10.8 * 1;
  	}else if ($scope.aluno.genero == "F")
  	{
  		var fator3 = 10.8 * 0;
  	}
  	
  	var percentualGordura = fator1 + fator2;

  	percentualGordura = percentualGordura - fator3;

  	percentualGordura = (percentualGordura - 5.4).toFixed(2);

  	$scope.avaliacao.percentual_gordura = percentualGordura;

  	$scope.avaliacao.massa_gorda = ((percentualGordura * peso) / 100).toFixed(2);

  	$scope.avaliacao.massa_magra = (peso - $scope.avaliacao.massa_gorda).toFixed(2);

  	$scope.avaliacao.imc = imc;

  	// classificação para IMC
  	if (imc < 15)
  	{
  		$scope.classificacaoIMC = "Extremamente abaixo do peso";
  	}else if ((imc >= 15) && (imc <= 16))
  	{
  		$scope.classificacaoIMC = "Gravemente abaixo do peso";
  	}else if ((imc >= 17) && (imc <= 18))
  	{
  		$scope.classificacaoIMC = "Abaixo o peso ideal";
  	}else if ((imc >= 19) && (imc <= 25))
  	{
  		$scope.classificacaoIMC = "Faixa de peso ideal";
  	}else if ((imc >= 26) && (imc <= 30))
  	{
  		$scope.classificacaoIMC = "Sobrepeso";
  	}else if ((imc >= 31) && (imc <= 35))
  	{
  		$scope.classificacaoIMC = "Obesidade grau 1";
  	}else if ((imc >= 36) && (imc <= 40))
  	{
  		$scope.classificacaoIMC = "Obesidade grau 2 (grave)";
  	}else if (imc > 40)
  	{
  		$scope.classificacaoIMC = "Obesidade grau 3 (mórbida)";
  	}

  	// classificação para Percentual de Gordura
  	// mulheres
  	if (($scope.aluno.genero == "F") && ($scope.idade >= 18)
  		|| ($scope.idade <= 39)) 
  	{
  		if (percentualGordura < 21)
	  	{
	  		$scope.classificacaoPercentualGordura = "Baixo percentual de gordura";
	  	}else if ((percentualGordura >= 21) && (percentualGordura <= 33))
	  	{
	  		$scope.classificacaoPercentualGordura = "Percentual de gordura saúdavel";
	  	}
	  	else if ((percentualGordura >= 34) && (percentualGordura <= 39))
	  	{
	  		$scope.classificacaoPercentualGordura = "Percentual de gordura em excesso";
	  	}
	  	else if(percentualGordura > 39)
	  	{
	  		$scope.classificacaoPercentualGordura = "Percentual de gordura muito em excesso";
	  	}
  	}
  	else if (($scope.aluno.genero == "F") && ($scope.idade >= 40)
  		|| ($scope.idade <= 59)) 
  	{
  		if (percentualGordura < 23)
	  	{
	  		$scope.classificacaoPercentualGordura = "Baixo percentual de gordura";
	  	}else if ((percentualGordura >= 24) && (percentualGordura <= 34))
	  	{
	  		$scope.classificacaoPercentualGordura = "Percentual de gordura saúdavel";
	  	}
	  	else if ((percentualGordura >= 35) && (percentualGordura <= 40))
	  	{
	  		$scope.classificacaoPercentualGordura = "Percentual de gordura em excesso";
	  	}
	  	else if(percentualGordura > 40)
	  	{
	  		$scope.classificacaoPercentualGordura = "Percentual de gordura muito em excesso";
	  	}
  	}
  	else if (($scope.aluno.genero == "F") && ($scope.idade >= 60)) 
  	{
  		if (percentualGordura < 24)
	  	{
	  		$scope.classificacaoPercentualGordura = "Baixo percentual de gordura";
	  	}else if ((percentualGordura >= 25) && (percentualGordura <= 36))
	  	{
	  		$scope.classificacaoPercentualGordura = "Percentual de gordura saúdavel";
	  	}
	  	else if ((percentualGordura >= 37) && (percentualGordura <= 42))
	  	{
	  		$scope.classificacaoPercentualGordura = "Percentual de gordura em excesso";
	  	}
	  	else if(percentualGordura > 42)
	  	{
	  		$scope.classificacaoPercentualGordura = "Percentual de gordura muito em excesso";
	  	}
  	}
  	// homens
  	else if (($scope.aluno.genero == "M") && ($scope.idade >= 18)
  		|| ($scope.idade <= 39)) 
  	{
  		if (percentualGordura < 8)
	  	{
	  		$scope.classificacaoPercentualGordura = "Baixo percentual de gordura";
	  	}else if ((percentualGordura >= 8) && (percentualGordura <= 20))
	  	{
	  		$scope.classificacaoPercentualGordura = "Percentual de gordura saúdavel";
	  	}
	  	else if ((percentualGordura >= 21) && (percentualGordura <= 25))
	  	{
	  		$scope.classificacaoPercentualGordura = "Percentual de gordura em excesso";
	  	}
	  	else if(percentualGordura > 25)
	  	{
	  		$scope.classificacaoPercentualGordura = "Percentual de gordura muito em excesso";
	  	}
  	}
  	else if (($scope.aluno.genero == "M") && ($scope.idade >= 40)
  		|| ($scope.idade <= 59)) 
  	{
  		if (percentualGordura < 11)
	  	{
	  		$scope.classificacaoPercentualGordura = "Baixo percentual de gordura";
	  	}else if ((percentualGordura >= 11) && (percentualGordura <= 22))
	  	{
	  		$scope.classificacaoPercentualGordura = "Percentual de gordura saúdavel";
	  	}
	  	else if ((percentualGordura >= 23) && (percentualGordura <= 28))
	  	{
	  		$scope.classificacaoPercentualGordura = "Percentual de gordura em excesso";
	  	}
	  	else if(percentualGordura > 28)
	  	{
	  		$scope.classificacaoPercentualGordura = "Percentual de gordura muito em excesso";
	  	}
  	}
  	else if (($scope.aluno.genero == "M") && ($scope.idade >= 60)) 
  	{
  		if (percentualGordura < 13)
	  	{
	  		$scope.classificacaoPercentualGordura = "Baixo percentual de gordura";
	  	}else if ((percentualGordura >= 13) && (percentualGordura <= 25))
	  	{
	  		$scope.classificacaoPercentualGordura = "Percentual de gordura saúdavel";
	  	}
	  	else if ((percentualGordura >= 26) && (percentualGordura <= 30))
	  	{
	  		$scope.classificacaoPercentualGordura = "Percentual de gordura em excesso";
	  	}
	  	else if(percentualGordura > 30)
	  	{
	  		$scope.classificacaoPercentualGordura = "Percentual de gordura muito em excesso";
	  	}
  	}
  	
  	// mostra o btn de salvar avaliação
  	$scope.mostraBtnSalvar = true;  		  	
  }

  // salva a avaliação física no banco de dados
  $scope.salvarAvaliacao = function()
  {

  	var avaliacao = $scope.avaliacao;

  	// cria o objeto para guardar o aluno e a avaliacao
  	var aluno_avaliacao = new Object();

    aluno_avaliacao.idaluno  = idAluno;
    
    aluno_avaliacao.avaliacao =  avaliacao; 

  	var config = 
    {
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        data : aluno_avaliacao, 
        method: 'POST',
        url :  url+"avaliacao_fisica/salvarAvaliacao"  
    }
    $http(config).then(function successCallback(response) 
    {  
      
      if (response.data != 0)
      {
      	
        $scope.validaAvaliacaoFisica = response.data;
              
        ngDialog.openConfirm({template: 'dialogValidaAvaliacaoFisica',
          scope: $scope //Pass the scope object if you need to access in the template
        }).then(
          
        );
                      
      }
      else 
      {
          
          $scope.cadastrado = "Cadastro Realizado";
        
          ngDialog.openConfirm({template: 'dialogCadastradoAvaliacaoFisica',
            scope: $scope //Pass the scope object if you need to access in the template
          }).then(
            
          );

          $scope.avaliacao = "";
          
          $scope.mostraListaAluno = false;
  		    $scope.mostraFormAvaliacao = false;
       
      } 

    }, function errorCallback(response)
    {
        console.log(response);
    });
    	
  }

  $scope.okValidaAvaliacao = function()
  {
    ngDialog.close();
  }

  $scope.okCadastrado = function()
  {
  	ngDialog.close();
  }

  $scope.listaAvaliacao = function(aluno)
  {

  	// chama o arquivo que faz o select das fotos
    $http.get("../Academia/api_fotos/select.php"
    ).success(function(data){
    
      $scope.images = data;
    
    });

    $scope.aluno = aluno;

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
        url :  url+"avaliacao_fisica/listaAvaliacao"  
    }
    $http(config).then(function successCallback(response) 
    {  
    	$scope.avaliacoes = response.data;

	  	$scope.mostraListaAvaliacao = true;
	  	$scope.mostraListaAluno = true;

	}, function errorCallback(response)
    {
        console.log(response);
    });  	
  }

  $scope.pesquisarAvaliacao = function()
  {

  	var avaliacao = $scope.avaliacao;

  	// cria o objeto para guardar o aluno e a avaliacao
  	var aluno_avaliacao = new Object();

    aluno_avaliacao.aluno  = $scope.aluno;
    
    aluno_avaliacao.avaliacao =  avaliacao; 


  	var config = 
    {
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        data : aluno_avaliacao, 
        method: 'POST',
        url :  url+"avaliacao_fisica/pesquisarAvaliacao"  
    }
    $http(config).then(function successCallback(response) 
    {  
    	$scope.avaliacoes = response.data;
	  	
	}, function errorCallback(response)
    {
        console.log(response);
    });  	
  }

  $scope.voltaListaAlunos = function()
  {
  	$scope.mostraListaAvaliacao = false;
	  $scope.mostraListaAluno     = false;
  }

  // altera uma avaliação física
  $scope.editar = function(avaliacao)
  {
      
      // passa o idaluno para a variavel global
      idAluno = avaliacao.idaluno;

      $scope.mostraListaAluno     = true;
      $scope.mostraFormAvaliacao  = true;
      $scope.mostraListaAvaliacao = false;

      $scope.avaliacao = avaliacao;
      
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

  $scope.detalharAvaliacao = function(avaliacao)
  {
    
    $http({
      method: 'POST',
      data:avaliacao,
      url:'avaliacao_fisica_pdf',
      headers:{'Content-Type':'application/json'}
        
    }).success(function(data){
      
      $window.open(url+'/avaliacao_fisica_pdf/imprimirAvaliacao');

    });
  }
});  