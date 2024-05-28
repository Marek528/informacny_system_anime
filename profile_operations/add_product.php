<?php
include('../connect.php');
?>
<!DOCTYPE html>
<html data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pridat produkt | Informacny system anime</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="../favicon.png" type="image/png">
</head>
<body>
    <?php include('navbar.php'); ?>
    <div class="ms-5 ps-5 mt-3">
        <a href="../profile.php" class="link-opacity-50-hover link-underline link-underline-opacity-0">Späť</a>
        <h1 class='mt-3'>Pridat produkt</h1>
        <form method="POST" action="add_product.php" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Nazov:</label>
                <input type="text" name="name" id="name" class="form-control" style="max-width:25em;" required>
            </div>
            <div class="mb-3">
                <label for="category">Kategoria:</label>
                <select name="category" id="category" class="form-select" style="width:auto;" required>
                    <option selected>-------------------</option>
                    <?php
                        $query = 'SELECT * FROM `kategorie`';
                        $result = $conn->query($query);
                        while ($row = $result->fetch_assoc())
                        {
                            echo '<option value="'.$row['ID'].'">'.$row['nazov'].'</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Popis:</label>
                <textarea name="description" id="description" class="form-control" style="max-width:35em;" required></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Cena:</label>
                <input type="number" name="price" id="price" class="form-control" style="width:auto;" min='0' step='0.01' required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Obrazok:</label>
                <input type="file" name="image" id="image" accept=".png" class="form-control" style="width:auto;" required>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Pocet kusov:</label>
                <input type="number" name="quantity" id="quantity" class="form-control" style="width:auto;" min='1' required>
                
            </div>
            <button type="submit" class="btn btn-success" name='update'>Pridat</button>
        </form>
        <?php
            if(isset($_POST['update']))
            {
                // nacitanie a nasledne vlozenie produktu do databazy
                $category = $_POST['category'];
                if($category == '-------------------')
                {
                    echo '<p class="text-danger">Vyber si kategoriu!</p>';
                    exit();
                }
                // overenie ci uz produkt s rovnakym nazvom je v db
                $query = "SELECT * FROM `produkty` WHERE nazov='".$_POST['name']."'";
                $result = $conn->query($query);
                if($result->num_rows > 0)
                {
                    echo '<p class="text-danger">Produkt s rovnakym nazvom uz existuje!</p>';
                    exit();
                }

                // naplnanie db
                $name = $_POST['name'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $quantity = $_POST['quantity'];
                $image = $_FILES['image']['name'];
                $image = "img/$image";
                $query = "INSERT INTO `produkty` (nazov, kategoriaID, popis, cena, pocet_kusov, obrazky) VALUES ('$name', '$category', '$description', '$price', '$quantity', '$image')";
                $result = $conn->query($query);
                if ($result == TRUE)
                {
                    //vytvori sa objednavka ak je uspesne pridany produkt
                    $query = "SELECT ID FROM `produkty` WHERE nazov='$name'";
                    $result = $conn->query($query);
                    $row = $result->fetch_assoc();
                    $produkt_id = $row['ID'];

                    $query = 'SELECT ID FROM `dodavatelia` WHERE email="'.$_SESSION['email'].'"';
                    $result = $conn->query($query);
                    $row = $result->fetch_assoc();
                    $dodavatel_id = $row['ID'];

                    $query = "INSERT INTO `objednavky` (dodavatelID, produktID, stav) VALUES ('$dodavatel_id', '$produkt_id', 'doručuje sa')";
                    $conn->query($query);
                    echo '<p class="text-success">Produkt bol uspesne pridany</p>';
                }
                else
                {
                    echo '<p class="text-danger">Pri pridavani produktu nastala chyba:</p> '.$conn->error.' ';
                }

                // download image
                $image = $_FILES['image']['name'];
                $image_tmp = $_FILES['image']['tmp_name'];
                $path = "C:/xampp/htdocs/informacny_system_anime/img/";

                $image = basename($image);
                $image_path = $path . $image;
                move_uploaded_file($image_tmp, $image_path);
            }
        ?>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>