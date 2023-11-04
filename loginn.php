<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="loginn.css">
</head>
<body>

<div class="title">
               <span> LOGIN </span>
            </div>  

    <div class="container">
        <?php
        if(isset($_POST["login"])){
            $email = $_POST["email"];
            $password = $_POST["password"];
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn , $sql);
            $user = mysqli_fetch_array($result , MYSQLI_ASSOC);

            if($user)
            {
                if(password_verify($password , $user["password"])){
                    header("Location: welcome.html");
                    die();
                }
                else
                {
                    echo "<div class='alert alert-danger'> Password does not match </div>";
                }
            }
            else
            {
                echo "<div class='alert alert-danger'> Email Does not match </div>";
            }
        }
        ?>
        <form action="loginn.php" method="post">
            <div class="form-group">
                <input type="email" placeholder="Username" name="email" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Password" name="password" class="form-control">
            </div>
            <div class="form-btn">
                <input type="submit" value="Login"  name="login" class="btn btn-primary">
            </div>
        </form>

        <div class="form-btn1">
            <form action="regg.php" method="post">
                <input type="submit" class="btn btn-primary" name="submit" value="SignUp Here!">
            </form>
            </div>
    </div>

</body>
</html>