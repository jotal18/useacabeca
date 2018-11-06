<?php 
	
	// Inclui as constantes da conexão ao banco de dados
	require_once('connectvars.php');

	// Se o nome e a senha não tiverem sido digitados, envie o cabeçalho de autenticação
	if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
		// o nome/senha não foram digitados, portanto, enviar os cabeçalhos de autenticação headers
		header('HTTP/1.1 401 Unauthorized');
		header('www-Authenticate: Basic realm="Mismatch"');
		// Para a execução do código aqui
		exit('<h3>Mismatch</h3> Desculpe, você precisa digitar o nome do usuário e a senha para acessar esta página');
	}

	// Conecta ao banco de dados
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	// Obtém os dados do login digitados pelo usuário
	$user_username = mysqli_real_escape_string($dbc, trim($_SERVER['PHP_AUTH_USER']));
	$user_password = mysqli_real_escape_string($dbc, trim($_SERVER['PHP_AUTH_PW']));

	// Procura o nome e a senha no banco de dados
	$query = "SELECT user_id, username FROM mismatch_user WHERE username = '$username' AND password = SHA('$user_password')";
	// Executa a query
	$data = mysqli_query($query);

	// Verifica a quantidade de linhas/registros retornados
	if (mysqli_num_rows($data) == 1) {
		
		// O login foi bem-sucedido, portanto, definir as variáveis de ID e nome do usuário
		$row = mysqli_fetch_array($data);
		$user_id = $row['user_id'];
		$user_username = $row['username'];

	} else {
		// O nome/senha estão incorretos, portanto, enviar os cabeçalhos de autenticação
		header('HTTP/1.1 401 Unauthorized');
		header('www-Authenticate: Basic realm="Mismatch"');
		// Para a execução do código aqui
		exit('<h3>Mismatch</h3> Desculpe, você precisa digitar o nome do usuário e a senha para acessar esta página');
	}

	// Confirma o login bem-sucedido
	echo '<p class="login">You are logged in as' . $username . '</p>';

 ?>