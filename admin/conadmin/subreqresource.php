<?php 

    include "../../connector/connector.php";

    session_start();
    if(isset($_SESSION['loginas']) === "admin"){
        header("location: ../../admin");
        exit();
    }

    $date = date("Y-m-d");
    $desc = $_POST['desc'];


    $schoolid = $_SESSION['schoolidkey'];

    $resourcetype = $_POST['resourcetype'];
    $numrequired = $_POST['numrequired'];

    $sql = "INSERT INTO `request` (`schoolidkey`, `requestid`, `requestdate`, `requeststatus`, `description`)
     VALUES ('$schoolid', '', '$date', 'NEW', '$desc')";

    if ($conn->query($sql) === TRUE) {
        $idlast = $conn->insert_id;
        $sql3 = "INSERT INTO `resourcerequest` (`idreqkey`, `resourcetype`, `numrequired`) 
        VALUES ('$idlast', '$resourcetype', '$numrequired ')";
        
        if ($conn->query($sql3) === TRUE) {
            echo 1;
        } else {
            echo 0;
        }
        
    } else {
        echo 0;
    }


    $conn->close();
?>