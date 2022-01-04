<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePassesRequest;
use App\Models\Pass;
use Illuminate\Http\Request;

use QrCode;

class PassController extends Controller
{
    
    public function index()
    {
       return view('client.pass');
    }

    public function create()
    {
        //
    }

    public function store(StorePassesRequest $request)
    {             
        // dd($request->file('attachment1'));
        // dd(request());
        // dd();
        $attachment1 = null;
        $attachment2 = null;
        $attachment1_path=null;
        $attachment2_path=null;
        
        $birthday = request('year'). "-" . str_pad(request('month'), 2, "0", STR_PAD_LEFT) . "-" . str_pad(request('day'), 2, "0", STR_PAD_LEFT);
    
        // $origin = request('po_street').' '.request('po_brgy').' '.request('po_city').' '.request('po_province');
        // $destination = request('pd_street').' '.request('pd_brgy').' '.request('pd_city').' '.request('pd_province');
        // dd($origin);
        if($request->attachment1){
            $attachment1 = time().'_'.$request->attachment1->getClientOriginalName(); 
            // $attachment1_path = $request->attachment1->store('public/files');
            $attachment1_path = $request->attachment1->storeAs('public/attachment1', $attachment1);
        }
        if($request->attachment2){
            $attachment2 = time().'_'.$request->attachment2->getClientOriginalName(); 
            $attachment2_path = $request->attachment2->storeAs('public/attachment2', $attachment2);
        }

        $generatedQR =  $this->generateUniqueCode();
        if(!$request->attachment1){
            $attachment1 = "no_image1";
        }
        if(!$request->attachment2){
            $attachment2 = "no_image2";
        }
        
        Pass::create([
            'qr' => $generatedQR,
            'fname' => request('fname'),
            'mname' => request('mname'),
            'lname' => request('lname'),
            'suffix' => request('suffix'),

            'sex' => request('sex'),
            'birthday' => $birthday,
            'address' => request('address'),
            'contact_no' => request('contact_no'),
            'email' => request('email'),
            'occupation' => request('occupation'),
            'workplace' => request('workplace'),

            'purpose' => request('purpose'),
            'travel_details' => request('travel_details'),
            // 'origin' => $origin,

            'po_street' => request('po_street'),
            'po_brgy' => request('po_brgy'),
            'po_municipality' => request('po_city'),
            'po_province' => request('po_province'),

            'pd_street' => request('pd_street'),
            'pd_brgy' => request('pd_brgy'),
            'pd_municipality' => request('pd_city'),
            'pd_province' => request('pd_province'),
            
            // 'destination' => $destination,
            'vehicle' => request('vehicle'),
            'plate_no' => request('plate_no'),
            'classification' => request('classification'),
            'booked_date' => request('booked_date'),

            'attachment1' => $attachment1,
            'attachment2' => $attachment2,
        ]);

        return redirect()->route('travel-pass-application.show', [$generatedQR]);

    }
    public function generateUniqueCode()
    {
        do {
            $qr = random_int(100000000, 999999999);
        } while (Pass::where("qr", "=", $qr)->first());
  
        return $qr;
    }
    public function simpleQr()
    {
       return QrCode::size(300)->generate('A basic example of QR code!');
    }  
    public function show($qr)
    {
    //   dump($qr);
        $pass = Pass::findOrFail($qr);
        // dump($pass);
            return view('client.print_pass', compact('pass'));
    }
    public function onLoadEvaluatedPass(){
        return view('admin.passed_travel');
    }
    public function onLoadTravelPass()
    {
       return view('admin.travel_pass');
    }

    //dashboard
    public function onLoadDashboard()
    {
        return view('admin.dashboard');
    }
    public function onLoadBookedPass()
    {
        return view('admin.booked_pass');
    }
    public function showFAQ(){
        return view('client.faq');
    }
}
