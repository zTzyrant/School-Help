<?php
session_start();
include "../../connector/connector.php";

$reqid = $_POST['reqid'];
$dateoffers = $_POST['dateoffers'];
$remarks = $_POST['remarks'];
$status = $_POST['status'];
$iduser = $_SESSION['idkey'];


$sql = "INSERT INTO offer (offersid, idreqkey, idkey, offerdate, remarks, offerstatus)
        VALUES ('', '$reqid', '$iduser', '$dateoffers', '$remarks', '$status')";

if ($conn->query($sql) === TRUE) {
    echo 1;
} else {
    echo 0;
}

$conn->close();

?>