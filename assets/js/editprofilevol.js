$(document).ready(function(){
    $("#form1_submit").click(function(){
        let valid = "true";
        let data = [];
        data[0] = $('input[name="password"]');
        data[1] = $('input[name="fullname"]');
        data[2] = $('input[name="email"]');
        data[3] = $('input[name="phone"]');
        data[4] = $('input[name="dob"]');
        data[5] = $('input[name="occupation"]');

        for (let x = 0; x < data.length; x++) {
            if (data[x].val().trim() == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data[x].attr('placeholder') +' must be filled out!'
                })
                valid = "false";
            }
        }

        if(valid === 'true'){
            updatedata();
        }
    });
    
});

function updatedata(){
    let data = [];
    data[0] = $('input[name="password"]').val();
    data[1] = $('input[name="fullname"]').val();
    data[2] = $('input[name="email"]').val();
    data[3] = $('input[name="phone"]').val();
    data[4] = $('input[name="dob"]').val();
    data[5] = $('input[name="occupation"]').val();


    $.ajax({
        url:'convolunteer/updateprofile.php',
        type:'post',
        data:{password:data[0], fullname:data[1], email:data[2], phone:data[3], 
            dob:data[4], occupation:data[5]},
        success:function(response){
            if(response == 1){
                Swal.fire(
                    'Success!',
                    'Success update information ' + data[1],
                    'success'
                )
            } else {
                let msg = "Something went wrong! please contact IT administrator";
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: msg
                })
            }
        }
    });
}

function showpass(){
    let take = document.getElementById("ps1x"); 
    if(take.type === "password"){
        take.type = "text";
    } else {
        take.type = "password";
    }
}