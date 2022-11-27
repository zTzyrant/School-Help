<?php 
session_start();
include "../connector/connector.php";

$requestID = $_GET['viewid'];
if(isset($_GET['offers']) != NULL){
    $offers = $_GET['offers'];
}

if(($_SESSION["username"]) === NULL){
    header("location: ../login");
    exit();
} else{
    if($_SESSION['loginas'] != 'volunteer'){
        header("location: ../login");
        exit();
    }
}


    $query = "SELECT * FROM `school` INNER JOIN request ON schoolid =
              schoolidkey LEFT JOIN tutorialrequest ON request.requestid = 
              tutorialrequest.idreqkey LEFT JOIN resourcerequest ON request.requestid = 
              resourcerequest.idreqkey WHERE request.requestid = "."$requestID";

    $result = mysqli_query($conn, $query);
    if ($result -> num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row["requeststatus"] == "NEW"){
                $schoolname = $row["schoolname"];
                $city = $row["schoolname"];
                $requestdate = $row["requestdate"];
                $requeststatus = $row["requeststatus"];
                $description = $row["description"];

                $proposeddate = $row["proposeddate"];
                $proposetime = $row["proposetime"];
                $studentlevel = $row["studentlevel"];
                $numstudent = $row["numstudent"];

                $resourcetype = $row["resourcetype"];
                $numrequired = $row["numrequired"];
            }  
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Favicons -->
    <link href="../assets/img/logois.png" rel="icon">
    <link href="../assets/img/apple-touch-iconis" rel="apple-touch-icon">

    <link rel="stylesheet" href="../assets/css/admindashboard.css">
    <!-- Bootsrapt -->
    <link rel="stylesheet" href="../assets/css/bootstrap52.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-icons.css">
    <!-- end Bootsrapt -->

    <!-- datatables -->
    <link rel="stylesheet" href="../assets/css/datatables/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../assets/css/datatables/datatables.css">
    <!-- end datatables -->

   <!-- sweet alert -->
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <!-- Side bar -->
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <!-- Need Logo -->
                            <a href="../volunteer"><img src="assets/images/logo/logo.svg" alt="Logo" srcset=""></a> 
                        </div>
                        <!-- toggle sidebar -->
                        <div class="sidebar-toggler x pointeri"> 
                            <a onclick="offsidebar()" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu mb-auto">
                        <li class="sidebar-title">Menu</li>
                        <li class="sidebar-item ">
                            <a href="../volunteer" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item active ">
                            <a href="admin" class='sidebar-link disabled'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Details Request</span>
                            </a>
                        </li>
                        <li class="sidebar-item ">
                            <a onclick="signoutvolun()" href="#" class='sidebar-link'>
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </div>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <!-- Side bar -->
    

    <div id="main">
    
        <header class="mb-3 pointeri">
            <a onclick="onsidebar()" class="burger-btn d-block d-xl-none">
                <i class="bi bi-list"></i>
            </a>
        </header>


        <div class="page-heading">
            <h3>Dashboard <?php echo $_SESSION['fullname'] ?></h3>
        </div>

        <!-- cONTENT -->
        <div class="page-content">
            <section class="row">
                <div class="col-12 col-lg-9">
                    <!-- Container Center -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form class="form" onsubmit="return false" method="POST">
                                        <h4>Details Requests ID: <?php echo $requestID; ?></h4>

                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Request ID</label>
                                                    <input type="text"class="form-control" value="<?php echo $requestID; ?>" disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label">School Name</label>
                                                    <input type="text" class="form-control" value="<?php echo $schoolname; ?>" disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label">City</label>
                                                    <input type="text"class="form-control" value="<?php echo $city; ?>" disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Request Date</label>
                                                    <input type="text"class="form-control" value="<?php echo $requestdate; ?>" disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Request Status</label>
                                                    <input type="text"class="form-control" value="<?php echo $requeststatus; ?>" disabled>
                                                </div>
                                            </div>
                                            
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Description</label>
                                                    <textarea type="text"class="form-control" rows="4" cols="50" disabled><?php echo $description; ?></textarea>
                                                </div>
                                            </div>

                                        </div>

                                    </form>

                                    <?php if($proposeddate != null) {?>
                                    <form class="form" onsubmit="return false" method="POST">
                                        <h4 class="card-title">Tutorial Request</h4>
                                        
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Tutorial Date</label>
                                                    <input type="text"class="form-control" value="<?php echo $proposeddate; ?>" disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Tutorial Time</label>
                                                    <input type="text"class="form-control" value="<?php echo $proposetime; ?>" disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Student Level</label>
                                                    <input type="text" class="form-control" value="<?php echo $studentlevel; ?>" disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Number of Students</label>
                                                    <input type="text"class="form-control" value="<?php echo $numstudent; ?>" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    
                                    <?php } if($resourcetype != null) {?>

                                    <form class="form" onsubmit="return false" method="POST">
                                        <h4 class="card-title">Resource Request</h4>
                                        
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Resource Type</label>
                                                    <input type="text"class="form-control" value="<?php echo $resourcetype; ?>" disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Number Required</label>
                                                    <input type="text" class="form-control" value="<?php echo $numrequired; ?>" disabled>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                    <?php } ?>
                                    <div class="row">
                                            <div class="col-12 d-flex justify-content-end">
                                                <button class="btn btn-light-secondary me-1 mb-1" onclick="window.location.href='../volunteer'">Back</button>
                                                <button type="submit" class="btn btn-primary me-1 mb-1" onclick="window.location.href='requestdetails?viewid=<?php echo $requestID ?>&offers=true';">Submit Offers</button>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Container Center -->

                </div>
                <!-- right profile -->
                <div class="col-12 col-lg-3">
                    <div class="card">
                        <div class="card-header">
                            <h4>User Profile</h4>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl">
                                    <img src="../assets/img/img_avatar.png" alt="face">
                                </div>
                                <div class="ms-3 name">
                                    <h5 class="font-bold"><?php echo $_SESSION['fullname'] ?></h5>
                                    <h6 class="text-muted mb-0"><?php echo $_SESSION['username'] ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="font-bold"><?php echo $_SESSION['occupation'] ?></h5>
                            <h6 class="text-muted mb-0"><?php echo $_SESSION['email'] ?></h6>
                            <h6 class="text-muted mb-0"><?php echo $_SESSION['dateofbirth'] ?></h6>
                            <h6 class="text-muted mb-0"><?php echo $_SESSION['phone'] ?></h6>
                        </div>
                        <div class="card-footer">
                            <button type="button" onclick="location='editprofile'" class="btn btn-outline-success">
                                <i class="bi bi-person-fill cstm"></i>
                                <span>Edit Profile</span>
                            </button>
                        </div>
                    </div>

                </div>
                <!-- right profile -->
            </section>
        </div>
        <!-- content -->    
    
    </div>
                    
    <?php if(isset($_GET['offers']) != NULL) { ?>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Submit Offers for Request ID <?php echo $requestID; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label class="form-label" for="datenow">Offers Date</label>
                <input type="date" id="datenow" name="datenow" class="form-control" value="<?php echo date('Y-m-d'); ?>" disabled>
                <br>
                <label class="form-label" for="remarks">Remarks</label>
                <input type="text" id="remarks" name="remarks" class="form-control" placeholder="Please Input Your Remarks">
                <input type="text" name="reqid"value="<?php echo $requestID ?>" hidden disabled>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitoffers()">Submit Offers</button>
            </div>
            </div>
        </div>
        </div>
    <?php } ?>
    
    <script src="../assets/js/bootstrap.js"></script>
    <script src="../assets/js/dashboard.js"></script>

    <script src="../assets/js/signoutadm.js"></script>
    
    <script src="../assets/js/jquery-3.6.1.js" type="text/javascript"></script>
    <script src="../assets/js/datatables.min.js"></script>
    <script src="../assets/js/datatables.js"></script>
    <script>
        if(document.getElementById("exampleModal")){
            var myModal = new bootstrap.Modal(document.getElementById("exampleModal"));
            myModal.show();
        }
        
        function submitoffers(){
            let offersremarks = $('input[name="remarks"]').val().trim();
            let datenow = $('input[name="datenow"]').val().trim();
            let reqid = $('input[name="reqid"]').val().trim();

            if(offersremarks == ""){
                Swal.fire(
                    'Error!',
                    'Please Input Remarks!',
                    'error'
                )
            } else {
                Swal.fire({
                    icon: 'question',
                    title: 'Submit now?',
                    text: 'Are you sure want to submit offers now?',
                    showDenyButton: true,
                    confirmButtonText: 'Yes',
                    denyButtonText: `No`,
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url:'convolunteer/submitoffers.php',
                            type:'post',
                            data:{reqid:reqid, remarks:offersremarks, dateoffers:datenow, status:"pending"},
                            success:function(response){
                                if(response == 1){
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Good Job!',
                                        text: 'Your offers has been recorded!',
                                        confirmButtonText: 'Back To View Request'
                                    }).then((result) => {
                                        if(result.isConfirmed){
                                            window.location = "../volunteer";
                                        }
                                    })

                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'Something Error Please Contact IT Administrator!',
                                        'error'
                                    )

                                    offersremarks.val = "";

                                }
                            }
                        });
                    }
                })
            }

            
        }

    </script>
</body>
</html>