<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class TransactionsRequest extends FormRequest
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

            'itemsPerPage'=>'nullable|int',
            'page'=>'nullable|int',
            'sortBy'=>'nullable|array',
            'sortBy[0]'=>'nullable|object',

            'search'=>'nullable|string',
            // 'date_from'=>'nullable|string',
            // 'date_to'=>'nullable|string',
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
        if (!array_key_exists('itemsPerPage', $this->all())) {
            $this->merge(['itemsPerPage' => 10]);
        }
        if (!array_key_exists('page', $this->all())) {
            $this->merge(['page' => 1]);
        }
		if (!array_key_exists('sortBy', $this->all())) {
            $this->merge(['sortBy' => []]);
        }
        
        if (!array_key_exists('search', $this->all())) {
            $this->merge(['search' => '']);
        }

        // if (!array_key_exists('date_from', $this->all())) {
        //     $this->merge(['date_from' => null]);
        // } elseif($this->date_from !== null) {
        //     $this->date_from = Carbon::parse($this->date_from)->format('Y-m-d H:i:s');
        // }

        // if (!array_key_exists('date_to', $this->all())) {
        //     $this->merge(['date_to' => null]);
        // } elseif($this->date_to !== null) {
        //     $this->date_to = Carbon::parse($this->date_to)->format('Y-m-d H:i:s');
        // }
    }
}
