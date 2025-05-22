<?php

require_once __DIR__ . "/../../../constants/constants.php";

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartamentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
			"name" => [ "required", "max:".DEFAULT_DEPT_NAME_SIZE ],
			"workerAmount" => [ "required" ]
        ];
    }
}
