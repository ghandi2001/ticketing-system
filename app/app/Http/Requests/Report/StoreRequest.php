<?php

namespace App\Http\Requests\Report;

use App\Http\Controllers\ReportController;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'report_name'=>'required|min:3|max:255',
            'report_description'=>'required|min:3',
            'report_table'=>Rule::in(ReportController::tables),
        ];
    }
}
