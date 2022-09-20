<?php

namespace App\Modules\Admin\LeadComment\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Services\Requests\ApiRequest;

class LeadCommentRequest extends ApiRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'lead_id' => 'required',
            'status_id' => 'required',
            'text'=> 'nullable',
        ];
    }
}
