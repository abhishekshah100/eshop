<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebsiteSettings extends FormRequest
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
            'website_name' => 'required|string|max:40',
            'website_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'website_email' => 'required|string|max:100',
            'contactno' => 'required|digits_between:9,16',
            'address' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:25',
            'pincode' => 'nullable|numeric',
            'website_url' => 'required|string|max:100',
            'facebook_url' => 'nullable|string|max:100',
            'twitter_url' => 'nullable|string|max:100',
            'youtube_url' =>'nullable|string|max:100',
            'instagram_url' =>'nullable|string|max:100'
        ];
    }

    public function messages()
    {
        return [
            'website_email.required' => 'Email is required!',
            'website_name.required' => 'Name is required!'
        ];
    }
}
