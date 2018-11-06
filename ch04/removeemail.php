<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <title>Make Me Elvis - Remove Email</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <img src="blankface.jpg" width="161" height="350" alt="" style="float:right" />
  <img name="elvislogo" src="elvislogo.gif" width="229" height="32" border="0" alt="Make Me Elvis" />
  <p>Please select the email addresses to delete from the email list and click Remove</p>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
    <?php 

    $dbc = mysqli_connect('localhost', 'root', '', 'elvis_store') or die('Erro ao conectar-se com o banco de dados.');

    //Exclui as linhas dos clientes(somente se o formulário tiver sido submetido)
    if (isset($_POST['submit'])) {
      foreach ($_POST['todelet'] as $delete_id) {
        $query = "DELETE FROM email_list WHERE id = $delete_id";
        mysqli_query($dbc, $query);
      }

      echo "Clientes Removidos. <br/>";
    }

    //Exibe as linhas dos clientes com caixas de verificação  
    $query = "SELECT * FROM email_list";
    $result = mysqli_query($dbc, $query);

    while ($row = mysqli_fetch_array($result)) {
      echo '<input type="checkbox" value="' . $row['id'] . '" name="todelet[]"/>';
      echo $row['first_name'];
      echo '' . $row['last_name'];
      echo '' . $row['email'];
      echo '<br/>';
    }

      mysqli_close($dbc);

     ?>
     <input type="submit" name="submit" value="Remove">
  </form>
</body>
</html>
