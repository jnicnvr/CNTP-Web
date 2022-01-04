require('dotenv').config()
const express = require('express')
const app = express();
const bcrypt = require('bcrypt')
const moment = require('moment');
const file = require('file-system');
const fs = require("fs");
let now = moment().format()

const httpServer = require("http").createServer(app);
const options = {
    cors: {
        origin: "*",
        methods: ["GET", "POST"]
    }
};

const PORT = process.env.PORT || 8080
//const pool = require('./config/database') //db
const io = require("socket.io")(httpServer, options);
const { createPool } = require('mysql');

var pool = createPool({
    connectionLimit: 200,
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'cntpschema'
});

io.on("connection", socket => {
    console.log(`Server Connected to Socket: ${socket.id}`)

    socket.on('disconnect', () => {
        console.log('disconnected 8=================D - - - - - - ')
    })

    socket.on('getTravelPassRecords', (data) => {
        console.log('getTravelPassRecords ', data)
        if (data == 'all') {
            let _query = 'SELECT `id`, `qr`, `fname`, `mname`, `lname`, `suffix`, `sex`, `birthday`, `address`, `contact_no`, `email`, `occupation`, `workplace`, `purpose`, `travel_details`, CONCAT(po_street,", ",po_brgy,", ",po_municipality,", ",po_province) AS `origin`, CONCAT(pd_street,", ",pd_brgy,", ",pd_municipality,", ",pd_province) AS destination, `vehicle`, `plate_no`, `classification`, `booked_date`, `attachment1`, `attachment2`, `status` FROM `passes`';
            pool.query(_query,

                [],
                (err, rows, fields) => {
                    if (rows == null) {
                        console.log('No Data Found!')
                        // console.log(rows)
                        socket.emit('collectTravelPassRecords', null)
                    } else {
                        socket.emit('collectTravelPassRecords', rows)
                        console.log(rows)
                    }
                    if (err) console.error("Boss we got an error with: ", err)
                    console.log('.....')
                })
        } else {
            let _query = 'SELECT `id`, `qr`, `fname`, `mname`, `lname`, `suffix`, `sex`, `birthday`, `address`, `contact_no`, `email`, `occupation`, `workplace`, `purpose`, `travel_details`, CONCAT(po_street,", ",po_brgy,", ",po_municipality,", ",po_province) AS `origin`, CONCAT(pd_street,", ",pd_brgy,", ",pd_municipality,", ",pd_province) AS destination, `vehicle`, `plate_no`, `classification`, `booked_date`, `attachment1`, `attachment2`, `status` FROM `passes` WHERE pd_municipality = ? OR po_municipality=?';
            pool.query(_query,

                [
                    data,
                    data
                ],
                (err, rows, fields) => {
                    if (rows == null) {
                        console.log('No Data Found!')
                        // console.log(rows)
                        socket.emit('collectTravelPassRecords', null)
                    } else {
                        socket.emit('collectTravelPassRecords', rows)
                        console.log(rows)
                    }
                    if (err) console.error("Boss we got an error with: ", err)
                    console.log('.....')
                })
        }
    })
    //======================== passed_travel ========================
    socket.on('getEvaluatedRecords', (data) => {
        console.log('getEvaluatedRecords', data)
        if (data == 'all') {
            // let _query = 'SELECT ep.id, ep.qr, `status`, `user_id`, p.fname,p.mname ,p.lname,p.suffix,`sex`, `birthday`, `address`, `contact_no`, `email`, `occupation`, `workplace`, `purpose`, `travel_details`, `origin`, CONCAT(p.pd_street," ",p.pd_brgy," ",p.pd_municipality," ",p.pd_province) AS destination, `vehicle`, `plate_no`, `classification`, DATE_FORMAT(p.booked_date, "%W %M %e %Y") AS booked_date, `attachment1`, `attachment2` FROM evaluated_pass AS ep JOIN passes AS p ON ep.qr = p.qr';
            let _query = 'SELECT `id`, `qr`, `fname`, `mname`, `lname`, `suffix`, `sex`, `birthday`, `address`, `contact_no`, `email`, `occupation`, `workplace`, `purpose`, `travel_details`,CONCAT(po_street," ",po_brgy," ",po_municipality," ",po_province) AS `origin`, CONCAT(pd_street," ",pd_brgy," ",pd_municipality," ",pd_province) AS destination, `vehicle`, `plate_no`, `classification`, `booked_date`, `attachment1`, `attachment2`, `status` FROM `passes` WHERE status="Evaluated"';
            pool.query(_query,
                [],
                (err, rows, fields) => {
                    if (!rows) {
                        console.log('No Data Found!')
                        // console.log(rows)
                        //emit data:false
                        socket.emit('collectEvaluatedRecords', null)
                    } else {
                        socket.emit('collectEvaluatedRecords', rows)
                        console.log(rows)
                    }
                    if (err) console.error("Boss we got an error with: ", err)
                    console.log('.....')
                })
        } else {
            let _query = 'SELECT `id`, `qr`, `fname`, `mname`, `lname`, `suffix`, `sex`, `birthday`, `address`, `contact_no`, `email`, `occupation`, `workplace`, `purpose`, `travel_details`,CONCAT(po_street," ",po_brgy," ",po_municipality," ",po_province) AS `origin`, CONCAT(pd_street," ",pd_brgy," ",pd_municipality," ",pd_province) AS destination, `vehicle`, `plate_no`, `classification`, `booked_date`, `attachment1`, `attachment2`, `status` FROM `passes` WHERE pd_municipality=? OR po_municipality=? AND status="Evaluated"';
            pool.query(_query,
                [
                    data,
                    data
                ],
                (err, rows, fields) => {
                    if (!rows) {
                        console.log('No Data Found!')
                        // console.log(rows)
                        //emit data:false
                        socket.emit('collectEvaluatedRecords', null)
                    } else {
                        socket.emit('collectEvaluatedRecords', rows)
                        console.log(rows)
                    }
                    if (err) console.error("Boss we got an error with: ", err)
                    console.log('.....')
                })
        }
    })
    // ==================== end of passed_travel ==========================

    //======================== booked_pass ========================
    socket.on('getNotYetEvaluatedRecords', (data) => {
        console.log('getNotYetEvaluatedRecords', data)
        if (data == "all") {
            let _query = 'SELECT `id`, `qr`, `fname`, `mname`, `lname`, `suffix`, `sex`, `birthday`, `address`, `contact_no`, `email`, `occupation`, `workplace`, `purpose`, `travel_details`, CONCAT(po_street," ",po_brgy," ",po_municipality," ",po_province) AS `origin`, CONCAT(pd_street," ",pd_brgy," ",pd_municipality," ",pd_province) AS destination, `vehicle`, `plate_no`, `classification`, `booked_date`, `attachment1`, `attachment2`, `status` FROM `passes` WHERE status="Not Yet Evaluated"';
            pool.query(_query,
                [],
                (err, rows, fields) => {
                    if (!rows) {
                        console.log('No Data Found!')
                        // console.log(rows)
                        //emit data:false
                        socket.emit('collectNotYetEvaluatedRecords', null)
                    } else {
                        socket.emit('collectNotYetEvaluatedRecords', rows)
                        console.log(rows)
                    }
                    if (err) console.error("Boss we got an error with: ", err)
                    console.log('.....')
                })
        } else {
            let _query = 'SELECT `id`, `qr`, `fname`, `mname`, `lname`, `suffix`, `sex`, `birthday`, `address`, `contact_no`, `email`, `occupation`, `workplace`, `purpose`, `travel_details`, CONCAT(po_street," ",po_brgy," ",po_municipality," ",po_province) AS `origin`, CONCAT(pd_street," ",pd_brgy," ",pd_municipality," ",pd_province) AS destination, `vehicle`, `plate_no`, `classification`, `booked_date`, `attachment1`, `attachment2`, `status` FROM `passes` WHERE po_municipality=? OR pd_municipality=? AND status="Not Yet Evaluated"';
            pool.query(_query,
                [
                    data,
                    data
                ],
                (err, rows, fields) => {
                    if (!rows) {
                        console.log('No Data Found!')
                        // console.log(rows)
                        //emit data:false
                        socket.emit('collectNotYetEvaluatedRecords', null)
                    } else {
                        socket.emit('collectNotYetEvaluatedRecords', rows)
                        console.log(rows)
                    }
                    if (err) console.error("Boss we got an error with: ", err)
                    console.log('.....')
                })
        }
        // let _query = 'SELECT ep.id, ep.qr, `status`, `user_id`, p.fname,p.mname ,p.lname,p.suffix,`sex`, `birthday`, `address`, `contact_no`, `email`, `occupation`, `workplace`, `purpose`, `travel_details`, `origin`, CONCAT(p.pd_street," ",p.pd_brgy," ",p.pd_municipality," ",p.pd_province) AS destination, `vehicle`, `plate_no`, `classification`, DATE_FORMAT(p.booked_date, "%W %M %e %Y") AS booked_date, `attachment1`, `attachment2` FROM evaluated_pass AS ep JOIN passes AS p ON ep.qr = p.qr';

    })
    // ==================== end of booked_pass ==========================

    socket.on('login_user', (data) => {
        console.log('login_user ')
        let _query = 'SELECT `id`, `name`, `role`, `foo` FROM `users` WHERE username=?';
        pool.query(_query,
            [
                data.uname
                // data.password
            ],
            (err, rows, fields) => {

                if (!rows || rows.length == 0) {

                    console.log('Incorrect Username')
                    // console.log(rows)
                    //emit data:false
                    socket.emit('login_onUser', data = { isSuccess: false })
                } else {
                    [rows] = rows
                    console.log('sam password', rows)
                    console.log(data.password)
                    console.log(rows.foo)

                    if (data.password != rows.foo) {
                        socket.emit('login_onUser', data = { isSuccess: false })
                    } else {
                        rows = { isSuccess: true, id: rows.id, name: rows.name, role: rows.role }
                        console.log('isSuccess', rows)
                        socket.emit('login_onUser', rows)
                    }
                }
                if (err) console.error("Boss we got an error with: ", err)
                console.log('.....')
            })
    })




    socket.on('getUserLogs', () => {
        console.log('getUserLogs ')
        let _query = 'SELECT `username`,`name`, IF(role="1","SuperAdmin", "Municipal") AS role,`activity`, DATE_FORMAT(ul.created_at, "%W %M %e %Y %H:%i") AS created_at FROM `user_logs`AS ul JOIN users AS u ON ul.user_id = u.id';
        pool.query(_query,
            [],
            (err, rows, fields) => {
                if (rows == null) {
                    console.log('No Data Found!')
                    // console.log(rows)
                    socket.emit('collectUserLogs', null)
                } else {
                    socket.emit('collectUserLogs', rows)
                    console.log(rows)
                }
                if (err) console.error("Boss we got an error with: ", err)
                console.log('.....')
            })
    })

    socket.on('getUsers', () => {
        console.log('getUsers ')
        let _query = 'SELECT `id`,`username`,`name`, email, IF(role="1","SuperAdmin", "Municipal") AS role, DATE_FORMAT(created_at, "%W %M %e %Y %H:%i") AS created_at FROM `users`';
        pool.query(_query,
            [],
            (err, rows, fields) => {
                if (rows == null) {
                    console.log('No Data Found!')
                    // console.log(rows)
                    socket.emit('collectUsers', null)
                } else {
                    socket.emit('collectUsers', rows)
                    console.log(rows)
                }
                if (err) console.error("Boss we got an error with: ", err)
                console.log('.....')
            })
    })

    socket.on('qrcode_Data', (data) => {
        console.log('qrcode_Data', data)

        let _query = 'SELECT `id`, `qr`, CONCAT(`fname`," ",`mname`," ",`lname`) AS name, `suffix`, `sex`, `birthday`, `address`, `contact_no`, `email`, `occupation`, `workplace`, `purpose`, `travel_details`, `origin`, CONCAT(pd_street," ",pd_brgy," ",pd_municipality," ",pd_province) AS destination, `vehicle`, `plate_no`, `classification`, `booked_date`, `attachment1`, `attachment2`, `status` FROM `passes` WHERE status="Not Yet Evaluated" AND qr=?';
        pool.query(_query,
            [data.id_tp],
            (err, rows, fields) => {
                console.log('rowsnull', rows)
                if (!rows || rows.length == 0) {
                    console.log('No Data Found!')
                    socket.emit('onGetData', data = { isSuccess: false })
                } else {
                    [rows] = rows
                    rows = { ...rows, isSuccess: true, ...rows }
                    console.log('myrows', rows)
                    socket.emit('onGetData', rows)
                    console.log('Destructured array', rows)
                }
                if (err) console.error("Boss we got an error with: ", err)
                console.log('.....')
            })
    })

    // ================== isAccepted ============================
    socket.on('isAccepted', (data) => {
        console.log('isAccepted', data)
        if (data.attachment1 == "no_image" && data.attachment2 == "no_image") { console.log('Found No image!') }
        else if (data.attachment1 == "no_image") {
            if (data.binary_attachment2) {
                require("fs").writeFile(`C:/xampp/htdocs/CNTP/storage/app/public/attachment2/${data.attachment2}`, data.binary_attachment2, 'base64', function (err) {
                    console.log('504', err);
                });
            } else { console.log('Found No image2!') }
        } else if (data.attachment2 == "no_image") {
            if (data.binary_attachment1) {
                require("fs").writeFile(`C:/xampp/htdocs/CNTP/storage/app/public/attachment1/${data.attachment1}`, data.binary_attachment1, 'base64', function (err) {
                    console.log('504', err);
                });
            } else { console.log('Found No image1!') }
        } else {
            if (data.binary_attachment1) {
                require("fs").writeFile(`C:/xampp/htdocs/CNTP/storage/app/public/attachment1/${data.attachment1}`, data.binary_attachment1, 'base64', function (err) {
                    console.log('504', err);
                });
            } else {
                console.log('Found No image1!')
            }
            if (data.binary_attachment2) {
                require("fs").writeFile(`C:/xampp/htdocs/CNTP/storage/app/public/attachment2/${data.attachment2}`, data.binary_attachment2, 'base64', function (err) {
                    console.log('504', err);
                });
            } else {
                console.log('Found No image2!')
            }
        }

        // let _query = 'UPDATE `passes` SET `status`="Evaluated", `updated_at`=? WHERE qr=?';
        let _query = 'UPDATE `passes` SET `status`="Evaluated",`attachment1`=?,`attachment2`=?, `updated_at`=? WHERE qr=?';
        let _isEvaluated = "INSERT INTO `evaluated_pass` (`qr`, `status`, `user_id`) VALUES (?,?,?)";

        pool.query(_query,
            [
                data.attachment1,
                data.attachment2,
                now,
                data.id_tp
            ],
            (err, rows, fields) => {
                if (rows == null) {
                    console.log('No Data Found!')
                    // console.log(rows)
                } else {
                    socket.emit('onGetStat', data = { isSuccess: true })
                    console.log('onGetStat', rows)
                    console.log("onReload")
                    socket.broadcast.emit('onReloadPassedTravel')
                    socket.broadcast.emit('onReloadTravelPass')
                    socket.broadcast.emit('onReloadBookedPass')
                    socket.broadcast.emit('onReloadDashboardStats')

                }
                if (err) console.error("Boss we got an error with: ", err)
                console.log('.....')
            })
        pool.query(_isEvaluated,
            [
                data.id_tp,
                "Evaluated",
                data.personId
            ],
            (err, rows, fields) => {
                if (rows == null) {
                    console.log('No Data Found!')
                    // console.log(rows)
                } else {
                    socket.emit('onGetStat', data = { isSuccess: true })
                    console.log(rows)
                }
                if (err) console.error("Boss we got an error with: ", err)
                console.log('.....')
            })

    })

    socket.on('getDashboardStats', (data) => {
        console.log('getDashboardStats', data)
        if (data == 'all') {
            let _query = 'SELECT COUNT(*) AS total, (SELECT COUNT(*) FROM`passes` WHERE status="Evaluated") as evaluated FROM `passes` ';
            pool.query(_query,
                [data],
                (err, rows, fields) => {
                    console.log('rowsnull', rows)
                    if (!rows || rows.length == 0) {
                        console.log('No Data Found!')
                        socket.emit('collectDashboardStats', null)
                    } else {
                        console.log('collectDashboardStats', rows)
                        socket.emit('collectDashboardStats', rows)
                    }
                    if (err) console.error("Boss we got an error with: ", err)
                    console.log('.....')
                })
        } else {
            let _query = 'SELECT COUNT(*) AS total, (SELECT COUNT(*) FROM`passes` WHERE status="Evaluated") as evaluated FROM `passes` WHERE po_municipality=? OR pd_municipality=? ';
            pool.query(_query,
                [
                    data,
                    data
                ],
                (err, rows, fields) => {
                    console.log('rowsnull', rows)
                    if (!rows || rows.length == 0) {
                        console.log('No Data Found!')
                        socket.emit('collectDashboardStats', null)
                    } else {
                        console.log('collectDashboardStats', rows)
                        socket.emit('collectDashboardStats', rows)
                    }
                    if (err) console.error("Boss we got an error with: ", err)
                    console.log('.....')
                })
        }

    })
});

httpServer.listen(PORT, '192.168.18.10', () => console.log(`Server is Running on port ${PORT}`));