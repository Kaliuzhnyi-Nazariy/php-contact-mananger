<?php

if (!isset($_SESSION["user_id"])) {
    header('Location: /signin');
    exit;
}

$contacts = [];

    $stmt = $pdo->prepare('SELECT * FROM contacts WHERE owner_id = :owner_id');

    $stmt->execute([
        ':owner_id' => $_SESSION['user_id'],
    ]);

    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);


if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION = [];

    session_destroy();

    header('Location: /signin');
    exit;
}