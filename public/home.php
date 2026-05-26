<?php

require '../vendor/autoload.php';

// session_start();

// $pdo = require __DIR__ .'/../src/db.php';

require __DIR__ . '/../src/bootstrap.php';

require __DIR__ . '/../src/contact/home.php';

require __DIR__ . '/../src/view/home.view.php';

// $contacts = [];

// if($pdo) {
//     $stmt = $pdo->prepare('SELECT * FROM contacts WHERE owner_id = :owner_id');

//     $stmt->execute([
//         ':owner_id' => $_SESSION['user_id'],
//     ]);

//     $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
// }

// if($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $_SESSION = [];

//     session_destroy();

//     header('Location: /signin.php');
//     exit;
// }

?>

