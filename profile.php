<?php
    include('connect.php');
    if(!isset($_SESSION['email']))
    {
        header("Location: login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil | Informačný systém anime</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="favicon.png" type="image/png">
</head>
<body>
    <?php include('navbar.php'); ?>
    <div class="ms-5 ps-5 mt-3">
        <?php
        echo '<h1>Vitaj '.$_SESSION['meno'].' '.$_SESSION['priezvisko'].'</h1>';
        ?>

        <h4>Operácie</h4>
        <ul>
            <li><a href='profile_operations/update_product.php' class='link-info link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-50-hover'>Aktualizovať produkt</a></li>
            <li><a href='profile_operations/add_product.php' class='link-info link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-50-hover'>Pridať produkt</a></li>
            <li><a href='profile_operations/remove_product.php' class='link-info link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-50-hover'>Odstrániť produkt</a></li>
        </ul>

        <h4>Moje objednávky</h4>
        <table class="table table-dark table-hover text-center" style="max-width: 70em;">
        <colgroup>
            <col style="width: 35em;">
            <col style="width: 35em;">
            <col style="width: 35em;">
        </colgroup>
        <thead>
            <tr>
                <th scope="col">Produkt</th>
                <th scope="col">Počet kusov</th>
                <th scope="col">Stav</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
            $query = 'SELECT * FROM `dodavatelia` WHERE email="'.$_SESSION['email'].'"';
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $dodavatel_id = $row['ID'];

            $query = 'SELECT * FROM `objednavky` WHERE dodavatelID='.$dodavatel_id.'';
            $result = $conn->query($query);
            if ($result->num_rows > 0)
            {
                while ($row = $result->fetch_assoc())
                {
                    $query = 'SELECT * FROM `produkty` WHERE ID='.$row['produktID'].'';
                    $result2 = $conn->query($query);
                    $row2 = $result2->fetch_assoc();
                    echo '<tr>';
                    echo '<td class="align-middle">'.$row2['nazov'].'</td>';
                    echo '<td class="align-middle">'.$row2['pocet_kusov'].'</td>';
                    if ($row['stav'] == "doručuje sa")
                    {
                        echo '<td class="text-warning">'.$row['stav'].' <a href="profile.php?id='.$row2['ID'].'" class="btn btn-success" role="button">označiť ako doručené</a></td>';
                    }
                    else
                    {
                        echo '<td class="text-success">'.$row['stav'].'</td>';
                    }
                    echo '</tr>';
                }
            }
            else 
            {
                echo '<tr><td colspan="3">Žiadne objednávky</td></tr>';
            }
            ?>
        </tbody>
        </table>

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

        if(isset($_GET['id']))
        {
            $query = 'UPDATE `objednavky` SET stav="doručené" WHERE produktID='.$_GET['id'].'';
            $conn->query($query);
            header("Location: profile.php");
            exit();
        }
        ?>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>