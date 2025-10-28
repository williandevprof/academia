select *
		from exercicio as e
left 	join exercicio_treino et on e.idexercicio = et.exercicio_idexercicio
left 	join treino t on et.treino_idtreino = t.idtreino
left 	join ciclo_treino ct on t.idtreino = ct.treino_idtreino
left 	join ciclo c on ct.ciclo_idciclo = c.idciclo
left    join exercicio_combinado ec on et.idexercicio_treino = ec.idexercicio_treino
where c.idciclo = 1 and t.idtreino = 1


select e.exercicio, e.idexercicio 
from exercicio e
join exercicio_combinado ec on e.idexercicio = ec.idexercicio
join exercicio_treino et on ec.idexercicio_treino = et.idexercicio_treino
join treino t on et.treino_idtreino = t.idtreino
join ciclo_treino ct on t.idtreino = ct.treino_idtreino
join ciclo c on ct.ciclo_idciclo = c.idciclo
where c.idciclo = 2  and t.idtreino = 9