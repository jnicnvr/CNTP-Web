const socket = io.connect('http://cntp.test:8080');

$('#title_head').text('User Logs')
$('#title_bread').text('User Logs')

socket.on('connect', () => {
    socket.emit('getUserLogs');
});

socket.on('collectUserLogs', data => {
    console.log(data)
    const dataSet = [];
    if ($.fn.dataTable.isDataTable('#datatable')) {
        $('#datatable').DataTable().destroy();
        $('#datatable').empty();
    }
    if (!data) { }
    else {
        console.log(data)
        console.log(data.length)
        for (let i = 0; i < data.length; i++) {
            dataSet[i] = [
                data[i].username,
                data[i].name,
                data[i].role,
                data[i].activity,
                data[i].created_at,
            ]
        }
    }

    table = $('#datatable').DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        stateSave: true,
        destroy: true,
        data: dataSet,
        columns: [
            { title: "Username" },
            { title: "Name" },
            { title: "Role" },
            { title: "Activity" },
            { title: "Created At" },                   
        ],
        dom: 'lBfrtip', buttons: ['csv', 'colvis']
    });   

});
