<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Guitar Wars - High Scores</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h2>Guitar Wars - High Scores</h2>
  <p>Welcome, Guitar Warrior, do you have what it takes to crack the high score list? If so, just <a href="addscore.php">add your own score</a>.</p>
  <hr />

<?php

  require_once('appvars.php');
  require_once('connectvars.php');

  // Conecta-se ao banco de dados 
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  // Recupera a pontuação do banco de dados
  $query = "SELECT * FROM guitarwars WHERE aproved = 1 ORDER BY score DESC, date ASC";
  $data = mysqli_query($dbc, $query);

  // Faz um loop através do array contendo os dados das pontuações, formatando-os como HTML 
  echo '<table>';

  $i = 0;

  while ($row = mysqli_fetch_array($data)) {

    if ($i == 0) {
      echo '<tr><td colspan="2" class="topscoreheader">Top Score: ' . $row['score'] . '</td></tr>';
    }
      // Exibe os dados das pontuações
      echo '<tr><td class="scoreinfo">';
      echo '<span class="score">' . $row['score'] . '</span><br />';
      echo '<strong>Name:</strong> ' . $row['name'] . '<br />';
      echo '<strong>Date:</strong> ' . $row['date'] . '<br/>';
      
      if (is_file(GW_UPLOADPATH . $row['screenshot']) && filesize (GW_UPLOADPATH . $row['screenshot']) > 0) {
        echo '<img src="' . GW_UPLOADPATH . $row['screenshot'] . '" alt="Score Image"></td></tr>';
      }else{
        echo '<td><img src="' . GW_UPLOADPATH . 'unverified.gif" alt="Unverified score"></td></tr>';
      } 

    $i++; 
  }
  echo '</table>';

  mysqli_close($dbc);
?>


</body> 
</html>
