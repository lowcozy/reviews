<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class AddListingForm extends FormRequest
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
              'name' => 'required|min:3',
              'lat' => 'required|numeric',
              'lng' => 'required|numeric',
               'category_id' => 'required|not_in:0',
               'service' => 'required',
              'city' => 'required|not_in:0',
            'image' => 'required',
            'image.*' => 'mimes:jpeg,bmp,png,jpg'

        ];
    }

    public function messages()
        {
            return [
                'category_id.not_in' => 'Select Category Plz',
                'service.required' => 'Select Service Plz',
                'city.not_in' => 'Select City Plz',
                'lat.required' => 'Select Location On Map Plz'
            ];
        }
}
