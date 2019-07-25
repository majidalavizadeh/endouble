<?php
/**
 * Created by PhpStorm.
 * User: majid
 * Date: 7/24/19
 * Time: 12:50 AM
 */

namespace Utils;


/**
 * Class Response
 * @package Utils
 */
class Response
{

    /**
     * return the json response
     * @param $response
     * @param int $response_code
     */
    static public function json($response, $response_code = 200)
    {

        if (!is_array($response)) {
            $response = [
                'result' => $response
            ];
        }

        http_response_code($response_code);
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}