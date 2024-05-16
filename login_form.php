<div class="center-wrap">
    <div class="main">
        <h1 class='mb-5 mt-3'>Login</h1>
        <form action='login.php' method='POST'>
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
        <p>Nie si zaregistrovany? <a href="register.php" style="text-decoration: none;">Vytvor si ucet</a></p>
    </div>
</div>