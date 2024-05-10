<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informacny system anime</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/login.css">
</head>
<body>
    <?php include('navbar.php'); ?>
    <div class="center-wrap">
        <div class="main">
            <h1 class='mb-5 mt-3'>Login</h1>
            <form action='action.php' method='POST'>
            <div class="form-floating mb-3">
                    <input type="email" class="form-control" placeholder="name@example.com" name='email' required>
                    <label for='email'>Email</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" placeholder="Heslo" name='heslo' required>
                    <label for='heslo'>Heslo</label>
                </div>
                <div class="wrap">
                    <input type="submit" class='btn btn-success btn-lg mt-3 mb-3'>
                </div>
            </form>
            <p>Nie si zaregistrovany? <a href="register.php" style="text-decoration: none;">Vytvor si ucet</a></p>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>