app.controller('aluno', function($scope, $rootScope, $http, ngDialog, $mdDialog)
{
  // declaração da variavel global da url da api
  url = "http://localhost/Academia/";

  // variavel global 
  idAluno_exercicio = "";
  idAluno_treino    = "";
  ID_aluno_exercicio = false;
  Clicked = false;
  Exercicio_novo_aluno = "";
  idAluno = "";

  // coloca cor na grid selecionada
  $scope.setClickedRow = function(index, idciclo)
  {  
    $scope.selectedRow = index;
    $scope.idcicloSelecionado = idciclo;
  }

  $scope.setClickedRowTreinoRealizado = function(index)
  {
    $scope.selectedRowTreinoRealizado = index;
  }

  // altera o status de ativo do ciclo do aluno
  $scope.mudarCicloAtivo = function(idaluno_ciclo, idaluno)
  {

    var idaluno_ciclo_idaluno = new Object();

    idaluno_ciclo_idaluno.idaluno_ciclo  = idaluno_ciclo;
    
    idaluno_ciclo_idaluno.idaluno =  idaluno; 
        
    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data: idaluno_ciclo_idaluno,
      method: 'POST',
      url :  url+"aluno/mudarCicloAtivo"  
    }
    $http(config).then(function successCallback(response) 
    { 
        // chama o metodo que lista os ciclos do aluno
        getCiclosTreinosAluno(idaluno);

    }, function errorCallback(response)
    {
      console.log(response);
    });
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

  // auto complete do buscar ciclo de treino do aluno
  $scope.autoCicloAluno = function(buscarCicloAluno)
  { 
    // cria o objeto
    var buscarCicloAlunoObj = new Object();

    // passa o aluno que está selecionado no $scope para o objeto
    buscarCicloAlunoObj.idaluno =  $scope.aluno.idaluno; 

    // passa o que o usuário digitou na busca para o objeto
    buscarCicloAlunoObj.buscar  = buscarCicloAluno;
    
    // chama o metodo de busca no controller
    $http.post('aluno/autoCicloAluno', { "buscarCicloAluno" : buscarCicloAlunoObj}).
    success(function(data) 
    { 
        // JSON retornado do banco
        $scope.autoCiclosAluno = data;  
    })
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

  // pesquisa o cilco de treino quando clica no botao buscar e filtra a grid 
  $scope.pesquisarCicloAluno = function()
  {
    
    // cria o objeto
    var pesquisarCicloAlunoObj = new Object();

    // passa o aluno que está selecionado no $scope para o objeto
    pesquisarCicloAlunoObj.idaluno =  $scope.aluno.idaluno; 

    // passa o que o usuário digitou na busca para o objeto
    pesquisarCicloAlunoObj.buscar  = $scope.buscarCicloAluno;

    pesquisarCicloAlunoObj.dataInicio  = $scope.buscarDataInicio;

    pesquisarCicloAlunoObj.dataTermino  = $scope.buscarDataTermino;
    
    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data: pesquisarCicloAlunoObj,
      method: 'POST',
      url :  url+"aluno/pesquisarCicloAluno"  
    }
    $http(config).then(function successCallback(response) 
    { 
       $scope.ciclosTreino = response.data;
        
    }, function errorCallback(response)
    {
      console.log(response);
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

  // fecha o md dialog
  $scope.closeDialog = function()
  {
     $mdDialog.cancel();
  } 

  $scope.treino = function(aluno)
  {
    // esconde a lista de alunos
    $scope.mostraListaAluno = true;
    // mostra o perfil do aluno e seus treinos
    $scope.mostraAlunoPerfil = true;

    // pega o ano de nascimento
    var anoNascimento = aluno.dataNascimento.split("-");
   

    // pega a data de hoje
    var todayDate = new Date(),
    // pega o ano atual
    todayYear = todayDate.getFullYear(),
    // pega o mes atual
    todayMonth = todayDate.getMonth(),
    // pega o dia atual
    todayDay = todayDate.getDate()

    // subtrai o ano atual com o ano de nascimento para obter a idade
    aluno.idade = todayYear - anoNascimento[0];
    
    if (aluno.genero == "M")
    {
         aluno.genero = "Masculino";
    }else if (aluno.genero == "F")
    {
         aluno.genero = "Feminino";
    }

    // guarda o objeto aluno no scope
    $scope.aluno = aluno;
     
  }

  // mostra a lista de ciclos de treino para serem adicionados
  $scope.addAlunoTreino = function(ev)
  {
    listaCiclos();
    $scope.mostraCiclosAluno           = false;
    $scope.mostraCicloSelecionado      = false;
    $scope.mostraCadastroCicloAluno    = false;
    $scope.mostraListaTreino           = false;
    $scope.mostraListaExercicios       = false;
    $scope.mostraNovaListaTreino       = false;
    $scope.mostraTreinosRealizados     = false;
    $scope.mostraCicloSelecionadoAluno = false;
    $scope.mostraListaTreinoCiclo      = false;

    // tira a seleção da tabela de ciclo
    $scope.selectedRow = 50000;

    // tira a seleção da tabela de treinos realizados
    $scope.selectedRowTreinoRealizado = 50000;

    $scope.mostraListaCiclo = true;


    // zera a lista de novos exercicios adicionados ao aluno
    $scope.exerciciosNovoTreinoAluno = "";
    $scope.treinos = "";

  }

  // mostra a lista de ciclos de treinos do aluno selecionado
  $scope.getCiclosTreinosAluno = function(ev, idaluno)
  {
    getCiclosTreinosAluno(idaluno);

    // tira a seleção da tabela de treinos realizados
    $scope.selectedRowTreinoRealizado = 50000;
  }

  // mostra a lista de ciclos de treinos do aluno selecionado
  function getCiclosTreinosAluno(idaluno)
  {
    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data: idaluno,
      method: 'POST',
      url :  url+"aluno/getCiclosTreinosAluno"  
    }
    $http(config).then(function successCallback(response) 
    { 
      $scope.ciclosTreino = response.data;
      
      // escode os ciclos e mostra apenas os ciclos do aluno
      $scope.mostraCiclosAluno           = true;
      $scope.mostraListaCiclo            = false;
      $scope.mostraCicloSelecionado      = false;
      $scope.mostraCadastroCicloAluno    = false;
      $scope.mostraListaTreino           = false;
      $scope.mostraListaExercicios       = false;
      $scope.mostraNovaListaTreino       = false;
      $scope.mostraTreinosRealizados     = false;
      $scope.mostraCicloSelecionadoAluno = false;
      $scope.mostraListaTreinoCiclo      = false;
     

      // zera a lista de novos exercicios adicionados ao aluno
      $scope.exerciciosNovoTreinoAluno = "";
      $scope.treinos = "";
      
    }, function errorCallback(response)
    {
      console.log(response);
    }); 
  }

   // seleciona os treinos do aluno e ciclo selecionados
   // quando clica na tabela de ciclos do aluno
  $scope.mostraTreinos = function(idaluno_ciclo, ciclo)
  {
     $scope.cicloSelecionado = ciclo;

     idCiclo = idaluno_ciclo;

     getTreinos(idaluno_ciclo);

     
     // guarda o idaluno_ciclo no scopo para poder ser utilizado
     // em outras funções
     $scope.idaluno_ciclo = idaluno_ciclo;
  }

  function getTreinos(idaluno_ciclo)
  {
      var idaluno_treino = "";
      
      var idAluno_ciclo = new Object();

      idAluno_ciclo.idaluno =  $scope.aluno.idaluno; 

      idAluno_ciclo.idaluno_ciclo  = idaluno_ciclo;
      
      var config = 
      {
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        data: idAluno_ciclo,
        method: 'POST',
        url :  url+"aluno/getTreinos"  
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
        
        $scope.mostraCicloSelecionado = true;
        $scope.mostraListaTreino = false;
                               
      }, function errorCallback(response)
      {
          console.log(response);
      }); 
  }

  // seleciona os exercicios dos treinos do aluno selecionado
  function getExerciciosTreinos(cicloTreino)
  {

    var idAluno_cicloTreino = new Object();

    idAluno_cicloTreino.idaluno =  $scope.aluno.idaluno; 

    idAluno_cicloTreino.idaluno_ciclo  = cicloTreino.idaluno_ciclo;

    idAluno_cicloTreino.idaluno_treino  = cicloTreino.idaluno_treino;
    
    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data: idAluno_cicloTreino,
      method: 'POST',
      url :  url+"aluno/getExerciciosTreinos"  
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

  // esconde a lista de ciclo e o aluno e mostra a lista de alunos
  $scope.voltaListaAlunos = function(ev)
  {
        
    $scope.mostraListaAluno            = false;
    $scope.mostraAlunoPerfil           = false;
    $scope.mostraListaCiclo            = false;
    $scope.mostraCiclosAluno           = false;
    $scope.mostraCadastroCicloAluno    = false;
    $scope.mostraCicloSelecionado      = false;
    $scope.mostraTreinosRealizados     = false;
    $scope.mostraCicloSelecionadoAluno = false;
    $scope.mostraListaTreinoCiclo      = false;

    // zera a lista de novos exercicios adicionados ao aluno
    $scope.exerciciosNovoTreinoAluno = "";
    $scope.treinos = "";

    // tira a seleção da tabela
    $scope.selectedRowTreinoRealizado = 50000;
 
  }

  // metodo que abre o formulario para adicionar um novo ciclo para o aluno
  $scope.novoCicloAluno = function()
  {
    $scope.mostraListaCiclo = false;
    $scope.mostraListaTreino = false;
    $scope.mostraCadastroCicloAluno = true;

  }

  $scope.cancelarCadastroCicloAluno = function()
  {
    $scope.mostraListaCiclo = true;
    $scope.mostraListaTreinoCiclo = true;
    $scope.mostraCadastroCicloAluno = false;
  }

  // metodo para salvar um novo ciclo de treino ao aluno
  $scope.salvarNovoCicloTreinoAluno = function()
  {
    var ciclo = $scope.ciclo;

    // cria o objeto para poder mandar o id do aluno selecionado
    // e os dados do novo ciclo
    var idAlunoNovo_ciclo = new Object();

    idAlunoNovo_ciclo.idaluno =  $scope.aluno.idaluno;
    idAlunoNovo_ciclo.ciclo = ciclo;
        
    var config = 
    {
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        data : idAlunoNovo_ciclo, 
        method: 'POST',
        url :  url+"aluno/salvarNovoCicloTreinoAluno"  
    }
    $http(config).then(function successCallback(response) 
    {  
      if (response.data.mensagem)
      {
        $scope.validaCicloAluno = response.data.mensagem;
        
        
        ngDialog.openConfirm({template: 'dialogValidaCicloAluno',
          scope: $scope //Pass the scope object if you need to access in the template
        }).then(
          
        );
                      
      }
      else if (response.data.idaluno_ciclo)
      {
          
          $scope.cadastrado = "Cadastro Realizado";
        
          ngDialog.openConfirm({template: 'dialogCadastradoCicloAluno',
            scope: $scope //Pass the scope object if you need to access in the template
          }).then(
            
          );

          $scope.ciclo = "";
          
          // mostra a lista de exercicios para poderem serem adicionados
          // ao novo ciclo de treino
          $scope.mostraListaExercicios = true;
          $scope.mostraNovaListaTreino = true;
          $scope.mostraCadastroCicloAluno = false;
          $scope.mostraCiclosAluno = false;

          // lista os exercícios para poderam serem adicionados ao treino
          listarExercicios();

          // mostra os treinos cadastrados para poderem receber exercicios
          listaTreinosAluno(response.data.idaluno_ciclo);
       
      } 

    }, function errorCallback(response)
    {
        console.log(response);
    });
  }

  // lista os exercicios do sistema depois que cadastra um novo ciclo 
  // para o aluno, para poder adicionar exercicicios ao novo ciclo
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


  function listaTreinosAluno(idaluno_ciclo)
  {
    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data: idaluno_ciclo,
      method: 'POST',
      url :  url+"aluno/listaTreinosAluno"  
    }
    $http(config).then(function successCallback(response) 
    { 
      $scope.treinos = response.data;

      // percorre todos os treinos do ciclo selecionado na grid de ciclo 
      angular.forEach($scope.treinos, function(value, key)
      {
          // verifica se o treino é A se for guarda o idtreino 
          if (value.treino == "A")
          {
              treinoLista = value.treino;
              idAluno_treino = value.idaluno_treino;
          }
      
      });

      $scope.alunoTreinoGrid = "Treino "+treinoLista;
      $scope.idAlunoTreinoGrid = "N° "+idAluno_treino;

      $scope.classe = treinoLista;
    
    }, function errorCallback(response)
    {
        console.log(response);
    });  

  }

  // dispara esse metodo quando clica em um exercicio da tabela de treino
  $scope.getIdExercicioTreinoAluno = function(exercicio, clicked)
  {
      // guarda o idaluno_exercicio da tabela de treino do exercicio
      // selecionado
      ID_aluno_exercicio   = exercicio.idaluno_exercicio;

      // guarda o nome do exercicio clicado na tabela de treino
      Exercicio_novo_aluno = exercicio.exercicio;
      
      // propriedade para deixar a linha selecionada
      Clicked = clicked;

      
  }

  // adiciona os exercicios na grid do treino selecionado
  $scope.addExercicioTreinoAluno = function(exercicio)
  {
    
    // Verifica se existe as variaveis 
    // ID_aluno_exercicio e Clicked as quais correspondem que
    // tem exercicio na tabela de treino selecionado 
    if ((ID_aluno_exercicio) &&  (Clicked))
    {
        // se existir cria um objeto para guardar 
        // o ID_aluno_exercicio que corresponde
        // ao exercicio selecionado na tabela de treino 
        // e o exercicio também selecionado na tabela de treino
        // e também o objeto exercicio clicado na tabela de exercicio 
        // para combinar com o exercicio selecionado na tabela de treino
        var exercicioCombinadoAluno = new Object();

        exercicioCombinadoAluno.ID_aluno_exercicio = ID_aluno_exercicio;

        exercicioCombinadoAluno.Exercicio_novo_aluno =  Exercicio_novo_aluno; 

        exercicioCombinadoAluno.exercicio  = exercicio;

        var config = 
        {
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data : exercicioCombinadoAluno, 
            method: 'POST',
            url :  url+"aluno/salvarTreinoCombinadoAluno"  
        }
        $http(config).then(function successCallback(response) 
        { 
            // tira a seleção da linha 
            Clicked = "";

            // chama o metodo que lista os exercicios do treino selecionado
            listaNovosExerciciosTreinoAluno(idAluno_treino)
        
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
        // cria o objeto para obter o idtreino_aluno e o exercicio clicado
             
        var novoExercicioAluno = new Object();

        novoExercicioAluno.idaluno_treino = idAluno_treino;

        novoExercicioAluno.exercicio      = exercicio;
        
        var config = 
        {
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data : novoExercicioAluno, 
            method: 'POST',
            url :  url+"aluno/addExercicioTreinoAluno"  
        }
        $http(config).then(function successCallback(response) 
        {   
                
            // chama o metodo que lista os exercicios do treino selecionado
            listaNovosExerciciosTreinoAluno(idAluno_treino);

        }, function errorCallback(response)
        {
            console.log(response);
        }); 
    }
  } 

  function  listaNovosExerciciosTreinoAluno(idAluno_treino)
  {
      var config = 
      {
          headers: {'Content-Type': 'application/x-www-form-urlencoded'},
          data : idAluno_treino, 
          method: 'POST',
          url :  url+"aluno/listaNovosExerciciosTreinoAluno"  
      }
      $http(config).then(function successCallback(response) 
      {   
          $scope.exerciciosNovoTreinoAluno = response.data; 

      }, function errorCallback(response)
      {
          console.log(response);
      }); 
  } 

  // mostra o treino selecionado quando clica no botao treino
  // quandoe sta adicionando um novo ciclo
  $scope.mostraNovoTreinoAluno = function(treino)
  {
    // essa linha é para colocar a classe de cor no botão 
    $scope.classe = treino.treino;

    $scope.alunoTreinoGrid = "Treino "+treino.treino;
    $scope.idAlunoTreinoGrid = "N° "+treino.idaluno_treino;

    // passa o id do treino para a variável que insere o idaluno_treino 
    // na tabela aluno_exercicio 
    idAluno_treino = treino.idaluno_treino;

    // chama o metodo que lista os exercicios do treino selecionado
    listaNovosExerciciosTreinoAluno(treino.idaluno_treino);
    
  }

    
  $scope.okValidaCadastroCiclo = function()
  {
    ngDialog.close();
  }

  // metodo que irá adicionar o ciclo selecionado para o aluno
  $scope.addCicloTreinoAluno = function()
  {

    var cicloTreinoAluno = $scope.cicloTreinoAluno;

    // verifica se tem ciclo selecionado
    if ($scope.idcicloSelecionado)
    {
      
        // cria o objeto para poder mandar o id do ciclo e o id do aluno selecionado
        var idAluno_ciclo = new Object();

        idAluno_ciclo.idaluno =  $scope.aluno.idaluno; 

        idAluno_ciclo.idciclo  = idCiclo;

        idAluno_ciclo.cicloTreinoAluno = cicloTreinoAluno;
        
        
        var config = 
        {
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data : idAluno_ciclo, 
            method: 'POST',
            url :  url+"aluno/addCicloTreinoAluno"  
        }
        $http(config).then(function successCallback(response) 
        {   
            if (response.data)
            {

                $scope.validaCicloTreino = response.data;

                ngDialog.openConfirm({template: 'dialogValidaCicloTreino',
                  scope: $scope //Pass the scope object if you need to access in the template
                }).then(
                  
                );
            }
            else
            {
                $scope.cicloTreinoCadastrado = "O ciclo de treino foi adicionado";

                ngDialog.openConfirm({template: 'dialogCicloTreinoAdicionado',
                  scope: $scope //Pass the scope object if you need to access in the template
                }).then(
                  
                );
            }  
            
                     
        }, function errorCallback(response)
        {
            console.log(response);
        });

    }
    else
    {
        $scope.validaCiclo = "Selecione um ciclo para adicionar ao aluno";

        ngDialog.openConfirm({template: 'dialogValidaCiclo',
        scope: $scope //Pass the scope object if you need to access in the template
        }).then(
          
        );
    } 

  }

  $scope.okValidaCiclo = function()
  {
    ngDialog.close();
  }

  $scope.okValidaCadCicloTreino = function()
  {
    ngDialog.close();
  }
 

  $scope.okCadCicloTreino = function()
  {
    ngDialog.close();
  }
  
    
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

    cicloTreino.idTreino =  treino.idtreino; 

    cicloTreino.idCiclo  = idCiclo;

    
    // chama o metodo que lista os exercicios do treino selecionado
    // passando o objeto que contem o id do ciclo e o id do treino selecionado
    listaExerciciosTreinoAluno(cicloTreino);
  }




  // metodo que seleciona os treinos para listar quando clica na grid de ciclos 
  $scope.listaTreino = function(idciclo)
  {
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
        
        var treinoList = "";

        $scope.treinos = response.data;


        // essa linha é para colocar a classe de cor no botão 
        $scope.classe = $scope.treinos[0].treino;
        

        // percorre todos os treinos do ciclo selecionado na grid de ciclo 
        angular.forEach($scope.treinos, function(value, key)
        {
            // verifica se o treino é A se for guarda o idtreino 
            if (value.treino == "A")
            {
                treinoList = value.treino;
                idTreino = value.idtreino;
            }
        
        });

        $scope.treinoGrid = "Treino "+treinoList;
        $scope.idTreinoGrid = "N° "+idTreino;


        $scope.mostraListaTreinoCiclo = true;

        
        // cria o objeto para guardar o id do treino e o id do ciclo selecionado
        var cicloTreino = new Object();

        cicloTreino.idCiclo  = idciclo;

        cicloTreino.idTreino = idTreino; 

        // chama o metodo que irá listar os exercicios do treino A do ciclo selecionado
        // passando o objeto que contem o id do ciclo e o id do treino 
        listaExerciciosTreinoAluno(cicloTreino);
                     
    }, function errorCallback(response)
    {
        console.log(response);
    }); 
  }

  // lista todos os exercicios do ciclo  e do treino selecionado
  function listaExerciciosTreinoAluno(cicloTreino)
  {

      var config = 
      {
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        data: cicloTreino,
        method: 'POST',
        url :  url+"aluno/listaExerciciosTreinoAluno"  
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


  // mostra o treino detalhado quando o usuário clica na 
  //grid do visualizar ciclos de treinos
  $scope.mostraTreinoAluno = function(treino)
  {
      // essa linha é para colocar a classe de cor no botão 
    $scope.classe = treino.treino;

    $scope.treinoGrid = "Treino "+treino.treino;
    $scope.idTreinoGrid = "N° "+treino.idtreino;

    
    // cria o objeto para guardar o id do treino e o id do ciclo selecionado
    var cicloTreino = new Object();

    cicloTreino.idTreino =  treino.idaluno_treino; 

    cicloTreino.idCiclo  = idCiclo;

    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data: cicloTreino,
      method: 'POST',
      url :  url+"aluno/listaExerciciosAluno"  
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

  // abre o modal para adicionar serie, peso e intervalo para o exercicio
  $scope.abreModalExercicio = function(idaluno_exercicio, exercicio)
  {
      // passa na variavel global o idaluno_exercicio
      // para ser usado quando salvar o exercicio
      idAluno_exercicio = idaluno_exercicio;
      
      // guarda no scopo o exercicio clicado      
      $scope.Exercicio = exercicio.exercicio;

      // preenche os campos do modal, caso abra um exercicio que 
      // já tenha peso, intervalo, repetição e série
      $scope.exercicioModal = exercicio;
      
      ngDialog.openConfirm({template: 'dialogCadastroSeriePesoIntervalo',
      scope: $scope //Pass the scope object if you need to access in the template
      }).then(
        
      );
  }

   

  // metodo para salvar o peso, serie e intervalo do exercicio selecionado
  $scope.salvarExercicio = function(exercicioModal)
  {
      // cria o objeto passando o objeto exercicio e o idaluno_exercicio
      var idexercicio_exercicio = new Object();

      idexercicio_exercicio.idaluno_exercicio =  idAluno_exercicio; 

      idexercicio_exercicio.exercicio = exercicioModal;

      var config = 
      {
          headers: {'Content-Type': 'application/x-www-form-urlencoded'},
          data : idexercicio_exercicio, 
          method: 'POST',
          url :  url+"aluno/salvarExercicio"  
      }
      $http(config).then(function successCallback(response) 
      { 
          $scope.cadastrado = "Cadastro Realizado";
          
          ngDialog.openConfirm({template: 'dialogCadastrado',
            scope: $scope //Pass the scope object if you need to access in the template
          }).then(
            
          );

          $scope.exercicio = "";
          
         // chama o getExerciciosTreinos para atualizar a tabela de exercicio        
         getExerciciosTreinos($scope.idaluno_ciclo);
         
      }, function errorCallback(response)
      {
          console.log(response);
      });
  }

  $scope.cancelarExercicio = function()
  {
    ngDialog.close();
  }

  $scope.okdialogCadastrado = function()
  {
    ngDialog.close();
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

  // deleta um exercicio da tabela de treino do aluno
  $scope.exluirExercicioTreinoAluno = function(idaluno_exercicio)
  {

    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data: idaluno_exercicio,
      method: 'POST',
      url :  url+"aluno/exluirExercicioTreinoAluno"  
    }
    $http(config).then(function successCallback(response) 
    { 
      
      listaNovosExerciciosTreinoAluno(idAluno_treino);

    }, function errorCallback(response)
    {
      console.log(response);
    });

  }


  // lista os treinos realizados pelo aluno
  $scope.getTreinosRealizadosAluno = function(idaluno)
  {
      
    // passa o idaluno para a variavel global para ser usado nos metodos
    // de pesquisa    
    idAluno =  idaluno; 

    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data : idaluno, 
      method: 'POST',
      url :  url+"aluno/getTreinosRealizadosAluno"  
    }
    $http(config).then(function successCallback(response) 
    { 
      
      $scope.treinosRealizados = response.data;

      $scope.mostraListaCiclo         = false;
      $scope.mostraListaTreinoCiclo   = false;
      $scope.mostraCiclosAluno        = false;
      $scope.mostraCicloSelecionado   = false;
      $scope.mostraCadastroCicloAluno = false;
      $scope.mostraListaExercicios    = false;
      $scope.mostraNovaListaTreino    = false;
      $scope.mostraTreinosRealizados  = true;

      // zera a lista de novos exercicios adicionados ao aluno
      $scope.exerciciosNovoTreinoAluno = "";
      $scope.treinos = "";
           
    }, function errorCallback(response)
    {
      console.log(response);
    }); 
   
  }


  $scope.autoCiclosRealizados = function(buscarCicloRealizado)
  { 
        
    var buscarCicloRealizadoObj = new Object();

    buscarCicloRealizadoObj.buscar = buscarCicloRealizado;

    buscarCicloRealizadoObj.idaluno = idAluno;
        
    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data : buscarCicloRealizadoObj, 
      method: 'POST',
      url :  url+"aluno/autoCiclosRealizados"  
    }
    $http(config).then(function successCallback(response) 
    { 
      $scope.autoCiclos = response.data;
           
    }, function errorCallback(response)
    {
      console.log(response);
    }); 
  }

  $scope.pesquisarTreinosRealizados = function()
  {
    var pesquisarCiclosRealizadosObj = new Object();

    pesquisarCiclosRealizadosObj.idaluno = idAluno;
    
    pesquisarCiclosRealizadosObj.buscar = $scope.buscarCicloRealizado;

    pesquisarCiclosRealizadosObj.dataInicio = $scope.buscarDataInicio;

    pesquisarCiclosRealizadosObj.dataTermino = $scope.buscarDataTermino;

    pesquisarCiclosRealizadosObj.dataTreinoRealizado = $scope.buscarDataTreinoRealizado;

    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data: pesquisarCiclosRealizadosObj,
      method: 'POST',
      url :  url+"aluno/pesquisarTreinosRealizados"  
    }
    $http(config).then(function successCallback(response) 
    { 
       $scope.treinosRealizados = response.data;
        
    }, function errorCallback(response)
    {
      console.log(response);
    });
  }

  // mostra detalhes do treino quando o aluno clica na grid de treinos realizados
  $scope.mostraTreinosRealizadosAluno = function(ciclo)
  {

    var idtreino_realizado = ciclo.idtreino_realizado;

    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data: idtreino_realizado,
      method: 'POST',
      url :  url+"aluno/mostraTreinosRealizadosAluno"  
    }
    $http(config).then(function successCallback(response) 
    { 
      $scope.cicloSelecionado = response.data[0];
        
      $scope.mostraCicloSelecionadoAluno = true;


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

      $scope.regioesTrabalhadas = stringRegiao;
        
    }, function errorCallback(response)
    {
      console.log(response);
    });

    getTreinosRealizadosAlunoSelecionado(idtreino_realizado);
    
    getExerciciosTreinosAlunoSelecionado(idtreino_realizado);

  }

  function getExerciciosTreinosAlunoSelecionado(idtreino_realizado)
  {
    
    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data: idtreino_realizado,
      method: 'POST',
      url :  url+"aluno/getExerciciosTreinosAlunoSelecionado"  
    }
    $http(config).then(function successCallback(response) 
    { 

      $scope.exerciciosTreino = response.data;
        
    }, function errorCallback(response)
    {
      console.log(response);
    }); 
   
  }

   
  function getTreinosRealizadosAlunoSelecionado(idtreino_realizado)
  {

    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data: idtreino_realizado,
      method: 'POST',
      url :  url+"aluno/getTreinosRealizadosAlunoSelecionado"  
    }
    $http(config).then(function successCallback(response) 
    { 
        $scope.treinos = response.data;
                             
    }, function errorCallback(response)
    {
        console.log(response);
    }); 
  }


});

