app.controller('salvar_treinos', function($scope, $rootScope, $http, ngDialog, $mdDialog)
{
  // declaração da variavel global da url da api
  url = "http://localhost/Academia/";

  idAluno_treino = "";
  idTreino = "";
  idCiclo  = "";

   // seleciona o ciclo de treino ativo para o aluno poder salvar
   // o treino que irá realizar
  function getCicloAtivo()
  {
    
    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      method: 'GET',
      url :  url+"salvar_treinos/getCicloAtivo"  
    }
    $http(config).then(function successCallback(response) 
    { 
      $scope.cicloTreino = response.data;

      $scope.ciclo  = response.data[0].ciclo;
      $scope.modelo = response.data[0].modeloCiclo;
      $scope.meta   = response.data[0].metaPrincipal;
      $scope.nivel  = response.data[0].nivel;
      $scope.genero = response.data[0].genero; 
      
        
    }, function errorCallback(response)
    {
      console.log(response);
    }); 
   
  }

  getCicloAtivo();

  function getTreinoAtivo()
  {
    
    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      method: 'GET',
      url :  url+"salvar_treinos/getTreinoAtivo"  
    }
    $http(config).then(function successCallback(response) 
    { 
      idCiclo = response.data[0].idaluno_ciclo;
     
      var treinoLista = "";

      $scope.treinos = response.data;

        
      // essa linha é para colocar a classe de cor no botão 
      $scope.classe = $scope.treinos[0].treino;
      

      // percorre todos os treinos do ciclo selecionado na grid de ciclo 
      angular.forEach($scope.treinos, function(value, key)
      {
          // verifica se o treino é A se for guarda o idtreino 
          if (value.treino == "A")
          {
              treinoLista = value.treino;
              idaluno_treino = value.idaluno_treino;
          }
      
      });


      $scope.treinoGrid = "Treino "+treinoLista;

      idAluno_treino = idaluno_treino;

      getExerciciosTreinoAtivo(idaluno_treino);

    }, function errorCallback(response)
    {
      console.log(response);
    }); 
   
  }

  getTreinoAtivo();

  function getExerciciosTreinoAtivo(idaluno_treino)
  {
    
    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data: idaluno_treino,
      method: 'POST',
      url :  url+"salvar_treinos/getExerciciosTreinoAtivo"  
    }
    $http(config).then(function successCallback(response) 
    { 
      $scope.exerciciosTreinosAtivo = response.data;

      // pega a ultima posição do array de exercicios
      var ultimaPosicao = response.data.length; 

      var stringRegiao = "";

      var verificaRegiao = "";

      // percorre todos os exercício
      for (var i = 0; i < ultimaPosicao; i++)
      {
        // verifica se a região trabalhada do exercício é diferente da anterior
        // para não repetir região trabalhada
        if (verificaRegiao != response.data[i].regiaoTrabalhada)
        {
            // verifica se a variável que vai guardar a string está vazio ou nao
            // para usar ou não a virgula 
            if (stringRegiao != "")
            {
               stringRegiao = stringRegiao+", "+response.data[i].regiaoTrabalhada;
            }
            else
            {
               stringRegiao = stringRegiao+" "+response.data[i].regiaoTrabalhada;
            }  
            
        }
        
        verificaRegiao = response.data[i].regiaoTrabalhada;
       
      }

      $scope.regiosTrabalhadas = stringRegiao;
        
    }, function errorCallback(response)
    {
       console.log(response);
    }); 
   
  }
  	
  getExerciciosTreinoAtivo();

  // mostra o treino selecionado quando clica no botao treino
  $scope.mostraTreino = function(treino)
  {

    // essa linha é para colocar a classe de cor no botão 
    $scope.classe = treino.treino;

    $scope.treinoGrid = "Treino "+treino.treino;
    $scope.idTreinoGrid = "N° "+treino.idaluno_treino;

    idTreino = treino.idaluno_treino;

    idAluno_treino = treino.idaluno_treino;

    // cria o objeto para guardar o id do treino e o id do ciclo selecionado
    var cicloTreino = new Object();

    cicloTreino.idTreino = idTreino; 

    cicloTreino.idCiclo  = idCiclo;

    
    // chama o metodo que lista os exercicios do treino selecionado
    // passando o objeto que contem o id do ciclo e o id do treino selecionado
    listaExerciciosTreinoAluno(cicloTreino);
  }


  // lista todos os exercicios do ciclo  e do treino selecionado
  function listaExerciciosTreinoAluno(cicloTreino)
  {

    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data: cicloTreino,
      method: 'POST',
      url :  url+"meus_treinos/listaExerciciosTreinoAluno"  
    }
    $http(config).then(function successCallback(response) 
    { 
      
      $scope.exerciciosTreinosAtivo = response.data;

      // pega a ultima posição do array de exercicios
      var ultimaPosicao = response.data.length; 

      var stringRegiao = "";

      var verificaRegiao = "";

      // percorre todos os exercício
      for (var i = 0; i < ultimaPosicao; i++)
      {
        // verifica se a região trabalhada do exercício é diferente da anterior
        // para não repetir região trabalhada
        if (verificaRegiao != response.data[i].regiaoTrabalhada)
        {
            // verifica se a variável que vai guardar a string está vazio ou nao
            // para usar ou não a virgula 
            if (stringRegiao != "")
            {
               stringRegiao = stringRegiao+", "+response.data[i].regiaoTrabalhada;
            }
            else
            {
               stringRegiao = stringRegiao+" "+response.data[i].regiaoTrabalhada;
            }  
            
        }
        
        verificaRegiao = response.data[i].regiaoTrabalhada;
       
      }

      $scope.regiosTrabalhadas = stringRegiao;
    
      
    }, function errorCallback(response)
    {
      console.log(response);
    }); 
  }  

  

  // salva os treinos realizados pelo aluno
  $scope.salvarTreinoSelecionado = function()
  {

  	// cria o objeto para guardar o idaluno_treino e a data_treino 
  	// para salvar na tabela treino_realizado 
  	var treinoRealizadoObj = new Object();

  	treinoRealizadoObj.dataRealizacaoTreino = $scope.dataRealizacaoTreino;
  	
  	treinoRealizadoObj.idaluno_treino = idAluno_treino;


  	var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data: treinoRealizadoObj,
      method: 'POST',
      url :  url+"salvar_treinos/salvarTreinoSelecionado"  
    }
    $http(config).then(function successCallback(response) 
    { 	


    	// entra aqui se não passar na validação
    	if (response.data.mensagem != "")
    	{
    		$scope.validaData = response.data.mensagem;
         
		    ngDialog.openConfirm({template: 'dialogValidaData',
		        scope: $scope //Pass the scope object if you need to access in the template
		    }).then(
		        
		    );
    	}
    	
    	// entra aqui se cadastrou o treino para cadastrar os exercicios
    	if (response.data.idtreino_realizado)
    	{	

    		// percorre todos os exercicios do ciclo ativo do aluno	
    		angular.forEach($scope.exerciciosTreinosAtivo, function(exercicio, key)
		    {

		    	// verifica se o aluno marcou o exercicio no check box
		    	if (exercicio.selected)
		    	{

		    		// cria o objeto para guardar o idaluno_exercicio
		    		// e o idtreino_realizado para salvar na tabela exercicio_realizado
				  	var exercicioRealizadoObj = new Object();

				  	exercicioRealizadoObj.idtreino_realizado = response.data.idtreino_realizado;
				  	
				  	exercicioRealizadoObj.idaluno_exercicio = exercicio.idaluno_exercicio;

            		    		
		    		var config = 
				    {
				      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
				      data: exercicioRealizadoObj,
				      method: 'POST',
				      url :  url+"salvar_treinos/salvarExercicioRealizado"  
				    }
				    $http(config).then(function successCallback(response) 
				    { 
              //console.log(response.data);
				    }, function errorCallback(response)
				    {
				      console.log(response);
				    });	
		    	}
		    });
    	
    		$scope.cadastrado = "Treino cadastrado";
         
		    ngDialog.openConfirm({template: 'dialogCadastrado',
		        scope: $scope //Pass the scope object if you need to access in the template
		    }).then(
		        
		    );
    		
    	}              
    }, function errorCallback(response)
    {
      console.log(response);
    }); 
  }

  $scope.okValidaData = function()
  {
    ngDialog.close();
  }

  $scope.okCadastrado = function()
  {
  	ngDialog.close();
  }

});  