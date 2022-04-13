$("#messageTable").DataTable({
    "ordering": true,
    "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
    "info": false,
    dom: 'Bfrtip',
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ]
});