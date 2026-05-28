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

    <h2 class="header">Add contact</h2>

    <form action="" method="POST" class="form create-form" enctype="multipart/form-data">
        <div class="field-inputs">
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
        </div>

        <div class="photo-container">
            <label for="photo" class="photoInput">Add photo</label>
        <input type="file" name="photo" id="photo" accept="image/*" hidden>    
        <!-- <?php if (isset($_FILES['photo'])): ?>
            <p>hello</p>
            <?php echo htmlspecialchars($_FILES['photo']['name']) ?>
            <?php endif; ?>  -->

            <p id="photo-message">No file selected!</p>
        </div>
    
        <button type="submit" class="btn addBtn">Add contact</button>
    </form>

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

<script>
    const input = document.getElementById('photo')
    const inputMessage = document.getElementById('photo-message');

    input.addEventListener('change', () => {

        if(input.files.length > 0) {
            inputMessage.textContent = input.files[0].name;
        } else {
            inputMessage.textContent = 'No file selected!'
        }
    })
</script>