<?php

session_start();

session_regenerate_id(true);

$pdo = require __DIR__ ."/../src/db.php";

$errors = [];

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    
    $password = $_POST['password'] ?? '';

if (!$email) {
    $errors[] = 'Empty email';
}

    $stmt = $pdo->prepare('SELECT * FROM users where email = :email');
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$user) {
    $errors[] = 'Invalid credentials';
} elseif (!password_verify($password, $user['password'])) {
    $errors[] = 'Invalid credentials';
} else {
        $_SESSION['user_id'] = $user['id'];

        header('Location: /home.php');
        exit;
}

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Contact manager</title>
</head>
<body class="body">

    <h2>Signin</h2>

    <form method="POST" class="form">
        <div class="inputContainer">
            <label for="email" class="label">Email</label>
            <input type="email" name="email" id="email" class="input" placeholder="Email">
        </div>

        <div class="inputContainer">
            <label for="password" class="label">Password</label>
            <input type="password" name="password" id="password" class="input" placeholder="Password">
        </div>

        <button type="submit" class="authBtn">Sign in</button>
    </form>

    <?php if(count($errors) > 0): ?>
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