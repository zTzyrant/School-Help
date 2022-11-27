function signoutadm() {
    Swal.fire({
        title: 'Do you want to sign out?',
        text: "You will direct to login page again!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#435ebe',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Sign Out'
        }).then((result) => {
        if (result.isConfirmed) {
            location.href = "conadmin/logout.php";

        }
    })
}

function insignoutadm() {
    Swal.fire({
        title: 'Do you want to sign out?',
        text: "You will direct to login page again!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#435ebe',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Sign Out'
        }).then((result) => {
        if (result.isConfirmed) {
            location.href = "../conadmin/logout.php";

        }
    })
}

function signoutvolun() {
    Swal.fire({
        title: 'Do you want to sign out?',
        text: "You will direct to login page again!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#435ebe',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Sign Out'
        }).then((result) => {
        if (result.isConfirmed) {
            location.href = "convolunteer/logout.php";

        }
    })
}