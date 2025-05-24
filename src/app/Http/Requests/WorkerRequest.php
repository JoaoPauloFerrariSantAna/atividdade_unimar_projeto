<?php

namespace App\Http\Requests;

require_once __DIR__ . "/../../../constants/constants.php";


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WorkerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
			"name" => "required|max:".DEFAULT_NAME_SIZE,
			"salary" => "required|decimal:4",
			"contractStart" => [ "required", Rule::date()->format("y-m-d") ],
			"contractEnd" => Rule::date()->format("y-m-d")
        ];
    }
}
