<?php 

$dbc = mysqli_connect('localhost', 'root', '', 'elvis_store') or die('Erro ao conectar-se ao banco de dados.');

$email = $_POST['email'];

$query = "DELETE FROM email_list WHERE email = '$email'";

mysqli_query($dbc, $query) or die('Erro ao consultar o banco de dados.');

echo 'Cliente removido: ' . $email . '.';

mysqli_close($dbc)

 ?>