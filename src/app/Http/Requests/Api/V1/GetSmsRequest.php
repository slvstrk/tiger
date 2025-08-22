<?php

namespace app\Http\Requests\Api\V1;

class GetSmsRequest extends BaseApiRequest
{
    public function prepareForValidation()
    {
        $this->merge([
            'action' => 'getSms'
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
