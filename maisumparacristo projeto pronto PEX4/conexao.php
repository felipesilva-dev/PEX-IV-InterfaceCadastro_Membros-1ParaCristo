<?php
// conexao.php
// retorna $conexao mysqli pronto

$host = '127.0.0.1';
$port = 3307; // porta do WAMP (número, sem : no host)
$user = 'root';
$password = '';
$database = 'formula_maisumparacristo';

$conexao = new mysqli($host, $user, $password, $database, $port);

if ($conexao->connect_errno) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Erro conexão DB: ' . $conexao->connect_error]);
    exit;
}

$conexao->set_charset('utf8mb4');

