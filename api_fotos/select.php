<?php
$connect = mysqli_connect("localhost", "root", "", "academia");
$output = "";

$query = "SELECT idpessoa, foto FROM pessoa ORDER BY idpessoa DESC";

$result = mysqli_query($connect, $query);

while ($row = mysqli_fetch_array($result))
{
	$output[] = $row;
}

echo json_encode($output);