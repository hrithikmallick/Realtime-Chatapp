<?php
ob_start();
$roomname = $_GET['roomname'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Title</title>
    <style>
        .chat {
            height: 70vh;
            overflow-y: scroll;
            background: url("chatback.png");

        }
    </style>
    <script>
        // var name = prompt("enter your name");
    </script>
</head>

<body>
    <?php include "header.php"; ?>

    <?php include("function.php");
    $temp1 = roomexist($roomname);
    if ($temp1 == 1) {
    ?>
        <div class="container mb-5 mt-2">
            <h1 class="text-center display-6 fw-light">Your personal Chat Room:- <b><?php echo $roomname; ?></b></h1>
            <p class="lead text-center"><b>Share this link with others to Chat:-</b> <span id="urlo"></span></p>

        </div>

        <div class="container  chat" id="chat">


        </div>
        <div class="container mt-2  ">
            <textarea rows="3" type="text" placeholder="type your text here...." class="form-control" name="adsms" id="in" id="exampleInputEmail1" aria-describedby="emailHelp"></textarea>

        </div>
        <div class="container mt-2 mb-3 d-grid">
            <button type="submit" name="btnsend" id="sub" class="btn btn-primary ">Send</button>

        </div>
        <form method="post" class="container  mt-2">
            <button type="submit" class="mb-5 btn btn-danger" name="leave">Leave room</button>
        </form>
        <?php
        if (isset($_POST['leave'])) {
            deleteroom($roomname);
            header("location:index.php");
        }
        ?>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <!--script for url-->
        <script>
            document.getElementById("urlo").innerHTML =
                window.location.href;
        </script>
        <!-- for inset chats -->
        <script>
            const myfunction = () => {
                $.post("resms.php", {
                        room: '<?php echo $roomname; ?>'
                    },
                    function(data, status) {
                        let chat = document.getElementById('chat');
                        chat.innerHTML = data;
                    });

            }
            setInterval(myfunction, 1000);
        </script>
        <!-- sending chat to the server -->
        <script>
            $("#sub").click(function() {
                var val = $("#in").val();
                $.post("msg.php", {
                        name: val,
                        room: '<?php echo $roomname; ?>'
                    },
                    function(data, status) {
                        $("#in").val("");
                    });


            });

            //for clicking by enter key
            var input = document.getElementById("in");
            input.addEventListener("keyup", function(event) {
                if (event.keyCode === 13) {
                    var val = $("#in").val();
                    $.post("msg.php", {
                            name: val,
                            room: '<?php echo $roomname; ?>'
                        },
                        function(data, status) {
                            $("#in").val("");
                        });

                }
            });
        </script>
    <?php } else {
        echo '  <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Your room does not Exist</h1>
                       
            </div>
        </div>
    </section>';
    } ?>

</html>