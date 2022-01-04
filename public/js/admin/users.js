const socket = io.connect('http://cntp.test:8080');

$('#title_head').text('Users')
$('#title_bread').text('Users')

socket.on('connect', () => {
    socket.emit('getUsers');
});

socket.on('collectUsers', data => {
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
                data[i].id,
                data[i].username,
                data[i].name,
                data[i].email,
                data[i].role,
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
            { title: "ID" },
            { title: "Username" },
            { title: "Name" },
            { title: "Email" },
            { title: "Role" },
            { title: "Created At" },              
        ],
        dom: 'lBfrtip', buttons: ['csv', 'colvis']
    });   

});
