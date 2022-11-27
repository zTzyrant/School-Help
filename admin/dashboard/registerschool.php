<?php 
session_start();

if(($_SESSION["username"]) === NULL){
    header("location: ../login");
    exit();
} else{
    if($_SESSION['loginas'] != 'admin'){
        header("location: ../login");
        exit();
    } else{
        include "../../connector/connector.php";

        $query = ("SELECT * from school where schoolid='". $_SESSION['schoolidkey'] . "'");
        $result = mysqli_query($conn, $query);

        if ($result -> num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $_SESSION['schoolname'] = $row["schoolname"];
                $_SESSION['address'] = $row["address"];
                $_SESSION['city'] = $row["city"];
        
            }
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
    <title>Dashboard <?php echo $_SESSION['username'] ?></title>


    <!-- This line is for dashboard theme -->
    <link rel="stylesheet" href="../../assets/css/admindashboard.css">
    <link rel="stylesheet" href="../../assets/css/admindashboard-dark.css">
    <!-- end of dashboard theme -->

    <!-- Favicons -->
    <link href="../../assets/img/logois.png" rel="icon">
    <link href="../../assets/img/apple-touch-iconis" rel="apple-touch-icon">

    <!-- Bootsrapt -->
    <link rel="stylesheet" href="../../assets/css/bootstrap52.css">
    <link rel="stylesheet" href="../../assets/css/bootstrap-icons.css">
    <!-- end Bootsrapt -->

    <!-- datatables -->
    <link rel="stylesheet" href="../../assets/css/datatables/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../../assets/css/datatables/datatables.css">
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
                            <a href="../"><img src="assets/images/logo/logo.svg" alt="Logo" srcset=""></a> 
                        </div>
                        <!-- Change theme color -->
                        <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21"><g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2" opacity=".3"></path><g transform="translate(-210 -1)"><path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path><circle cx="220.5" cy="11.5" r="4"></circle><path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path></g></g></svg>
                            <div class="form-check form-switch fs-6">
                                <input class="form-check-input  me-0" type="checkbox" id="toggle-dark" onclick="toogledark()">
                                <label class="form-check-label" ></label>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z"></path></svg>
                        </div>
                        <!-- end Change theme color -->

                        <!-- toggle sidebar -->
                        <div class="sidebar-toggler x pointeri"> 
                            <a onclick="offsidebar()" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>
                        <li class="sidebar-item">
                            <a href="../" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        
                        <li class="sidebar-item active">
                            <a href="dashboard/registerschool" class='sidebar-link disabled '>
                            <i class="bi bi-file-plus-fill"></i>
                                <span>Register School</span>
                            </a>
                        </li>

                        <li class="sidebar-item ">
                            <a href="submitreq" class='sidebar-link'>
                                <i class="bi bi-file-earmark-medical-fill"></i>
                                <span>Submit Request</span>
                            </a>
                        </li>

                        <li class="sidebar-item ">
                            <a href="reviewoffers" class='sidebar-link'>
                                <i class="bi bi-journal-check"></i>
                                <span>Review Offers</span>
                            </a>
                        </li>

                        <li class="sidebar-item ">
                            <a onclick="insignoutadm()" href="#" class='sidebar-link'>
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>
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
            <h3>Dashboard <?php echo $_SESSION['position'] ?></h3>
        </div>

        <!-- // Basic multiple Column Form section start -->
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12 col-lg-9">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Select Register For</h4>
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="selectformtype">Register for</label>
                                <select class="form-select" id="selectformtype">
                                    <option value="1">School</option>
                                    <option value="2">School Administrator</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                

                                <!-- Form School & School Administrator  -->
                                <form class="form" id="form1" onsubmit="return false" method="POST">
                                    <h4 class="card-title">Register School</h4>
                                    
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="col-schname" class="form-label">School Name</label>
                                                <input type="text" id="col-schname" class="form-control" placeholder="School Name" name="schoolname" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="col-schaddress" class="form-label">School Address</label>
                                                <input type="text" id="col-schaddress" class="form-control" placeholder="School Address" name="address" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="col-city" class="form-label">City</label>
                                                <input type="text" id="col-city" class="form-control" placeholder="City" name="city" required>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1" id="form1_submit">Submit</button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </form>

                                <!-- School Administrator -->
                                <form class="form" id="form2" style="display: none;" onsubmit="return false" method="POST">
                                    <h4 class="card-title">Register School Administrator</h4>
                                        <div class="form-group">
                                            <label class="form-label">Select School</label>
                                            <div class="input-group mb-3">
                                                <label class="input-group-text" for="inputGroupSelect01">School</label>
                                                <select class="form-select" id="inputGroupSelect01" required>
                                                    <option value="-1" selected hidden>Select Administrator School to Register</option>
                                                    <?php 
                                                        include "../../connector/connector.php";
                                                        $query = ("SELECT * FROM `school`");
                                                        $result = mysqli_query($conn, $query);

                                                        if ($result -> num_rows > 0) {
                                                            while($row = $result->fetch_assoc()) {
                                                                echo '<option value="'.$row["schoolid"].'">'.$row["schoolname"].'</option>';
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                                <select class="form-select" id="idcollection" disabled hidden>
                                                    <?php 
                                                        include "../../connector/connector.php";
                                                        $query = ("SELECT * FROM `schooladmin`");
                                                        $result = mysqli_query($conn, $query);

                                                        if ($result -> num_rows > 0) {
                                                            while($row = $result->fetch_assoc()) {
                                                                echo '<option value="'.$row["staffid"].'">'.$row["staffid"].'</option>';
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </div>


                                        </div>
                                        
                                        
                                    <div class="row">
                                        
                                        <div class="form-group">
                                            <label for="col-staffid" class="form-label">Staff ID</label>
                                            <input id="col-staffid" type="number" class="form-control" placeholder="Staff ID" name="col-staffid" required>
                                        </div>
                                        
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="col-uname" class="form-label">Username</label>
                                                <input id="col-uname" type="text"  class="form-control" placeholder="Username" name="col-uname" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="col-pass" class="form-label">Password</label>
                                                <input type="password" id="col-pass" class="form-control" placeholder="Password" name="col-pass" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="col-fullname" class="form-label">Fullname</label>
                                                <input type="text" id="col-fullname" class="form-control" name="col-fullname" placeholder="Fullname" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="col-email" class="form-label">Email</label>
                                                <input type="text" id="col-email" class="form-control" name="col-email" placeholder="Email@example.com" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="col-phone" class="form-label">Phone</label>
                                                <input type="number" id="col-phone" class="form-control" name="col-phone" placeholder="Phone Number" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="col-pos" class="form-label">Position</label>
                                                <input type="text" id="col-pos" class="form-control" name="col-pos" placeholder="Position" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                    </div> 
                                </form>
                                <!-- Form School & School Administrator  -->

                            </div>
                        </div>
                    </div>
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
                                        <img src="../../assets/img/img_avatar.png" alt="face">
                                    </div>
                                    <div class="ms-3 name">
                                        <h5 class="font-bold"><?php echo $_SESSION['fullname'] ?></h5>
                                        <h6 class="text-muted mb-0"><?php echo $_SESSION['username'] ?></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="font-bold"><?php echo $_SESSION['schoolname'] ?></h5>
                                <h6 class="text-muted mb-0">School ID: <?php echo $_SESSION['schoolidkey'] ?></h6>
                                <h6 class="text-muted mb-0"><?php echo $_SESSION['position'] ?></h6>
                                <h6 class="text-muted mb-0"><?php echo $_SESSION['email'] ?></h6>
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
            </div>
        </section>
        <!-- // Basic multiple Column Form section end -->

        <!-- cONTENT -->
        <div class="page-content">
            <section class="row">
                <div class="col-12 col-lg-9">
                    
                    <!-- Container Center -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>School List</h4>
                                </div>
                                <div class="card-body">
                                    <table id="schooltblionreg" class="table overflow-auto" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>School Name</th>
                                                <th>City</th>
                                                <th>Address</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                include "../../connector/connector.php";
                                                $query = ("SELECT * FROM `school`");
                                                $result = mysqli_query($conn, $query);

                                                if ($result -> num_rows > 0) {
                                                    while($row = $result->fetch_assoc()) {
                                                        echo '<tr>';
                                                        echo '<td>'.$row["schoolname"].'</td>';
                                                        echo '<td>'.$row["city"].'</td>';
                                                        echo '<td>'.$row["address"].'</td>';
                                                        echo '</tr>';
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Container Center -->

                </div>
            </section>
        </div>
        <!-- content -->

    </div>
    <script src="../../assets/js/bootstrap.js"></script>
    <script src="../../assets/js/dashboard.js"></script>

    
    <script src="../../assets/js/signoutadm.js"></script>

    <script src="../../assets/js/jquery-3.6.1.js" type="text/javascript"></script>
    <script src="../../assets/js/datatables.min.js"></script>
    <script src="../../assets/js/datatables.js"></script>
    <script src="../../assets/js/regschool.js"></script>


    

</body>
</html>