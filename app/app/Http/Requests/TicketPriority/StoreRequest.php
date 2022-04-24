<?php

namespace App\Http\Requests\TicketPriority;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'title' => 'Required|min:3|max:255',
            'description' => 'Required|min:3|max:255',
            'ticket_type'=>'exists:ticket_types,id|Required'
        ];
    }
}
