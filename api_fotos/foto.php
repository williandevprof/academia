<?php 
$connect = mysqli_connect("localhost", "root", "", "academia");

$uri = $_SERVER["REQUEST_URI"];
$uriArray = explode('/', $uri);

// guarda o quarto parametro da url que é o idpessoa
$idpessoa = $uriArray[4];

// verifica se tem foto para cadastrar
if (!empty($_FILES))
{
	
	// move a foto para a pasta images endereço no mac
	// no mac é necessario dar permissão chmod 777 via terminal na pasta
	// para funcionar
	if (move_uploaded_file($_FILES['file']['tmp_name'], '/Applications/XAMPP/xamppfiles/htdocs/Academia/api_fotos/images/'.$_FILES['file']['name'])) 
	{
		// insere a foto no banco de dados
		$insertQuery = "UPDATE pessoa SET foto = '". $_FILES['file']['name']."'
		WHERE idpessoa = ".$idpessoa;
		mysqli_query($connect, $insertQuery);
	}

	// move a foto para a pasta images endereço no windows
	/* if (move_uploaded_file($_FILES['file']['tmp_name'], 'G:\wamp\www\Academia\api_fotos\images/'.$_FILES['file']['name'])) 
	{
		// insere a foto no banco de dados
		$insertQuery = "UPDATE pessoa SET foto = '". $_FILES['file']['name']."'
		WHERE idpessoa = ".$idpessoa;
		mysqli_query($connect, $insertQuery);
	}*/
	
}