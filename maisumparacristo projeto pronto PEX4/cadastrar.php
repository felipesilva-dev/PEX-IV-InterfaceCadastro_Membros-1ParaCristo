<?php
// cadastrar.php
header('Content-Type: application/json; charset=UTF-8');
ini_set('display_errors', 0);

require_once __DIR__ . '/conexao.php';

// Pega valores do POST (FormData)
$nome = trim($_POST['nome'] ?? '');
$cep = trim($_POST['cep'] ?? '');
$dataNascimento = trim($_POST['dataNascimento'] ?? '');
$cpf = trim($_POST['cpf'] ?? '');
$endereco = trim($_POST['endereco'] ?? '');
$numero = trim($_POST['numero'] ?? '');
$cargo = trim($_POST['cargo'] ?? '');

// Validações mínimas
if ($nome === '' || $cpf === '' || $cep === '') {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Preencha nome, CPF e CEP.']);
    exit;
}

// Checa duplicidade por CPF
$stmt = $conexao->prepare("SELECT id FROM menbros WHERE cpf = ? LIMIT 1");
if (!$stmt) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Erro na preparação (select): ' . $conexao->error]);
    exit;
}
$stmt->bind_param('s', $cpf);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    $stmt->close();
    http_response_code(409);
    echo json_encode(['success' => false, 'message' => 'CPF já cadastrado.']);
    exit;
}
$stmt->close();

// Insere
$stmt = $conexao->prepare("
    INSERT INTO menbros (nome, cep, dataNascimento, cpf, endereco, numero, cargo)
    VALUES (?, ?, ?, ?, ?, ?, ?)
");
if (!$stmt) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Erro preparação (insert): ' . $conexao->error]);
    exit;
}
$stmt->bind_param('sssssss', $nome, $cep, $dataNascimento, $cpf, $endereco, $numero, $cargo);

if ($stmt->execute()) {
    $newId = $stmt->insert_id;
    echo json_encode(['success' => true, 'message' => 'Cadastro realizado com sucesso.', 'id' => $newId]);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Erro ao inserir: ' . $stmt->error]);
}

$stmt->close();
$conexao->close();
