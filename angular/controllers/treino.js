app.controller('treino', function($scope, $http, $window, ngDialog)
{
  url = "http://localhost/Academia/";

  // variavel global idTreino
  idTreino = "";

  // variavel global que será utilizada apenas para alterar o ciclo de treino
  idCicloAlterar = "";  

  ID_exercicio_treino = false;
  Clicked = false;

  $scope.ciclo = {};

  $scope.mostrar = 'mostraListaCiclo';
  
  $scope.showModal = true;

  $scope.selectedRow = null; 

  // mostra o treino selecionado quando clica no botao treino
  $scope.mostraTreino = function(treino)
  {

    // essa linha é para colocar a classe de cor no botão 
    $scope.classe = treino.treino;

    $scope.treinoGrid = "Treino "+treino.treino;
    $scope.idTreinoGrid = "N° "+treino.idtreino;

    idTreino = treino.idtreino;

    // cria o objeto para guardar o id do treino e o id do ciclo selecionado
    var cicloTreino = new Object();

    cicloTreino.idTreino =  idTreino; 

    cicloTreino.idCiclo  = idCiclo;

    // chama o metodo que lista os exercicios do treino selecionado
    // passando o objeto que contem o id do ciclo e o id do treino selecionado
    listaExerciciosTreino(cicloTreino);
  }
  
  // coloca cor na grid selecionada
  $scope.setClickedRow = function(index, idciclo)
  {  
    // armazena o id do ciclo selecionado apenas para utilizá-lo 
    // caso precise ser alterado com o botão alterar. Utilizo uma variavel global para isso 
    idCicloAlterar = idciclo;

    $scope.selectedRow = index;
  }
  
    
   // lista a grid de exercicios para cadastrar no treino selecionado
  function listarExercicios()
  {
    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      method: 'GET',
      url :  url+"exercicio/listaExercicios"  
    }
    $http(config).then(function successCallback(response) 
    { 

      $scope.exercicios = response.data;
         
    }, function errorCallback(response)
    {
      console.log(response);
    }); 
 
  }

  // pesquisa o exercicio quando clica no botao buscar e filtra a grid 
  $scope.pesquisarExercicio = function()
  {
    var exercicio = $scope.exercicio;

    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data: exercicio,
      method: 'POST',
      url :  url+"exercicio/pesquisarExercicio"  
    }
    $http(config).then(function successCallback(response) 
    { 

      $scope.exercicios = response.data;
         
    }, function errorCallback(response)
    {
      console.log(response);
    }); 
   
  }

  // pesquisa o cilco de treino quando clica no botao buscar e filtra a grid 
  $scope.pesquisarCiclo = function()
  {
    var buscarCiclo = $scope.buscarCiclo;

    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data: buscarCiclo,
      method: 'POST',
      url :  url+"treino/pesquisarCiclo"  
    }
    $http(config).then(function successCallback(response) 
    { 
      $scope.ciclos = response.data;
        
    }, function errorCallback(response)
    {
      console.log(response);
    }); 
   
  }

  

  // lista os exercicios adicionados no treino selecionado
  function listaExerciciosTreino(cicloTreino)
  {

      var config = 
      {
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        data: cicloTreino,
        method: 'POST',
        url :  url+"treino/listaExerciciosTreino"  
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
        url :  url+"treino/listaExerciciosCombinados"  
      }
      $http(config).then(function successCallback(response) 
      { 
     
        $scope.exerciciosTreinoCombinado = response.data;
        
      }, function errorCallback(response)
      {
        console.log(response);
      }); 
 
  }

  // guarda o idexercicio_treino e a verificação de clique da tabela treino nas variaveis
  // globais para serem utilizadas no metodo addExercicioTreino 
  $scope.getIdExercicioTreino = function(idexercicio_treino, clicked)
  {
      ID_exercicio_treino = idexercicio_treino;
      Clicked = clicked;
  }

  
  // adiciona os exercicios na grid do treino selecionado
  $scope.addExercicioTreino = function(idexercicio)
  {
      
      // Verifica se existe as variaveis 
      // ID_exercicio_treino e Clicked as quais correspondem que
      // tem exercicio na tabela de treino selecionado 
      if ((ID_exercicio_treino) &&  (Clicked))
      {
          // se existir cria um objeto para guardar o ID_exercicio_treino que corresponde
          // ao exercicio selecionado na tabela de treino
          // e o idexercicio que foi clicado na tabela de exercicio, que fara junção com 
          // o exercicio selecionado na tabela de treino para formar o treino combinado
          var exercicioCombinado = new Object();

          exercicioCombinado.idexercicio_treino =  ID_exercicio_treino; 

          exercicioCombinado.idexercicio  = idexercicio;

          var config = 
          {
              headers: {'Content-Type': 'application/x-www-form-urlencoded'},
              data : exercicioCombinado, 
              method: 'POST',
              url :  url+"treino/salvarTreinoCombinado"  
          }
          $http(config).then(function successCallback(response) 
          { 
              // cria o objeto para guardar o id do treino e o id do ciclo selecionado
              var cicloTreino = new Object();

              cicloTreino.idTreino =  idTreino; 

              cicloTreino.idCiclo  = idCiclo;
              
              // chama o metodo que lista os exercicios do treino selecionado
              // passando o objeto que contem o id do ciclo e o id do treino selecionado
              listaExerciciosTreino(cicloTreino);
          
          }, function errorCallback(response)
          {
              console.log(response);
          }); 
      }
      // apenas se não for criar treino combinado é que adicionará um 
      // novo exercicio_treino na tabela exercicio_treino que visualmente 
      // corresponde a tabela de treino no sistema 
      else
      {
          // cria o objeto para obter o id do treino e id do ciclo
          var treinoExercicio = new Object();

          treinoExercicio.idexercicio = idexercicio;

          treinoExercicio.idTreino    = idTreino;
          
          var config = 
          {
              headers: {'Content-Type': 'application/x-www-form-urlencoded'},
              data : treinoExercicio, 
              method: 'POST',
              url :  url+"treino/addExercicioTreino"  
          }
          $http(config).then(function successCallback(response) 
          {   
              // cria o objeto para guardar o id do treino e o id do ciclo selecionado
              var cicloTreino = new Object();

              cicloTreino.idTreino =  idTreino; 

              cicloTreino.idCiclo  = idCiclo;
              
              // chama o metodo que lista os exercicios do treino selecionado
              // passando o objeto que contem o id do ciclo e o id do treino selecionado
              listaExerciciosTreino(cicloTreino);

          }, function errorCallback(response)
          {
              console.log(response);
          });   
      }



      // independente de cadastrar ou não treino combinado
      // as variaveis globais tem que voltar a serem falsas
      // para garantir que somente quando tiver exercicio selecionado na tabela de treino
      // é que será adicionado treino combinado
      ID_exercicio_treino = false;
      Clicked = false;


  }

  // metodo que seleciona os treinos para listar quando clica na grid de ciclos 
  $scope.listaTreino = function(idciclo)
  {
   
    // mostra e chama a lista de exercicios
    listarExercicios();
    $scope.mostraListaExercicios = true;

    $scope.mostraListaTreino = true;


    // cria a variavel global idCiclo para poder ser utilizada nos metodos
    // mostraTreino e addExercicioTreino
    idCiclo = idciclo;

    $scope.treinoGrid = "";
    $scope.idTreinoGrid = "";
    
    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data: idciclo,
      method: 'POST',
      url :  url+"treino/listaTreino"  
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
                idTreino = value.idtreino;
            }
        
        });

        $scope.treinoGrid = "Treino "+treinoLista;
        $scope.idTreinoGrid = "N° "+idTreino;

        // cria o objeto para guardar o id do treino e o id do ciclo selecionado
        var cicloTreino = new Object();

        cicloTreino.idTreino = idTreino; 

        cicloTreino.idCiclo  = idciclo;

        // chama o metodo que irá listar os exercicios do treino A do ciclo selecionado
        // passando o objeto que contem o id do ciclo e o id do treino 
        listaExerciciosTreino(cicloTreino);
                     
    }, function errorCallback(response)
    {
        console.log(response);
    }); 
  }

  // metodo para preencher o formulario de ciclo para alterar
  $scope.alterarCiclo = function(idciclo)
  {

      var config = 
      {
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        data: idciclo,
        method: 'POST',
        url :  url+"treino/getCicloEditar"  
      }
      $http(config).then(function successCallback(response) 
      { 
        //Irá esconder o modelo de ciclo quando o usuário tentar alterar o ciclo
        $scope.escondeModeloCiclo = true;
        
        $scope.ciclo = response.data[0];
        $scope.mostrar = 'mostraCadastroCiclo';
        $scope.mostraListaTreino = false;
        $scope.mostraListaExercicios = false;
      
      }, function errorCallback(response)
      {
        console.log(response);
      }); 
  }

  
  // abre o formulario para cadastrar um novo ciclo de treino
  $scope.novoCiclo = function()
  {
    $scope.mostrar = 'mostraCadastroCiclo';
    $scope.mostraListaExercicios = false;
    $scope.mostraListaTreino = false;
    //Mostra o modelo de ciclo quando o usuário for adicionar o ciclo
    $scope.escondeModeloCiclo = false;
  }

  // salva o ciclo de treino e o treino no banco
  $scope.salvarCicloTreino = function()
  {
      var ciclo = $scope.ciclo;
        
      var config = 
      {
          headers: {'Content-Type': 'application/x-www-form-urlencoded'},
          data : ciclo, 
          method: 'POST',
          url :  url+"treino/salvarCicloTreino"  
      }
      $http(config).then(function successCallback(response) 
      {   
          if (response.data != "")
          {
            $scope.validaExercicio = response.data;

            ngDialog.openConfirm({template: 'dialogValidaExercicio',
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

              $scope.ciclo = "";
              
              $scope.mostrar = 'mostraListaCiclo';
            
              listaCiclos();             
            
          }  
      }, function errorCallback(response)
      {
          console.log(response);
      });
  }

  // carrega a grid de ciclos assim que o usuário acessar o plano de treinos no menu
  listaCiclos();

  // lista os ciclos de treino
  function listaCiclos()
  {
    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      method: 'GET',
      url :  url+"treino/listaCiclos"  
    }
    $http(config).then(function successCallback(response) 
    { 

      $scope.ciclos = response.data;
         
    }, function errorCallback(response)
    {
      console.log(response);
    }); 
    
  }

  

  // metodo para excluir o exercicio do treino
  $scope.exluirExercicioTreino = function(idexercicio_treino)
  {
      
      var config = 
      {
          headers: {'Content-Type': 'application/x-www-form-urlencoded'},
          data : idexercicio_treino, 
          method: 'POST',
          url :  url+"treino/exluirExercicioTreino"  
      }
      $http(config).then(function successCallback(response) 
      {   
           //cria o objeto para guardar o id do treino e o id do ciclo selecionado
          var cicloTreino = new Object();

          cicloTreino.idTreino =  idTreino; 

          cicloTreino.idCiclo  = idCiclo;

          // chama o metodo que lista os exercicios do treino selecionado
          // passando o objeto que contem o id do ciclo e o id do treino selecionado
          listaExerciciosTreino(cicloTreino);
          
      }, function errorCallback(response)
      {
          console.log(response);
      });
  }


  $scope.okdialogCadastrado = function()
  {
    ngDialog.close();
  }

  $scope.okValidaExercicio = function()
  {
    ngDialog.close();
  }

  // auto complete do buscar exercicio
  $scope.autoExercicio = function(buscarExercicio)
  {
    $http.post('exercicio/autoExercicio', { "buscarExercicio" : buscarExercicio}).
    success(function(data) 
    {
        // JSON retornado do banco
        $scope.autoExercicios = data;  
    })
  }

  // auto complete do buscar exercicio por regiao
  $scope.autoExercicioRegiao = function(buscarExercicioRegiao)
  { 
    
    $http.post('exercicio/autoExercicioRegiao', { "buscarExercicioRegiao" : buscarExercicioRegiao}).
    success(function(data) 
    { 
        // JSON retornado do banco
        $scope.autoRegioes = data;  
    })
  }

  // auto complete do buscar ciclo de treino
  $scope.autoCiclo = function(buscarCiclo)
  { 
    $http.post('treino/autoCiclo', { "buscarCiclo" : buscarCiclo}).
    success(function(data) 
    { 
        // JSON retornado do banco
        $scope.autoCiclos = data;  
    })
  }

  

	$scope.cancelarExercicio = function()
	{
	  ngDialog.openConfirm({template: 'dialogcancelarExercicio',
    	scope: $scope //Pass the scope object if you need to access in the template
      }).then(
        
      );
	}	

	$scope.confirmcancelarExercicio = function()
	{
		 ngDialog.close();
     $scope.ciclo = "";
		 $scope.mostrar = 'mostraListaCiclo';
	}

	$scope.cancelcancelarExercicio = function()
	{
	    ngDialog.close();
	}


  $scope.okValidaExercicio = function()
  {
    ngDialog.close();
  }

  $scope.okdialogCadastrado = function()
  {
    ngDialog.close();
  }

});	