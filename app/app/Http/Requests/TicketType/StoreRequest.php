<?php

namespace App\Http\Requests\TicketType;

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
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:3|max:255',
            'unit_id' => 'required|exists:units,id',
            'ticket_priority_id' => 'required|exists:ticket_priorities,id',
        ];
    }
}
