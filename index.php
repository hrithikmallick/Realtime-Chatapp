<?php
include "header.php";
include "function.php";
ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Title</title>
    <style>
        .rightchap {
            margin-left: 5vh;
            margin-right: 5vh;
        }
    </style>
</head>

<body>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">This is an anonymous chat appllication </h1>
                <p class="lead text-muted ">Anonymous chat will allow you to chat with anyone, truly the anonymous way. You don't have to make a new user ID or register with an email ID. Just create room and share your link , and begin chatting right away. All messages will deleted after roomclosed. </p>
                <p>
                    <a href="https://github.com/hrithikmallick" class="btn btn-primary my-2">Github <i class="fab fa-github"></i></a>&nbsp;
                    <a href="https://www.linkedin.com/in/hrithik-mallick-30599620a" class="btn btn-secondary my-2">Linkedin <i class="fab fa-linkedin"></i></a>
                </p>
            </div>
        </div>
    </section>

    <div class="col-lg-6 col-md-8 mx-auto my-5 container">
        <h1 class="fw-light">Let's create Your CHAT room</h1>
        <p class="lead text-muted">This is a chat apllication made by Hrithik Mallick</p>
        <p style="float:right" class="lead text-muted"> <?php echo totalRoom(); ?> <?php echo (totalRoom() > 1) ? ('Rooms') : ('Room'); ?> Running</p>
        <form method="post" class="mb-3 ">
            <label for="exampleInputEmail1" class="form-label"></label>
            <input type="name" class="form-control " name="inroom" id="exampleInputEmail1" placeholder="example:- room" aria-describedby="emailHelp">
            <div class="d-grid gap-2">
                <button type="submit" name="btnroom" class="btn btn-primary rightchap mt-2">Enter</button>
            </div>


        </form>
    </div>
    <?php
    if (isset($_POST['btnroom'])) {
        $roomname = $_POST['inroom'];
        if (strlen($roomname) >= 4) {

            $conn = dbConnect();
            $sql = "SELECT * FROM `room` WHERE roomname='$roomname'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                if (mysqli_num_rows($result)) {
                    echo '<script>alert("please choose another name");</script>';
                } else {
                    $res = addroom($roomname);
                    header("location:room.php?roomname=$roomname");
                }
            }
        } else {
            echo '<script>alert("Please choose another name that containe 4 letters atleast");</script>';
        }
    }
    ?>
    <script>

    </script>
</body>

</html>