<?php 
    include "../../connector/connector.php";

    session_start();
    
    if(isset($_POST['username']) != NULL){
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $query = ("SELECT * from user where username='$username' and password='$password'"); // get user


        $result = mysqli_query($conn, $query);
        
        if ($result -> num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $_SESSION['idkey'] = $row["id"];
                $_SESSION['fullname'] = $row["fullname"];
                $_SESSION['email'] = $row["email"];
                $_SESSION['phone'] = $row["phone"];
        
            }
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $_POST['password'];
            $_SESSION['status'] = 'login';

            

            $_SESSION['loginas'] = 'volunteer';

            $query2 = ("SELECT * from volunteer where idkey='". $_SESSION['idkey'] . "'"); // get detail admin user
            $result2 = $conn->query($query2);
            while($row = $result2->fetch_assoc()) {
                $_SESSION['dateofbirth'] = $row["dateofbirth"];
                $_SESSION['occupation'] = $row["occupation"];
            }

            echo 1;
        } else if ($result -> num_rows <= 0){
            echo 0;
        }
    }
    
?>