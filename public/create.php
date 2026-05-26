<?php

session_start();

session_regenerate_id(true);

$pdo = require __DIR__ . '/../src/db.php';

$uploadsFolder = 'uploads/';

$errors = [];

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim(filter_input(INPUT_POST,"name", FILTER_SANITIZE_SPECIAL_CHARS));
$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);    $phone = trim(filter_input(INPUT_POST,"phone", FILTER_SANITIZE_NUMBER_INT));

    $photo = '';


    if (empty($name) || empty($email) || empty($phone)) {
        $errors[] = 'Name, email and phone fields are required!';
    }

    if ($name && $email && $phone) {
        if(isset($_FILES['photo'])) {
            if (!is_dir($uploadsFolder)) {
                mkdir($uploadsFolder,0777, true);
            }

            $imageName = time() . '_' . basename($_FILES['photo']['name']);
            $imagePath = $uploadsFolder . $imageName;

            try {
             move_uploaded_file($_FILES['photo']['tmp_name'], $imagePath);
                $photo = $imagePath;
             }
             catch (Exception $e) {
                return null;
            }
        }   

        $stmt = $pdo->prepare('INSERT INTO contacts (name, email, phone, photo, owner_id) VALUES (:name, :email, :phone, :photo, :owner_id); RETURNING *;');
        $stmt->execute([
            ':name' => $name ?? '',
            ':email' => $email ?? '',
            ':phone' => $phone ?? '',
            ':photo' => $photo,
            ':owner_id' => $_SESSION['user_id'],
        ]);
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
    <link rel="stylesheet" href="/css/create.css">
    <title>Create contact</title>
</head>
<body class="body">

    <h2>Add contact</h2>

    <form action="" method="POST" class="form" enctype="multipart/form-data">
        <div class="inputContainer">
            <label for="name" class="label">Name</label>
            <input type="text" name="name" id="name" placeholder="Name" class="input">
        </div>

        <div class="inputContainer">
            <label for="email" class="label">Email</label>
            <input type="email" name="email" id="email" class="input" placeholder="Email">
        </div>

        <div class="inputContainer">
            <label for="phone" class="label">Phone</label>
            <input type="text" name="phone" id="phone" placeholder="+1234567890" class="input">
        </div>

        <label for="photo" class="photoInput">Add photo</label>
        <input type="file" name="photo" id="photo" accept="image/*" hidden>    
        <!-- <?php if ($_FILES['photo']): ?>
            <p><?php echo $_FILES['photo']['name'] ?></p>
            <?php endif; ?> -->
    
        <button type="submit" class="authBtn">Add contact</button>
    </form>

    <?php if (count($errors) > 0): ?>
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