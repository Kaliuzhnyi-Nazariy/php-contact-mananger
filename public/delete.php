<?php 

session_start();

session_regenerate_id(true);

$pdo = require __DIR__ ."/../src/db.php";
$uploadsFolder = __DIR__ . "./uploads";

if(isset($_GET['id'])) {

$stmt = $pdo -> prepare('SELECT * FROM contacts WHERE id = :id AND owner_id = :owner_id');
$stmt -> execute([":id" => $_GET["id"],
":owner_id" => $_SESSION['user_id']]);
$contact = $stmt -> fetch(PDO::FETCH_ASSOC);

    if (!$contact) {
        echo 'Contact is not found';
    }

    if ($pdo) {
        echo $contact['id'];
        $stmt = $pdo->prepare('DELETE FROM contacts WHERE owner_id = :owner_id AND id = :id');
        $isDeleted = $stmt->execute([":owner_id" => $_SESSION['user_id'], ':id' => $contact['id']]);

        if ($isDeleted && file_exists($contact['photo'])) {
            unlink($contact['photo']);
        }

        header('Location: /home.php');
        exit;
    }
}