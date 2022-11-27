<?php 
    include "../../connector/connector.php";

    session_start();
    if(isset($_SESSION['loginas']) === "admin"){
        header("location: ../../admin");
        exit();
    }

    $userid = $_SESSION['idkey'];
    $password = md5($_POST['password']);
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    
    $staffid = $_POST['staffID'];
    $position = $_POST['position'];


    $query = ("UPDATE user SET user.password = '$password', fullname = '$fullname',
             email = '$email', phone = '$phone' WHERE id = '$userid';"); // update user
    $result = mysqli_query($conn, $query);
    
    if ($result === TRUE) {

        $_SESSION['password'] = $_POST['password'];
        $_SESSION['fullname'] = $fullname;
        $_SESSION['email'] = $email;
        $_SESSION['phone'] = $phone;

        $query2 = ("UPDATE schooladmin SET staffid = '$staffid', 
                  position = '$position' WHERE idkey = '$userid';"); // update user
        $result2 = mysqli_query($conn, $query2);
        if ($result === TRUE) {
            $_SESSION['staffid'] = $staffid;
            $_SESSION['position'] = $position;
            echo 1;
        } else {
            echo -1;
        }
    } else {
        echo 0;
    }
    
    
?>