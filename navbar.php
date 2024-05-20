<nav class="navbar bg-dark navbar-expand-lg bg-body-tertiary border-bottom" data-bs-theme='dark'>
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">INFORMACNY SYSTEM ANIME</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-flex justify-content-between">
            <div class="navbar-nav">
                <div class="nav-item">
                    <a class="nav-link active" href="kategorie.php">Kategorie</a>
                </div>
            </div>
            <div class="navbar-nav">
                <div class="nav-item">
                    <?php
                    if (isset($_SESSION['email']))
                    {
                        $query = 'SELECT * FROM `dodavatelia` WHERE email="'.$_SESSION['email'].'"';
                        $result = $conn->query($query);
                        $row = $result->fetch_assoc();
                        echo "<a class='nav-link active' href='profile.php'> ".$row['meno']." ".$row['priezvisko']." </a>";
                    }
                    else
                    {
                        echo "<a class='nav-link active' href='login.php'>Login</a>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</nav>