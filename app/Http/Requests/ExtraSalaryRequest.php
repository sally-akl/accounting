<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExtraSalaryRequest extends FormRequest
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
          'sal_min_extra'=>'required|integer',
          'emp_m_id'=>'required|integer',
          //'amount'=>'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
        ];
    }

    public function response(array $errors)
    {
        $transformed = [];
        foreach ($errors as $field => $message) {
            $transformed[] = [
                'field' => $field,
                'message' => $message[0]
            ];
        }

        if($this->is_ajax = 1)
           return response()->json(['errors' => $transformed], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        return $errors;
    }
}
