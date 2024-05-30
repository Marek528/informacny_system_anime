<div class="center-wrap">
    <div class="main">
        <h1 class='mb-5 mt-3'>Register</h1>
        <form action='register.php' method='POST'>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" placeholder="Meno" name='meno' required>
                <label for='meno'>Meno</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" placeholder="Priezvisko" name='priezvisko' required>
                <label for='priezvisko'>Priezvisko</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" placeholder="name@example.com" name='email' required>
                <label for='email'>Email</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" placeholder="Heslo" name='heslo' required>
                <label for='heslo'>Heslo</label>
            </div>
            <div class="wrap">
                <input type="submit" class='btn btn-success btn-lg mt-3 mb-3'>
            </div>
        </form>
        <p>Máš už účet? <a href="login.php" style="text-decoration: none;">Prihlás sa</a></p>
    </div>
</div>