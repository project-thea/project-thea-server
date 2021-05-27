<?php

namespace App\Helpers;

class APIHelpers
{
    public const SUCCESS_RESPONSE = 'success';
    public const FAILED_RESPONSE = 'fail';

    /** 
     * The basis of this function is to format all authentication API responses.
     * 
     * @param bool $has_error
     * @param string $message
     * @param array $content
     * @param string $access_token

     * @return array
     */
    public static function createAuthResponse($has_error, $message, $content, $accessToken)
    {
        $result = [];

        if ($has_error) {
            $result['status'] = self::FAILED_RESPONSE;
            $result['data'] = $content;
        } else {
            $result['status'] = self::SUCCESS_RESPONSE;
            if ($content == null) {
                $result['message'] = 'The data is null.';
            } else {
                $result['data'] = $content;
                $result['access_token'] = $accessToken;
                $result['message'] = $message;
            }
        }

        return $result;
    }
}
