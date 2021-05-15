<?php
function dbConnect()
{
    $servername = "localhost";
    $username = "root";
    $pass = "";
    $dbname = "chatroom";

    $conn = mysqli_connect($servername, $username, $pass, $dbname);

    return $conn;
}
function addroom($roomname)
{
    $conn = dbConnect();
    if ($conn) {
        // $sql = "insert into forum (forum_name,forum_desc,forum_describe,imgaddress) values('$forumname', '$forumsmalldesc','$forumdesc','$imgaddress')";
        $sql = "insert into room (roomname) values('$roomname')";
        if (mysqli_query($conn, $sql)) {
            $response = 1;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            $response = 0;
        }
    }
}
function addsms($msg, $roomname)
{
    $conn = dbConnect();
    if ($conn) {
        // $sql = "insert into forum (forum_name,forum_desc,forum_describe,imgaddress) values('$forumname', '$forumsmalldesc','$forumdesc','$imgaddress')";
        $sql = "insert into msgs (msg,roomname) values('$msg','$roomname')";
        if (mysqli_query($conn, $sql)) {
            $response = 1;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            $response = 0;
        }
    }
}
function outsms($roomname)
{
    $conn = dbConnect();
    if ($conn) {

        $sql = "SELECT * FROM `msgs` WHERE roomname='$roomname'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<p>sms ' . $row['msg'] . ' time is :-' . $row['timestamp'] . '</p>';
        }
    }
}
//for encription 


function encriptval($simple_string)
{

    // Store a string into the variable which
    // need to be Encrypted


    // Display the original string
    // echo "Original String: " . $simple_string;

    // Store the cipher method
    $ciphering = "AES-128-CTR";

    // Use OpenSSl Encryption method
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;

    // Non-NULL Initialization Vector for encryption
    $encryption_iv = '1234567891011121';

    // Store the encryption key
    $encryption_key = "chat";

    // Use openssl_encrypt() function to encrypt the data
    $encryption = openssl_encrypt(
        $simple_string,
        $ciphering,
        $encryption_key,
        $options,
        $encryption_iv
    );

    // Display the encrypted string
    // echo "Encrypted String: " . $encryption . "\n";
    return $encryption;
}
function decriptval($encryption)
{

    // Non-NULL Initialization Vector for decryption
    $decryption_iv = '1234567891011121';

    // Store the decryption key
    $decryption_key = "chat";
    $ciphering = "AES-128-CTR";
    $options = 0;

    // Use openssl_decrypt() function to decrypt the data
    $decryption = openssl_decrypt(
        $encryption,
        $ciphering,
        $decryption_key,
        $options,
        $decryption_iv
    );

    // Display the decrypted string
    // echo "Decrypted String: " . $decryption;
    return $decryption;
}

//delete from database
function deleteroom($roomname)
{
    $conn = dbConnect();
    if ($conn) {

        // sql to delete a record
        $sql = "DELETE FROM room WHERE roomname='$roomname'";
        $sql1 = "DELETE FROM msgs WHERE roomname='$roomname'";
        if (mysqli_query($conn, $sql)) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
        if (mysqli_query($conn, $sql1)) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    }
}
function roomexist($roomname)
{
    $conn = dbConnect();
    if ($conn) {
        //echo "Connection Successfully";
        $sql = "select *from room where roomname='$roomname'  ";
        $result = mysqli_query($conn, $sql);
        $records = mysqli_num_rows($result);
        // echo $records;
        return $records;
    } else {
        //echo "Connection Failed";
        $response = 0;
    }
    return $response;
}
function totalRoom()
{
    $conn = dbConnect();
    if ($conn) {
        $sql = "select *from room";
        $temp = 0;
        $result = mysqli_query($conn, $sql);
        $temp = mysqli_num_rows($result);

        return $temp;
    }
}
