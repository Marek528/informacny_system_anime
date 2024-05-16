<?php
include('connect.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategorie | Informacny system anime</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <?php include('navbar.php'); ?>
    <div class='shadow-lg m-3 p-3'>
        <h3>Kategorie:</h3>
        <ul class='list-group list-group-flush'>
            <?php
            $query = "SELECT * FROM `kategorie`";
            $result = $conn->query($query);
            if ($result->num_rows > 0)
            {
                while ($row = $result->fetch_assoc())
                {
                    echo "<li class='list-group-item'><a href='kategoria.php?id=".$row['ID']."' class='list-group-item list-group-item-action list-group-item-secondary'>".$row['nazov']."</a></li>";
                }
            }
            else 
            {
                echo "<li>no result</li>";
            }
            ?>
        </ul>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>