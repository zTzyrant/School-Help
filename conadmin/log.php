<?php 
    include "../../connector/connector.php";

    session_start();
    if(isset($_SESSION['loginas']) === "admin"){
        header("location: ../../admin");
        exit();
    }

    if(isset($_POST['username']) != NULL){
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $query = ("SELECT * from user where username='$username' and password='$password'"); // get user
        $result = mysqli_query($conn, $query);

        if ($result -> num_rows > 0) { // it's for check num of rows
            while($row = $result->fetch_assoc()) {
                $_SESSION['idkey'] = $row["id"];
                $_SESSION['fullname'] = $row["fullname"];
                $_SESSION['email'] = $row["email"];
                $_SESSION['phone'] = $row["phone"];
            }
            $_SESSION['password'] = $_POST['password'];
            $_SESSION['username'] = $username;
            $_SESSION['status'] = 'login';
            $_SESSION['loginas'] = 'admin';

            $query2 = ("SELECT * from schooladmin where idkey='". $_SESSION['idkey'] . "'"); // get detail admin user
            $result2 = $conn->query($query2);
            while($row = $result2->fetch_assoc()) {
                $_SESSION['staffid'] = $row["staffid"];
                $_SESSION['position'] = $row["position"];
                $_SESSION['schoolidkey'] = $row["schoolidkey"];
            }

            echo 1;
        } else if ($result -> num_rows <= 0){
            echo 0;
        }
    }
    
?>