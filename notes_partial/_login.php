<?php

$login = false;
$showError = false;
$showAlert = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    include '_db_connect.php';
    $email = $_POST["email"];
    $password = $_POST["password"];
    $branchcode = $_POST["branchcode"];
   

    // $sql = "select * from user where username='$username' AND password='$password'"; 
    $sql = "SELECT * FROM `signuptec` WHERE tec_email ='$email'";
    $branchSQL = "SELECT * FROM `branch` Where branch_no ='$branchcode' ";
    $result1 = mysqli_query($conn, $sql);
    
    $numExistRow1 = mysqli_num_rows($result1);
    
    $fetch1 =mysqli_fetch_assoc($result1);
    if (($numExistRow1 == 1 && $branchcode == $fetch1['tec_code']) && ($fetch1['tec_password']=$password) ) {

        $login=true;
                        
        session_start();
        $_SESSION['loggedin']=true;
        $_SESSION['username']=$username;
        $_SESSION['branchcode']=$branchcode;
        header("location:_welcome.php");

    }
    else {
        $showerror = "Invalid credentials";
        $showError =true;
    }
}

?>



<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Login</title>
</head>

<body>
    <?php include '_nav.php' ?>
    <?php include '_slider.php' ?>
    <?php

    if ($showAlert) {
        echo '<div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Well done!</h4>
        <p>You successfully Login !!!.</p>
        <hr>
        
      </div>';
    }

    if ($showError) {
        echo '<div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Try again!</h4>
        <p>you need to try again !!!.</p>
        <hr>
        <p class="mb-0">'.$showerror.'</p>
      </div>';
    }

    ?>

    <div class="container my-5">

        <h2 class="text-center">Login To our website</h2>

        <form action="_login.php" method="post">
        <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>

            <div class="mb-3">
                <label for="BranchCode" class="form-label">Enter your branch code</label>
                <input type="text" class="form-control" id="BranchCode" name="branchcode">
            </div>


            <button type="submit" class="btn btn-primary">Login</button>
        </form>

    </div>





    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>