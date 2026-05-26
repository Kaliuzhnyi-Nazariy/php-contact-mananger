<?php

session_start();

session_regenerate_id(true);

$pdo = require __DIR__ . '/../src/db.php';

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

            $_SESSION['user_id'] = $userId;
        header('Location: /home.php');
        exit;
        } catch (Exception $e) {
    error_log($e->getMessage());
            $error = 'Something went wrong';
            }

}
}

?>

<!-- <?php require_once __DIR__ . '/../src/metadata.php'; ?> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styles.css">
    <!-- <link rel="stylesheet" href="/css/signup.css"> -->
    <title>Contact manager</title>
</head>
<body class="body">

    <h2>Signup</h2>

    <form method="POST" class="form">
        <div class="inputContainer">
            <label for="" class="label">Name</label>
            <input type="text" name="name" class="input" placeholder="Name">
        </div>

        <div class="inputContainer">
            <label for="" class="label">Email</label>
            <input type="email" name="email" class="input" placeholder="Email">
        </div>

        <div class="inputContainer">
            <label for="" class="label">Password</label>
            <input type="password" name="password" class="input" placeholder="Password">
        </div>

        <div class="inputContainer">
            <label for="" class="label">Confirm password</label>
            <input type="password" name="confirmPassword" class="input" placeholder="Confirm password">
        </div>

        <button type="submit" class="authBtn">Sign up</button>
    </form>
    <?php if ($errors): ?>
        <div class="errors">
            <h3>Errors:</h3>
        <ul>
            <?php foreach($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
        </div>
    <?php endif; ?>
</body>

</html>