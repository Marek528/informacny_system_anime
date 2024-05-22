<?php
include('connect.php');
?>
<!DOCTYPE html>
<html data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informacny system anime</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <?php include('navbar.php'); ?>
    <div class="ms-5 ps-5 mt-3">
        <?php
        echo '<h1>Vitaj '.$_SESSION['meno'].' '.$_SESSION['priezvisko'].'</h1>';
        ?>

        <h4>Operacie</h4>
        <ul>
            <li><a href='profile_operations/update_product.php' class='link-info link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-50-hover'>Aktualizovat produkt</a></li>
            <li><a href='profile_operations/add_product.php' class='link-info link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-50-hover'>Pridat produkt</a></li>
            <li><a href='profile_operations/remove_product.php' class='link-info link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-50-hover'>Odstranit produkt</a></li>
        </ul>

        <h4>Moje objednavky</h4>
        <!-- Tu bude zoznam objednavok cez nejaku simple tabulku + ?moznost menit stav? (dorucuje sa, dorucene) -->

        <form method="POST" class='mt-5'>
            <button class="btn btn-danger" type="submit" name="logout">Logout</button>
        </form>

        <?php
        if(isset($_POST['logout']))
        {
            session_unset();
            header("Location: login.php");
            exit();
        }
        ?>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>