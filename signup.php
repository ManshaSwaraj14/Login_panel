<?php 
session_start();
if(isset($_SESSION['name'])) {
    header("Location: welcome.php");

}
?>
<?php 
if(isset($_POST['submit'])) {
    include "connection.php";
    $username =mysqli_real_escape_string($conn, $_POST['user']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($_POST['pass']);
    $cpassword =mysqli_real_escape_string($_POST['cpass']);

    $sql = "select 8 from login_page where username = '$username'";
    $result =mysqli_query($conn, $sql);
    $count_user = mysqli_num_rows($result);

    $sql = "select 8 from login_page where email = '$email'";
    $result =mysqli_query($conn, $sql);
    $count_email = mysqli_num_rows($result);

   if($count_user==0 || $count_email==0) {
    if($password==$cpassword) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql ="insert into entry_page(username, email, password) values('$username', '$email', '$hash')";
        $result=mysqli_query($conn, $sql);

    }
    else {
       echo '<script> 
       alert("Password do not match!!!");
        window.location.href="signup.php";
        </script>';
    }

   }
   else {
    echo '<script>
    alert("user already exists!!!");
    window.location.href ="index.php";
    </script>';
   }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <?php
    include "navbar.php";
  ?>
    <div id="form">
    <h1>Signup Form</h1>
    <form name="form" action="signup.php" method="POST">
    <label for="">Enter Username</label>
    <input type="text" id="user" name="user" required><br><br>
    <label for="">Enter Email</label>
    <input type="email" id="email" name="email" required><br><br>
    <label for="">Enter Password</label>
    <input type="password" id="pass" name="pass" required><br><br>
    <label for="">Retype Password</label>
    <input type="password" id="cpass" name="cpass" required><br><br>
    <input type="submit" id="btn" value="Signup" class="login" name="submit">
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>