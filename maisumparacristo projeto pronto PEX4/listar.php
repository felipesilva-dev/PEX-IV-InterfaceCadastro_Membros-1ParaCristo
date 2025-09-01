<?php
// listar.php
header('Content-Type: application/json; charset=UTF-8');
ini_set('display_errors', 0);

require_once __DIR__ . '/conexao.php';

$sql = "SELECT id, nome, cpf, cep, endereco, numero, cargo, dataNascimento FROM menbros ORDER BY id DESC";
$result = $conexao->query($sql);

if ($result === false) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Erro na consulta: ' . $conexao->error]);
    exit;
}

$membros = [];
while ($row = $result->fetch_assoc()) {
    $membros[] = $row;
}

echo json_encode(['success' => true, 'data' => $membros]);

$conexao->close();
