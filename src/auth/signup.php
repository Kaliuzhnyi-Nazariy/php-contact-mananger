<?php


/** @var PDO $pdo */

if(isset($_SESSION['user_id'])) {
    header('Location: /home');
    exit;
}

$errors = [];

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS));
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
   
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';

    if(!$email) {
    echo 'Invalid email';
        die();
    }

    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$name) {
    $errors[] =  'Name is required';
} elseif ($user) {
    $errors[] = 'Email is already in use';
} elseif (strlen($password) < 6) {
    $errors[] = 'Password too short';
} elseif ($password !== $confirmPassword) {
    $errors[] = 'Passwords do not match';
} else {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
            $stmt = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password); RETURN *;');

            $newUser = $stmt->execute([
                ":name" => $name,
                ":email" => $email,
                ":password" => $hashedPassword,
            ]);

            $userId = $pdo->lastInsertId();

            session_regenerate_id(true);

            $_SESSION['user_id'] = $userId;
        header('Location: /');
        exit;
        } catch (Exception $e) {
    error_log($e->getMessage());
            $error = 'Something went wrong';
            }

}
}