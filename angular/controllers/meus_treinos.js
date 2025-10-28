app.controller('meus_treinos', function($scope, $rootScope, $http, ngDialog, $mdDialog)
{
  // declaração da variavel global da url da api
  url = "http://localhost/Academia/";

  // começa mostrando os ciclos do aluno selecionado
  $scope.mostraCiclosAluno = true;

  idCiclo = "";

  // coloca cor na grid selecionada
  $scope.setClickedRow = function(index, idciclo)
  {  
    $scope.selectedRow = index;
    $scope.idcicloSelecionado = idciclo;
  }

  // seleciona os ciclos dos treinos do usuario logado
  function getCiclosTreinos()
  {
    
    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      method: 'GET',
      url :  url+"meus_treinos/getCiclosTreinos"  
    }
    $http(config).then(function successCallback(response) 
    { 

      $scope.ciclosTreino = response.data;
        
    }, function errorCallback(response)
    {
      console.log(response);
    }); 
   
  }

  getCiclosTreinos();

  // mostra o treino selecionado quando clica no botao treino
  $scope.mostraTreino = function(treino)
  {

    // essa linha é para colocar a classe de cor no botão 
    $scope.classe = treino.treino;

    $scope.treinoGrid = "Treino "+treino.treino;
    $scope.idTreinoGrid = "N° "+treino.idaluno_treino;

    idTreino = treino.idtreino;

    // cria o objeto para guardar o id do treino e o id do ciclo selecionado
    var cicloTreino = new Object();

    cicloTreino.idTreino =  treino.idaluno_treino; 

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
        
        $scope.exerciciosTreino = response.data;

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


      // lista os exercicios combinados
      var config = 
      {
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        data: cicloTreino,
        method: 'POST',
        url :  url+"aluno/listaExerciciosCombinadosAluno"  
      }
      $http(config).then(function successCallback(response) 
      { 
     
        $scope.exerciciosTreinoCombinadoAluno = response.data;
        
      }, function errorCallback(response)
      {
        console.log(response);
      }); 
 
  }

  // mostra os treinos do ciclo selecionado
  $scope.mostraTreinos = function(idaluno_ciclo, ciclo)
  {
    $scope.cicloSelecionado = ciclo;

    idCiclo = idaluno_ciclo;

  	$scope.mostraCicloSelecionado = true;
  	
  	getTreinos(idaluno_ciclo);
  	  	    	
  }



  // seleciona os treinos do usuario logado
  function getTreinos(idaluno_ciclo)
  {

    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data: idaluno_ciclo,
      method: 'POST',
      url :  url+"meus_treinos/getTreinos"  
    }
    $http(config).then(function successCallback(response) 
    { 
        
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

        var cicloTreino = new Object();

        cicloTreino.idaluno_treino = idaluno_treino; 

        cicloTreino.idaluno_ciclo  = idaluno_ciclo;

        getExerciciosTreinos(cicloTreino);
                             
    }, function errorCallback(response)
    {
        console.log(response);
    }); 
  }

  // seleciona os exercicios dos treinos do usuario logado
  function getExerciciosTreinos(cicloTreino)
  {
    
    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data: cicloTreino,
      method: 'POST',
      url :  url+"meus_treinos/getExerciciosTreinos"  
    }
    $http(config).then(function successCallback(response) 
    { 

      $scope.exerciciosTreino = response.data;

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


  // pesquisa o cilco de treino quando clica no botao buscar e filtra a grid 
  $scope.pesquisarMeusCiclos = function()
  {
    var pesquisarMeusCiclosObj = new Object();
    
    pesquisarMeusCiclosObj.buscar = $scope.buscarMeusCiclos;

    pesquisarMeusCiclosObj.dataInicio = $scope.buscarDataInicio;

    pesquisarMeusCiclosObj.dataTermino = $scope.buscarDataTermino;

    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data: pesquisarMeusCiclosObj,
      method: 'POST',
      url :  url+"meus_treinos/pesquisarMeusCiclos"  
    }
    $http(config).then(function successCallback(response) 
    { 
       $scope.ciclosTreino = response.data;
        
    }, function errorCallback(response)
    {
      console.log(response);
    });
  }

   // auto complete do buscar ciclo de treino do aluno
  $scope.autoMeusCiclos = function(buscarMeusCiclos)
  { 
        
    // chama o metodo de busca no controller
    $http.post('meus_treinos/autoMeusCiclos', { "buscarMeusCiclos" : buscarMeusCiclos}).
    success(function(data) 
    { 
        // JSON retornado do banco
        $scope.autoCiclos = data;  
    })
  }


});  