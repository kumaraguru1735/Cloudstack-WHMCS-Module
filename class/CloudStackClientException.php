<?php

/*
 * This file is part of the CloudStack PHP Client.
 *
 * (c) Vexora Solutions LLP <vexorasolutions@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

enum CloudStackError: int
{
    case ENDPOINT_EMPTY = 1000;
    case ENDPOINT_NOT_URL = 1001;
    case APIKEY_EMPTY = 1002;
    case SECRETKEY_EMPTY = 1003;
    case STRTOSIGN_EMPTY = 1004;
    case NO_COMMAND = 1005;
    case WRONG_REQUEST_ARGS = 1006;
    case NOT_A_CLOUDSTACK_SERVER = 1007;
    case NO_VALID_JSON_RECEIVED = 1008;
    case MISSING_ARGUMENT = 1009;

    public function message(): string
    {
        return match ($this) {
            self::ENDPOINT_EMPTY => "No endpoint provided.",
            self::ENDPOINT_NOT_URL => "The endpoint must be a URL (starting with http:// or https://).",
            self::APIKEY_EMPTY => "No API key provided.",
            self::SECRETKEY_EMPTY => "No secret key provided.",
            self::STRTOSIGN_EMPTY => "String to sign is empty.",
            self::NO_COMMAND => "No command given for the request.",
            self::WRONG_REQUEST_ARGS => "Arguments for the request must be in an array.",
            self::NOT_A_CLOUDSTACK_SERVER => "The response is not a CloudStack server response. Check your endpoint.",
            self::NO_VALID_JSON_RECEIVED => "The server did not issue a valid JSON response.",
            self::MISSING_ARGUMENT => "A required argument is missing.",
        };
    }
}

class CloudStackClientException extends Exception
{
    public function __construct(CloudStackError $error, ?string $customMessage = null)
    {
        $message = $customMessage ?? $error->message();
        parent::__construct($message, $error->value);
    }
}
