<?php

namespace App\Helpers;

class APIHelpers
{
    public const SUCCESS_RESPONSE = 'success';
    public const FAILED_RESPONSE = 'fail';

    /** 
     * The basis of this function is to format all authentication API responses.
     * 
     * @param bool $hasError
     * @param string $message
     * @param array $content
     * @param string $accessToken

     * @return array
     */
    public static function formatAuthResponse($hasError, $message, $content, $accessToken)
    {
        $response = [];

        if ($hasError) {
            $response['status'] = self::FAILED_RESPONSE;
            $response['message'] = $message;
        } else {
            $response['status'] = self::SUCCESS_RESPONSE;
            if ($content == null) {
                $response['message'] = 'There is no data.';
            } else {
                $response['data'] = $content;
                $response['access_token'] = $accessToken;
                $response['message'] = $message;
            }
        }

        return $response;
    }

    /** 
     * The basis of this function is to format all API responses.
     * 
     * @param bool $hasError
     * @param string $message
     * @param array $content

     * @return array
     */
    public static function formatAPIResponse($hasError, $message, $content)
    {
        $response = [];

        if ($hasError) {
            $response['status'] = self::FAILED_RESPONSE;
            $response['data'] = $content;
            $response['message'] = $message;
        } else {
            $response['status'] = self::SUCCESS_RESPONSE;
            if ($content == null) {
                $response['message'] = $message;
            } else {
                $response['data'] = $content;
                $response['message'] = $message;
            }
        }

        return $response;
    }
}
