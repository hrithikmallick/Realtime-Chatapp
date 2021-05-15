<?php
$msg = $_POST['name'];
$room = $_POST['room'];
// $room = "BABAHRITHIK";

include "function.php";

addsms(encriptval($msg), $room);
