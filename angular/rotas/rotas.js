app.config(function($routeProvider)
{
    $routeProvider

    .when('/main',{
            templateUrl: 'main',
            controller: 'main'
    })

    .when('/usuario',{
            templateUrl:'usuario',
            controller: 'usuario'
    })

    .when('/log',{
            templateUrl:'log',
            controller: 'log'
    })
    
    .when('/pessoa',{
            templateUrl: 'pessoa',
            controller: 'pessoa'
    })

    .when('/contrato',{
            templateUrl: 'contrato',
            controller: 'contrato'
    })

    .when('/valores_planos',{
            templateUrl: 'valores_planos',
            controller:  'valores_planos'
    })

    .when('/parq',{
            templateUrl: 'parq',
            controller: 'parq'
    })

    .when('/aparelho',{
            templateUrl:'aparelho',
            controller: 'aparelho'
    })

    .when('/tipo_exercicio',{
            templateUrl:'tipo_exercicio',
            controller: 'tipo_exercicio'
    })

    .when('/regiao_trabalhada',{
            templateUrl:'regiao_trabalhada',
            controller: 'regiao_trabalhada'
    })

    .when('/exercicio',{
            templateUrl:'exercicio',
            controller: 'exercicio'
    })

    .when('/avaliacao_fisica',{
            templateUrl:'avaliacao_fisica',
            controller: 'avaliacao_fisica'
    })

    .when('/nutricao',{
            templateUrl:'nutricao',
            controller: 'nutricao'
    })

    .when('/treino',{
            templateUrl:'treino',
            controller: 'treino'
    })

    .when('/aluno',{
            templateUrl:'aluno',
            controller: 'aluno'
    })

    .when('/meus_planos_nutricao',{
            templateUrl:'meus_planos_nutricao',
            controller: 'meus_planos_nutricao'
    })

    .when('/minhas_avaliacoes',{
            templateUrl:'minhas_avaliacoes',
            controller: 'minhas_avaliacoes'
    })

    .when('/meus_treinos',{
            templateUrl:'meus_treinos',
            controller: 'meus_treinos'
    })

    .when('/salvar_treinos',{
            templateUrl:'salvar_treinos',
            controller: 'salvar_treinos'
    })

    .when('/treinos_realizados',{
            templateUrl:'treinos_realizados',
            controller: 'treinos_realizados'
    })
       
});