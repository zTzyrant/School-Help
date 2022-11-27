<?php 

    include "../../connector/connector.php";

    session_start();
    if(isset($_SESSION['loginas']) === "admin"){
        header("location: ../../admin");
        exit();
    }
    
    if(isset($_POST['requestoclose'])){
        $requestid = $_POST['requestoclose'];
        $query = ("UPDATE request SET requeststatus = 'CLOSED' WHERE requestid = $requestid;"); // update user
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