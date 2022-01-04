@extends('layouts.print')

@push('styles')
<style>
    #qr svg {
        text-align: center;
        margin-left: auto;
        margin-right: auto;
    }

    .signatory_container {
        position: relative;
        text-align: center;
    }

    .signatory {
        position: absolute;
        line-height: 10%;
        top: 100%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>
@endpush

@section('content')
<div id="invoice">
    <!-- <button onClick="generatePDF()">PDF</button> -->
    <div class="mx-auto row">
        <div class="col-6 ">
            <img src="/assets/img/logo_cn.png" class="float-right" alt="Logo Camarines Norte" />
        </div>
        <div class="col-6">
            <img src="/assets/img/logo_cn_drr.png" class="float-left h-48" alt="Logo Camarines Norte" />
        </div>
    </div>
    <div class="mx-auto row">
        <div class="col-12">
            <h1 class="text-center font-bold mt-4 text-4xl">CERTIFICATION TO TRAVEL</h1>
        </div>
    </div>
    <div class="mx-auto row my-4">
        <div class="col-12 text-center">
            <div class="mx-auto" id="qr">
                {!! QrCode::size(150)->generate($pass->qr) !!}
            </div>
        </div>
        <div class="col-12 my-4">
            <h4 class="text-center tracking-widest">{{$pass->qr}}</h4>
        </div>
    </div>

    <!-- Letter Section -->
    <div class="mx-auto px-20 row my-4 pb-10">

        <p>TO WHOM IT MAY CONCERN</p>

        <p>THIS IS TO CERTIFY THAT, the person mentioned hereunder was from
            <strong>{{$pass->address}}.</strong>
            The purpose of this travel is to
            <!-- <strong>Origin</strong> -->
            <strong>{{$pass->purpose}}</strong>
            at
            <strong>{{$pass->pd_province}}</strong>
        </p>

        <p>Name: &emsp; <strong> {{$pass->fname}} {{$pass->mname}} {{$pass->lname}} </strong> </p>

        <p>Type of Vehicle: &emsp; <strong> {{$pass->vehicle}}</strong> </p>

        <p>Plate Number: &emsp; <strong> {{$pass->plate_no}}</strong> </p>

        <p>Validity: &emsp; <strong> {{ Carbon\Carbon::now()->format('F d Y') }} - {{
                Carbon\Carbon::now()->addDay(15)->format('F d Y') }}</strong> </p>

        <p>This certification is issued upon request of the interested party for whatsoever legal purpose this may
            serve.
        </p>

        <p>ISSUED THIS
            {{Carbon\Carbon::parse(Carbon\Carbon::now())->format('jS')}}
            DAY OF
            {{ Carbon\Carbon::now()->format('F Y') }}
            at Provincial Capitol, Daet, Camarines Norte.
        </p>

        <p>NOTE: PRESENT ID AND ANTIGEN TEST/SALIVA TEST RESULT OR VACCINATION CARD AT QUARANTINE CHECKPOINTS AND REPORT
            TO
            MDRRMO UPON RETURN TO THE PROVINCE.</p>
    </div>

    <div class="mx-auto row my-4 signatory_container">

        <div class="col-12 text-center signatory ">
            <p><strong>ATTY. DON H. CULVERA</strong></p>
            <p>Provincial Legal Officer </p>
            <p>Unified Incident Commander</p>
        </div>
        <div class="col-12">
            <img src="/assets/img/signature.png" class="mx-auto h-28" alt="Signature" />
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
    integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<script>
    window.print();
    // const generatePDF = () => {
    //     var canvas = document.getElementById("qr");
    //     var img = canvas.toDataURL("image/png");
    //     document.write('<img id="qr" src="' + img + '"/>');

    //     const element = document.getElementById('invoice');

    //     var opt = {
    //         margin: 0,
    //         filename: 'myfile.pdf',
    //         image: { type: 'jpeg', quality: 1 },
    //         html2canvas: {
    //             // scale: 1,

    //             onclone: (element) => {
    //                 const svgElements = Array.from(element.querySelectorAll('svg'));
    //                 svgElements.forEach(s => {
    //                     const bBox = s.getBBox();
    //                     s.setAttribute("x", bBox.x);
    //                     s.setAttribute("y", bBox.y);
    //                     s.setAttribute("width", bBox.width);
    //                     s.setAttribute("height", bBox.height);
    //                 })
    //             }
    //         },
    //         jsPDF: { floatPrecision: 16, unit: 'in', format: [8.5, 13], orientation: 'portrait' }
    //     };
    //     console.log(opt)
    //     html2pdf().set(opt).from(element).save();
    // }
</script>
@endpush