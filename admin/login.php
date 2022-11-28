<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- Favicons -->
    <link href="../assets/img/logois.png" rel="icon">
    <link href="../assets/img/apple-touch-iconis" rel="apple-touch-icon">

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../assets/css/adminlog.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="main">  	
        <div class="content">
            <h3>Log in to your account</h3>
            <form name="admlogform" method="POST" onsubmit="return false" id="admlogform">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button id="but_submit">Log in</button>
            </form>
            <small>© 2022 ISchool Help</small>
        </div>
    </div>
    <script>

        $(document).ready(function(){
            $("#but_submit").click(function(){
                var username = $('input[name="username"]').val().trim();
                var password = $('input[name="password"]').val().trim();
                const data = [];
                data[0] = document.forms["admlogform"]["username"];
                data[1] = document.forms["admlogform"]["password"];
                for (let indexdata = 0; indexdata < data.length; indexdata++) {
                    if (data[indexdata].value == "") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data[indexdata].placeholder +' must be filled out!'
                        })
                        return false;
                    }
                }
                if( username != "" && password != "" ){
                    $.ajax({
                        url:'conadmin/log.php',
                        type:'post',
                        data:{username:username,password:password},
                        success:function(response){
                            var msg = "";
                            if(response == 1){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Good job!',
                                    text: 'Login Successfull' ,
                                    confirmButtonText: 'OK',
                                }).then((result) => {
                                    /* Read more about isConfirmed, isDenied below */
                                    if (result.isConfirmed) {
                                        window.location = "../admin";
                                    }
                                })
                            } else {
                                msg = "Invalid username and password!";
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: msg
                                })
                            }
                        }
                    });
                }
            });
        });

    </script>
</body>
</html>