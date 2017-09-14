<?php

namespace App\Exceptions;

use MabeEnum\Enum;

class AppError extends Enum
{
    const VALIDATION_ERR = array(10100, 'Validation Error: Invalid Inputs.');
    const RESOURCE_NOT_FOUND = array(10111, 'No resource was found');
    const UNABLE_TO_CREATE_RESOURCE = array(10114, 'Unable to create resource');
    const CREDENTIAL_ERR = array(10112, 'Auth. Credential Error');
    const TOKEN_ERR = array(10118, 'Token Error');
    const APPLICATION_ERR = array(10123, 'Application Error');
    const AUTHORIZATION_ERR = array(10116, 'Unauthorized');

    /**
     * @return mixed
     */
    public function getErrorDetails($details)
    {
        return [
            "code" => $this->getCode(),
            "description" => $this->getMessage(),
            "details" => $details,
        ];
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->getValue()[0];
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->getValue()[1];
    }
}
