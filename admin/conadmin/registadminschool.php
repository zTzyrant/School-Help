<?php 
    include "../../connector/connector.php";

    session_start();
    if(isset($_SESSION['loginas']) === "admin"){
        header("location: ../../admin");
        exit();
    }

    $successg = TRUE;

    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $pos = $_POST['pos'];
    $staffid = $_POST['staffid'];

    $schoolid = $_POST['school'];


    $sql = "INSERT INTO user (id, username, password, fullname, email, phone)
    VALUES ('', '$username', '$password', '$fullname', '$email', '$phone')";
    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;

        $pushadmn = "INSERT INTO schooladmin (idkey, staffid, position, schoolidkey) 

        VALUES ('$last_id', '$staffid', '$pos', '$schoolid')";

        if ($conn->query($pushadmn) === TRUE) {
            $successg = TRUE;
        }  else {
            $successg = FALSE;
        }

    } else {
        $successg = FALSE;
    }

    if($successg == TRUE){
        echo 1;
    } else {
        echo 'Something error';
    }



?>