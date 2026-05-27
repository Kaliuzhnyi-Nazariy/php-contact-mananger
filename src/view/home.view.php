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
            <button type="submit" class="btn logoutBtn">Logout</button>
        </form>
        <a href="create.php" class="addBtn btn">Add contact</a>
    </div>

    
    <?php if (empty($contacts)): ?>
        <div class="message">
            <p>No contacts yet</p>
        </div>
            <?php else: ?>
                <div class="data-block">
                    <ul class="list">
                    <?php foreach ($contacts as $contact) : ?>
                        <li class="listItem">
                            <div class="listItemContent">
                                <?php if (!empty($contact['photo'])): ?>
    <img                   src="<?= htmlspecialchars('/../../public'. $contact['photo']) ?>">
<?php endif; ?>
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
                </div>
        <?php endif; ?>
    </body>
    </html>