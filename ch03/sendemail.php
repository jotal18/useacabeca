<?php 

$from = 'elmer@makeelvis.com';
$subject = $_POST['subject'];
$text = $_POST['elvismail'];

$dbc = mysqli_connect('localhost', 'root', '', 'elvis_store') or die('Erro ao conectar-se ao banco de dados.');

$query = "SELECT * FROM email_list";

$result = mysqli_query($dbc, $query);

while ($row = mysqli_fetch_array($result)) {
	
	$first_name = $row['first_name'];
	$last_name = $row['last_name'];
	$msg = "Dear $first_name $last_name,\n $text";
	$to = $row['email'];
	
	mail($to, $subject, $msg, 'From:' . $from);

	echo 'Email sent to : ' . $to . '<br/>';
}

mysqli_close($dbc)

 ?>