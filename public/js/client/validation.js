
$('#travelPassForm').validate({
    rules: {
        fname: {
            required: true,
        },
        mname: {
            required: true,
        },
        lname: {
            required: true,
        },
        sex: {
            required: true,
        },
        month: {
            required: true,
        },
        day: {
            required: true,
        },
        year: {
            required: true,
        },
        address: {
            required: true,
        },
        contact_no: {
            required: true,
        },
        email: {
            required: true,
        },
        occupation: {
            required: true,
        },
        workplace: {
            required: true,
        },
        // travel informations
        purpose: {
            required: true,           
        },
        travel_details: {
            required: true,           
        },
        po_street: {
            required: true,           
        },
        po_brgy: {
            required: true,           
        },
        po_city: {
            required: true,           
        },
        po_province: {
            required: true,           
        },
        pd_street: {
            required: true,           
        },
        pd_brgy: {
            required: true,           
        },
        pd_city: {
            required: true,           
        },        
        //vehicle details
        vehicle: {
            required: true,           
        },   
        plate_no: {
            required: true,           
        },   
        // Classifications
        classification: {
            required: true,           
        }, 
        booked_date: {
            required: true,           
        }, 
        //Attachments
        // attachment1: {
        //     required: true,           
        // }, 
        // attachment2: {
        //     required: true,           
        // }, 
    },
    messages: {
        fname: {
            required: "Please provide first name",
        },
        mname: {
            required: "Please provide middle name",
        },
        lname: {
            required: "Please provide last name",
        },
        email: {
            required: "Please provide email address",
        },       
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
        error.addClass('invalid-feedback col-sm-6 ');
        element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
    }
});