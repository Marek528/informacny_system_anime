<?php
include('connect.php');
$id = $_GET['id'];
$query = "SELECT * FROM `produkty` WHERE ID=$id";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    if ($result->num_rows > 0)
    {
        while ($row = $result->fetch_assoc())
        {
            echo "<title>".$row['nazov']." | Informačný systém anime </title>";
        }
    }
    else 
    {
        echo "<title>Informačný systém anime</title>";
    }
    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="icon" href="favicon.png" type="image/png">
</head>
<body>
    <?php include('navbar.php'); ?>
    <div class='ms-5 mt-3'>
        <?php
        $query = "SELECT * FROM `produkty` WHERE ID=$id";
        $result = $conn->query($query);
        $kategoria_id;
        if ($result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc())
            {
                $kategoria_id = $row['kategoriaID'];
                echo "<h2>".$row['nazov']."</h2>";
                echo '<div class="row mx-0">';
                echo '<div class="col px-0 img-length">';
                echo '<img src="'.$row['obrazky'].'" alt="'.$row['nazov'].'" title="'.$row['nazov'].'">';
                echo '</div>';
            }
        }
        else 
        {
            echo "<h2>no result</h2>";
            echo '<img src="https://via.placeholder.com/150" alt="'.$row['obrazky'].'">';
        }
        
        $query = "SELECT * FROM kategorie WHERE ID=$kategoria_id";
        $result = $conn->query($query);
        if ($result->num_rows > 0)
        {
            echo '<div class="col px-0">';
            echo "<p class='mb-2'><strong>Kategória: </strong>";
            while ($row = $result->fetch_assoc())
            {
                echo "<a href='kategoria.php?id=".$row['ID']."'>".$row['nazov']."</a>";
            }
            echo "</p>";
        }
        else 
        {
            echo "<p><strong>Kategória:</strong><br> no result</p>";
        }

        $query = "SELECT * FROM `produkty` WHERE ID=$id";
        $result = $conn->query($query);
        if ($result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc())
            {
                echo "<p class='mb-2'><strong>Cena:</strong> ".$row['cena']."€</p>";
                echo "<p class='mb-2'><strong>Počet kusov:</strong> ".$row['pocet_kusov']."</p>";
                echo "<p style='max-width:70em;'><strong>Popis:</strong><br> ".$row['popis']."</p>";
                echo '</div>';
            }
        }
        else 
        {
            echo '<p><strong>Cena:</strong><br> no result</p>';
            echo '<p><strong>Počet kusov:</strong><br> no result</p>';
            echo '<p><strong>Popis:</strong><br> no result</p>';
        }
        ?>
        
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>