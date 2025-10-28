app.controller('pessoa', function($scope, $http, $window, pessoaServico, myResource,  $mdDialog, ngDialog)
{
  $scope.pessoa = {};

  idPessoa = "";

  
  // declaração da variavel global da url da api
  url = "http://localhost/Academia/";

  // muda o formulario de acordo com o click do usuário nos icones
  // acima dos formularios do cadastro de pessoa
  $scope.mudaFormulario = function(form)
  {
      $scope.mostrar = form;

      // se for clicado no icone do tipo de pessoa
      // deixa o mostrarPessoas verdadeiro para poder 
      // aparecer os formularios especificos de aluno, funcionario etc
      if (form == "tipopessoa")
      {
        $scope.mostrarPessoas = true;
      }
      else
      {
        $scope.mostrarPessoas = false;
      }  
  }

  // mostra o campo operadora se o telefone for celular
  $scope.changeTipoTelefone = function()
  { 
    if ($scope.pessoa.tipoTelefone == "Celular")
    {
        $scope.mostraOperadora = true;
    }
    else
    {
        $scope.mostraOperadora = false;
    }  
  }

  $scope.changeTipoTelefoneArray = function(index)
  {
      if ($scope.pessoa.contatos[index].tipoTelefone == "Celular")
      {
          $scope.mostraOperadoraArray = true;
      }
      else
      {
          $scope.mostraOperadoraArray = false;
      } 
  }


   // como a api CEP traz apenas as siglas dos estados
  // preciso fazer esses ifs para passar os resultados com o nome
  // inteiro do estado para ficar selecionado no formulario
  function getNomeEstado(uf)
  {
     
     if (uf == "PR")
     {
        uf = "Paraná";
     }else if (uf == "AC")
     {
        uf = "Acre";
     }else if (uf == "AL")
     {
        uf = "Alagoas";
     }else if (uf == "AM")
     {
        uf = "Amazonas";
     }else if (uf == "AP")
     {
        uf = "Amapá";
     }else if (uf == "BA")
     {
        uf = "Bahia";
     }else if (uf == "CE")
     {
        uf = "Ceará";
     }else if (uf == "DF")
     {
        uf = "Distrito Federal";
     }
     else if (uf == "ES")
     {
        uf = "Espirito Santo";
     }else if (uf == "GO")
     {
        uf = "Goiás";
     }else if (uf == "MA")
     {
        uf = "Maranhão";
     }else if (uf == "MG")
     {
        uf = "Minas Gerais";
     }else if (uf == "MS")
     {
        uf = "Mato Grosso do Sul";
     }else if (uf == "MT")
     {
        uf = "Mato Grosso";
     }else if (uf == "PA")
     {
        uf = "Pará";
     }else if (uf == "PB")
     {
        uf = "Paraíba";
     }else if (uf == "PE")
     {
        uf = "Pernambuco";
     }else if (uf == "PI")
     {
        uf = "Piauí";
     }else if (uf == "RJ")
     {
        uf = "Rio de Janeiro";
     }else if (uf == "RN")
     {
        uf = "Rio Grande do Norte";
     }else if (uf == "RO")
     {
        uf = "Rondônia";
     }else if (uf == "RR")
     {
        uf = "Roraima";
     }else if (uf == "RS")
     {
        uf = "Rio Grande do Sul";
     }else if (uf == "SC")
     {
        uf = "Santa Catarina";
     }else if (uf == "SE")
     {
        uf = "Sergipe";
     }else if (uf == "SP")
     {
        uf = "São Paulo";
     }else if (uf == "TO")
     {
        uf = "Tocantins";
     }

     return uf;
        
  }

  // preenche os campos de endereço de acordo com o cep digitado
  $scope.buscarEndereco = function()
  {
    myResource.get({'cep': $scope.pessoa.cep}).$promise
   .then(function success(result)
   {
     $scope.resultado     = result;
     $scope.pessoa.rua    = $scope.resultado.logradouro;
     $scope.pessoa.bairro = $scope.resultado.bairro;
     $scope.pessoa.cidade = $scope.resultado.localidade;

     // chama o metodo que transforma as siglas dos estados
     // em nomes inteiros
     $scope.pessoa.uf = getNomeEstado($scope.resultado.uf);

     var estado = $scope.pessoa.uf;
     
     // pega o id do estado de acordo com o nome 
     var config = 
      {
          headers: {'Content-Type': 'application/x-www-form-urlencoded'},
          data : estado, 
          method: 'POST',
          url :  url+"pessoa/getIdEstado"  
      }
      $http(config).then(function successCallback(response) 
      { 
          // passa para o campo o id do estado
          $scope.pessoa.estado =  response.data[0].idestado; 
      
      }, function errorCallback(response)
      {
          console.log(response);
      });
     
     $scope.pessoa.estado = $scope.pessoa.uf;



   }).catch(function error(msg) {
     console.error('Error');
   });
  
  }

  $scope.buscarEnderecoAlternativo = function(index)
  {
    myResource.get({'cep': $scope.pessoa.enderecos[index].cep}).$promise
   .then(function success(result)
   {
     $scope.resultado  = result;
     $scope.pessoa.enderecos[index].rua    = $scope.resultado.logradouro;
     $scope.pessoa.enderecos[index].bairro = $scope.resultado.bairro;
     $scope.pessoa.enderecos[index].cidade = $scope.resultado.localidade;
     
     // chama o metodo que transforma as siglas dos estados
     // em nomes inteiros
     $scope.pessoa.enderecos[index].uf = getNomeEstado($scope.resultado.uf);

   }).catch(function error(msg) {
     console.error('Error');
   });
  
  }

  
  // quando clica no botão novo esconde a lista e mostra o formulario
  // esconde o botao novo e mostra os botoes do formulario
  $scope.novaPessoa = function()
  {
    listaPerguntas();

    listaRespostasParq();

    listarEstado();
   
    getConsultores();
   

    // inicializa os arrays para contato e endereço
    $scope.pessoa.contatos  = [];
    $scope.pessoa.enderecos = [];
    $scope.pessoa.contratos = [];

    $scope.mostrar = "pessoa";

    $scope.pf = true;

    $scope.pessoaFisica = true;

    $scope.btnAnterior = false;

    // mostra a linha de cadastro
    $scope.linha_cadastro = true;

    $scope.mostraListaPessoa = true;
    $scope.mostraPessoa = true;
    $scope.mostraBotoesPessoa = true;
    $scope.mostrabtnovaPessoa = true;
    $scope.mostrainputbuscarIdPessoa = true;
    $scope.mostrainputbuscarPessoa = true;
    $scope.mostrainputbuscarUsuario = true;
    $scope.mostrainputbuscarDataNascimento = true;
    $scope.mostraInputTipoPessoa = true;
    $scope.mostrabtnpesquisarPessoa = true;
    $scope.mostratituloPessoaLista = true;
    $scope.mostrabntCancelarPessoa = true;
        
    // mostra o botao proximo endereco
    $scope.btnProximo  = true;
 
    // esconde o botão salvar quando abre o formulario
    $scope.mostrabntSalvar  = false;
   
  }

  $scope.mostrarPf = function()
  {
    $scope.pessoaFisica = true;
    $scope.pessoaJuridica = false;
      
  }

  $scope.mostrarPj = function()
  {
    $scope.pessoaJuridica = true;
    $scope.pessoaFisica   = false;
  }


  
  $scope.proximo = function()
  {
    
    if($scope.mostrar == "pessoa")
    {
      $scope.mostrar = "contato";
      $scope.btnAnterior = true;
    
    }else if($scope.mostrar == "contato")
    {
      $scope.mostrar = "endereco";
          
    }else if($scope.mostrar == "endereco")
    {
      $scope.mostrarPessoas = true;
      $scope.mostrar = "tipopessoa";
     
    
    }else if($scope.mostrar == "tipopessoa")
    {
      $scope.mostrarPessoas = false;
      $scope.mostrar = "usuario"
      $scope.mostrabntSalvar = true;

      if(!$scope.pessoa.aluno)
      {
        $scope.btnProximo = false;
      }  
   
    }else if($scope.mostrar == "usuario")
    {
      // verifica se marcou aluno para mostrar o botao btnProximoParque
      if($scope.pessoa.aluno)
      {
         $scope.mostrar = "parq";

      } 
         
    }
            
  }

  $scope.anterior = function()
  {
    if($scope.mostrar == "parq")
    {
      $scope.btnProximo = true;
      $scope.mostrar = "usuario";
    
    }else if($scope.mostrar == "usuario")
    {
      $scope.mostrar = "tipopessoa";
      $scope.mostrarPessoas = true;
      $scope.btnProximo = true;
    
    }else if($scope.mostrar == "tipopessoa")
    {
      $scope.mostrarPessoas = false;
      $scope.mostrar = "endereco";
    
    }else if($scope.mostrar == "endereco")
    {
      $scope.mostrar = "contato";
    
    }else if($scope.mostrar == "contato")
    {
      $scope.mostrar = "pessoa";
      $scope.btnAnterior = false;
    }        

           
  }
  
  
  // mostra mais campos de telefone 
  $scope.maisTelefone = function()
  {
   
    $scope.pessoa.contatos.push(
    { 
        
    });
  }

  // excluir os campos de contato da linha clicada
  $scope.btnExluirContato = function(index)
  {
     $scope.pessoa.contatos.splice(index, 1);
  }
  
  
  // mostra mais campos de endereco 
  $scope.maisEndereco = function()
  {
    $scope.pessoa.enderecos.push(
    { 
        
    });
  }
  
  // excluir os campos de endereço da linha clicada
  $scope.btnExluirEndereco = function(index)
  {
     $scope.pessoa.enderecos.splice(index, 1);
  }

  // mostra mais campos de contratos 
  $scope.maisContrato = function()
  {
    $scope.pessoa.contratos.push(
    { 
           
    });
  }

  // excluir os campos de endereço da linha clicada
  $scope.btnExluirContrato = function(index)
  {
     $scope.pessoa.contratos.splice(index, 1);
  }


  $scope.validaNome = function()
  {
    // verifica se o campo está preenchido para mostrar
    // ou não a mensagem
    if ( $scope.pessoa.nome != "")
    {
        $scope.mostranomeObrigatorio = true;
    }
    else
    {
        $scope.mostranomeObrigatorio = false;
    }  
  }

  $scope.validaBlurNome = function()
  {
    // quando perder o foco no input nome verifica se o mesmo
    // está ou não vazio para mostrar a mensagem
    if (($scope.pessoa.nome == "") || ($scope.pessoa.nome == null))
    {
        $scope.mostranomeObrigatorio = false;
    }
    
  }

  $scope.validaDataNascimento = function()
  {
    // verifica se o campo está preenchido para mostrar
    // ou não a mensagem
    if ( $scope.pessoa.dataNascimento != "")
    {
        $scope.mostraDataNascimentoObrigatorio = true;
    }
    else
    {
        $scope.mostraDataNascimentoObrigatorio = false;
    }  
  }

  $scope.validaBlurDataNascimento = function()
  {
    // quando perder o foco no input dataNascimento verifica se o mesmo
    // está ou não vazio para mostrar a mensagem
    if (($scope.pessoa.dataNascimento == "") || ($scope.pessoa.dataNascimento == null))
    {
        $scope.mostraDataNascimentoObrigatorio = false;
    }
    
  }

  // mostra mensagem de senha não confirmada se campo 
  // confirmar senha for diferente do campo senha
  $scope.validaConfSenha = function()
  {
     if ($scope.pessoa.confsenha != $scope.pessoa.senha) 
     {
        $scope.mostraConfSenhaDiferente = true;
     }
     else
     {
        $scope.mostraConfSenhaDiferente = false;
     } 
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
      
      $scope.pessoas = response.data;
  
    }, function errorCallback(response)
    {
      console.log(response);
    }); 

  }

  function getConsultores()
  {
      
    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      method: 'GET',
      url :  url+"pessoa/getConsultores"  
    }
    $http(config).then(function successCallback(response) 
    { 
      
      $scope.consultores = response.data;
  
    }, function errorCallback(response)
    {
      console.log(response);
    });  
  }

  
  

  $scope.calcNumeroParcelas = function()
  {
    var prazoPlano = $scope.pessoa.prazoPlano;
    
    if(prazoPlano == 1)
    {
      $scope.pessoa.numeroParcelas = 1;
    } else if(prazoPlano == 2)
    {
      $scope.pessoa.numeroParcelas = 3;
    }
    else if(prazoPlano == 3)
    {
      $scope.pessoa.numeroParcelas = 6;
    }
    else if(prazoPlano == 4)
    {
      $scope.pessoa.numeroParcelas = 12;
    }
  }
  
  $scope.calcTotal = function()
  {
    $scope.pessoa.valorTotal = $scope.pessoa.numeroParcelas * $scope.pessoa.valorParcela;
  }

  $scope.cancelarPessoa  = function()
  {
      ngDialog.openConfirm({template: 'dialogcancelarPessoa',
        scope: $scope //Pass the scope object if you need to access in the template
      }).then(
        
      );
  }

  $scope.confirmcancelarPessoa = function()
  {
      // esconde a linha de cadastro
      $scope.linha_cadastro = false;

      // mostra a lista e esconde o formulario  
      $scope.mostraListaPessoa = false;
      // esconde todos os formulários
      $scope.mostrar = "";
      $scope.mostraBotoesPessoa = false;
      $scope.mostrabtnovaPessoa = false;
     
      $scope.mostrainputbuscarIdPessoa = false;
      $scope.mostrainputbuscarPessoa = false;
      $scope.mostrainputbuscarUsuario = false;
      $scope.mostrainputbuscarDataNascimento = false;
      $scope.mostraInputTipoPessoa = false;
      $scope.mostrabtnpesquisarPessoa = false;
      $scope.mostratituloPessoaLista = false;
      $scope.mostrabntCancelarPessoa = false;

      $scope.pessoa = {};

      ngDialog.close();
  } 

  $scope.cancelcancelarPessoa = function()
  {
    ngDialog.close();
  }

       
  $scope.salvarPessoa = function()
  { 
    var pessoa = $scope.pessoa;
    
    var config = 
    {
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        data : pessoa, 
        method: 'POST',
        url :  url+"pessoa/addPessoa"  
    }
    $http(config).then(function successCallback(response) 
    {   
        // da mensagens de validações se a mensagem for diferente de vazio
        // e não existir retorno do idpessoa
        if ((response.data.mensagem != null) && (!response.data.idpessoa))
        {
          $scope.validaUsuario = response.data.mensagem;
          
          ngDialog.openConfirm({template: 'dialogValidaUsuario',
            scope: $scope //Pass the scope object if you need to access in the template
          }).then(
            
          );
        }
        else 
        {
          
          // verifica se retornou o id da pessoa para cadastrar a foto
          if (response.data.idpessoa)
          {
              // chama o metodo que cadastra a foto passando o idpessoa
              addFoto(response.data.idpessoa);
          }  

          // atualiza a grid chamando o listar pessoa
          listarPessoa();
                  
          // esconde a linha de cadastro
          $scope.linha_cadastro = false;

          // chama o confirmcancelarPessoa para esconder o formulario mostrar a lista e limpar os campos
          $scope.confirmcancelarPessoa();

          $scope.cadastrado = "Cadastro Realizado";
          
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

  
  function addFoto(idpessoa)
  {
      var form_data = new FormData();
      
      angular.forEach($scope.files, function(file)
      {
        form_data.append('file', file);
      });

      // chama o arquivo que ira cadastrar a foto no banco de dados
      $http.post("../Academia/api_fotos/foto.php/"+idpessoa, form_data,
      {
        transformRequest: angular.identity,
        headers:{'Content-Type':undefined, 'Process-Data':false}

      }).success(function(response)
      {
         // depois de cadastrar faz a seleção da foto
         selectFoto();
      })
  }

  // seleciona a foto assim que carrega a página
  selectFoto();

  // metodo que faz a seleção da foto
  function selectFoto()
  {
      // chama o arquivo que faz o select das fotos
      $http.get("../Academia/api_fotos/select.php"
      ).success(function(data){
        
        $scope.images = data;
        
      });
  }
   
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
   
  $scope.okValidaUsuario = function()
  {
      ngDialog.close();
  }

  function listarPessoa()
  {

      var config = 
      {
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        method: 'GET',
        url :  url+"pessoa/listaPessoa"  
      }
      $http(config).then(function successCallback(response) 
      { 
     
        $scope.pessoas = response.data;
     
      }, function errorCallback(response)
      {
        console.log(response);
      }); 
  }

  // lista quando carrega a aplicação
  listarPessoa();


  function listarEstado()
  {

    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
       method: 'GET',
      url :  url+"pessoa/listaEstado"  
    }
    $http(config).then(function successCallback(response) 
    { 

      $scope.estados = response.data;
         
    }, function errorCallback(response)
    {
      console.log(response);
    }); 
  }

  
  
  // quando clica em editar carrega os dados no formulario
  $scope.editar = function(pessoa)
  {
    idPessoa = pessoa.idpessoa;

    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data : pessoa, 
      method: 'POST',
      url :  url+"pessoa/getPessoaEditar"  
    }
    $http(config).then(function successCallback(response) 
    { 
        
        // preenche os campos do formulário
        $scope.pessoa = response.data[0];
        $scope.pessoa.confsenha = pessoa.senha;
        $scope.pessoa.user = pessoa.usuario;

        if(pessoa.idpessoaFisica)
        {
          $scope.pj = false;
          $scope.pf = true;
          $scope.pessoaJuridica = false;
          $scope.pessoaFisica   = true;

        }else if(pessoa.idpessoaJuridica)
        {
          $scope.pf = false;
          $scope.pj = true;
          $scope.pessoaFisica   = false;
          $scope.pessoaJuridica = true;
          
        }

        // verifica se é aluno para marcar o check box
        if (pessoa.idaluno)
        {
            // marca o check 
           $scope.pessoa.aluno = true;
        }
        else
        {
           // desmarca o check box
           $scope.pessoa.aluno = false;
        }  

        // verifica se é funcionario para marcar o check box
        if (pessoa.idfuncionario)
        {
           // marca o check 
           $scope.pessoa.funcionario = true;
        }
        else
        {
           // desmarca o check box
           $scope.pessoa.funcionario = false;
        }  

        // abre o formulario e esconde a lista
        $scope.novaPessoa();
      

    }, function errorCallback(response)
    {
      console.log(response);
    }); 
   
  }

  $scope.excluir = function(idCliente)
  {
    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data : idCliente, 
      method: 'DELETE',
      url :  "http://localhost/angular_factory_rest/cliente/cliente"  
    }
    $http(config).then(function successCallback(response) 
    { 
      console.log("ok salvo");
      $scope.clientes = response.data;
      listar();
    }, function errorCallback(response)
    {
      console.log("erro");
    }); 
  }

  // lista as perguntas para o usuário responder o parq
  function listaPerguntas()
  {   
      var config = 
      {
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
         method: 'GET',
        url :  url+"pessoa/listaPerguntas"  
      }
      $http(config).then(function successCallback(response) 
      { 
        $scope.pessoa.perguntas = response.data;
              
      }, function errorCallback(response)
      {
        console.log(response);
      }); 
   
  }

  // lista as respostas do aluno no parq para evitar 
  //de listar perguntas repetidas
  function listaRespostasParq()
  {   
      var config = 
      {
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        method: 'POST',
        data:idPessoa,  
        url :  url+"pessoa/listaRespostasParq"  
      }
      $http(config).then(function successCallback(response) 
      { 
        $scope.pessoa.respostasAlunoParq = response.data;
              
      }, function errorCallback(response)
      {
        console.log(response);
      }); 
   
  }
  
  

  // gera o parq em pdf 
  $scope.imprimirParq = function(pessoa)
  {

    $http({
      method: 'POST',
      data:pessoa,
      url:'parq_pdf',
      headers:{'Content-Type':'application/json'}
        
    }).success(function(data){
      
      $window.open(url+'/parq_pdf/imprimirParq');

    });
          
  }

  // gera o contrato do aluno em pdf
  $scope.imprimirContrato = function(contratoAluno)
  {
    $http({
      method: 'POST',
      data:contratoAluno,
      url:'aluno_contrato_pdf',
      headers:{'Content-Type':'application/json'}
        
    }).success(function(data){
      
      $window.open(url+'/aluno_contrato_pdf/imprimirContrato');

    });
  }

  // abre a lista de contrato e o botão novo 
  // para adicionar um novo contrato ao aluno
  $scope.gerarContrato = function(pessoa)
  {
    $scope.mostrabtnovaPessoa       = true;
    $scope.mostrabtnpesquisarPessoa = true;
    $scope.mostraListaPessoa        = true;
    $scope.mostratituloPessoaLista  = true;
    $scope.mostraInputTipoPessoa    = true;
    $scope.mostrainputbuscarPessoa  = true;
    $scope.mostrainputbuscarDataNascimento = true;

    // chama o arquivo que faz o select das fotos
    $http.get("../Academia/api_fotos/select.php"
    ).success(function(data){
    
      $scope.images = data;
    
    });

    // guarda no escopo para poder mostrar a imagem no form 
    $scope.pessoa = pessoa;

    $scope.nome   = aluno.nome;

    if (pessoa.genero == "F") 
    {
      $scope.genero = "Feminino";
    }else if (pessoa.genero == "M") 
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
    var anoNascimento = pessoa.dataNascimento.split("-");
    
    // subtrai o ano atual com o ano de nascimento para obter a idade
    $scope.idade = todayYear - anoNascimento[0];
       
    $scope.mostrarContrato = false;
    $scope.mostraPerfilAlunoContrato = true;
    $scope.mostrarListaContrato = true;

    // chama o metodo que lista os contratos do aluno selecionado
    listaContratosAluno();
          
  }

  // lista os contratos do aluno selecionado
  function listaContratosAluno()
  {
    var pessoa = $scope.pessoa;

    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data : pessoa, 
      method: 'POST',
      url :  url+"contrato/listaContratosAluno"  
    }
    $http(config).then(function successCallback(response) 
    { 
      if (response.data != 0)
      {
         $scope.contratosAluno = response.data;
      }
     
      
    }, function errorCallback(response)
    {
      console.log(response);
    });     
  }

  // abre o fomrulario para adicionar um novo contrato para o aluno
  $scope.novoAlunoContrato = function()
  {
    $scope.mostrarContrato = true;
    $scope.mostrarListaContrato = false;

  }

  
  $scope.cancelarCadastroContrato  = function()
  {
      ngDialog.openConfirm({template: 'dialogcancelarCadastroContrato',
        scope: $scope //Pass the scope object if you need to access in the template
      }).then(
        
      );
  }

  $scope.confirmcancelarCadastroContrato = function()
  {
      $scope.aluno_contrato = "";
      $scope.mostrarContrato = false;
      $scope.mostrarListaContrato = true;
      
      ngDialog.close();
  } 

  $scope.cancelcancelarCadastroContrato = function()
  {
    ngDialog.close();
  }

  $scope.voltaListaPessoas = function()
  {
    $scope.mostrabtnovaPessoa       = false;
    $scope.mostrabtnpesquisarPessoa = false;
    $scope.mostraListaPessoa        = false;
    $scope.mostratituloPessoaLista  = false;
    $scope.mostraInputTipoPessoa    = false;
    $scope.mostrainputbuscarPessoa  = false;
    $scope.mostrainputbuscarDataNascimento = false;
    $scope.mostrarContrato = false;
    $scope.mostrarListaContrato = false;
    $scope.mostraPerfilAlunoContrato = false;
  }

  // lista os contratos para o campo contrato do formulario
  function listarContratos()
  {
      var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      method: 'GET',
      url :  url+"contrato/listarContratos"  
    }
    $http(config).then(function successCallback(response) 
    { 
      $scope.contratos = response.data;
      
    }, function errorCallback(response)
    {
      console.log(response);
    });  
  }

  listarContratos();

  // lista as formas de pagamento para o campo do formulário
  function listarFormas_pgto()
  {
      var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      method: 'GET',
      url :  url+"contrato/listarFormas_pgto"  
    }
    $http(config).then(function successCallback(response) 
    { 
      $scope.formas_pgto = response.data;
      
    }, function errorCallback(response)
    {
      console.log(response);
    });  
  }

  listarFormas_pgto();

  // lista os prazos para o campo do formulario
  function listarPrazos_plano()
  {
      var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      method: 'GET',
      url :  url+"contrato/listarPrazos_plano"  
    }
    $http(config).then(function successCallback(response) 
    { 
      $scope.prazos_plano = response.data;
      
    }, function errorCallback(response)
    {
      console.log(response);
    });  
  }

  listarPrazos_plano();

  // lista os tipos de plano para o campo do formulario
  function listarTipos_plano()
  {
      var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      method: 'GET',
      url :  url+"contrato/listarTipos_plano"  
    }
    $http(config).then(function successCallback(response) 
    { 
      $scope.tipos_plano = response.data;
      
    }, function errorCallback(response)
    {
      console.log(response);
    });  
  }

  listarTipos_plano();

  // lista as modalidades para o campo do formulario
  function listarModalidades()
  {
    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      method: 'GET',
      url :  url+"contrato/listarModalidades"  
    }
    $http(config).then(function successCallback(response) 
    { 
      $scope.modalidades = response.data;
      
    }, function errorCallback(response)
    {
      console.log(response);
    });  
  }

  listarModalidades();

  // metodo que busca os valores na tabela valores_planos 
  //conforme o que o usuário escolher no formulario de contrato do aluno
  // para preencher os campos de valores
  $scope.getValores = function()
  {
    var aluno_contrato = $scope.aluno_contrato;

    // verifica se existem essas variáveis e elas não são vazias
    if ((aluno_contrato.tipo_plano)  && (aluno_contrato.tipo_plano  != "") && 
        (aluno_contrato.modalidade)  && (aluno_contrato.modalidade  != "") &&
        (aluno_contrato.prazo_plano) && (aluno_contrato.prazo_plano != "")) 
    {

        var config = 
        {
          headers: {'Content-Type': 'application/x-www-form-urlencoded'},
          data : aluno_contrato, 
          method: 'POST',
          url :  url+"contrato/getValores"  
        }
        $http(config).then(function successCallback(response) 
        {    
          // se retornar valores entra aqui
          if (response.data != 0)
          {
            // preenche o campo valor total
            $scope.aluno_contrato.valorTotal = response.data[0].valor;
          
            // verifica o prazo de plano escolhido para preencher
            // os campos número de parcelas e valor de cada parcela
            if (response.data[0].prazoPlano == "Mensal")
            {
                $scope.aluno_contrato.numeroParcelas = 1;

                $scope.aluno_contrato.valorParcela = response.data[0].valor;
            }
            else if (response.data[0].prazoPlano == "Trimestral")
            {
                $scope.aluno_contrato.numeroParcelas = 3;

                $scope.aluno_contrato.valorParcela = (response.data[0].valor / 3).toFixed(2);
            } 
            else if (response.data[0].prazoPlano == "Semestral")
            {
              $scope.aluno_contrato.numeroParcelas = 6;

              $scope.aluno_contrato.valorParcela = (response.data[0].valor / 6).toFixed(2);

            }else if (response.data[0].prazoPlano == "Anual")
            {
              $scope.aluno_contrato.numeroParcelas = 12;

              $scope.aluno_contrato.valorParcela = (response.data[0].valor / 12).toFixed(2);
            }

          }
     
        }, function errorCallback(response)
        {
          console.log(response);
        }); 

    }
    
  }

  // metodo que salva o contrato do aluno na tabela aluno_contrato
  $scope.salvarAlunoContrato = function()
  {
    
    // cria o objeto para guardar o id aluno e os dados do contrato do formulario
    var aluno_contrato = new Object();

    aluno_contrato.idaluno  =  $scope.pessoa.idaluno;
    
    aluno_contrato.contrato =  $scope.aluno_contrato;

    var config = 
    {
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data : aluno_contrato, 
      method: 'POST',
      url :  url+"contrato/salvarAlunoContrato"  
    }
    $http(config).then(function successCallback(response) 
    { 
      if (response.data != 0)
      {
        $scope.ValidaAlunoContrato = response.data;

        ngDialog.openConfirm({template: 'dialogValidaAlunoContrato',
          scope: $scope //Pass the scope object if you need to access in the template
        }).then(
          
        );

      }
      else
      {
        $scope.CadastradoAlunoContrato = "cadastro Realizado";

        ngDialog.openConfirm({template: 'dialogCadastradoAlunoContrato',
          scope: $scope //Pass the scope object if you need to access in the template
        }).then(
          
        );
      }  
      
    
    }, function errorCallback(response)
    {
      console.log(response);
    }); 
  }

  $scope.okValidaAlunoContrato = function()
  {
      ngDialog.close();
  }

  $scope.okCadastradoAlunoContrato = function()
  {
    ngDialog.close();
  }

});

// metodo que faz o request no site de cep
app.factory('myResource', function ($resource) {
  var rest = $resource(
      'https://viacep.com.br/ws/:cep/json/',
      {
        'cep': ''
      }
    );
    return rest;
});


// diretiva da foto
app.directive("fileInput", function($parse){
    return{
      link:function($scope, element, attrs){
        element.on("change", function(event){
          var files = event.target.files;
          //console.log(files[0].name);
          $parse(attrs.fileInput).assign($scope, element[0].files);
          $scope.$apply();
        })
      }
    } 
  });



