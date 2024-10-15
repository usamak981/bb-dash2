<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreExportDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can('exports.store');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'start_year' => 'required|digits:4|integer|min:1990|max:'.(date('Y')),
            'end_year' => 'required|digits:4|integer|min:1990|max:'.(date('Y')+10).'|gte:start_year'
        ];
    }
}
