<?php 

    include "../../connector/connector.php";

    session_start();
    if(isset($_SESSION['loginas']) === "admin"){
        header("location: ../../admin");
        exit();
    }
    
    if(isset($_POST['offeridtoconfirm'])){
        $offerid = $_POST['offeridtoconfirm'];
        $query = ("UPDATE offer SET offerstatus = 'ACCEPTED' WHERE offersid = $offerid;"); // update user
        if ($conn->query($query) === TRUE) {
            echo 1;
        } else {
            echo -1;
        }
    } else {
        echo 0;
    }
  
    $conn->close();

?>