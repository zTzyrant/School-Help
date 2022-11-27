$('#selectformtype').change(function(){
    let check = $('#selectformtype').find(":selected").val();
    if(check === '1'){
        $('#form1').show();
        $('#form2').hide();
    } else if (check === '2'){
        $('#form1').hide();
        $('#form2').show();
    }
})

$(document).ready(function(){
    $("#form1_submit").click(function(){
        let valid = "true";
        let data = [];
        data[0] = $('input[name="desc"]');
        data[1] = $('input[name="datetutor"]');
        data[2] = $('input[name="timetutor"]');
        data[3] = $('input[name="studentlevel"]');
        data[4] = $('input[name="nos"]');
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
            subrequest();
        }
    });

    $("#form2_submit").click(function(){
        let valid = "true";
        let data = [];
        data[0] = $('input[name="descx"]');
        data[1] = $('#resourcetype');
        data[2] = $('input[name="numrequired"]');

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

        if (data[1].val() === "0") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Select Resource Type must be Selected!'
            })
            valid = "false";
        }

        if(valid === 'true'){
            subrequestresource();
        }
    });
});

function subrequest(){
    let data = [];
    data[0] = $('input[name="desc"]').val();
    data[1] = $('input[name="datetutor"]').val();
    data[2] = $('input[name="timetutor"]').val();
    data[3] = $('input[name="studentlevel"]').val();
    data[4] = $('input[name="nos"]').val();
    let time = data[2] + " AM"
    var atime = data[2].split(":");

    if(parseInt(atime[0]) > 12){
        let tempt = parseInt(atime[0]) - 12;
        if( tempt < 10){
            time = "0" + (parseInt(atime[0]) - 12) + ":" + atime[1] + " PM";
        } else {
            time = (parseInt(atime[0]) - 12) + ":" + atime[1] + " PM";
        }
    }

    $.ajax({
        url:'../conadmin/subreq.php',
        type:'post',
        data:{desc:data[0], datetutor:data[1], timetutor:time, 
            studentlevel:data[3], nos:data[4]},
        success:function(response){
            let msg = "";
            if(response == 1){
                Swal.fire(
                    'Success!',
                    'Success adding submit request for date ' + data[1],
                    'success'
                )
            } else {
                msg = "Something went wrong! please contact IT administrator";
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: msg
                })
            }
        }
    });
}

function subrequestresource() {
    let data = [];
    data[0] = $('input[name="descx"]').val();
    data[1] = $("#resourcetype option:selected").text(); 
    data[2] = $('input[name="numrequired"]').val();

    $.ajax({
        url:'../conadmin/subreqresource.php',
        type:'post',
        data:{desc:data[0], resourcetype:data[1], numrequired:data[2]},
        success:function(response){
            let msg = "";
            if(response == 1){
                Swal.fire(
                    'Success!',
                    'Success adding submit resource request for ' + data[1],
                    'success'
                )
            } else {
                msg = "Something went wrong! please contact IT administrator";
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: msg
                })
            }
        }
    });
    
}