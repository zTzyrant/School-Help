<?php 

    include "../../connector/connector.php";

    session_start();
    if(isset($_SESSION['loginas']) === "admin"){
        header("location: ../../admin");
        exit();
    }

    $date = date("Y-m-d");
    $desc = $_POST['desc'];
    $datetutor = $_POST['datetutor'];
    $timetutor = $_POST['timetutor'];
    $studentlevel = $_POST['studentlevel'];
    $nos = $_POST['nos'];
    $schoolid = $_SESSION['schoolidkey'];

    $sql = "INSERT INTO `request` (`schoolidkey`, `requestid`, `requestdate`, `requeststatus`, `description`)
     VALUES ('$schoolid', '', '$date', 'NEW', '$desc')";

    if ($conn->query($sql) === TRUE) {
        $idlast = $conn->insert_id;

        $sql2 = "INSERT INTO `tutorialrequest` (`idreqkey`, `proposeddate`, `proposetime`, `studentlevel`, `numstudent`) 
        VALUES ('$idlast', '$datetutor', '$timetutor', '$studentlevel', '$nos');";
        if ($conn->query($sql2) === TRUE) {
            echo 1;
        } else {
            echo 0;
        }
    } else {
        echo 0;
    }


    $conn->close();
?>