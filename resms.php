<?php
$room = $_REQUEST['room'];
include "function.php";

$sql = "SELECT *FROM msgs where roomname ='$room'";
$conn = dbConnect();
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    echo '<P style="font-size: 25px;">Annomas::-  <span class="  text-white">' . decriptval($row['msg'])  . '</span> <span class="lead" style="font-size:15px; float:right; ">' . substr($row['timestamp'], 0, 16)  . '</span></p>';
}
