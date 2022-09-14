$("#appRatingCustomer").DataTable({
    "ordering": true,
    "pageLength": 10,
    "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
    "info": true,
    // "responsive": true,
    dom: 'Bfrtip',
    buttons: [
        'copy', 'csv', 'excel', 'print',
        {
            extend: 'pdfHtml5',
            exportOptions: {
                columns: [ 0, 1, 2, 3, 4, 5 ]
            }
        },
    ]
});

$("#appRatingClinic").DataTable({
    "ordering": true,
    "pageLength": 10,
    "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
    "info": true,
    // "responsive": true,
    dom: 'Bfrtip',
    buttons: [
        'copy', 'csv', 'excel', 'print',
        {
            extend: 'pdfHtml5',
            exportOptions: {
                columns: [ 0, 1, 2, 3, 4, 5 ]
            }
        },
    ]
});
