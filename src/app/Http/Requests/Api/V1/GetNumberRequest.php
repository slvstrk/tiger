<?php

namespace app\Http\Requests\Api\V1;

class GetNumberRequest extends BaseApiRequest
{
    public function prepareForValidation()
    {
        $this->merge([
            'action' => 'getNumber'
        ]);
    }

    public function rules(): array
    {
        return [
            'action' => 'required',
            'token' => 'required|string',
            'country' => 'required|string|size:2',
            'service' => 'required|string',
            'rent_time' => 'sometimes|integer',
        ];
    }
}
