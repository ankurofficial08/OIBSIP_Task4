<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="regg.css">
</head>
<body>

<div class="title">
               <span> REGISTRATION FORM </span>
            </div> 

    <div class="container">
        
       <?php
        if(isset($_POST["submit"]))
        {
            $fullname = $_POST["fullname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $rpassword = $_POST["rpassword"];

            $passwordhash = password_hash($password , PASSWORD_DEFAULT);

            $errors = array();

            if(empty($fullname) OR empty($email) OR empty($password) OR empty($rpassword)){
                array_push($errors , "All fields are required");
            }

            if(!filter_var($email , FILTER_VALIDATE_EMAIL)){
                array_push($errors , "Email is not valid");
            }

            if(strlen($password) <8){
                array_push($errors , "Password must be atleast 8 character long");
            }

            if($password !== $rpassword){
                array_push($errors , "Passsword does not match");
            }

            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email='$email'";
            $result = mysqli_query($conn,$sql);
            $rowResult = mysqli_num_rows($result);

            if($rowResult > 0){
                array_push($errors , "Email already exists!");
            }

            if(count($errors) > 0){
                foreach($errors as $error){
                    echo "<div class='alert alert-danger'> $error</div>";
                }
            }else{
                
                $sql = "INSERT INTO users (full_name , email , password ) VALUES (? ,? ,? )";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt , $sql);

                if($prepareStmt){
                    mysqli_stmt_bind_param($stmt, "sss" ,$fullname , $email , $passwordhash);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'> Registerd Succesfully </div>";
                    
                }
                else{
                    die("Someething went wrong"); 
                }
                // we will insert the data into database
            }
        }   
        ?>  

        
        
                    
        <form action="regg.php" method="post">
            
            <div class="form-group">
                <input type="text" class="form-control" name="fullname" placeholder="Full Name">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="rpassword" placeholder="Repeat Password">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" name="submit" value="Register" onclick="openPopup()">
            </div>

    </form>

    <div class="form-btn1">
            <form action="loginn.php" method="post">
                <input type="submit" class="btn btn-primary" name="submit" value="Already Registerd? Login Here!">
            </form>
            </div>       
    </div>

<script>

let popup = document.getElementById("popup");

function openPopup(){
    popup.classList.add("open-popup");
}

function closePopup(){
    popup.classList.remove("open-popup");
}

</script>   
</body>
</html>