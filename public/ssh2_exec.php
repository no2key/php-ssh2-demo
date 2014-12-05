<?php
// Quando for executado pelo php -S redirecionar os arquivos
if (php_sapi_name() === 'cli-server' && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}
?>

<html>
	<head>
		<title>PHP SSH2 - Example</title>
		<!-- Boostrap -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-theme.min.css">
	</head>
	<body>
		<div class="container">
			<h1>PHP SSH2 - Demonstração ssh2_exec</h1>
				<form>
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
					<div class="col-md-3">
						<label for="cmd">Comando</label>
						<input type="text" required class="form-control" name="cmd" id="cmd" placeholder="Ex: ls -l" />
					</div>
					<div class="col-md-2">
						<br/>
						<input type="submit" class="btn btn-primary" value="Executar" />
					</div>
				</div>
				<div class="row">
					<pre id="result" style="text-wrap: pre; padding: 5px; border: 1px solid #CCC; max-height: 400px; overflow: auto;margin-top:10px;"></pre>
				</div>
			</form>
		</div>
		<script src="js/jquery-1.11.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script>
			$('form').submit(function (event) {
				$('#result').html('Executando...');

				$.ajax({
					"url" : 'ssh2_exec_ajax.php',
					"data" : {
						host : $('#host').val(),
						user : $('#user').val(),
						pass : $('#pass').val(),
						port : $('#port').val(),
						cmd : $('#cmd').val()
					},
					"success" : function(data) {
						$('#result').html(data);
					},
					"error" : function(data) {
						$('#result').html('Erro: ' + data);
					}
				});

				event.preventDefault();
			});
		</script>
	</body>
</html>
