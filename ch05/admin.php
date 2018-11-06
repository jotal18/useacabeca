<!DOCTYPE html>
<html>
<head>
	<title>Guitar Wars - High Scores Administration</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<h2>Guitar Wars - High Scores Administration</h2>
  	<p>Below is a list of all Guitar Wars high scores. Use this page to remove scores as needed.</p>
  <hr/>

  <?php 

  	require_once('appvars.php');
  	require_once('connectvars.php');

  	//Conecta-se ao banco de dados
  	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die ('Erro ao conectar com o banco de dados.');

  	//Obtém os dados das pontuações a partir do MySql
  	$query = "SELECT * FROM guitarwars ORDER BY score DESC, date ASC";
  	$result = mysqli_query($dbc, $query);

  	//Faz um loop através do array contendo os dados das pontuações, formatando-os como HTML
  	echo '<table>';
  	while ($row = mysqli_fetch_array($result)) {
  		echo '<tr class="scorerow"><td><strong>' . $row['name'] . '</strong></td>';
  		echo '<td>' . $row['date'] . '</td>';
  		echo '<td>' . $row['score'] . '</td>';
  		echo '<td><a href="removescore.php?id=' . $row['id'] . '&amp;date=' . $row['date'] . '&amp;name=' . $row['name'] . '&amp;score='  . $row['score'] . '&amp;screenshot='  . $row['screenshot'] . '">Remove</a></td></tr>';
  	}
  	echo '</table>';

  	mysqli_close($dbc);
   ?>

</body>
</html>