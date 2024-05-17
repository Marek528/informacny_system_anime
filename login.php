<?php
    include('connect.php');
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $email = $_POST['email'];
        $heslo = $_POST['heslo'];

        $query = "SELECT * FROM `dodavatelia` WHERE email='$email' AND heslo='$heslo'";
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
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if ($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                $_SESSION['meno'] = $row['meno'];
                $_SESSION['priezvisko'] = $row['priezvisko'];
                $_SESSION['email'] = $row['email'];
                include('navbar.php');
                echo '
                    <div class="center-wrap">
                        <div class="main">
                            <img src="img/success.png" alt="Uspesne prihlaseny" title="Uspesne prihlaseny">
                            <h2>Uspesne prihlaseny</h2>
                            <a href="index.php" style="text-decoration: none;">Domovska stranka</a>
                        </div>
                    </div>
                ';
            }
            else
            {
                include('navbar.php');
                include('login_form.php');
                echo "<script>alert('Nespravne prihlasovacie udaje');</script>";
            }
        }
        else
        {
            include('navbar.php');
            include('login_form.php');
        }
    ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>