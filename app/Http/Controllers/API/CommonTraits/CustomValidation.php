<?php

namespace App\Http\Controllers\API\CommonTraits;

use \Illuminate\Contracts\Validation\Validator;
use App\Exceptions\AppError;

trait CustomValidation
{

    public function wantsJson()
    {
        return true;
    }

    /**
     * Converts Input validation errors to JSON
     *
     * {@inheritdoc}
     */
    protected function formatErrors(Validator $validator)
    {
        return [
            'status' => false,
            'errors' => AppError::VALIDATION_ERR()->getErrorDetails($validator->errors())
        ];
    }
}
