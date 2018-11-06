<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <title>Guitar Wars - Remove a High Score</title>
  <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
  <h2>Guitar Wars - Remove a High Score</h2>

<?php
  require_once('appvars.php');
  require_once('connectvars.php');

  if (isset($_GET['id']) && isset($_GET['date']) && isset($_GET['name']) && isset($_GET['score']) && isset($_GET['screenshot'])) {
      
    $id = $_GET['id'];
    $date = $_GET['date'];
    $name = $_GET['name'];
    $score = $_GET['score'];
    $screenshot = $_GET['screenshot'];

  }elseif (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['score']) && isset($_POST['screenshot'])) {
    
    $id = $_POST['id'];
    $name = $_POST['name'];
    $score = $_POST['score'];
    $screenshot = $_POST['screenshot'];

  }else{

    echo '<p class="error">Sorry, no high score was specified for removal.</p>';
  }

  //Se o botão submit foi clicado
  if (isset($_POST['submit'])) {
    if ($_POST['confirm'] == 'yes') {
      
      //Exclui o arquivo gráfico
      @unlink(GW_UPLOADPATH . $screenshot);

      //Conecte ao banco de dados
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die ('Erro ao conectar com o banco de dados.');

      //Exclui os dados da pontuação do banco
      $query = "DELETE FROM guitarwars WHERE id = $id LIMIT 1";

      mysqli_query($dbc, $query);

      mysqli_close($dbc);
      
      //Confirma êxito com o usuário
      echo '<p>The high score of ' . $score . ' for' . $name . ' was successfully removed.</p>';
      
    }else{

      echo '<p class="error">The high score was not removed.</p>';

    }
  }elseif (isset($id) && isset($date) && isset($name) && isset($score) && isset($screenshot)) {
    $teste = '<p>Are sure you want to delete the following high score?</p>';
    $teste .= '<p><strong>Name: </strong>' . $name . '<br/>';
    $teste .= '<strong>Date: </strong>' . $date . '<br/>';
    $teste .= '<strong>Score: </strong>' . $score . '</p>';
    $teste .= '<form method="post" action="removescore.php">';
    $teste .= '<input type="radio" name="confirm" value="yes">Yes';
    $teste .= '<input type="radio" name="confirm" value="no" checked="checked">No<br/>';
    $teste .= '<input type="submit" name="submit" value="Enviar">';

    $teste .= '<input type="hidden" name="id" value="' . $id . '">';
    $teste .= '<input type="hidden" name="name" value="' . $name . '">';
    $teste .= '<input type="hidden" name="score" value="' . $score . '">';
    $teste .= '<input type="hidden" name="screenshot" value="' . $screenshot . '">';

    $teste .= '</form>';

    echo $teste;
  }

  echo '<p><a href="admin.php">Voltar</a></p>';

?>

</body> 
</html>
