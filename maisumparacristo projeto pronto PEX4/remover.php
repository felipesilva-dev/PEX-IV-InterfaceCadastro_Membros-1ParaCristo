<?php
// remover.php
header('Content-Type: application/json; charset=UTF-8');
ini_set('display_errors', 0);

require_once __DIR__ . '/conexao.php';

$raw = file_get_contents('php://input');
$input = json_decode($raw, true);

$id = null;
if (is_array($input) && isset($input['id'])) $id = (int)$input['id'];
elseif (isset($_POST['id'])) $id = (int)$_POST['id'];
elseif (isset($_GET['id'])) $id = (int)$_GET['id'];

if (!$id) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'ID inválido.']);
    exit;
}

$stmt = $conexao->prepare("DELETE FROM menbros WHERE id = ?");
if (!$stmt) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Erro preparação: ' . $conexao->error]);
    exit;
}
$stmt->bind_param('i', $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Membro removido com sucesso.']);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Erro ao remover: ' . $stmt->error]);
}

$stmt->close();
$conexao->close();
