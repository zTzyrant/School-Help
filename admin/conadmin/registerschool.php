<?php 

    include "../../connector/connector.php";

    session_start();
    if(isset($_SESSION['loginas']) === "admin"){
        header("location: ../../admin");
        exit();
    }

    $schoolname = $_POST['schoolname'];
    $address = $_POST['address'];
    $city = $_POST['city'];



    $sql = "INSERT INTO school (schoolid, schoolname, address, city)
    VALUES ('', '$schoolname', '$address', '$city')";

    if ($conn->query($sql) === TRUE) {
        $idlast = $conn->insert_id;
        echo $idlast;
    } else {
        echo -1;
    }
  
    $conn->close();

?>