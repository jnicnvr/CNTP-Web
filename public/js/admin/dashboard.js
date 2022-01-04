const socket = io.connect('http://cntp.test:8080');



socket.on('connect', () => {
    //municipality
    const municipal_role = $('#municipality').val()
    if(municipal_role){
        socket.emit('getDashboardStats', municipal_role);
    }else{
        let def_val = "all";
        socket.emit('getDashboardStats', def_val);
    }
    $('#municipality').change(function () {
        const municipality_admin = $('#municipality').val()
        socket.emit('getDashboardStats', municipality_admin);
        console.log(municipality_admin)
    })
});

socket.on('onReloadDashboardStats', () => {
    socket.emit('getDashboardStats')
});
socket.on('collectDashboardStats', ([data]) => {
    $('#total').text(data.total);
    $('#evaluated').text(data.evaluated);
    $('#not_evaluated').text(data.total - data.evaluated);
});