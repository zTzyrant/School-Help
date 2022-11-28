function acceptoffers(needid,voluntmail){
    Swal.fire({
        icon: 'question',
        title: 'Accept Offer Request?',
        text: 'Do you want to Accept Offer Request?',
        showDenyButton: true,
        confirmButtonText: 'Yes',
        denyButtonText: `No`,
    }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:'../conadmin/confirmoffer.php',
                    type:'post',
                    data:{offeridtoconfirm:needid},
                    success:function(response){
                        if(response == 1){
                            Swal.fire({
                                icon: 'success',
                                title: 'Good Job!',
                                text: 'Success to Accept Offer Request, do you want to send an email to volunteer?',
                                showDenyButton: true,
                                confirmButtonText: 'Yes',
                                denyButtonText: `No`,
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        var mailToLink = "mailto:"+voluntmail+"?subject=Offer Has Been Accept&body=Your offer Request Has been accepted, thanks!";
                                        window.open(mailToLink);
                                        location.reload();
                                    }
                                })
                        } else {
                            msg = "Something went wrong! please contact IT administrator";
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: msg
                            })
                        }
                    }
                })
            }
        })
}

function closerequest(needid){
    Swal.fire({
        icon: 'warning',
        title: 'Close Request?',
        text: 'Do you want to Close This Request, this action cannot be changed?',
        showDenyButton: true,
        confirmButtonText: 'Yes',
        denyButtonText: `No`,
    }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:'../conadmin/closerequest.php',
                    type:'post',
                    data:{requestoclose:needid},
                    success:function(response){
                        if(response == 1){
                            Swal.fire({
                                icon: 'success',
                                title: 'Good Job!',
                                text: 'Success to Accept Offer Request, do you want to send an email to volunteer?',
                                showDenyButton: false,
                                confirmButtonText: 'Yes',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                })
                        } else {
                            msg = "Something went wrong! please contact IT administrator";
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: msg
                            })
                        }
                    }
                })
            }
        })
}