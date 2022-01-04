const socket = io.connect('http://cntp.test:8080');

$('#title_head').text('Booked Travel Pass')
$('#title_bread').text('Booked Travel Pass')
socket.on('connect', () => {

    const municipal_role = $('#municipality').val()
    if (municipal_role) {
        socket.emit('getNotYetEvaluatedRecords', municipal_role);
    } else {
        let def_val = "all";
        socket.emit('getNotYetEvaluatedRecords', def_val);
    }
    $('#municipality').change(function () {
        const municipality_admin = $('#municipality').val()
        socket.emit('getNotYetEvaluatedRecords', municipality_admin);
        console.log(municipality_admin)
    })
    // socket.emit('getNotYetEvaluatedRecords');
});
socket.on('onReloadBookedPass', () => {
    socket.emit('getNotYetEvaluatedRecords');
});
socket.on('collectNotYetEvaluatedRecords', data => {
    console.log(data)
    const dataSet = [];
    if ($.fn.dataTable.isDataTable('#datatable')) {
        $('#datatable').DataTable().destroy();
        $('#datatable').empty();
    }
    if (!data) { }
    else {
        for (let i = 0; i < data.length; i++) {
            dataSet[i] = [
                data[i].id,
                data[i].status,
                data[i].qr,
                data[i].fname,
                data[i].mname,
                data[i].lname,
                data[i].suffix,
                data[i].sex,
                data[i].birthday,
                data[i].address,
                data[i].contact_no,
                data[i].email,
                data[i].occupation,
                data[i].workplace,
                data[i].purpose,
                data[i].travel_details,
                data[i].origin,
                data[i].destination,
                data[i].vehicle,
                data[i].plate_no,
                data[i].classification,
                data[i].booked_date,
                data[i].attachment1,
                data[i].attachment2
                // data[i].created_at,
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
            { title: "Status" },
            { title: "QR" },
            { title: "First Name" },
            { title: "Middle Name" },
            { title: "Last Name" },
            { title: "Suffix" },
            { title: "Sex" },
            { title: "Birthday" },
            { title: "Address" },
            { title: "Contact Number" },
            { title: "Email" },
            { title: "Occupation" },
            { title: "Workplace" },
            { title: "Purpose" },
            { title: "Travel Details" },
            { title: "Origin" },
            { title: "Destination" },
            { title: "Vehicle" },
            { title: "Plate Number" },
            { title: "Classification" },
            { title: "Booked Date" },
            { title: "ID 1" },
            { title: "ID 2" },
            {
                title: "Action",
                "data": null,

                "defaultContent": '<button type="button"  onClick="onPressViewModal()" class="text-white btn-success btn-xs mx-1">View</button>'
            }
        ],
        dom: 'lBfrtip', buttons: ['csv', 'colvis']
    });

    $('#datatable tbody').on('click', 'button', function () {
        let data = table.row($(this).parents('tr')).data();
        console.log(data)
        $("#fullname").text(data[3] + ' ' + data[4] + ' ' + data[5]);
        $("#contact_no").text(data[10]);
        $("#plate_no").text(data[19]);
        $("#origin").text(data[16]);
        $("#destination").text(data[17]);
        if (data[22] == "no_image1" || data[22] == null) {
            $("#attachment1").attr("src", `/storage/error/no_image.png`);
        } else {
            $("#attachment1").attr("src", `/storage/attachment1/${data[22]}`);
        }
        if (data[23] == "no_image2" || data[23] == null) {
            $("#attachment2").attr("src", `/storage/error/no_image.png`);
        } else {
            $("#attachment2").attr("src", `/storage/attachment2/${data[23]}`);
        }
    });

});

const onPressViewModal = () => {
    $('#travel_pass_modal').modal('show');
}