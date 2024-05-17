<?php
include('connect.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $username = $_POST['meno'];
    $surname = $_POST['priezvisko'];
    $email = $_POST['email'];
    $pass = $_POST['heslo'];

    $query = "SELECT * FROM dodavatelia WHERE email = '$email'";
    $result = $conn->query($query);
}
?>
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
    <?php
    include('navbar.php');
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if ($result->num_rows > 0)
        {
            include('register_form.php');
            echo "<script>alert('Email je uz pouzity');</script>";
        }
        else
        {
            $insertQuery = "INSERT INTO dodavatelia (meno, priezvisko, email, heslo) VALUES ('$username', '$surname', '$email', '$pass')";
            $conn->query($insertQuery);
            echo '
            <div class="center-wrap">
                <div class="main">
                    <img src="img/success.png" alt="Uspesne zaregistrovany" title="Teraz sa mozes prihlasit">
                    <h2>Uspesne zaregistrovany</h2>
                    <a href="login.php" style="text-decoration: none;">Prihlasit sa</a>
                </div>
            </div>
            ';
        }
    }
    else
    {
        include('register_form.php');
    }
    ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>