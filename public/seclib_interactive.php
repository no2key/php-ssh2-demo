<html>
	<head>
		<title>PHP SSH2 - Example</title>
		<!-- Boostrap -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-theme.min.css">
	</head>
	<body>
		<div class="container">
			<h1>PHPSecLib - Demonstração Comando Interativo</h1>
			<form method="POST">
				<div class="row">
					<div class="col-md-2">
						<label for="host">Servidor</label>
						<input type="text" required class="form-control" name="host" id="host" placeholder="IP ou host" />
					</div>
					<div class="col-md-1">
						<label for="port">Porta</label>
						<input type="text" value="22" required class="form-control" name="port" id="port" placeholder="Porta" />
					</div>
					<div class="col-md-2">
						<label for="user">Usuário</label>
						<input type="text" required class="form-control" name="user" id="user" placeholder="Username" />
					</div>
					<div class="col-md-2">
						<label for="pass">Senha</label>
						<input type="password" required class="form-control" name="pass" id="pass" placeholder="Senha" />
					</div>
					<div class="col-md-2">
						<br/>
						<input type="submit" class="btn btn-primary" value="Executar" />
					</div>
				</div>
				<div class="row">
					<pre id="result" style="text-wrap: pre; padding: 5px; border: 1px solid #CCC; max-height: 400px; overflow: auto;margin-top:10px;">
						<?php
if (!empty($_POST)) {
	set_include_path(__DIR__ . '/../library');

	$host = $_POST['host'];
	$user = $_POST['user'];
	$pass = $_POST['pass'];

	require_once 'Net/SSH2.php';
	$ssh = new Net_SSH2($host);
	if (!$ssh->login($user, $pass)) {
	    exit('Login Failed');
	}

	//Aguarda o prompt
	$output = $ssh->read('$');

	//Executa o sudo
	$ssh->write("sudo ls -la\n");

	//Aguarda o prompt da senha e envia a senha
	$output .= $ssh->read('/[pP]assword[^:]*:/', NET_SSH2_READ_REGEX);
	$ssh->write("{$pass}\n");

	//Lê o restante
	$output .= $ssh->read('$');

	echo $output;
}
?>
					</pre>
				</div>
			</form>
		</div>
	</body>
</html>


