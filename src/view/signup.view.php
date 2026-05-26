<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/auth.css">
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

        <button type="submit" class="authBtn btn">Sign up</button>
    </form>

        <p class="redirect">You have an account? <a href="signin.php">Sign in!</a></p>

    <?php if (!empty($errors)): ?>
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