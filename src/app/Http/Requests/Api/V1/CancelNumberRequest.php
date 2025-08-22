<?php

namespace App\Http\Requests\Api\V1;

class CancelNumberRequest extends BaseApiRequest
{
    public function prepareForValidation()
    {
        $this->merge([
            'action' => 'cancelNumber'
        ]);
    }

    public function rules(): array
    {
        return [
            'action' => 'required',
            'token' => 'required|string',
            'activation' => 'required|string',
        ];
    }
}
