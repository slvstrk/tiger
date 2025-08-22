<?php

namespace app\Http\Requests\Api\V1;

class GetStatusRequest extends BaseApiRequest
{
    public function prepareForValidation()
    {
        $this->merge([
            'action' => 'getStatus'
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
