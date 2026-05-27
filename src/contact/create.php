<?php
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

        $stmt = $pdo->prepare('INSERT INTO contacts (name, email, phone, photo, owner_id) VALUES (:name, :email, :phone, :photo, :owner_id);');
        $stmt->execute([
            ':name' => $name ?? '',
            ':email' => $email ?? '',
            ':phone' => $phone ?? '',
            ':photo' => $photo,
            ':owner_id' => $_SESSION['user_id'],
        ]);
        header('Location: /');
        exit;
    }
}

