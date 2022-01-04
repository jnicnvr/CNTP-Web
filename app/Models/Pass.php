<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pass extends Model
{
    use HasFactory;
    protected $fillable = [
        'qr',
        'fname',
        'mname',
        'lname',
        'suffix',
        'sex',
        'birthday',
        'address',
        'contact_no',
        'email',
        'occupation',
        'workplace',

        'purpose',
        'travel_details',
        'po_street' ,
        'po_brgy',
        'po_municipality',
        'po_province',
       
        'pd_street' ,
        'pd_brgy',
        'pd_municipality',
        'pd_province',
        'vehicle',
        'plate_no',
        'classification',
        'booked_date',

        'attachment1',
        'attachment2',

    ];
    protected $primaryKey = 'qr';
    public function getRouteKeyName()
    {
        return 'qr';
    }
}
