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

        <button type="submit" class="authBtn btn">Sign in</button>
    </form>

    <p class="redirect">Don't have an account? <a href="signup.php">Sign up!</a></p>

    <?php if(!empty($errors)): ?>
        <div class="errors">
            <h3>Errors:</h3>
        <ul>
            <?php foreach($errors as $error): ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
        </div>
    <?php endif; ?>
</body>

</html>