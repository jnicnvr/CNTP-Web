<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePassesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()

    {
        return [
            'fname' => ['required'],
            'mname' => ['required'],
            'lname' => ['required'],
            'sex' => ['required'],
            'year' => ['required'],
            'month' => ['required'],
            'day' => ['required'],

            'address' => ['required'],
            'contact_no' => ['required','max:11'],
            'email' => ['required','unique:passes','max:255'],
            'occupation' => ['required'],
            'workplace' => ['required'],
            
            'purpose' => ['required'],
            'travel_details' => ['required'],
            'po_street' => ['required'],
            'po_brgy' => ['required'],
            'po_city' => ['required'],
            'po_province' => ['required'],

            'pd_street' => ['required'],
            'pd_brgy' => ['required'],
            'pd_city' => ['required'],
            'pd_province' => ['required'],
           
            'vehicle' => ['required'],
            'plate_no' => ['required'],
            'classification' => ['required'],
            'booked_date' => ['required'],     
            
            'attachment1' =>  ['nullable','max:2048'],
            'attachment2' =>  ['nullable','max:2048'],
            
        ];
    }
}
