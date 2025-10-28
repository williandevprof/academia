<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html ng-app="myApp">
	<head>
		<meta charset="utf-8">
		<title>Welcome to CodeIgniter</title>
		<link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/estilo.css">
		<script src="angular/angular.min.js"></script>
		<script src="angular/ngDialog.min.js"></script>
		<script src="angular/dirPagination.js"></script>
		<script src="angular/myApp.js"></script>	
		<link rel="stylesheet" type="text/css" href="css/ngDialog.css">
		<link rel="stylesheet" href="css/ngDialog-theme-default.css">
		<link rel="stylesheet" href="css/ngDialog-theme-plain.css">
		<link rel="stylesheet" href="css/ngDialog-custom-width.css">
    </head>

	<body ng-controller="clienteCtrl">
		<form name="formCliente">
			<input type="hidden" class="form-control" name="idCliente" ng-model="cliente.idCliente"
	        value="{{cliente.idCliente}}">
	        <label>Nome </label>
	        <input type="text" class="form-control" name="nome" ng-model="cliente.nome"
	        value="{{cliente.nome}}"  required>
	        <label>Email </label>
	        <input type="text" class="form-control" name="email" ng-model="cliente.email"
	        value="{{cliente.email}}"  required>
	   		<label>Idade </label>
	        <input type="text" class="form-control" name="idade" ng-model="cliente.idade"
	        value="{{cliente.idade}}"  required>
	   		<br>
	       <button class="btn btn-success" ng-click="salvar(cliente)" >Salvar</button>
	    </form>
	    <br><br>
		<table class="table table-bordered table-striped table-hover">
			<tr>
				<th>Id</th>
				<th>Nome</th>
				<th>Email</th>
				<th>Idade</th>
				<th>Alterar</th>
			</tr>
			<tr dir-paginate="cliente in clientes|itemsPerPage:5">
				<td>{{cliente.idCliente}}</td>
				<td>{{cliente.nome}}</td>
				<td>{{cliente.email}}</td>
				<td>{{cliente.idade}}</td>
				<td><button class="btn btn-warning" ng-click="editar(cliente)">Alterar</button></td>
				<td><a href="#" class="btn btn-danger" ng-click="deleteCliente(cliente)">Excluir</a></td>	
			</tr>
		</table>
		<div class="btn_paginacao">
			<dir-pagination-controls
				max-size="5"
				direction-links="true"
				boundary-links="true" >
			</dir-pagination-controls>
		</div>
		<script type="text/ng-template" id="dialogExcCliente">
			<div class="ngdialog-message">
	            <h3>Tem ceteza que deseja excluir esse cliente?</h3>
	            <p ng-show="theme">Test content for <code>{{theme}}</code></p>
	        </div>
        	<div class="ngdialog-buttons">
            	<button type="button" class="ngdialog-button ngdialog-button-danger"  ng-click="cancelExcCliente()">Não</button>
            	<button type="button" class="ngdialog-button ngdialog-button-primary" ng-click="confirmExcCliente()">Sim</button>
        	</div>
		</script>
	</body>
</html>