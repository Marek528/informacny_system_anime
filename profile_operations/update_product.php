<?php
include('../connect.php');
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
        <h1>Aktualizovat produkt</h1>
        <form method="POST" action="update_product.php">
            <div class="mb-3">
                <label for="product" class="form-label">Vyber si produkt:</label>
                <select name="product" id="product" class="form-select" required>
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
            <div class="mb-3">
                <label for="quantity" class="form-label">Pocet kusov, kolko chces pridat:</label>
                <input type="number" name="quantity" id="quantity" class="form-control" min="1" required>
            </div>
            <button type="submit" class="btn btn-primary" name='update'>Update</button>
        </form>
        <?php
            // spracovanie udajov cez isset POST 'update'
            // 1. overit ci vybral produkt
            // potom klasicky spravit sql query na update produktu
        ?>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>