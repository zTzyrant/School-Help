$(document).ready(function(){
    $("#form1_submit").click(function(){
        let valid = "true";
        let data = [];
        data[0] = $('input[name="password"]');
        data[1] = $('input[name="fullname"]');
        data[2] = $('input[name="email"]');
        data[3] = $('input[name="phone"]');
        data[4] = $('input[name="staffID"]');
        data[5] = $('input[name="position"]');

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

        let admid = document.getElementById('idcollection').options; 

        for (let x = 0; x < admid.length; x++) {
            if (data[4].val() === admid[x].value){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Staff Id Already used!'
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
    data[4] = $('input[name="staffID"]').val();
    data[5] = $('input[name="position"]').val();

    data[6] = $('input[name="oldstaff"]').val();


    $.ajax({
        url:'../conadmin/updateprofile',
        type:'post',
        data:{password:data[0], fullname:data[1], email:data[2], phone:data[3], 
            staffID:data[4], position:data[5]},
        success:function(response){
            if(response == 1){
                // this start line used for update data staff id
                let admid = document.getElementById('idcollection').options; 
                for (let x = 0; x < admid.length; x++) {
                    if (data[6] === admid[x].value){
                        admid[x].value = data[4];
                        admid[x].tetx = data[4];
                    }
                    
                }
                // this end used for update data staff id

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