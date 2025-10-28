select perguntas_parq.pergunta, parq_aluno_perguntas_parq.resposta
		from pessoa
		join aluno on pessoa.idpessoa = aluno.idpessoa
		join parq_aluno on aluno.idaluno = parq_aluno.idaluno
		join parq_aluno_perguntas_parq on parq_aluno.idparqAluno = parq_aluno_perguntas_parq.idparqAluno
		join perguntas_parq on parq_aluno_perguntas_parq.idperguntaParq = perguntas_parq.idperguntaParq
		
		where pessoa.idpessoa = 1