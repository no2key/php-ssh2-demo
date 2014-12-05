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
			<h1>PHP SSH2 - Demonstração</h1>
			<ul>
				<li><a href="ssh2_exec.php">exec com extensão ssh2</a></li>
				<li><a href="seclib_interactive.php">comando interativo com seclib</a></li>
			</ul>
		</div>

	</body>
</html>
