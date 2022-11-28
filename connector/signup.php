<?php 
include 'connector.php';
$successg = TRUE;
$MSGF = NULL;

$username = $_POST['username'];
$password = md5($_POST['password']);
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$occupation = $_POST['occupation'];
$date = $_POST['dob'];
$newDate = date("Y-m-d", strtotime($date));
if($username == NULL){
    header("Location: ../login");
    exit();
} else {
    $sql = "INSERT INTO user (id, username, password, fullname, email, phone)
    VALUES ('', '$username', '$password', '$fullname', '$email', '$phone')";

    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        $grabvolunteer = "INSERT INTO volunteer (idkey, dateofbirth, occupation) 
        VALUES ('$last_id', '$newDate', '$occupation')";
        if ($conn->query($grabvolunteer) != TRUE) {
            $successg = FALSE;
        }
    } else {
        $successg = FALSE;
    }

    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../assets/css/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="../assets/js/customlog.js"></script>
</head>
<body>
    <?php if($successg == TRUE) {?>
    <div class="main">  	
        <div class="content">
            <i class="fa fa-check-circle-o" style="font-size:150px;color:white;"></i>
            <h1>Success Sign Up as <?php echo $username ?></h1>
            <button class="buttonbc" onclick="location.href='../login'">Back To Sign Up Page</button>
        </div>
	</div>
    <script>
        Swal.fire(
            'Good job!',
            'Success Sign Up as <?php echo $username ?>',
            'success'
        )
    </script>
    <?php } else {?>
        <div class="main">  	
            <div class="content">
                <i class="material-icons" style="font-size:150px;color:#F96666;">&#xe888;</i>
                <h1>Failed Sign Up as <?php echo $username ?></h1>
                <button class="buttonbc" onclick="location.href='../login'">Back To Sign Up Page</button>
            </div>
        </div>
        <script>
            Swal.fire(
                'Oops...',
                'Failed Sign Up as <?php echo $username ?>',
                'error'
            )
        </script>
    <?php } ?>
</body>
</html>