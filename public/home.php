<?php

require '../vendor/autoload.php';

session_start();

$pdo = require __DIR__ .'/../src/db.php';

$contacts = [];

if($pdo) {
    $stmt = $pdo->prepare('SELECT * FROM contacts WHERE owner_id = :owner_id');

    $stmt->execute([
        ':owner_id' => $_SESSION['user_id'],
    ]);

    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION = [];

    session_destroy();

    header('Location: /signin.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/home.css">
    <title>Contact manager</title>
</head>
<body class="body">
    <!-- <p>Hello</p> -->
    <div class="hero">
        <h1>Contact manager</h1>
        <p>Let your most useful contacts be close to you!</p>
    </div>

    <div class="buttons">
        <form action="" method="POST">
            <button type="submit" class="deleteBtn">Logout</button>
        </form>
        <a href="create.php" class="addBtn">Add contact</a>
    </div>

    <div class="data-block">

        <?php if (count($contacts) == 0): ?>
            <p>No contacts yet</p>
            <?php else: ?>
                <ul class="list">
                    <?php foreach ($contacts as $contact) : ?>
                        <li class="listItem">
                            <div class="listItemContent">
                                <img src="<?php echo $contact['photo'] ?>" alt="">
                                <div>
                                    <h3 class="name">Name: <?php echo $contact['name'] ;?></h3>
                                    <p class="info">Email: <?php echo $contact['email'] ;?></p>
                                    <p class="info">Phone: <?php echo $contact['phone'] ;?></p>
                                </div>
                            </div>
                            <a href="delete.php?id=<?php echo $contact['id']; ?>" class="deleteBtn">X</a>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </div>
    </body>
    </html>