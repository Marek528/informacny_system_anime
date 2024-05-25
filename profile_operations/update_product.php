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
        <a href="../profile.php" class="link-opacity-50-hover link-underline link-underline-opacity-0">Späť</a>
        <h1 class='mt-3'>Aktualizovat produkt</h1>
        <form method="POST" action="update_product.php">
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
            <div class="mb-3">
                <label for="operation" class="form-label">Pocet kusov:</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="operation" id="add" value="add" required>
                    <label class="form-check-label" for="add">Pridat</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="operation" id="remove" value="remove" required>
                    <label class="form-check-label" for="remove">Odstranit</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Kolko chces pridat/odstranit:</label>
                <input type="number" name="quantity" id="quantity" class="form-control" min="1" style="width:auto;" required>
            </div>
            <button type="submit" class="btn btn-success" name='update'>Update</button>
        </form>
        <?php
            // spracovanie udajov cez isset POST 'update'
            // 1. overit ci vybral produkt
            // potom klasicky spravit sql query na update produktu
            if(isset($_POST['update']))
            {
                $product = $_POST['product'];
                $quantity = $_POST['quantity'];

                if($product == '-------------------')
                {
                    echo '<p class="text-danger">Prosim vyber produkt</p>';
                }
                else
                {
                    $operation = $_POST['operation'];
                    if($operation == 'remove')
                    {
                        $query = 'SELECT pocet_kusov FROM `produkty` WHERE ID='.$product.'';
                        $result = $conn->query($query);
                        $row = $result->fetch_assoc();
                        if($row['pocet_kusov'] < $quantity)
                        {
                            echo '<p class="text-danger">Nemozes odstranit viac kusov ako je na sklade</p>';
                            exit();
                        }
                        $query = 'UPDATE `produkty` SET pocet_kusov=pocet_kusov - '.$quantity.' WHERE ID='.$product.'';
                        $conn->query($query);
                        echo '<p class="text-success">Produkt bol uspesne aktualizovany</p>';
                    }
                    else
                    {
                        $query = 'UPDATE `produkty` SET pocet_kusov=pocet_kusov + '.$quantity.' WHERE ID='.$product.'';
                        $conn->query($query);
                        echo '<p class="text-success">Produkt bol uspesne aktualizovany</p>';
                    }
                }
            }
        ?>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>