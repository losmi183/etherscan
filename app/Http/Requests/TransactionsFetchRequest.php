<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class TransactionsFetchRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'address'=>'required|string',
            'startblock'=>'nullable|int',
            'endblock'=>'nullable|int'
        ];
    }

    /**
     * @param Validator $validator
     *
     * @return void
     */
    public function failedValidation(Validator $validator): void
    {
        abort(418, $validator->errors());
    }

    /**
     * Setovanje neobaveznih polja na null ako nisu poslata
     * @return void
     */
    public function prepareForValidation(): void
    {
        // Setting request field default value if not exists
        if (!array_key_exists('startblock', $this->all())) {
            $this->merge(['startblock' => 9000]);
        }
        if (!array_key_exists('endblock', $this->all())) {
            $this->merge(['endblock' => null]);
        }
    }
}
