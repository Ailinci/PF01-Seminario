<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Solo se permite método POST']);
    exit;
}

$user_id = isset($_POST['user_id']) ? trim($_POST['user_id']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

$errors = [];

if (empty($user_id)) {
    $errors[] = 'El nombre de usuario es obligatorio';
} elseif (strlen($user_id) < 4) {
    $errors[] = 'El nombre de usuario debe tener al menos 4 caracteres';
}

if (empty($email)) {
    $errors[] = 'El correo electrónico es obligatorio';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'El formato del correo electrónico no es válido';
}

if (empty($password)) {
    $errors[] = 'La contraseña es obligatoria';
} elseif (strlen($password) < 8) {
    $errors[] = 'La contraseña debe tener al menos 8 caracteres';
}

if (count($errors) > 0) {
    echo json_encode([
        'status' => 'error',
        'message' => implode(', ', $errors)
    ]);
} else {
    echo json_encode([
        'status' => 'ok',
        'message' => 'Usuario registrado con éxito'
    ]);
}
?>