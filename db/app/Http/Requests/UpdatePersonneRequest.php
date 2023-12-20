<?php

namespace App\Http\Requests;

use App\Models\Personne;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonneRequest extends FormRequest
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
        $rules = Personne::$rules;
        
        return $rules;
    }
}
