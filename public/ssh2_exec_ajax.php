<?php

if (!extension_loaded('ssh2')) {
	die('Extensão ssh2 não carregada');
}

$host = $_GET['host'];
$port = $_GET['port'];
$user = $_GET['user'];
$pass = $_GET['pass'];
$cmd = $_GET['cmd'];

$con = ssh2_connect($host, $port);
if (!$con) {
	die('Erro ao conectar');
}

if (!ssh2_auth_password($con, $user, $pass)) {
	die('Erro ao autenticar com senha');
}

$stream = ssh2_exec($con, $cmd);
if (!$stream) {
	die('Erro ao executar comando');
}
stream_set_blocking($stream, true);
stream_set_timeout($stream, 15);
echo stream_get_contents($stream);
fclose($stream);