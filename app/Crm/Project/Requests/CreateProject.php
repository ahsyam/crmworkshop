<?php

namespace Crm\Project\Requests;

use Crm\Base\Requests\ApiRequest;

class CreateProject extends ApiRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'project_name' => 'required|min:3',
            'status' => 'required|numeric',
            'project_cost' => 'required|numeric'
        ];
    }
}
