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
    
    $dob = $_POST['dob'];
    $occupation = $_POST['occupation'];


    $query = ("UPDATE user SET user.password = '$password', fullname = '$fullname', email = '$email', phone = '$phone' WHERE id = '$userid';"); // update user
    $result = mysqli_query($conn, $query);
    
    if ($result === TRUE) {

        $_SESSION['password'] = $password;
        $_SESSION['fullname'] = $fullname;
        $_SESSION['email'] = $email;
        $_SESSION['phone'] = $phone;

        $query2 = ("UPDATE volunteer SET dateofbirth = '$dob', occupation = '$occupation' WHERE idkey = '$userid';"); // update user
        $result2 = mysqli_query($conn, $query2);
        if ($result === TRUE) {
            $_SESSION['dateofbirth'] = $dob;
            $_SESSION['occupation'] = $occupation;
            echo 1;
        } else {
            echo -1;
        }
    } else {
        echo 0;
    }
    
    
?>