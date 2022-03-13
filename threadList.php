<?php
include 'partial/db_connect.php';
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>edu-Discuss -codding Forums</title>
</head>

<body>

    <?php include 'partial/_header.php';?>

    <?php 
        $id=$_GET['catid'];
        echo $id ;
        $sql = "SELECT * FROM `catg` WHERE ct_id=$id";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){

            $catname=$row['ct_name'];
            $catdess=$row['ct_dess'];
        }
    ?>


    <!-- category container  -->
    <div class="container">

        <div class="jumbotron">
            <h1 class="display-4">welcome to <?php echo $catname; ?> forums</h1>
            <p class="lead"><?php echo $catdess; ?></p>
            <hr class="my-4">
            <p>This is peer to peer formus shering option here you can connect to each other in peer to peer .</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>

    </div>

    <div class="container">
        <h1>Browse question</h1>

        <?php 
            $id=$_GET['catid'];
           
            $sql = "SELECT * FROM `threads` WHERE thread_cat_id = $id ";
            $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_assoc($result)){

                $id = $row['thread_id'];
                $title = $row['thread_title'];
                $desc = $row['thread_desc'];

               echo ' <div class="media">
                    <img class="mr-3" src="img\icon_h.png" width="30px" alt="Generic placeholder image">
                    <div class="media-body">
                        <h5 class="mt-0"><a href="thread.php?threadid='.$id.'">'.$title.'</a></h5>
                        '.$desc.'
                    </div>
                </div>';
            
            }
        ?>

    </div>

    <?php include 'partial/_footer.php';?>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>
</html>