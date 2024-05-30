<?php
include('connect.php');
$id = $_GET['id'];
$query = "SELECT * FROM `kategorie` WHERE ID=$id";
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
    <link rel="icon" href="favicon.png" type="image/png">
</head>
<body>
    <?php include('navbar.php'); ?>
    <div class='shadow-lg m-3 p-3 ms-5 me-5'>
        <?php
        $query = "SELECT * FROM `kategorie` WHERE ID=$id";
        $result = $conn->query($query);
        if ($result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc())
            {
                echo "<h3>".$row['nazov']."</h3>";
            }
        }
        else 
        {
            echo "<h3>no result</h3>";
        }
        ?>
        <ul class='list-group list-group-flush'>
            <?php
            $query = "SELECT * FROM `produkty` WHERE kategoriaID=$id";
            $result = $conn->query($query);
            if ($result->num_rows > 0)
            {
                while ($row = $result->fetch_assoc())
                {
                    echo "<li class='list-group-item'><a href='produkt.php?id=".$row['ID']."' class='list-group-item list-group-item-action list-group-item-secondary'>".$row['nazov']."</a></li>";
                }
            }
            else 
            {
                echo "<li class='list-group-item'>no result</li>";
            }
            ?>
        </ul>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>