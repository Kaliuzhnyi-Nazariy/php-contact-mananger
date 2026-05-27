<?php 

if (isset($_SESSION['user_id'])) {
    header('Location: /');
    exit;
}


/** @var PDO $pdo */

$errors = [];

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    
    $password = $_POST['password'] ?? '';

if (!$email) {
    $errors[] = 'Empty email';
}

    if (empty($errors)) {

        $stmt = $pdo->prepare('SELECT * FROM users where email = :email');
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    }

if(!$user) {
    $errors[] = 'Invalid credentials';
} elseif (!password_verify($password, $user['password'])) {
    $errors[] = 'Invalid credentials';
} else {
         session_regenerate_id(true);

    $_SESSION['user_id'] = $user['id'];

    header('Location: /');
    exit;
}

}