<?php
$showAlert =false;
$showError =false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '_db_connect.php';
    $email = $_POST["email"];
    $password = $_POST["password"];
    $branchcode = $_POST["branchcode"];
    $branch = $_POST["branch"];

    // check whather this username exists 
    $existsSql = "SELECT * FROM `signuptec` WHERE tec_email ='$email'";
    $branchSQL = "SELECT * FROM `branch` Where branch_no ='$branchcode' ";
    $result1 = mysqli_query($conn, $existsSql);
    $result2 = mysqli_query($conn, $branchSQL);
    $numExistRow1 = mysqli_num_rows($result1);
    $numExistRow2 = mysqli_num_rows($result2);
    if ($numExistRow1 > 0) {
        // $exists =true;
        $showError = true;
    } else {
        $exists =false;
        if($numExistRow2 > 0){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `signuptec` (`tec_email`, `tec_password`, `tec_code`, `tec_branch`, `tec_dt`) VALUES ('$email', '$password', '$branchcode', '$branch',current_timestamp());";

            $result = mysqli_query($conn, $sql);
            if ($result) {
                $showAlert = true;
            } else {
                $showError = true;
            }
        }
        else {
            $showError = true;
        }
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


    <title>Edu-chnagge Signup Form -signup and get access of our website</title>
</head>

<body>

    <?php include '_nav.php' ?>
    <?php include '_slider.php' ?>
    <?php

    if ($showAlert) {
        echo '<div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Well done!</h4>
        <p>You successfully SignUp !!!.</p>
        <hr>
        <p class="mb-0">go to login page and try your login process.</p>
      </div>';
    }

    if ($showError) {
        echo '<div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Try again!</h4>
        <p>you need to try again !!!.</p>
        <hr>
        <p class="mb-0">After successfully signUp you can go to login page .</p>
      </div>',$numExistRow1,$numExistRow2;
    }

    ?>

    <div class="container my-5">

        <h2 class="text-center">SignUp To Website</h2>
        <form action="_teacher_signup.php" method="post">
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
            <div class="mb-3">
                <label for="BranchCode" class="form-label">Select your branch code</label>
                <select class="form-select" aria-label="Default select example" name="branch">
                    <option selected>Computer Science</option>
                    <option value="2">Civil</option>
                    <option value="3">Electronic and Communication</option>
                    <option value="4">Electrical Enginearing</option>
                    <option value="4">Mechanical Enginearing</option>
                    <option value="4">Mining Engineering</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
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


    <script>
        var slider = document.getElementById("slider");
        var items = [
            "https://source.unsplash.com/1600x900/?program,education",
            "https://source.unsplash.com/1600x900/?java",
            "https://source.unsplash.com/1600x900/?technology"
        ];
        var i = 0;

        function change() {
            if (i < 3) {
                console.log(i);
                slider.src = items[i];
                i++;
            } else {
                i = 0;
            }
        }
        setTimeout(change, 100)
        setInterval(change, 5000);
    </script>

</body>

</html>