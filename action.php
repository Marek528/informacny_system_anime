<?php
include('connect.php');
if (isset($_POST['email']) && isset($_POST['heslo']))
{
    $email = $_POST['email'];
    $heslo = $_POST['heslo'];
    $query = "SELECT * FROM `dodavatelia` WHERE email='$email' AND heslo='$heslo'";
    $result = $conn->query($query);
    if ($result->num_rows == 1)
    {
        $row = $result->fetch_assoc();
        $username = $row['meno'];
        $surname = $row['priezvisko'];
        echo "Username: $username<br>";
        echo "Surname: $surname<br>";
    }
    else 
    {
        echo 'no data';
    }
}
else 
{
    echo 'no input'; 
}
?>