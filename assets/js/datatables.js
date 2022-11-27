$('#schooltbl').dataTable( {
  scrollY: 270,
   scrollX: true,
} );

$('#schooltblionreg').dataTable( {
   scrollX: true,
} );

$('#tabletutorialrequest').dataTable( {
  scrollX: true,
} );


$('#reqtbl').dataTable( {
  scrollY: 270,
   scrollX: true,
} );

$(document).ready(function () {
    $('#table1').DataTable({
      "scrollX": true
    });
    $('.dataTables_length').addClass('bs-select');
});

$('#viewoffersbyreqid').DataTable({
  scrollY: 270,
   scrollX: true,
} );

$('#reviewioffers').DataTable({
  scrollY: 270,
   scrollX: true,
   order: [[ 0, 'desc' ], [ 1, 'asc' ]]
});

$('#myoffer').DataTable({
  scrollY: 270,
   scrollX: true,
} );

$('#tableresourcerequest').DataTable( {
  scrollX: true,
})