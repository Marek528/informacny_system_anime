<?php
    include('../connect.php');
    $report = "";

    if(isset($_POST['delete']))
    {
        $product = $_POST['product'];

        if($product == '-------------------')
        {
            $report = '<p class="text-danger">Prosim vyber produkt</p>';
        }
        else
        {
            $query = 'DELETE FROM `produkty` WHERE ID='.$product.'';
            if($conn->query($query))
            {
                $query = 'DELETE FROM `objednavky` WHERE produktID='.$product.'';
                $conn->query($query);
                $report = '<p class="text-success">Produkt bol uspesne odstraneny</p>';
            }
            else
            {
                $report = '<p class="text-danger">Produkt sa nepodarilo odstranit</p>';
            }
        }
    }
?>
<!DOCTYPE html>
<html data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Odstranit produkt | Informacny system anime</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="../favicon.png" type="image/png">
</head>
<body>
    <?php include('navbar.php'); ?>
    <div class="ms-5 ps-5 mt-3">
        <a href="../profile.php" class="link-opacity-50-hover link-underline link-underline-opacity-0">Späť</a>
        <h1 class='mt-3'>Odstranit produkt</h1>
        <form method="POST" action="remove_product.php">
            <div class="mb-3">
                <label for="product" class="form-label">Vyber si produkt:</label>
                <select name="product" id="product" class="form-select" style="width:auto;" required>
                    <option selected>-------------------</option>
                    <?php
                        $query = 'SELECT ID FROM `dodavatelia` WHERE email="'.$_SESSION["email"].'"';
                        $result = $conn->query($query);
                        $row = $result->fetch_assoc();
                        $dodavatel_id = $row['ID'];
                        $query = 'SELECT produktID FROM `objednavky` WHERE dodavatelID='.$dodavatel_id.'';
                        $result = $conn->query($query);
                        $produkt_id = array();
                        while ($row = $result->fetch_assoc())
                        {
                            array_push($produkt_id, $row['produktID']);
                        }

                        foreach ($produkt_id as $id)
                        {
                            $query = 'SELECT * FROM `produkty` WHERE ID='.$id.'';
                            $result = $conn->query($query);
                            $row = $result->fetch_assoc();
                            echo '<option value="'.$row['ID'].'">'.$row['nazov'].'</option>';
                        }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-danger" name='delete'>Odstranit</button>
            <?php
                if(!empty($report))
                {
                    echo $report;
                }
            ?>
        </form>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>