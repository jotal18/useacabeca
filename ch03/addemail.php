<?php 

$dbc = mysqli_connect('localhost', 'root', '', 'elvis_store') or die('Erro ao conectar-se com o banco de dados.');

$first_name = $_POST['firstname'];
$last_name = $_POST['lastname']; 
$email = $_POST['email'];

$query = "INSERT INTO email_list (first_name, last_name, email) VALUES ('$first_name', '$last_name', '$email')";

mysqli_query($dbc, $query) or die('Erro ao acessar o bando de dados.');

echo 'Cliente adicionado.';

mysqli_close($dbc);

 ?>